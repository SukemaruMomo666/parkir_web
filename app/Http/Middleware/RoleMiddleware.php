<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            return redirect()->guest('/login')->with('error', 'Please sign in to access this page.');
        }

        $user = Auth::user();

        // 1. Account Status Enforcement
        if ($user->isSuspended()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Your account has been suspended. Please contact platform administration.',
                ], 403);
            }

            return redirect('/login')->with('error', 'Your account has been suspended. Please contact platform administration.');
        }

        // 2. Role-Based Portal Access Enforcement
        $authorized = false;

        switch (strtolower($role)) {
            case 'admin':
            case 'super_admin':
            case 'superadmin':
                $authorized = $user->isSuperAdmin();
                break;

            case 'vendor':
            case 'vendor_staff':
                // Super Admins also have diagnostic oversight over vendor portals
                $authorized = $user->isVendor() || $user->isSuperAdmin();
                break;

            case 'driver':
                // All valid active users can access driver / motorist services
                $authorized = $user->isDriver() || $user->isVendor() || $user->isSuperAdmin();
                break;

            default:
                $authorized = false;
                break;
        }

        if (!$authorized) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Forbidden: You do not have permissions to access this portal.',
                ], 403);
            }

            $dashboard = $user->dashboardRoute();
            return redirect($dashboard)->with('error', 'Access denied: You do not have permission to access that area.');
        }

        return $next($request);
    }
}
