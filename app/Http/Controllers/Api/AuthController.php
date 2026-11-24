<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Handle incoming API login requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        // 1. Security Check: Never accept credentials through URL query parameters
        if ($request->query('password') !== null || $request->query('login') !== null || $request->query('email') !== null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kredensial tidak boleh dikirim melalui URL query parameters.',
            ], 400);
        }

        // Support both "login" and "email" in request body
        $input = $request->all();
        if (!isset($input['login']) && isset($input['email'])) {
            $input['login'] = $input['email'];
        }

        // 2. Validate required fields with Indonesian localized messages
        $validator = Validator::make($input, [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'Email atau username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data login tidak lengkap',
                'errors' => $validator->errors(),
            ], 422);
        }

        $loginIdentifier = trim($input['login']);
        $password = (string) $input['password'];

        // 3. Rate limiting / Throttling (5 attempts per minute per IP and identifier)
        $throttleKey = Str::transliterate(Str::lower($loginIdentifier) . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return response()->json([
                'status' => 'error',
                'message' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik.",
                'retry_after' => $seconds,
            ], 429);
        }

        // 4. Database user lookup (supports both Email and Phone number)
        $isEmail = filter_var($loginIdentifier, FILTER_VALIDATE_EMAIL);
        $user = User::query()
            ->when($isEmail, fn ($query) => $query->where('email', $loginIdentifier))
            ->when(!$isEmail, fn ($query) => $query->where('phone', $loginIdentifier)->orWhere('email', $loginIdentifier))
            ->first();

        // 5. Secure password verification using Hash::check()
        // Generic failure message prevents user enumeration (TC-02 & TC-03)
        if (!$user || !Hash::check($password, $user->password)) {
            RateLimiter::hit($throttleKey, 60);

            return response()->json([
                'status' => 'error',
                'message' => 'Email atau password tidak sesuai',
            ], 401);
        }

        // 6. Account Status Check (Suspended accounts are denied access)
        if ($user->isSuspended()) {
            RateLimiter::hit($throttleKey, 60);

            return response()->json([
                'status' => 'error',
                'message' => 'Akun Anda sedang dinonaktifkan. Silakan hubungi administrator.',
            ], 403);
        }

        // Clear rate limiter upon successful authentication
        RateLimiter::clear($throttleKey);

        // Update login audit telemetry (non-blocking)
        try {
            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);
        } catch (\Throwable $e) {
            // Non-critical telemetry logging
        }

        // 7. Token Generation (Sanctum compatibility or native SHA-256 token)
        $token = $this->generateApiToken($user);

        // 8. Return standardized JSON response (TC-01)
        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role ?? $user->account_type ?? 'Registered Driver',
                ],
                'token' => $token,
            ],
        ], 200);
    }

    /**
     * Retrieve authenticated user profile via Bearer token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated',
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data pengguna berhasil diambil',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role ?? $user->account_type ?? 'Registered Driver',
                ],
            ],
        ], 200);
    }

    /**
     * Revoke authenticated API Bearer token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $token = $request->bearerToken();

        if ($token) {
            $tokenHash = hash('sha256', $token);
            Cache::forget("api_token:{$tokenHash}");
        }

        // Also revoke Sanctum token if present
        $user = $request->user();
        if ($user && method_exists($user, 'currentAccessToken') && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil. Token telah dicabut.',
        ], 200);
    }

    /**
     * Generate an API access token.
     * Delegates to Sanctum if configured, or issues a secure SHA-256 hashed bearer token.
     *
     * @param  \App\Models\User  $user
     * @return string
     */
    protected function generateApiToken(User $user): string
    {
        // 1. If Sanctum Personal Access Token trait is available on model
        if (method_exists($user, 'createToken')) {
            return $user->createToken('api-token', ['api:access'])->plainTextToken;
        }

        // 2. High-entropy cryptographically secure random token (64 hex characters)
        $plainTextToken = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $plainTextToken);

        // Store hashed token with metadata in persistent cache
        Cache::put("api_token:{$tokenHash}", [
            'user_id' => $user->id,
            'role' => $user->role,
            'abilities' => ['api:access'],
            'created_at' => now()->toIso8601String(),
        ], now()->addDays(30));

        return $plainTextToken;
    }
}
