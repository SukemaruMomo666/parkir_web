<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication consent screen.
     * Supports strictly separated login and register intents.
     */
    public function redirectToGoogle(Request $request): RedirectResponse
    {
        $intent = $request->query('intent', 'login');
        if (!in_array($intent, ['login', 'register'], true)) {
            $intent = 'login';
        }

        // Store validated intent in session
        $request->session()->put('google_oauth_intent', $intent);
        $request->session()->put('google_oauth_time', now()->timestamp);

        return Socialite::driver('google')
            ->scopes(['openid', 'email', 'profile'])
            ->redirect();
    }

    /**
     * Obtain user information from Google with strict separation between Login and Registration.
     */
    public function handleGoogleCallback(Request $request): RedirectResponse
    {
        // Strictly retrieve intent from server session (cannot be manipulated via callback URL)
        $intent = $request->session()->pull('google_oauth_intent', 'login');
        $request->session()->forget('google_oauth_time');

        if (!in_array($intent, ['login', 'register'], true)) {
            $intent = 'login';
        }

        $fallbackRoute = $intent === 'register' ? 'register' : 'login';

        // 1. Detect user cancellation or OAuth error parameter
        if ($request->has('error')) {
            $errorCode = $request->query('error');
            Log::info('Google OAuth cancelled or returned error', ['error' => $errorCode, 'intent' => $intent]);

            $message = $intent === 'register'
                ? 'Pendaftaran dengan Google dibatalkan.'
                : 'Login dengan Google dibatalkan.';

            return redirect()->route($fallbackRoute)->with('error', $message);
        }

        // 2. Retrieve user identity securely with Socialite
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            Log::warning('Google OAuth InvalidStateException encountered during callback');

            return redirect()->route($fallbackRoute)->with(
                'error',
                'Sesi autentikasi kedaluwarsa atau tidak valid. Silakan coba kembali.'
            );
        } catch (\Throwable $e) {
            Log::error('Google OAuth callback unexpected failure', [
                'exception_class' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            return redirect()->route($fallbackRoute)->with(
                'error',
                'Gagal melakukan autentikasi dengan Google. Silakan coba beberapa saat lagi.'
            );
        }

        // 3. Extract and validate Google user payload
        $googleId = (string) $googleUser->getId();
        $googleEmail = strtolower(trim((string) $googleUser->getEmail()));
        $googleName = $googleUser->getName() ?: 'Pengemudi NusaPark';
        $rawGoogleUser = $googleUser->user ?? [];

        if (empty($googleId) || empty($googleEmail)) {
            return redirect()->route($fallbackRoute)->with(
                'error',
                'Identitas atau email akun Google tidak valid.'
            );
        }

        // Validate verified email status prioritizing 'verified_email' from Socialite Google provider
        $isVerified = false;
        if (isset($rawGoogleUser['verified_email'])) {
            $isVerified = filter_var($rawGoogleUser['verified_email'], FILTER_VALIDATE_BOOLEAN);
        } elseif (isset($rawGoogleUser['email_verified'])) {
            $isVerified = filter_var($rawGoogleUser['email_verified'], FILTER_VALIDATE_BOOLEAN);
        }

        if (!$isVerified) {
            return redirect()->route($fallbackRoute)->with(
                'error',
                'Email akun Google Anda belum diverifikasi oleh Google. Autentikasi ditolak demi keamanan.'
            );
        }

        // =====================================================================
        // ALUR 1: LOGIN DENGAN GOOGLE (intent === 'login')
        // =====================================================================
        if ($intent === 'login') {
            // A. Cek kecocokan berdasarkan google_id
            $matchedUser = User::where('google_id', $googleId)->first();
            if ($matchedUser) {
                // Cegah konflik identitas email
                if (strtolower(trim($matchedUser->email)) !== $googleEmail) {
                    $otherUser = User::where('email', $googleEmail)->first();
                    if ($otherUser && $otherUser->id !== $matchedUser->id) {
                        return redirect()->route('login')->with(
                            'error',
                            'Terjadi konflik akun: Akun Google ini sudah terhubung dengan pengguna lain.'
                        );
                    }
                }

                if ($matchedUser->isSuspended()) {
                    return redirect()->route('login')->with(
                        'error',
                        'Akun Anda telah disuspensi. Silakan hubungi administrator platform NusaPark.'
                    );
                }

                Auth::login($matchedUser, remember: true);
                $request->session()->regenerate();

                try {
                    $matchedUser->update([
                        'last_login_at' => now(),
                        'last_login_ip' => $request->ip(),
                    ]);
                } catch (\Throwable $e) {
                    // Non-blocking telemetry
                }

                return redirect()->intended($matchedUser->dashboardRoute())->with(
                    'success',
                    'Berhasil masuk dengan akun Google.'
                );
            }

            // B. Cek kecocokan berdasarkan email akun lokal
            $existingUser = User::where('email', $googleEmail)->first();
            if ($existingUser) {
                if ($existingUser->isSuspended()) {
                    return redirect()->route('login')->with(
                        'error',
                        'Akun lokal yang cocok dengan email ini telah disuspensi. Silakan hubungi administrator.'
                    );
                }

                // Cegah konflik jika akun lokal sudah ditautkan ke google_id yang berbeda
                if (!empty($existingUser->google_id) && $existingUser->google_id !== $googleId) {
                    return redirect()->route('login')->with(
                        'error',
                        'Email ini sudah terhubung dengan akun Google yang berbeda. Hubungan akun tidak dapat diubah demi keamanan.'
                    );
                }

                // Cegah konflik jika google_id ini sudah dipakai user lain
                $conflictUser = User::where('google_id', $googleId)->where('id', '!=', $existingUser->id)->first();
                if ($conflictUser) {
                    return redirect()->route('login')->with(
                        'error',
                        'Akun Google ini sudah terhubung dengan akun pengguna lain di NusaPark.'
                    );
                }

                // Tautkan google_id ke akun lokal tanpa mengubah role yang ada (Super Admin, Vendor, Driver)
                $existingUser->update([
                    'google_id' => $googleId,
                    'email_verified_at' => $existingUser->email_verified_at ?: now(),
                    'last_login_at' => now(),
                    'last_login_ip' => $request->ip(),
                ]);

                Auth::login($existingUser, remember: true);
                $request->session()->regenerate();

                return redirect()->intended($existingUser->dashboardRoute())->with(
                    'success',
                    'Akun Google berhasil ditautkan ke akun NusaPark Anda. Selamat datang!'
                );
            }

            // C. Email dan Google ID belum terdaftar di database NusaPark
            // TOLAK LOGIN! Jangan membuat akun baru melalui tombol Login dengan Google.
            return redirect()->route('register')->with(
                'error',
                'Akun belum terdaftar. Silakan daftar terlebih dahulu.'
            );
        }

        // =====================================================================
        // ALUR 2: REGISTRASI DENGAN GOOGLE (intent === 'register')
        // =====================================================================
        if ($intent === 'register') {
            // A. Periksa apakah email atau google_id sudah terdaftar di sistem
            $alreadyRegistered = User::where('email', $googleEmail)
                ->orWhere('google_id', $googleId)
                ->first();

            if ($alreadyRegistered) {
                // JANGAN membuat akun duplikat. Tolak dan arahkan ke login.
                return redirect()->route('login')->with(
                    'error',
                    'Akun dengan email ini sudah terdaftar. Silakan masuk menggunakan akun Anda.'
                );
            }

            // B. Buat akun baru dengan role Driver / Registered Driver
            try {
                $newUser = User::create([
                    'name' => $googleName,
                    'email' => $googleEmail,
                    'google_id' => $googleId,
                    'password' => Hash::make(Str::random(32)),
                    'account_type' => 'Driver',
                    'role' => 'Registered Driver',
                    'status' => 'Active',
                    'email_verified_at' => now(),
                    'last_login_at' => now(),
                    'last_login_ip' => $request->ip(),
                ]);

                Auth::login($newUser, remember: true);
                $request->session()->regenerate();

                return redirect()->to($newUser->dashboardRoute())->with(
                    'success',
                    'Pendaftaran berhasil! Selamat datang di NusaPark.'
                );
            } catch (\Throwable $e) {
                Log::error('Failed to create new user from Google OAuth registration', [
                    'error' => $e->getMessage(),
                ]);

                return redirect()->route('register')->with(
                    'error',
                    'Terjadi kesalahan saat membuat akun baru. Silakan coba kembali.'
                );
            }
        }

        return redirect()->route('login');
    }
}
