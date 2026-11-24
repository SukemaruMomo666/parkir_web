<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use App\Services\VehicleService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    protected ProfileService $profileService;
    protected VehicleService $vehicleService;
    protected NotificationService $notificationService;

    public function __construct(
        ProfileService $profileService,
        VehicleService $vehicleService,
        NotificationService $notificationService
    ) {
        $this->profileService = $profileService;
        $this->vehicleService = $vehicleService;
        $this->notificationService = $notificationService;
    }

    /**
     * Display the Driver Profile page (Page 19).
     */
    public function index(Request $request): View
    {
        $profile = $this->profileService->getProfile($request->user());
        $vehicles = $this->vehicleService->getUserVehicles();
        $defaultVehicle = $this->vehicleService->getDefaultVehicle();
        $unreadCount = $this->notificationService->getUnreadCount();

        // Check active session status
        $hasActiveSession = false;
        $activeSessionVehicle = null;
        foreach ($vehicles as $v) {
            if (!empty($v['has_active_session'])) {
                $hasActiveSession = true;
                $activeSessionVehicle = $v;
                break;
            }
        }

        return view('profile', [
            'profile' => $profile,
            'vehicles' => $vehicles,
            'vehicleCount' => count($vehicles),
            'defaultVehicle' => $defaultVehicle,
            'hasActiveSession' => $hasActiveSession,
            'activeSessionVehicle' => $activeSessionVehicle,
            'unreadCount' => $unreadCount,
            'profileSuccess' => session('profile_success'),
            'passwordSuccess' => session('password_success'),
            'preferencesSuccess' => session('preferences_success'),
            'profileError' => session('profile_error'),
        ]);
    }

    /**
     * Update driver personal information.
     */
    public function update(Request $request): RedirectResponse
    {
        $validation = $this->profileService->validateProfile($request->all(), $request->user()?->id);

        if (!$validation['valid']) {
            return redirect('/profile#personal-info')
                ->withErrors($validation['errors'])
                ->withInput();
        }

        $result = $this->profileService->updateProfile($validation['sanitized'], $request->user());

        if ($result['success']) {
            return redirect('/profile#personal-info')
                ->with('profile_success', 'Your personal information has been updated successfully.');
        }

        return redirect('/profile#personal-info')
            ->with('profile_error', 'Failed to update profile. Please try again.');
    }

    /**
     * Update account password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $result = $this->profileService->updatePassword($request->all(), $request->user());

        if (!$result['valid']) {
            return redirect('/profile#security')
                ->withErrors($result['errors'])
                ->withInput();
        }

        return redirect('/profile#security')
            ->with('password_success', 'Your password has been changed successfully.');
    }

    /**
     * Update notification preferences.
     */
    public function updatePreferences(Request $request): RedirectResponse
    {
        $this->profileService->updatePreferences($request->all(), $request->user());

        return redirect('/profile#preferences')
            ->with('preferences_success', 'Notification preferences saved.');
    }
}
