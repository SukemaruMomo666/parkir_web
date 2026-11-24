<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display the login view or redirect if already authenticated.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect(Auth::user()->dashboardRoute());
        }

        return view('auth', ['mode' => 'login']);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request): JsonResponse|RedirectResponse
    {
        // 1. Server-side validation
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
        ]);

        $loginIdentifier = trim($validated['login']);
        $password = $validated['password'];
        $remember = $request->boolean('remember');

        // 2. Rate limiting / Throttling by IP and Identifier
        $throttleKey = Str::transliterate(Str::lower($loginIdentifier) . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $message = "Too many login attempts. Please try again in {$seconds} seconds.";

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $message,
                    'retry_after' => $seconds,
                ], 429);
            }

            return back()->withInput($request->only('login', 'remember'))->withErrors([
                'login' => $message,
            ]);
        }

        // 3. Database lookup by email or phone
        $isEmail = filter_var($loginIdentifier, FILTER_VALIDATE_EMAIL);
        $user = User::query()
            ->when($isEmail, fn ($query) => $query->where('email', $loginIdentifier))
            ->when(!$isEmail, fn ($query) => $query->where('phone', $loginIdentifier)->orWhere('email', $loginIdentifier))
            ->first();

        // 4. Verify password securely using Laravel's Hash::check()
        // Generic error returned if user does not exist or password mismatch
        if (!$user || !Hash::check($password, $user->password)) {
            RateLimiter::hit($throttleKey, 60);

            $genericErrorMessage = 'The provided credentials do not match our records.';

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $genericErrorMessage,
                    'errors' => [
                        'login' => [$genericErrorMessage],
                    ],
                ], 422);
            }

            return back()->withInput($request->only('login', 'remember'))->withErrors([
                'login' => $genericErrorMessage,
            ]);
        }

        // 5. Account status checks
        if ($user->isSuspended()) {
            RateLimiter::hit($throttleKey, 60);
            $suspendedMessage = 'Your account has been suspended. Please contact platform administration.';

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $suspendedMessage,
                ], 403);
            }

            return back()->withInput($request->only('login'))->withErrors([
                'login' => $suspendedMessage,
            ]);
        }

        // 6. Clear rate limiter on successful authentication
        RateLimiter::clear($throttleKey);

        // 7. Log in user and regenerate session to protect against session fixation
        Auth::login($user, $remember);
        $request->session()->regenerate();

        // Update login audit telemetry
        try {
            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);
        } catch (\Throwable $e) {
            // Non-blocking telemetry
        }

        // 8. Role-aware redirect resolution with validation against privilege bypass
        $targetDashboard = $user->dashboardRoute();
        $intendedUrl = redirect()->intended($targetDashboard)->getTargetUrl();

        // Prevent cross-portal privilege escalation via manipulated intended URLs
        $finalDestination = $targetDashboard;
        if (!empty($intendedUrl) && str_starts_with($intendedUrl, url('/'))) {
            $path = parse_url($intendedUrl, PHP_URL_PATH) ?? '';
            if (str_starts_with($path, '/admin') && !$user->isSuperAdmin()) {
                $finalDestination = $targetDashboard;
            } elseif (str_starts_with($path, '/vendor') && !$user->isVendor() && !$user->isSuperAdmin()) {
                $finalDestination = $targetDashboard;
            } else {
                $finalDestination = $intendedUrl;
            }
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Signed in successfully. Redirecting...',
                'redirect' => $finalDestination,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'account_type' => $user->account_type,
                    'role' => $user->role,
                ],
            ]);
        }

        return redirect()->to($finalDestination);
    }

    /**
     * Terminate the authenticated session.
     */
    public function logout(Request $request): RedirectResponse|JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Signed out successfully.',
                'redirect' => route('login'),
            ]);
        }

        return redirect('/login')->with('success', 'You have been signed out successfully.');
    }

    /**
     * Display registration view or redirect if already authenticated.
     */
    public function showRegisterForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect(Auth::user()->dashboardRoute());
        }

        return view('auth', ['mode' => 'register']);
    }

    /**
     * Handle user account registration.
     */
    public function register(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['nullable', 'string', 'max:30', 'unique:users,phone'],
            'terms' => ['accepted'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => strtolower(trim($validated['email'])),
            'phone' => !empty($validated['phone']) ? trim($validated['phone']) : null,
            'password' => Hash::make($validated['password']),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
            'email_verified_at' => now(),
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        $dashboard = $user->dashboardRoute();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Account created successfully. Welcome to NusaPark!',
                'redirect' => $dashboard,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'account_type' => $user->account_type,
                    'role' => $user->role,
                ],
            ]);
        }

        return redirect()->to($dashboard)->with('success', 'Welcome to NusaPark! Your account has been created.');
    }

    /**
     * Display forgot password view.
     */
    public function showForgotPasswordForm(): View
    {
        return view('auth', ['mode' => 'forgot']);
    }

    /**
     * Display verification view.
     */
    public function showVerifyForm(): View
    {
        return view('auth', ['mode' => 'verify']);
    }
}
