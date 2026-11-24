<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    /**
     * Fallback cache key for demo driver profile store.
     */
    protected const CACHE_KEY = 'driver_profile_alex';

    /**
     * Retrieve driver profile for authenticated user (or provided user).
     */
    public function getProfile(?User $user = null): array
    {
        if ($user === null && Auth::check()) {
            $user = Auth::user();
        }

        if ($user instanceof User) {
            $parts = preg_split('/\s+/', trim($user->name ?? ''));
            $firstName = !empty($parts[0]) ? $parts[0] : ($user->name ?? 'Driver');
            $lastName = count($parts) > 1 ? end($parts) : '';

            $initials = '';
            foreach (array_slice($parts, 0, 2) as $p) {
                if (!empty($p)) {
                    $initials .= mb_strtoupper(mb_substr($p, 0, 1));
                }
            }
            $avatarInitials = $initials ?: 'U';

            $meta = Cache::get('user_profile_meta_' . $user->id, []);
            $idCard = $meta['id_card'] ?? '';

            $defaultPreferences = [
                'notify_session' => true,
                'notify_reservation' => true,
                'notify_payment' => true,
                'notify_promo' => false,
            ];
            $preferences = array_merge($defaultPreferences, $meta['preferences'] ?? []);

            return [
                'id' => $user->id,
                'name' => $user->name,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $user->email,
                'phone' => $user->phone ?? '',
                'has_google_linked' => !empty($user->google_id),
                'id_card' => $idCard,
                'avatar_initials' => $avatarInitials,
                'driver_id' => 'NP-DRV-' . str_pad((string)$user->id, 5, '0', STR_PAD_LEFT),
                'role' => $user->role ?? ($user->account_type ?? 'Registered Driver'),
                'member_since' => $user->created_at ? $user->created_at->format('d M Y') : date('d M Y'),
                'email_verified' => !is_null($user->email_verified_at),
                'email_verified_at' => $user->email_verified_at ? $user->email_verified_at->format('d M Y, H:i') . ' WIB' : null,
                'phone_verified' => !empty($user->phone),
                'phone_verified_at' => !empty($user->phone) && $user->created_at ? $user->created_at->format('d M Y, H:i') . ' WIB' : null,
                'preferences' => $preferences,
                'created_at' => $user->created_at ? $user->created_at->toDateTimeString() : date('Y-m-d H:i:s'),
                'updated_at' => $user->updated_at ? $user->updated_at->toDateTimeString() : date('Y-m-d H:i:s'),
            ];
        }

        return Cache::get(self::CACHE_KEY, function () {
            $seed = $this->seedProfile();
            Cache::put(self::CACHE_KEY, $seed, now()->addDays(7));
            return $seed;
        });
    }

    /**
     * Validate profile update fields.
     */
    public function validateProfile(array $data, ?int $currentUserId = null): array
    {
        $errors = [];

        $name = trim($data['name'] ?? '');
        if (empty($name)) {
            $errors['name'] = 'Full name is required.';
        } elseif (strlen($name) < 2 || strlen($name) > 100) {
            $errors['name'] = 'Full name must be between 2 and 100 characters.';
        }

        $email = trim($data['email'] ?? '');
        if (empty($email)) {
            $errors['email'] = 'Email address is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        } else {
            $emailExists = User::where('email', strtolower($email))
                ->when($currentUserId, fn($q) => $q->where('id', '!=', $currentUserId))
                ->exists();
            if ($emailExists) {
                $errors['email'] = 'Email address is already in use by another account.';
            }
        }

        $phone = trim($data['phone'] ?? '');
        if (empty($phone)) {
            $errors['phone'] = 'Phone number is required.';
        } else {
            $cleanPhone = preg_replace('/[^\d+]/', '', $phone);
            if (strlen($cleanPhone) < 8 || strlen($cleanPhone) > 20) {
                $errors['phone'] = 'Please enter a valid phone number (8–20 digits).';
            } else {
                $phoneExists = User::where(function ($q) use ($phone, $cleanPhone) {
                        $q->where('phone', $phone)->orWhere('phone', $cleanPhone);
                    })
                    ->when($currentUserId, fn($q) => $q->where('id', '!=', $currentUserId))
                    ->exists();
                if ($phoneExists) {
                    $errors['phone'] = 'Phone number is already registered to another account.';
                }
            }
        }

        $idCard = trim($data['id_card'] ?? '');
        if (!empty($idCard) && strlen($idCard) > 30) {
            $errors['id_card'] = 'National ID or License number must not exceed 30 characters.';
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors,
            'sanitized' => [
                'name' => $name,
                'email' => strtolower($email),
                'phone' => $phone,
                'id_card' => $idCard,
            ],
        ];
    }

    /**
     * Update profile details.
     */
    public function updateProfile(array $sanitized, ?User $user = null): array
    {
        if ($user === null && Auth::check()) {
            $user = Auth::user();
        }

        if ($user instanceof User) {
            $user->name = $sanitized['name'];

            if (strtolower($sanitized['email']) !== strtolower($user->email)) {
                $user->email = $sanitized['email'];
                $user->email_verified_at = null;
            }

            if (!empty($sanitized['phone']) && $sanitized['phone'] !== $user->phone) {
                $user->phone = $sanitized['phone'];
            }

            $user->save();

            // Persist user-specific metadata
            $meta = Cache::get('user_profile_meta_' . $user->id, []);
            $meta['id_card'] = $sanitized['id_card'];
            Cache::put('user_profile_meta_' . $user->id, $meta, now()->addDays(30));

            return ['success' => true, 'profile' => $this->getProfile($user)];
        }

        // Demo fallback
        $profile = $this->getProfile();

        $profile['name'] = $sanitized['name'];
        $parts = explode(' ', $sanitized['name']);
        $profile['first_name'] = $parts[0] ?? $sanitized['name'];
        $profile['last_name'] = count($parts) > 1 ? end($parts) : '';
        
        $initials = '';
        foreach (array_slice($parts, 0, 2) as $p) {
            if (!empty($p)) {
                $initials .= strtoupper($p[0]);
            }
        }
        $profile['avatar_initials'] = $initials ?: 'A';

        if (strtolower($sanitized['email']) !== strtolower($profile['email'])) {
            $profile['email'] = $sanitized['email'];
            $profile['email_verified'] = false;
            $profile['email_verified_at'] = null;
        }

        if ($sanitized['phone'] !== $profile['phone']) {
            $profile['phone'] = $sanitized['phone'];
            $profile['phone_verified'] = false;
            $profile['phone_verified_at'] = null;
        }

        $profile['id_card'] = $sanitized['id_card'];
        $profile['updated_at'] = date('Y-m-d H:i:s');

        $this->persistProfile($profile);

        return ['success' => true, 'profile' => $profile];
    }

    /**
     * Validate and update password.
     */
    public function updatePassword(array $data, ?User $user = null): array
    {
        if ($user === null && Auth::check()) {
            $user = Auth::user();
        }

        $errors = [];

        $current = $data['current_password'] ?? '';
        $new = $data['new_password'] ?? '';
        $confirm = $data['new_password_confirmation'] ?? '';

        if (empty($current)) {
            $errors['current_password'] = 'Current password is required.';
        }

        if (empty($new)) {
            $errors['new_password'] = 'New password is required.';
        } elseif (strlen($new) < 8) {
            $errors['new_password'] = 'New password must be at least 8 characters long.';
        }

        if ($new !== $confirm) {
            $errors['new_password_confirmation'] = 'Password confirmation does not match.';
        }

        if (!empty($errors)) {
            return ['valid' => false, 'errors' => $errors];
        }

        if ($user instanceof User) {
            $isCorrect = Hash::check($current, $user->password);

            // Allow demo passwords for dev seeder user alex.driver
            if (!$isCorrect && in_array($current, ['password', 'password123', 'admin123', 'secret123', 'nusapark2026'], true) && $user->email === 'alex.driver@nusapark.id') {
                $isCorrect = true;
            }

            if (!$isCorrect) {
                return [
                    'valid' => false,
                    'errors' => ['current_password' => 'The provided current password does not match our records.'],
                ];
            }

            $user->password = Hash::make($new);
            $user->save();

            return ['valid' => true, 'success' => true];
        }

        // Demo fallback
        $validCurrents = ['password', 'password123', 'admin123', 'secret123', 'nusapark2026'];
        $profile = $this->getProfile();
        if (!empty($profile['custom_password_hash'])) {
            $validCurrents[] = $profile['custom_password_plain'] ?? '';
        }

        if (!in_array($current, $validCurrents, true) && !empty($profile['custom_password_plain']) && $current !== $profile['custom_password_plain']) {
            return [
                'valid' => false,
                'errors' => ['current_password' => 'The provided current password does not match our records.'],
            ];
        }

        $profile['custom_password_plain'] = $new;
        $profile['custom_password_hash'] = password_hash($new, PASSWORD_BCRYPT);
        $profile['password_updated_at'] = date('Y-m-d H:i:s');

        $this->persistProfile($profile);

        return ['valid' => true, 'success' => true];
    }

    /**
     * Update notification & communication preferences.
     */
    public function updatePreferences(array $data, ?User $user = null): array
    {
        if ($user === null && Auth::check()) {
            $user = Auth::user();
        }

        $preferences = [
            'notify_session' => !empty($data['notify_session']),
            'notify_reservation' => !empty($data['notify_reservation']),
            'notify_payment' => !empty($data['notify_payment']),
            'notify_promo' => !empty($data['notify_promo']),
        ];

        if ($user instanceof User) {
            $meta = Cache::get('user_profile_meta_' . $user->id, []);
            $meta['preferences'] = $preferences;
            Cache::put('user_profile_meta_' . $user->id, $meta, now()->addDays(30));

            return ['success' => true, 'preferences' => $preferences];
        }

        $profile = $this->getProfile();
        $profile['preferences'] = $preferences;
        $profile['updated_at'] = date('Y-m-d H:i:s');

        $this->persistProfile($profile);

        return ['success' => true, 'preferences' => $profile['preferences']];
    }

    /**
     * Save profile state to cache.
     */
    protected function persistProfile(array $profile): void
    {
        Cache::put(self::CACHE_KEY, $profile, now()->addDays(7));
    }

    /**
     * Seed authoritative driver profile for fallback demo.
     */
    protected function seedProfile(): array
    {
        return [
            'name' => 'Alex Chandra',
            'first_name' => 'Alex',
            'last_name' => 'Chandra',
            'email' => 'alex@example.com',
            'phone' => '+62 812-3456-7890',
            'id_card' => '3171052408920003',
            'avatar_initials' => 'AC',
            'driver_id' => 'NP-DRV-84920',
            'role' => 'Verified Driver',
            'member_since' => '15 Aug 2026',
            'email_verified' => true,
            'email_verified_at' => '15 Aug 2026, 09:30 WIB',
            'phone_verified' => true,
            'phone_verified_at' => '15 Aug 2026, 09:32 WIB',
            'custom_password_plain' => 'password123',
            'preferences' => [
                'notify_session' => true,
                'notify_reservation' => true,
                'notify_payment' => true,
                'notify_promo' => false,
            ],
            'created_at' => '2026-08-15 09:30:00',
            'updated_at' => '2026-10-11 10:00:00',
        ];
    }
}
