<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public & Marketing Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', function () {
    return view('search');
});

Route::get('/locations', function () {
    return view('locations');
});

Route::get('/location-detail', function () {
    return view('location-detail');
});

Route::get('/pricing', function () {
    return view('pricing');
});

Route::get('/how-it-works', function () {
    return view('how-it-works');
});

Route::get('/faq', function () {
    return view('faq');
});

/*
|--------------------------------------------------------------------------
| Authentication & Account Lifecycle Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::get('/verify', [AuthController::class, 'showVerifyForm'])->name('verification.notice');

// Google OAuth 2.0 (Login & Registrasi Otomatis)
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

/*
|--------------------------------------------------------------------------
| Driver Protected Routes (Motorist Portal)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:driver'])->group(function () {
    Route::get('/dashboard', function () {
        $hasActiveParking = request()->query('active', '1') === '1';
        return view('dashboard', [
            'hasActiveParking' => $hasActiveParking,
        ]);
    })->name('dashboard');

    Route::get('/parking-map', function () {
        return view('parking-map');
    })->name('parking-map');

    Route::get('/app/search', function () {
        return view('app-search');
    })->name('app.search');

    Route::get('/active-parking', function () {
        $hasActiveSession = request()->query('active', '1') === '1';
        return view('active-parking', ['hasActiveSession' => $hasActiveSession]);
    })->name('active-parking');

    Route::get('/reservations', function () {
        $supported = request()->query('supported', '1') === '1';
        return view('reservations', [
            'supported' => $supported,
        ]);
    })->name('reservations');

    // Page 15: Payment
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/status/{transactionId}', [PaymentController::class, 'status'])->name('payment.status');
    Route::post('/payment/simulate', [PaymentController::class, 'simulate'])->name('payment.simulate');

    // Page 16: History
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/history/receipt/{id}', [HistoryController::class, 'receipt'])->name('history.receipt');

    // Page 17: My Vehicles
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');
    Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::post('/vehicles/{id}/default', [VehicleController::class, 'setDefault'])->name('vehicles.default');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    // Page 18: Driver Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/api/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');

    // Page 19: Driver Profile & Account Settings
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/settings', [ProfileController::class, 'index'])->name('settings');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::put('/profile/preferences', [ProfileController::class, 'updatePreferences'])->name('profile.preferences');
});

/*
|--------------------------------------------------------------------------
| Vendor Protected Routes (Tenant / Facility Operator Portal)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:vendor'])->group(function () {
    // Phase 2, Page 20: Vendor Dashboard
    Route::get('/vendor', function () {
        return redirect('/vendor/dashboard');
    });
    Route::get('/vendor/dashboard', [VendorController::class, 'dashboard'])->name('vendor.dashboard');
    Route::get('/api/vendor/stats', [VendorController::class, 'apiStats'])->name('vendor.stats');

    // Phase 2, Page 21: Vendor Locations Management
    Route::get('/vendor/locations', [VendorController::class, 'locations'])->name('vendor.locations');
    Route::post('/vendor/locations', [VendorController::class, 'storeLocation'])->name('vendor.locations.store');
    Route::put('/vendor/locations/{id}', [VendorController::class, 'updateLocation'])->name('vendor.locations.update');
    Route::patch('/vendor/locations/{id}/status', [VendorController::class, 'toggleLocationStatus'])->name('vendor.locations.status');
    Route::get('/api/vendor/locations/{id}', [VendorController::class, 'apiLocation'])->name('vendor.locations.detail');

    // Phase 2, Page 22: Vendor Parking Area Management
    Route::get('/vendor/parking-areas', [VendorController::class, 'areas'])->name('vendor.areas');
    Route::post('/vendor/parking-areas', [VendorController::class, 'storeParkingArea'])->name('vendor.areas.store');
    Route::put('/vendor/parking-areas/{id}', [VendorController::class, 'updateParkingArea'])->name('vendor.areas.update');
    Route::patch('/vendor/parking-areas/{id}/status', [VendorController::class, 'toggleParkingAreaStatus'])->name('vendor.areas.status');
    Route::get('/api/vendor/parking-areas/{id}', [VendorController::class, 'apiParkingArea'])->name('vendor.areas.detail');

    // Phase 2, Page 23: Vendor Parking Map
    Route::get('/vendor/parking-map', [VendorController::class, 'parkingMap'])->name('vendor.map');
    Route::get('/api/vendor/map/{facilityId}', [VendorController::class, 'apiMapData'])->name('vendor.map.data');

    // Phase 2, Page 24: Vendor Parking Slots
    Route::get('/vendor/parking-slots', [VendorController::class, 'slots'])->name('vendor.slots');
    Route::post('/vendor/parking-slots', [VendorController::class, 'storeSlot'])->name('vendor.slots.store');
    Route::put('/vendor/parking-slots/{id}', [VendorController::class, 'updateSlot'])->name('vendor.slots.update');
    Route::patch('/vendor/parking-slots/{id}/status', [VendorController::class, 'toggleSlotStatus'])->name('vendor.slots.status');
    Route::delete('/vendor/parking-slots/{id}', [VendorController::class, 'destroySlot'])->name('vendor.slots.destroy');
    Route::get('/api/vendor/parking-slots/{id}', [VendorController::class, 'apiSlot'])->name('vendor.slots.detail');

    // Phase 2, Page 25: Vendor Gates
    Route::get('/vendor/gates', [VendorController::class, 'gates'])->name('vendor.gates');
    Route::post('/vendor/gates', [VendorController::class, 'storeGate'])->name('vendor.gates.store');
    Route::put('/vendor/gates/{id}', [VendorController::class, 'updateGate'])->name('vendor.gates.update');
    Route::post('/vendor/gates/{id}/command', [VendorController::class, 'executeGateCommand'])->name('vendor.gates.command');
    Route::patch('/vendor/gates/{id}/status', [VendorController::class, 'toggleGateStatus'])->name('vendor.gates.status');
    Route::delete('/vendor/gates/{id}', [VendorController::class, 'destroyGate'])->name('vendor.gates.destroy');
    Route::get('/api/vendor/gates/{id}', [VendorController::class, 'apiGate'])->name('vendor.gates.detail');
    Route::get('/api/vendor/gates/{id}/logs', [VendorController::class, 'apiGateLogs'])->name('vendor.gates.logs');

    // Phase 2, Page 26: Vendor ANPR Cameras & Recognition Events
    Route::get('/vendor/anpr', [VendorController::class, 'anpr'])->name('vendor.anpr');
    Route::post('/vendor/anpr/events/{id}/review', [VendorController::class, 'reviewEvent'])->name('vendor.anpr.review');
    Route::get('/api/vendor/anpr/events/{id}', [VendorController::class, 'apiAnprEvent'])->name('vendor.anpr.event.detail');
    Route::get('/api/vendor/anpr/cameras/{id}', [VendorController::class, 'apiAnprCamera'])->name('vendor.anpr.camera.detail');

    // Phase 2, Page 27: Vendor IoT Devices Inventory & Monitoring
    Route::get('/vendor/iot-devices', [VendorController::class, 'iotDevices'])->name('vendor.iot');
    Route::post('/vendor/iot-devices', [VendorController::class, 'storeIotDevice'])->name('vendor.iot.store');
    Route::put('/vendor/iot-devices/{id}', [VendorController::class, 'updateIotDevice'])->name('vendor.iot.update');
    Route::patch('/vendor/iot-devices/{id}/status', [VendorController::class, 'toggleIotDeviceStatus'])->name('vendor.iot.status');
    Route::delete('/vendor/iot-devices/{id}', [VendorController::class, 'destroyIotDevice'])->name('vendor.iot.destroy');
    Route::get('/api/vendor/iot-devices/{id}', [VendorController::class, 'apiIotDevice'])->name('vendor.iot.detail');
    Route::post('/api/vendor/iot-devices/{id}/ping', [VendorController::class, 'apiPingIotDevice'])->name('vendor.iot.ping');

    // Phase 2, Page 28: Vendor Parking Sessions
    Route::get('/vendor/parking-sessions', [VendorController::class, 'sessions'])->name('vendor.sessions');
    Route::get('/vendor/parking-sessions/export', [VendorController::class, 'exportSessions'])->name('vendor.sessions.export');
    Route::post('/vendor/parking-sessions/{id}/flag', [VendorController::class, 'flagSession'])->name('vendor.sessions.flag');
    Route::post('/vendor/parking-sessions/{id}/resolve', [VendorController::class, 'resolveSession'])->name('vendor.sessions.resolve');
    Route::get('/api/vendor/parking-sessions/{id}', [VendorController::class, 'apiSession'])->name('vendor.sessions.detail');

    // Phase 2, Page 29: Vendor Transactions
    Route::get('/vendor/transactions', [VendorController::class, 'transactions'])->name('vendor.transactions');
    Route::get('/vendor/transactions/export', [VendorController::class, 'exportTransactions'])->name('vendor.transactions.export');
    Route::post('/vendor/transactions/{id}/reconcile', [VendorController::class, 'reconcileTransaction'])->name('vendor.transactions.reconcile');
    Route::get('/api/vendor/transactions/{id}', [VendorController::class, 'apiTransaction'])->name('vendor.transactions.detail');

    // Phase 2, Page 30: Vendor Revenue
    Route::get('/vendor/revenue', [VendorController::class, 'revenue'])->name('vendor.revenue');
    Route::get('/vendor/revenue/export', [VendorController::class, 'exportRevenue'])->name('vendor.revenue.export');
    Route::get('/api/vendor/revenue', [VendorController::class, 'apiRevenue'])->name('vendor.revenue.api');

    // Phase 2, Page 31: Vendor Reports
    Route::get('/vendor/reports', [VendorController::class, 'reports'])->name('vendor.reports');
    Route::get('/vendor/reports/export', [VendorController::class, 'exportReports'])->name('vendor.reports.export');

    // Phase 2, Page 32: Vendor Staff
    Route::get('/vendor/staff', [VendorController::class, 'staff'])->name('vendor.staff');
    Route::post('/vendor/staff', [VendorController::class, 'storeStaff'])->name('vendor.staff.store');
    Route::put('/vendor/staff/{id}', [VendorController::class, 'updateStaff'])->name('vendor.staff.update');
    Route::patch('/vendor/staff/{id}/status', [VendorController::class, 'toggleStaffStatus'])->name('vendor.staff.status');
    Route::post('/vendor/staff/{id}/resend-invitation', [VendorController::class, 'resendInvitation'])->name('vendor.staff.resend');
    Route::delete('/vendor/staff/{id}', [VendorController::class, 'destroyStaff'])->name('vendor.staff.destroy');
    Route::get('/api/vendor/staff/{id}', [VendorController::class, 'apiStaffDetail'])->name('vendor.staff.detail');

    // Phase 2, Page 34: Vendor Billing
    Route::get('/vendor/billing', [VendorController::class, 'billing'])->name('vendor.billing');
    Route::post('/vendor/billing/invoices/{id}/pay', [VendorController::class, 'payInvoice'])->name('vendor.billing.pay');
    Route::get('/vendor/billing/invoices/{id}/export', [VendorController::class, 'exportInvoice'])->name('vendor.billing.export');
    Route::get('/vendor/billing/export', [VendorController::class, 'exportBillingLedger'])->name('vendor.billing.exportLedger');
    Route::get('/api/vendor/billing/invoices/{id}', [VendorController::class, 'apiInvoice'])->name('vendor.billing.detail');

    // Phase 2, Page 35: Vendor Notifications & Operational Alerts
    Route::get('/vendor/notifications', [VendorController::class, 'notifications'])->name('vendor.notifications');
    Route::post('/vendor/notifications/read-all', [VendorController::class, 'markAllNotificationsRead'])->name('vendor.notifications.readAll');
    Route::post('/vendor/notifications/bulk-read', [VendorController::class, 'bulkMarkNotificationsRead'])->name('vendor.notifications.bulkRead');
    Route::post('/vendor/notifications/{id}/read', [VendorController::class, 'markNotificationRead'])->name('vendor.notifications.read');
    Route::delete('/vendor/notifications/{id}', [VendorController::class, 'destroyNotification'])->name('vendor.notifications.destroy');
    Route::get('/api/vendor/notifications/unread-count', [VendorController::class, 'apiNotificationUnreadCount'])->name('vendor.notifications.unreadCount');
    Route::get('/api/vendor/notifications/{id}', [VendorController::class, 'apiNotificationDetail'])->name('vendor.notifications.detail');

    // Phase 2, Page 36: Vendor Settings & Organization Profile
    Route::get('/vendor/settings', [VendorController::class, 'settings'])->name('vendor.settings');
    Route::post('/vendor/settings', [VendorController::class, 'updateSettings'])->name('vendor.settings.update');
    Route::post('/vendor/settings/reset', [VendorController::class, 'resetSettingsDefaults'])->name('vendor.settings.reset');
    Route::get('/api/vendor/settings', [VendorController::class, 'apiSettings'])->name('vendor.settings.api');
});

/*
|--------------------------------------------------------------------------
| Super Admin Protected Routes (Platform Root Ops)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Phase 3, Page 37: Super Admin National Dashboard
    Route::get('/admin', function () {
        return redirect('/admin/dashboard');
    });
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/api/admin/metrics', [AdminController::class, 'apiMetrics'])->name('admin.metrics');
    Route::get('/api/admin/health', [AdminController::class, 'apiHealth'])->name('admin.health');

    // Phase 3, Page 38: Super Admin Indonesia Map
    Route::get('/admin/map', [AdminController::class, 'map'])->name('admin.map');
    Route::get('/api/admin/locations', [AdminController::class, 'apiLocations'])->name('admin.locations.api');
    Route::get('/api/admin/locations/{id}', [AdminController::class, 'apiLocationDetail'])->name('admin.locations.detail');

    // Phase 3, Page 39: Super Admin Tenant Management
    Route::get('/admin/tenants', [AdminController::class, 'tenants'])->name('admin.tenants');
    Route::post('/admin/tenants', [AdminController::class, 'storeTenant'])->name('admin.tenants.store');
    Route::put('/admin/tenants/{id}', [AdminController::class, 'updateTenant'])->name('admin.tenants.update');
    Route::patch('/admin/tenants/{id}/status', [AdminController::class, 'updateTenantStatus'])->name('admin.tenants.status');
    Route::get('/admin/tenants/export', [AdminController::class, 'exportTenants'])->name('admin.tenants.export');
    Route::get('/api/admin/tenants/{id}', [AdminController::class, 'apiTenant'])->name('admin.tenants.detail');

    // Phase 3, Page 40: Super Admin Location Management
    Route::get('/admin/locations', [AdminController::class, 'locations'])->name('admin.locations');
    Route::post('/admin/locations', [AdminController::class, 'storeLocation'])->name('admin.locations.store');
    Route::put('/admin/locations/{id}', [AdminController::class, 'updateLocation'])->name('admin.locations.update');
    Route::patch('/admin/locations/{id}/status', [AdminController::class, 'updateLocationStatus'])->name('admin.locations.status');
    Route::get('/admin/locations/export', [AdminController::class, 'exportLocations'])->name('admin.locations.export');

    // Phase 3, Page 41: Super Admin User Management
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::patch('/admin/users/{id}/status', [AdminController::class, 'updateUserStatus'])->name('admin.users.status');
    Route::post('/admin/users/{id}/reset-password', [AdminController::class, 'resetUserPassword'])->name('admin.users.resetPassword');
    Route::get('/admin/users/export', [AdminController::class, 'exportUsers'])->name('admin.users.export');

    // Phase 3, Page 42: Super Admin IoT Monitoring
    Route::get('/admin/iot', [AdminController::class, 'iot'])->name('admin.iot');
    Route::post('/admin/iot/{id}/ping', [AdminController::class, 'pingIotDevice'])->name('admin.iot.ping');
    Route::patch('/admin/iot/{id}/status', [AdminController::class, 'updateIotDeviceStatus'])->name('admin.iot.status');
    Route::get('/admin/iot/export', [AdminController::class, 'exportIot'])->name('admin.iot.export');
    Route::get('/api/admin/iot/{id}', [AdminController::class, 'apiIotDevice'])->name('admin.iot.detail');

    // Phase 3, Page 43: Super Admin Transaction Monitoring
    Route::get('/admin/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::post('/admin/transactions/{id}/verify', [AdminController::class, 'verifyGatewayTransaction'])->name('admin.transactions.verify');
    Route::patch('/admin/transactions/{id}/settlement', [AdminController::class, 'updateTransactionSettlement'])->name('admin.transactions.settlement');
    Route::get('/admin/transactions/export', [AdminController::class, 'exportTransactions'])->name('admin.transactions.export');
    Route::get('/api/admin/transactions/{id}', [AdminController::class, 'apiTransaction'])->name('admin.transactions.detail');

    // Phase 3, Page 44: Super Admin Revenue Analytics
    Route::get('/admin/revenue', [AdminController::class, 'revenue'])->name('admin.revenue');
    Route::get('/admin/revenue/export', [AdminController::class, 'exportRevenue'])->name('admin.revenue.export');
    Route::get('/api/admin/revenue', [AdminController::class, 'apiRevenue'])->name('admin.revenue.api');

    // Phase 3, Page 45: Super Admin Subscription Management
    Route::get('/admin/subscriptions', [AdminController::class, 'subscriptions'])->name('admin.subscriptions');
    Route::post('/admin/subscriptions/{id}/plan', [AdminController::class, 'changeSubscriptionPlan'])->name('admin.subscriptions.plan');
    Route::post('/admin/subscriptions/{id}/extend-trial', [AdminController::class, 'extendSubscriptionTrial'])->name('admin.subscriptions.extendTrial');
    Route::patch('/admin/subscriptions/{id}/status', [AdminController::class, 'updateSubscriptionStatus'])->name('admin.subscriptions.status');
    Route::patch('/admin/subscriptions/{id}/auto-renew', [AdminController::class, 'toggleSubscriptionAutoRenew'])->name('admin.subscriptions.autoRenew');
    Route::put('/admin/subscriptions/plans/{id}', [AdminController::class, 'updateSubscriptionPlanConfig'])->name('admin.subscriptions.updatePlan');
    Route::get('/admin/subscriptions/export', [AdminController::class, 'exportSubscriptions'])->name('admin.subscriptions.export');
    Route::get('/api/admin/subscriptions/{id}', [AdminController::class, 'apiSubscription'])->name('admin.subscriptions.detail');

    // Phase 3, Page 46: Super Admin Billing Platform
    Route::get('/admin/billing', [AdminController::class, 'billing'])->name('admin.billing');
    Route::post('/admin/billing/invoices/{id}/reconcile', [AdminController::class, 'reconcileBillingPayment'])->name('admin.billing.reconcile');
    Route::patch('/admin/billing/invoices/{id}/void', [AdminController::class, 'voidBillingInvoice'])->name('admin.billing.void');
    Route::post('/admin/billing/invoices/{id}/remind', [AdminController::class, 'sendBillingReminder'])->name('admin.billing.remind');
    Route::get('/admin/billing/export', [AdminController::class, 'exportBillingInvoices'])->name('admin.billing.export');
    Route::get('/api/admin/billing/invoices/{id}', [AdminController::class, 'apiBillingInvoice'])->name('admin.billing.detail');

    // Phase 3, Page 47: Super Admin System Health & Observability
    Route::get('/admin/system-health', [AdminController::class, 'systemHealth'])->name('admin.system-health');
    Route::post('/admin/system-health/refresh', [AdminController::class, 'refreshSystemHealth'])->name('admin.system-health.refresh');
    Route::get('/admin/system-health/export', [AdminController::class, 'exportSystemHealth'])->name('admin.system-health.export');
    Route::get('/api/admin/system-health', [AdminController::class, 'apiSystemHealth'])->name('admin.system-health.api');
    Route::get('/api/admin/system-health/services/{id}', [AdminController::class, 'apiServiceDetail'])->name('admin.system-health.service-detail');

    // Phase 3, Page 48: Super Admin Operational Alerts & Triage
    Route::get('/admin/alerts', [AdminController::class, 'alerts'])->name('admin.alerts');
    Route::post('/admin/alerts/{id}/acknowledge', [AdminController::class, 'acknowledgeAlert'])->name('admin.alerts.acknowledge');
    Route::patch('/admin/alerts/{id}/resolve', [AdminController::class, 'resolveAlert'])->name('admin.alerts.resolve');
    Route::patch('/admin/alerts/{id}/suppress', [AdminController::class, 'suppressAlert'])->name('admin.alerts.suppress');
    Route::post('/admin/alerts/bulk', [AdminController::class, 'bulkAlertAction'])->name('admin.alerts.bulk');
    Route::get('/admin/alerts/export', [AdminController::class, 'exportAlerts'])->name('admin.alerts.export');
    Route::get('/api/admin/alerts/{id}', [AdminController::class, 'apiAlert'])->name('admin.alerts.detail');

    // Phase 3, Page 49: Super Admin Incident Management
    Route::get('/admin/incidents', [AdminController::class, 'incidents'])->name('admin.incidents');
    Route::post('/admin/incidents', [AdminController::class, 'storeIncident'])->name('admin.incidents.store');
    Route::patch('/admin/incidents/{id}/assign', [AdminController::class, 'assignIncident'])->name('admin.incidents.assign');
    Route::patch('/admin/incidents/{id}/status', [AdminController::class, 'updateIncidentStatus'])->name('admin.incidents.status');
    Route::post('/admin/incidents/{id}/notes', [AdminController::class, 'addIncidentNote'])->name('admin.incidents.note');
    Route::patch('/admin/incidents/{id}/resolve', [AdminController::class, 'resolveIncident'])->name('admin.incidents.resolve');
    Route::get('/admin/incidents/export', [AdminController::class, 'exportIncidents'])->name('admin.incidents.export');
    Route::get('/api/admin/incidents/{id}', [AdminController::class, 'apiIncident'])->name('admin.incidents.detail');

    // Phase 3, Page 50: Super Admin API Management & Security Controls
    Route::get('/admin/api-management', [AdminController::class, 'apiManagement'])->name('admin.api-management');
    Route::get('/admin/api', function () {
        return redirect()->route('admin.api-management');
    });
    Route::post('/admin/api-management', [AdminController::class, 'storeApiClient'])->name('admin.api-management.store');
    Route::post('/admin/api-management/{id}/rotate-secret', [AdminController::class, 'rotateApiClientSecret'])->name('admin.api-management.rotate');
    Route::patch('/admin/api-management/{id}/status', [AdminController::class, 'updateApiClientStatus'])->name('admin.api-management.status');
    Route::put('/admin/api-management/{id}/policy', [AdminController::class, 'updateApiClientPolicy'])->name('admin.api-management.policy');
    Route::get('/admin/api-management/export', [AdminController::class, 'exportApiClients'])->name('admin.api-management.export');
    Route::get('/api/admin/api-clients/{id}', [AdminController::class, 'apiClientDetail'])->name('admin.api-management.detail');

    // Phase 3, Page 51: Super Admin Audit Logs & Platform Integrity
    Route::get('/admin/audit-logs', [AdminController::class, 'auditLogs'])->name('admin.audit-logs');
    Route::get('/admin/audit', function () {
        return redirect()->route('admin.audit-logs');
    });
    Route::get('/admin/audit-logs/export', [AdminController::class, 'exportAuditLogs'])->name('admin.audit-logs.export');
    Route::get('/api/admin/audit-logs/{id}', [AdminController::class, 'apiAuditLogDetail'])->name('admin.audit-logs.detail');

    // Phase 3, Page 52: Super Admin Roles & Permissions Governance
    Route::get('/admin/roles-permissions', [AdminController::class, 'rolesPermissions'])->name('admin.roles-permissions');
    Route::get('/admin/roles', function () {
        return redirect()->route('admin.roles-permissions');
    });
    Route::post('/admin/roles-permissions', [AdminController::class, 'storeRole'])->name('admin.roles-permissions.store');
    Route::put('/admin/roles-permissions/{id}', [AdminController::class, 'updateRolePermissions'])->name('admin.roles-permissions.update');
    Route::delete('/admin/roles-permissions/{id}', [AdminController::class, 'destroyRole'])->name('admin.roles-permissions.destroy');
    Route::get('/admin/roles-permissions/export', [AdminController::class, 'exportRolesMatrix'])->name('admin.roles-permissions.export');
    Route::get('/api/admin/roles/{id}', [AdminController::class, 'apiRoleDetail'])->name('api.admin.roles.detail');

    // Phase 3, Page 53: Super Admin Platform Settings & Global Defaults
    Route::get('/admin/platform-settings', [AdminController::class, 'platformSettings'])->name('admin.platform-settings');
    Route::get('/admin/settings', function () {
        return redirect()->route('admin.platform-settings');
    });
    Route::put('/admin/platform-settings', [AdminController::class, 'updatePlatformSettings'])->name('admin.platform-settings.update');
    Route::post('/admin/platform-settings/reset', [AdminController::class, 'resetPlatformSettings'])->name('admin.platform-settings.reset');
});
