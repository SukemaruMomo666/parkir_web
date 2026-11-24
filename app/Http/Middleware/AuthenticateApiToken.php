<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApiToken
{
    /**
     * Handle an incoming request for token-protected API endpoints.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated: Token bearer diperlukan.',
            ], 401);
        }

        // 1. Check native high-entropy SHA-256 token cache
        $tokenHash = hash('sha256', $token);
        $tokenData = Cache::get("api_token:{$tokenHash}");

        $user = null;
        if ($tokenData && isset($tokenData['user_id'])) {
            $user = User::find($tokenData['user_id']);
        }

        // 2. Check Sanctum PersonalAccessToken if Sanctum package is present
        if (!$user && class_exists(\Laravel\Sanctum\PersonalAccessToken::class)) {
            $accessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($token);
            if ($accessToken && $accessToken->tokenable instanceof User) {
                $user = $accessToken->tokenable;
            }
        }

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated: Token tidak valid atau sudah kadaluarsa.',
            ], 401);
        }

        if ($user->isSuspended()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akun Anda sedang dinonaktifkan. Silakan hubungi administrator.',
            ], 403);
        }

        // Bind user to request
        $request->setUserResolver(fn () => $user);

        return $next($request);
    }
}
