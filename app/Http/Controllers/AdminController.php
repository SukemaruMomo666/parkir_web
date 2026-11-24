<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    protected AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Display the Super Admin National Dashboard (Page 37).
     */
    public function dashboard(Request $request): View
    {
        $period = $request->query('period', 'today');
        if (!array_key_exists($period, AdminService::PERIODS)) {
            $period = 'today';
        }

        $region = $request->query('region', 'all');
        if (!array_key_exists($region, AdminService::REGIONS)) {
            $region = 'all';
        }

        $forceRefresh = $request->query('refresh', '0') === '1';

        $data = $this->adminService->getNationalDashboardData($period, $region, $forceRefresh);

        return view('admin.dashboard', [
            'period' => $period,
            'periods' => AdminService::PERIODS,
            'region' => $region,
            'regions' => AdminService::REGIONS,
            'data' => $data,
        ]);
    }

    /**
     * Asynchronous JSON endpoint for metrics refresh.
     */
    public function apiMetrics(Request $request): JsonResponse
    {
        $period = $request->query('period', 'today');
        if (!array_key_exists($period, AdminService::PERIODS)) {
            $period = 'today';
        }

        $region = $request->query('region', 'all');
        if (!array_key_exists($region, AdminService::REGIONS)) {
            $region = 'all';
        }

        $forceRefresh = $request->query('refresh', '0') === '1';

        $data = $this->adminService->getNationalDashboardData($period, $region, $forceRefresh);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * Asynchronous JSON endpoint for IoT fleet and system health.
     */
    public function apiHealth(Request $request): JsonResponse
    {
        $data = $this->adminService->getNationalDashboardData('today', 'all', false);

        return response()->json([
            'status' => 'success',
            'system_health' => $data['system_health'],
            'iot_health' => $data['iot_health'],
            'alerts' => $data['alerts'],
        ]);
    }

    /**
     * Display the Super Admin Indonesia Map (Page 38).
     */
    public function map(Request $request): View
    {
        $filters = [
            'q' => $request->query('q', ''),
            'province' => $request->query('province', 'all'),
            'status' => $request->query('status', 'all'),
            'vendor' => $request->query('vendor', 'all'),
        ];

        $selectedId = $request->query('selected');
        $filteredLocations = $this->adminService->filterLocations($filters);
        $summaryMetrics = $this->adminService->getLocationSummaryMetrics($filteredLocations);
        $operators = $this->adminService->getOperatorFilterOptions();
        $regions = AdminService::REGIONS;

        $selectedLocation = null;
        if (!empty($selectedId)) {
            $selectedLocation = $this->adminService->getLocationById($selectedId);
        }
        if (!$selectedLocation && count($filteredLocations) > 0) {
            // Default to first location with valid coordinates if available
            foreach ($filteredLocations as $loc) {
                if (!empty($loc['coordinates'])) {
                    $selectedLocation = $loc;
                    break;
                }
            }
            if (!$selectedLocation) {
                $selectedLocation = $filteredLocations[0];
            }
        }

        return view('admin.map', [
            'filters' => $filters,
            'locations' => $filteredLocations,
            'metrics' => $summaryMetrics,
            'operators' => $operators,
            'regions' => $regions,
            'selectedLocation' => $selectedLocation,
            'lastUpdated' => now()->format('d M Y, H:i') . ' WIB',
        ]);
    }

    /**
     * Asynchronous JSON endpoint for filtered locations on map.
     */
    public function apiLocations(Request $request): JsonResponse
    {
        $filters = [
            'q' => $request->query('q', ''),
            'province' => $request->query('province', 'all'),
            'status' => $request->query('status', 'all'),
            'vendor' => $request->query('vendor', 'all'),
        ];

        $filteredLocations = $this->adminService->filterLocations($filters);
        $metrics = $this->adminService->getLocationSummaryMetrics($filteredLocations);

        return response()->json([
            'status' => 'success',
            'count' => count($filteredLocations),
            'metrics' => $metrics,
            'data' => $filteredLocations,
        ]);
    }

    /**
     * Asynchronous JSON endpoint for single location detail.
     */
    public function apiLocationDetail(string $id): JsonResponse
    {
        $location = $this->adminService->getLocationById($id);

        if (!$location) {
            return response()->json([
                'status' => 'error',
                'message' => 'Parking facility location not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $location,
        ]);
    }

    /**
     * Display Super Admin Tenant Management (Page 39).
     */
    public function tenants(Request $request): View
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'status' => $request->query('status', 'all'),
            'tier' => $request->query('tier', 'all'),
            'province' => $request->query('province', 'all'),
            'sort' => $request->query('sort', 'name_asc'),
        ];

        $allTenants = $this->adminService->getTenants($filters);
        $summary = $this->adminService->getTenantSummaryMetrics($allTenants);

        // Pagination (10 per page)
        $total = count($allTenants);
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedTenants = array_slice($allTenants, $offset, $perPage);

        // Selected detail tenant for drawer / modal inspection
        $detailId = $request->query('detail');
        $selectedTenant = null;
        if (!empty($detailId)) {
            $selectedTenant = $this->adminService->getTenantById($detailId);
        }

        return view('admin.tenants', [
            'filters' => $filters,
            'tenants' => $pagedTenants,
            'summary' => $summary,
            'statuses' => AdminService::TENANT_STATUSES,
            'tiers' => AdminService::TENANT_TIERS,
            'regions' => AdminService::REGIONS,
            'selectedTenant' => $selectedTenant,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'from' => $total > 0 ? $offset + 1 : 0,
                'to' => min($offset + $perPage, $total),
            ],
            'lastUpdated' => now()->format('d M Y, H:i') . ' WIB',
        ]);
    }

    /**
     * Register / Provision a new tenant organization.
     */
    public function storeTenant(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:150',
            'brand_name' => 'nullable|string|max:100',
            'nib' => 'nullable|string|max:30',
            'npwp' => 'nullable|string|max:30',
            'tier' => 'required|string',
            'primary_contact_name' => 'required|string|max:100',
            'primary_contact_role' => 'nullable|string|max:100',
            'primary_contact_email' => 'required|email|max:150',
            'primary_contact_phone' => 'required|string|max:30',
            'billing_email' => 'nullable|email|max:150',
            'city' => 'required|string|max:80',
            'province' => 'required|string|max:80',
            'address' => 'nullable|string|max:255',
        ]);

        $created = $this->adminService->createTenant($validated);

        return redirect()->route('admin.tenants', ['detail' => $created['id']])
            ->with('success', "Tenant {$created['company_name']} ({$created['id']}) successfully registered with status Pending Verification.");
    }

    /**
     * Update an existing tenant organization's profile.
     */
    public function updateTenant(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:150',
            'brand_name' => 'nullable|string|max:100',
            'nib' => 'nullable|string|max:30',
            'npwp' => 'nullable|string|max:30',
            'tier' => 'required|string',
            'primary_contact_name' => 'required|string|max:100',
            'primary_contact_role' => 'nullable|string|max:100',
            'primary_contact_email' => 'required|email|max:150',
            'primary_contact_phone' => 'required|string|max:30',
            'billing_email' => 'nullable|email|max:150',
            'city' => 'required|string|max:80',
            'province' => 'required|string|max:80',
            'address' => 'nullable|string|max:255',
        ]);

        $updated = $this->adminService->updateTenant($id, $validated);

        if (!$updated) {
            return redirect()->back()->with('error', "Tenant record {$id} not found.");
        }

        return redirect()->route('admin.tenants', ['detail' => $id])
            ->with('success', "Tenant {$updated['company_name']} updated successfully.");
    }

    /**
     * Update tenant lifecycle status (Activate, Suspend, Reinstate).
     */
    public function updateTenantStatus(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:Active,Pending Verification,In Grace,Suspended',
            'reason' => 'nullable|string|max:255',
        ]);

        $updated = $this->adminService->updateTenantStatus($id, $validated['status'], $validated['reason'] ?? null);

        if (!$updated) {
            return redirect()->back()->with('error', "Tenant record {$id} not found.");
        }

        return redirect()->back()
            ->with('success', "Status for {$updated['company_name']} changed to {$updated['status']}.");
    }

    /**
     * Export filtered tenant list to an RFC-compliant CSV document.
     */
    public function exportTenants(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'status' => $request->query('status', 'all'),
            'tier' => $request->query('tier', 'all'),
            'province' => $request->query('province', 'all'),
            'sort' => $request->query('sort', 'name_asc'),
        ];

        $tenants = $this->adminService->getTenants($filters);
        $filename = 'nusapark-tenants-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($tenants) {
            $handle = fopen('php://output', 'w');
            // Write UTF-8 BOM for Excel
            fputs($handle, "\xEF\xBB\xBF");

            // Header Row
            fputcsv($handle, [
                'Tenant ID',
                'Company Legal Name',
                'Brand Name',
                'Partner Tier',
                'Operational Status',
                'Primary Representative',
                'Representative Role',
                'Business Email',
                'Contact Phone',
                'Billing Email',
                'City',
                'Province',
                'NIB (Business ID)',
                'NPWP (Tax ID)',
                'Facilities Monitored',
                'Total Bay Capacity',
                'Live Active Sessions',
                'SLA Health',
                'Subscription Plan',
                'Monthly MRR (IDR)',
                'Contract Number',
                'Registration Date',
            ]);

            foreach ($tenants as $t) {
                fputcsv($handle, [
                    $t['id'],
                    $t['company_name'],
                    $t['brand_name'],
                    $t['tier'],
                    $t['status'],
                    $t['primary_contact_name'],
                    $t['primary_contact_role'],
                    $t['primary_contact_email'],
                    $t['primary_contact_phone'],
                    $t['billing_email'],
                    $t['city'],
                    $t['province'],
                    $t['nib'] ?? '',
                    $t['npwp'] ?? '',
                    $t['facilities_count'],
                    $t['total_bays'],
                    $t['active_sessions'],
                    $t['sla_health'],
                    $t['subscription_plan'],
                    $t['subscription_mrr'],
                    $t['contract_number'],
                    $t['created_at'],
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Asynchronous JSON endpoint for single tenant details.
     */
    public function apiTenant(string $id): JsonResponse
    {
        $tenant = $this->adminService->getTenantById($id);

        if (!$tenant) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tenant organization not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $tenant,
        ]);
    }

    /**
     * Display Super Admin Location Management (Page 40).
     */
    public function locations(Request $request): View
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'vendor' => $request->query('vendor', 'all'),
            'status' => $request->query('status', 'all'),
            'province' => $request->query('province', 'all'),
            'completeness' => $request->query('completeness', 'all'),
            'facility_type' => $request->query('facility_type', 'all'),
            'sort' => $request->query('sort', 'name_asc'),
        ];

        $allLocations = $this->adminService->filterLocationsRegistry($filters);
        $summary = $this->adminService->getLocationRegistrySummary($allLocations);
        $operators = $this->adminService->getOperatorFilterOptions();
        $allTenants = $this->adminService->getStoredTenants();
        $regions = AdminService::REGIONS;

        // Pagination (10 per page)
        $total = count($allLocations);
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedLocations = array_slice($allLocations, $offset, $perPage);

        // Selected location for detail drawer inspection
        $detailId = $request->query('detail');
        $selectedLocation = null;
        if (!empty($detailId)) {
            $selectedLocation = $this->adminService->getLocationById($detailId);
        }

        return view('admin.locations', [
            'filters' => $filters,
            'locations' => $pagedLocations,
            'summary' => $summary,
            'operators' => $operators,
            'tenants' => $allTenants,
            'regions' => $regions,
            'statuses' => AdminService::LOCATION_STATUSES,
            'facilityTypes' => AdminService::FACILITY_TYPES,
            'selectedLocation' => $selectedLocation,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'from' => $total > 0 ? $offset + 1 : 0,
                'to' => min($offset + $perPage, $total),
            ],
            'lastUpdated' => now()->format('d M Y, H:i') . ' WIB',
        ]);
    }

    /**
     * Store/Provision a new parking location under an authorized tenant.
     */
    public function storeLocation(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'vendor_id' => 'required|string',
            'name' => 'required|string|max:150',
            'code' => 'nullable|string|max:30',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:80',
            'province' => 'required|string|max:80',
            'region_id' => 'nullable|string|max:20',
            'facility_type' => 'nullable|string|max:60',
            'lat' => 'nullable|numeric|between:-11.0,6.0',
            'lng' => 'nullable|numeric|between:95.0,141.0',
            'total_capacity' => 'required|integer|min:1|max:50000',
            'gates_count' => 'required|integer|min:1|max:100',
            'cameras_count' => 'required|integer|min:0|max:200',
            'operating_hours' => 'nullable|string|max:50',
            'contact_phone' => 'nullable|string|max:30',
        ]);

        $created = $this->adminService->createLocation($validated);

        return redirect()->route('admin.locations', ['detail' => $created['id']])
            ->with('success', "Parking facility \"{$created['name']}\" ({$created['code']}) successfully registered under {$created['vendor_name']}.");
    }

    /**
     * Update an existing parking location's profile.
     */
    public function updateLocation(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:80',
            'province' => 'required|string|max:80',
            'facility_type' => 'nullable|string|max:60',
            'lat' => 'nullable|numeric|between:-11.0,6.0',
            'lng' => 'nullable|numeric|between:95.0,141.0',
            'total_capacity' => 'required|integer|min:1|max:50000',
            'gates_count' => 'required|integer|min:1|max:100',
            'cameras_count' => 'required|integer|min:0|max:200',
            'operating_hours' => 'nullable|string|max:50',
            'contact_phone' => 'nullable|string|max:30',
        ]);

        $updated = $this->adminService->updateLocation($id, $validated);

        if (!$updated) {
            return redirect()->back()->with('error', "Facility record \"{$id}\" not found.");
        }

        return redirect()->route('admin.locations', ['detail' => $id])
            ->with('success', "Location \"{$updated['name']}\" configuration updated successfully.");
    }

    /**
     * Update location operational lifecycle status.
     */
    public function updateLocationStatus(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:Operational,Attention Required,Maintenance,Suspended',
            'reason' => 'nullable|string|max:255',
        ]);

        $updated = $this->adminService->updateLocationStatus($id, $validated['status'], $validated['reason'] ?? null);

        if (!$updated) {
            return redirect()->back()->with('error', "Facility record \"{$id}\" not found.");
        }

        return redirect()->back()
            ->with('success', "Operational status for \"{$updated['name']}\" transitioned to \"{$updated['status']}\".");
    }

    /**
     * Export filtered locations list to RFC-compliant CSV with UTF-8 BOM.
     */
    public function exportLocations(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'vendor' => $request->query('vendor', 'all'),
            'status' => $request->query('status', 'all'),
            'province' => $request->query('province', 'all'),
            'completeness' => $request->query('completeness', 'all'),
            'facility_type' => $request->query('facility_type', 'all'),
            'sort' => $request->query('sort', 'name_asc'),
        ];

        $locations = $this->adminService->filterLocationsRegistry($filters);
        $filename = 'nusapark-locations-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($locations) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Excel

            fputcsv($handle, [
                'Facility ID',
                'Location Code',
                'Facility Name',
                'Facility Type',
                'Owning Tenant ID',
                'Owning Tenant Name',
                'Tenant Tier',
                'Operational Status',
                'Status Note',
                'Street Address',
                'City',
                'Province',
                'Latitude',
                'Longitude',
                'GPS Completeness',
                'Total Declared Capacity',
                'Occupied Bays',
                'Available Bays',
                'Barrier Gates Count',
                'ANPR Cameras Count',
                'Operating Hours',
                'Emergency Contact Phone',
                'Last Telemetry Heartbeat',
                'Registration Date',
            ]);

            foreach ($locations as $loc) {
                $hasGps = !empty($loc['coordinates']) && isset($loc['coordinates']['lat'], $loc['coordinates']['lng']);
                fputcsv($handle, [
                    $loc['id'],
                    $loc['code'],
                    $loc['name'],
                    $loc['facility_type'] ?? 'Commercial Mall',
                    $loc['vendor_id'],
                    $loc['vendor_name'],
                    $loc['vendor_tier'],
                    $loc['status'],
                    $loc['status_note'] ?? '',
                    $loc['address'],
                    $loc['city'],
                    $loc['province'],
                    $hasGps ? $loc['coordinates']['lat'] : '',
                    $hasGps ? $loc['coordinates']['lng'] : '',
                    $hasGps ? 'Mapped' : 'Missing (Pending Site Survey)',
                    $loc['total_capacity'] ?? 0,
                    $loc['occupied'] ?? 0,
                    $loc['available'] ?? 0,
                    $loc['gates_count'] ?? 0,
                    $loc['cameras_count'] ?? 0,
                    $loc['operating_hours'] ?? '24 Hours',
                    $loc['contact_phone'] ?? '',
                    $loc['last_telemetry_at'] ?? 'N/A',
                    $loc['created_at'] ?? '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Display Super Admin User Management (Page 41).
     */
    public function users(Request $request): View
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'account_type' => $request->query('account_type', 'all'),
            'role' => $request->query('role', 'all'),
            'status' => $request->query('status', 'all'),
            'vendor' => $request->query('vendor', 'all'),
            'verification' => $request->query('verification', 'all'),
            'sort' => $request->query('sort', 'name_asc'),
        ];

        $allUsers = $this->adminService->getUsers($filters);
        $summary = $this->adminService->getUserSummaryMetrics($allUsers);
        $tenants = $this->adminService->getStoredTenants();

        // Pagination (10 per page)
        $total = count($allUsers);
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedUsers = array_slice($allUsers, $offset, $perPage);

        // Selected user for detail drawer inspection
        $detailId = $request->query('detail');
        $selectedUser = null;
        if (!empty($detailId)) {
            $selectedUser = $this->adminService->getUserById($detailId);
        }

        return view('admin.users', [
            'filters' => $filters,
            'users' => $pagedUsers,
            'summary' => $summary,
            'tenants' => $tenants,
            'statuses' => AdminService::USER_STATUSES,
            'accountTypes' => AdminService::USER_ACCOUNT_TYPES,
            'roles' => AdminService::USER_ROLES,
            'selectedUser' => $selectedUser,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'from' => $total > 0 ? $offset + 1 : 0,
                'to' => min($offset + $perPage, $total),
            ],
            'lastUpdated' => now()->format('d M Y, H:i') . ' WIB',
        ]);
    }

    /**
     * Store/Provision or invite a new platform user account.
     */
    public function storeUser(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:30',
            'account_type' => 'required|string|in:Super Admin,Vendor Staff,Driver',
            'role' => 'required|string',
            'vendor_id' => 'nullable|string',
            'corporate_org' => 'nullable|string|max:100',
            'status' => 'required|string|in:Active,Pending Verification',
        ]);

        // Duplicate email validation against existing repository
        $existing = $this->adminService->getUsers(['q' => $validated['email']]);
        foreach ($existing as $u) {
            if (strtolower($u['email']) === strtolower($validated['email'])) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "An account with email address {$validated['email']} already exists on the platform.");
            }
        }

        $created = $this->adminService->createUser($validated);

        return redirect()->route('admin.users', ['detail' => $created['id']])
            ->with('success', "User account for {$created['name']} ({$created['email']}) provisioned successfully as {$created['role']}.");
    }

    /**
     * Update an existing user account's profile and roles.
     */
    public function updateUser(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:30',
            'account_type' => 'required|string|in:Super Admin,Vendor Staff,Driver',
            'role' => 'required|string',
            'vendor_id' => 'nullable|string',
        ]);

        $updated = $this->adminService->updateUser($id, $validated);

        if (!$updated) {
            return redirect()->back()->with('error', "User account {$id} not found.");
        }

        return redirect()->route('admin.users', ['detail' => $id])
            ->with('success', "Account profile for {$updated['name']} updated successfully.");
    }

    /**
     * Update user account lifecycle status.
     */
    public function updateUserStatus(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:Active,Pending Verification,Suspended,Inactive',
            'reason' => 'nullable|string|max:255',
        ]);

        $updated = $this->adminService->updateUserStatus($id, $validated['status'], $validated['reason'] ?? null);

        if (!$updated) {
            return redirect()->back()->with('error', "User account {$id} not found.");
        }

        return redirect()->back()
            ->with('success', "Account status for {$updated['name']} transitioned to {$updated['status']}.");
    }

    /**
     * Trigger secure password reset link for a platform account.
     */
    public function resetUserPassword(Request $request, string $id): RedirectResponse
    {
        $res = $this->adminService->triggerUserPasswordReset($id);

        if (!$res['success']) {
            return redirect()->back()->with('error', $res['message']);
        }

        return redirect()->back()->with('success', $res['message']);
    }

    /**
     * Export filtered user accounts list to RFC-compliant CSV with UTF-8 BOM.
     */
    public function exportUsers(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'account_type' => $request->query('account_type', 'all'),
            'role' => $request->query('role', 'all'),
            'status' => $request->query('status', 'all'),
            'vendor' => $request->query('vendor', 'all'),
            'verification' => $request->query('verification', 'all'),
            'sort' => $request->query('sort', 'name_asc'),
        ];

        $users = $this->adminService->getUsers($filters);
        $filename = 'nusapark-users-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($users) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Excel

            fputcsv($handle, [
                'Account ID',
                'Full Name',
                'Email Address',
                'Phone Number',
                'Account Type',
                'Assigned Role',
                'Organization ID',
                'Organization Name',
                'Account Status',
                'Status Audit Note',
                'Email Verified',
                'Two-Factor Auth (2FA)',
                'Last Login Timestamp',
                'Last Login IP',
                'Registration Date',
            ]);

            foreach ($users as $u) {
                fputcsv($handle, [
                    $u['id'],
                    $u['name'],
                    $u['email'],
                    $u['phone'],
                    $u['account_type'],
                    $u['role'],
                    $u['vendor_id'],
                    $u['vendor_name'],
                    $u['status'],
                    $u['status_note'] ?? '',
                    $u['email_verified'] ? 'Verified' : 'Unverified',
                    $u['two_factor_enabled'] ? 'Enabled' : 'Disabled',
                    $u['last_login_at'] ?? 'Never',
                    $u['last_login_ip'] ?? '-',
                    $u['created_at'],
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // PHASE 3, PAGE 42: SUPER ADMIN IOT MONITORING & FLEET TELEMETRY
    // =========================================================================

    /**
     * Display the national IoT Device Fleet Monitoring interface (Page 42).
     */
    public function iot(Request $request): View
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'vendor' => $request->query('vendor', 'all'),
            'location' => $request->query('location', 'all'),
            'type' => $request->query('type', 'all'),
            'connectivity' => $request->query('connectivity', 'all'),
            'health' => $request->query('health', 'all'),
            'freshness' => $request->query('freshness', 'all'),
            'sort' => $request->query('sort', 'status'),
        ];

        // Filtered dataset
        $allDevices = $this->adminService->getIotDevices($filters);
        $summary = $this->adminService->getIotSummaryMetrics($allDevices);

        // Also calculate baseline totals across all registered hardware (unfiltered)
        $unfilteredDevices = $this->adminService->getIotDevices([]);
        $globalSummary = $this->adminService->getIotSummaryMetrics($unfilteredDevices);

        // Pagination (10 devices per page)
        $total = count($allDevices);
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedDevices = array_slice($allDevices, $offset, $perPage);

        // Selected device for drawer / inspection modal
        $detailId = $request->query('detail');
        $selectedDevice = null;
        if (!empty($detailId)) {
            $selectedDevice = $this->adminService->getIotDeviceById($detailId);
        }

        // Available tenants and locations for filter selectors
        $tenants = $this->adminService->getStoredTenants();
        $locations = $this->adminService->getStoredLocations();

        // If a specific tenant is filtered, cascade/filter location options
        if (!empty($filters['vendor']) && $filters['vendor'] !== 'all') {
            $locations = array_filter($locations, fn($loc) => ($loc['vendor_id'] ?? '') === $filters['vendor']);
        }

        return view('admin.iot', [
            'filters' => $filters,
            'devices' => $pagedDevices,
            'summary' => $summary,
            'globalSummary' => $globalSummary,
            'types' => AdminService::IOT_DEVICE_TYPES,
            'connectivities' => AdminService::IOT_CONNECTIVITY_STATUSES,
            'healths' => AdminService::IOT_HEALTH_STATUSES,
            'freshnessOptions' => AdminService::IOT_FRESHNESS_OPTIONS,
            'tenants' => $tenants,
            'locations' => $locations,
            'selectedDevice' => $selectedDevice,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'from' => $total > 0 ? $offset + 1 : 0,
                'to' => min($offset + $perPage, $total),
            ],
            'lastUpdated' => now()->format('d M Y, H:i:s') . ' WIB',
        ]);
    }

    /**
     * Trigger diagnostic echo ping to an IoT device.
     */
    public function pingIotDevice(Request $request, string $id)
    {
        $result = $this->adminService->pingIotDevice($id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($result, $result['success'] ? 200 : 422);
        }

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->back()->with('success', $result['message']);
    }

    /**
     * Update IoT device administrative status (Maintenance Mode / Operational / Clear Fault).
     */
    public function updateIotDeviceStatus(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'connectivity' => 'required|string|in:Online,Offline,Degraded',
            'health' => 'required|string|in:Operational,Attention Required,Maintenance,Fault',
            'note' => 'nullable|string|max:255',
        ]);

        $updated = $this->adminService->updateIotDeviceStatus(
            $id,
            $validated['connectivity'],
            $validated['health'],
            $validated['note'] ?? null
        );

        if (!$updated) {
            return redirect()->back()->with('error', "Device ID {$id} not found.");
        }

        return redirect()->back()->with('success', "Device {$updated['code']} status updated to {$updated['health']} ({$updated['connectivity']}).");
    }

    /**
     * API endpoint to retrieve full device detail payload for asynchronous drawer.
     */
    public function apiIotDevice(Request $request, string $id): JsonResponse
    {
        $device = $this->adminService->getIotDeviceById($id);

        if (!$device) {
            return response()->json([
                'success' => false,
                'message' => "Device ID {$id} not found in national registry.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'device' => $device,
        ]);
    }

    /**
     * Export filtered national IoT device registry to RFC-compliant CSV with UTF-8 BOM.
     */
    public function exportIot(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'vendor' => $request->query('vendor', 'all'),
            'location' => $request->query('location', 'all'),
            'type' => $request->query('type', 'all'),
            'connectivity' => $request->query('connectivity', 'all'),
            'health' => $request->query('health', 'all'),
            'freshness' => $request->query('freshness', 'all'),
            'sort' => $request->query('sort', 'status'),
        ];

        $devices = $this->adminService->getIotDevices($filters);
        $filename = 'nusapark-iot-fleet-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($devices) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Microsoft Excel

            fputcsv($handle, [
                'Device ID',
                'Device Code',
                'Device Name',
                'Equipment Type',
                'Hardware Model',
                'Serial Number',
                'Tenant Organization',
                'Parking Facility',
                'City',
                'Assigned Zone / Gate',
                'IP Address',
                'MAC Address',
                'Protocol',
                'Firmware Version',
                'Connectivity Status',
                'Operational Health',
                'Maintenance Mode',
                'Ping Latency (ms)',
                'Last Heartbeat Timestamp',
                'Reporting Freshness',
                'Active Error Code',
                'Diagnostic Summary',
            ]);

            foreach ($devices as $d) {
                fputcsv($handle, [
                    $d['id'],
                    $d['code'],
                    $d['name'],
                    $d['type'],
                    $d['model'] ?? '',
                    $d['serial_number'] ?? '',
                    $d['vendor_name'] ?? '',
                    $d['location_name'] ?? '',
                    $d['location_city'] ?? '',
                    $d['zone'] ?? '',
                    $d['ip_address'] ?? '',
                    $d['mac_address'] ?? '',
                    $d['protocol'] ?? '',
                    $d['firmware_version'] ?? '',
                    $d['connectivity'],
                    $d['health'],
                    !empty($d['is_maintenance']) ? 'YES' : 'NO',
                    $d['ping_ms'] !== null ? $d['ping_ms'] . ' ms' : 'N/A (Offline)',
                    $d['last_heartbeat_at'] ?? 'Never',
                    strtoupper($d['freshness'] ?? 'unknown'),
                    $d['error_code'] ?? 'ERR_NONE',
                    $d['error_message'] ?? 'Nominal operation',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // PHASE 3, PAGE 43: SUPER ADMIN TRANSACTION MONITORING & FINANCIAL OPS
    // =========================================================================

    /**
     * Display the national Transaction Monitoring interface (Page 43).
     */
    public function transactions(Request $request): View
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'period' => $request->query('period', 'today'),
            'date_from' => $request->query('date_from'),
            'date_to' => $request->query('date_to'),
            'status' => $request->query('status', 'all'),
            'payment_method' => $request->query('payment_method', 'all'),
            'vendor' => $request->query('vendor', 'all'),
            'location' => $request->query('location', 'all'),
            'provider' => $request->query('provider', 'all'),
            'settlement' => $request->query('settlement', 'all'),
            'payable_type' => $request->query('payable_type', 'all'),
            'sort' => $request->query('sort', 'date_desc'),
        ];

        // Filtered transaction dataset
        $allTransactions = $this->adminService->getNationalTransactions($filters);
        $summary = $this->adminService->getTransactionSummaryMetrics($allTransactions);

        // Baseline totals for comparison
        $unfilteredTransactions = $this->adminService->getNationalTransactions([]);
        $globalSummary = $this->adminService->getTransactionSummaryMetrics($unfilteredTransactions);

        // Server-side pagination (10 per page)
        $total = count($allTransactions);
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedTransactions = array_slice($allTransactions, $offset, $perPage);

        // Selected transaction for drawer inspection
        $detailId = $request->query('detail');
        $selectedTransaction = null;
        if (!empty($detailId)) {
            $selectedTransaction = $this->adminService->getTransactionById($detailId);
        }

        // Available tenant operators & facilities for cascading selectors
        $tenants = $this->adminService->getStoredTenants();
        $locations = $this->adminService->getStoredLocations();

        if (!empty($filters['vendor']) && $filters['vendor'] !== 'all') {
            $locations = array_filter($locations, fn($loc) => ($loc['vendor_id'] ?? '') === $filters['vendor']);
        }

        return view('admin.transactions', [
            'filters' => $filters,
            'transactions' => $pagedTransactions,
            'summary' => $summary,
            'globalSummary' => $globalSummary,
            'statuses' => AdminService::TRANSACTION_STATUSES,
            'methods' => AdminService::PAYMENT_METHODS,
            'providers' => AdminService::PAYMENT_PROVIDERS,
            'settlementStatuses' => AdminService::SETTLEMENT_STATUSES,
            'payableTypes' => AdminService::PAYABLE_TYPES,
            'datePresets' => AdminService::DATE_PRESETS,
            'tenants' => $tenants,
            'locations' => $locations,
            'selectedTransaction' => $selectedTransaction,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'from' => $total > 0 ? $offset + 1 : 0,
                'to' => min($offset + $perPage, $total),
            ],
            'lastUpdated' => now()->format('d M Y, H:i:s') . ' WIB',
        ]);
    }

    /**
     * Re-verify transaction state with payment gateway provider engine.
     */
    public function verifyGatewayTransaction(Request $request, string $id)
    {
        $result = $this->adminService->verifyTransactionWithGateway($id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($result, $result['success'] ? 200 : 422);
        }

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->back()->with('success', $result['message']);
    }

    /**
     * Update transaction settlement state (e.g. resolve audit hold).
     */
    public function updateTransactionSettlement(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'settlement_status' => 'required|string|in:settled,pending_settlement,on_hold,refunded',
            'notes' => 'nullable|string|max:255',
        ]);

        $updated = $this->adminService->updateTransactionSettlement(
            $id,
            $validated['settlement_status'],
            $validated['notes'] ?? null
        );

        if (!$updated) {
            return redirect()->back()->with('error', "Transaction {$id} not found.");
        }

        return redirect()->back()->with('success', "Settlement state for {$updated['transaction_reference']} transitioned to {$updated['settlement_status_label']}.");
    }

    /**
     * API endpoint to retrieve full transaction detail payload for asynchronous drawer.
     */
    public function apiTransaction(Request $request, string $id): JsonResponse
    {
        $trx = $this->adminService->getTransactionById($id);

        if (!$trx) {
            return response()->json([
                'success' => false,
                'message' => "Transaction {$id} not found.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'transaction' => $trx,
        ]);
    }

    /**
     * Export filtered national transaction records to RFC-compliant CSV with UTF-8 BOM.
     */
    public function exportTransactions(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'period' => $request->query('period', 'today'),
            'date_from' => $request->query('date_from'),
            'date_to' => $request->query('date_to'),
            'status' => $request->query('status', 'all'),
            'payment_method' => $request->query('payment_method', 'all'),
            'vendor' => $request->query('vendor', 'all'),
            'location' => $request->query('location', 'all'),
            'provider' => $request->query('provider', 'all'),
            'settlement' => $request->query('settlement', 'all'),
            'payable_type' => $request->query('payable_type', 'all'),
            'sort' => $request->query('sort', 'date_desc'),
        ];

        $transactions = $this->adminService->getNationalTransactions($filters);
        $filename = 'nusapark-transactions-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($transactions) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Microsoft Excel

            fputcsv($handle, [
                'Internal Reference',
                'Provider Reference',
                'Auth Approval Code',
                'Created Timestamp (WIB)',
                'Tenant Organization',
                'Parking Facility',
                'City',
                'Terminal / Gate Lane',
                'Payable Type',
                'Payable Reference',
                'Vehicle Plate',
                'Vehicle Model',
                'Payment Method',
                'Payment Channel',
                'Gateway Provider',
                'Gateway Acquirer',
                'Gross Amount (IDR)',
                'Base Parking Fee',
                'Gateway Service Fee',
                'Platform Commission (3.5%)',
                'Net Operator Amount',
                'Refunded Amount (IDR)',
                'Refund Reference',
                'Payment Status',
                'Settlement Status',
                'Settlement Batch',
                'Gateway Response Code',
                'Gateway Response Message',
            ]);

            foreach ($transactions as $t) {
                fputcsv($handle, [
                    $t['transaction_reference'],
                    $t['provider_reference'] ?? '',
                    $t['auth_approval_code'] ?? '',
                    $t['created_at'],
                    $t['vendor_name'] ?? '',
                    $t['facility_name'] ?? '',
                    $t['location_city'] ?? '',
                    $t['terminal_lane'] ?? '',
                    $t['payable_type_label'] ?? $t['payable_type'],
                    $t['payable_reference'] ?? '',
                    $t['vehicle_plate'] ?? '-',
                    $t['vehicle_model'] ?? '-',
                    $t['payment_method_label'] ?? $t['payment_method'],
                    $t['payment_channel'] ?? '',
                    $t['gateway_provider_label'] ?? $t['gateway_provider'],
                    $t['gateway_acquirer'] ?? '',
                    $t['amount'],
                    $t['base_fee'] ?? $t['amount'],
                    $t['service_fee'] ?? 0,
                    $t['platform_fee'] ?? 0,
                    $t['net_operator_amount'] ?? $t['amount'],
                    $t['refunded_amount'] ?? 0,
                    $t['refund_reference'] ?? '',
                    strtoupper($t['transaction_status']),
                    $t['settlement_status_label'] ?? $t['settlement_status'],
                    $t['settlement_batch_ref'] ?? '-',
                    $t['gateway_response_code'] ?? '',
                    $t['gateway_response_message'] ?? '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // PHASE 3, PAGE 44: SUPER ADMIN REVENUE ANALYTICS & FINANCIAL OPS
    // =========================================================================

    /**
     * Display the national Revenue Analytics interface (Page 44).
     */
    public function revenue(Request $request): View
    {
        $filters = [
            'period' => $request->query('period', 'today'),
            'date_from' => $request->query('date_from'),
            'date_to' => $request->query('date_to'),
            'vendor' => $request->query('vendor', 'all'),
            'location' => $request->query('location', 'all'),
            'province' => $request->query('province', 'all'),
            'payment_method' => $request->query('payment_method', 'all'),
            'settlement' => $request->query('settlement', 'all'),
        ];

        $compare = $request->query('compare', '1') !== '0';

        $analytics = $this->adminService->getNationalRevenueAnalytics($filters, $compare);

        // Cascading selector data
        $tenants = $this->adminService->getStoredTenants();
        $locations = $this->adminService->getStoredLocations();
        $regions = AdminService::REGIONS;

        if (!empty($filters['vendor']) && $filters['vendor'] !== 'all') {
            $locations = array_values(array_filter($locations, fn($loc) => ($loc['vendor_id'] ?? '') === $filters['vendor']));
        }

        return view('admin.revenue', [
            'filters' => $filters,
            'compare' => $compare,
            'analytics' => $analytics,
            'tenants' => $tenants,
            'locations' => $locations,
            'regions' => $regions,
            'statuses' => AdminService::TRANSACTION_STATUSES,
            'methods' => AdminService::PAYMENT_METHODS,
            'settlementStatuses' => AdminService::SETTLEMENT_STATUSES,
            'datePresets' => AdminService::DATE_PRESETS,
            'lastUpdated' => now()->format('d M Y, H:i:s') . ' WIB',
        ]);
    }

    /**
     * JSON endpoint for real-time telemetry / dashboard refresh of revenue analytics.
     */
    public function apiRevenue(Request $request): JsonResponse
    {
        $filters = [
            'period' => $request->query('period', 'today'),
            'date_from' => $request->query('date_from'),
            'date_to' => $request->query('date_to'),
            'vendor' => $request->query('vendor', 'all'),
            'location' => $request->query('location', 'all'),
            'province' => $request->query('province', 'all'),
            'payment_method' => $request->query('payment_method', 'all'),
            'settlement' => $request->query('settlement', 'all'),
        ];

        $compare = $request->query('compare', '1') !== '0';
        $analytics = $this->adminService->getNationalRevenueAnalytics($filters, $compare);

        return response()->json([
            'success' => true,
            'analytics' => $analytics,
            'timestamp' => now()->format('d M Y, H:i:s') . ' WIB',
        ]);
    }

    /**
     * Export national revenue performance breakdown to RFC-compliant CSV with UTF-8 BOM.
     */
    public function exportRevenue(Request $request)
    {
        $filters = [
            'period' => $request->query('period', 'today'),
            'date_from' => $request->query('date_from'),
            'date_to' => $request->query('date_to'),
            'vendor' => $request->query('vendor', 'all'),
            'location' => $request->query('location', 'all'),
            'province' => $request->query('province', 'all'),
            'payment_method' => $request->query('payment_method', 'all'),
            'settlement' => $request->query('settlement', 'all'),
        ];

        $compare = $request->query('compare', '1') !== '0';
        $analytics = $this->adminService->getNationalRevenueAnalytics($filters, $compare);

        $filename = 'nusapark-revenue-report-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($analytics) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Excel

            // 1. Executive Summary Block
            fputcsv($handle, ['NusaPark Smart Parking SaaS - National Revenue Analytics Report']);
            fputcsv($handle, ['Reporting Period', $analytics['period_label']]);
            fputcsv($handle, ['Comparison Benchmark', $analytics['previous_period_label']]);
            fputcsv($handle, ['Export Timestamp', $analytics['last_sync']]);
            fputcsv($handle, []);

            // Summary Financial Metrics
            fputcsv($handle, ['Executive Financial Metrics', 'Current Period (IDR)', 'Previous Benchmark (IDR)', 'Growth / Delta (%)']);
            fputcsv($handle, [
                'Gross Parking Receipts',
                $analytics['summary']['gross_parking_receipts'],
                $analytics['summary']['prev_gross_receipts'],
                $analytics['summary']['delta_gross_pct'] . '%',
            ]);
            fputcsv($handle, [
                'Completed Refunds & Adjustments',
                $analytics['summary']['refund_amount'],
                0,
                '-',
            ]);
            fputcsv($handle, [
                'Net Parking Receipts',
                $analytics['summary']['net_parking_receipts'],
                $analytics['summary']['prev_net_receipts'],
                $analytics['summary']['delta_net_pct'] . '%',
            ]);
            fputcsv($handle, [
                'NusaPark SaaS Platform Commission (3.5%)',
                $analytics['summary']['platform_commission'],
                $analytics['summary']['prev_platform_commission'],
                $analytics['summary']['delta_gross_pct'] . '%',
            ]);
            fputcsv($handle, [
                'Settled Payouts (T+1 Cleared)',
                $analytics['summary']['settled_volume'],
                '-',
                '-',
            ]);
            fputcsv($handle, [
                'In-Flight / Pending Clearing',
                $analytics['summary']['pending_volume'],
                '-',
                '-',
            ]);
            fputcsv($handle, [
                'Audit Hold Volume',
                $analytics['summary']['audit_hold_volume'],
                '-',
                '-',
            ]);
            fputcsv($handle, [
                'Successful Transaction Count',
                $analytics['summary']['successful_transactions_count'],
                $analytics['summary']['prev_successful_transactions_count'],
                $analytics['summary']['delta_tx_pct'] . '%',
            ]);
            fputcsv($handle, [
                'Average Ticket Size (IDR)',
                $analytics['summary']['average_ticket'],
                $analytics['summary']['prev_average_ticket'],
                $analytics['summary']['delta_avg_ticket_pct'] . '%',
            ]);
            fputcsv($handle, [
                'Platform B2B SaaS MRR (Distinct Recurring)',
                $analytics['summary']['subscription_mrr'],
                '-',
                '-',
            ]);
            fputcsv($handle, []);

            // 2. Tenant Revenue Breakdown
            fputcsv($handle, ['Tenant / Operator Financial Breakdown']);
            fputcsv($handle, [
                'Tenant ID',
                'Operator Company Name',
                'Brand Name',
                'Partner Tier',
                'Province',
                'Gross Parking Receipts (IDR)',
                'Refunds (IDR)',
                'Net Parking Receipts (IDR)',
                'Platform Fee 3.5% (IDR)',
                'Transaction Count',
                'Average Ticket (IDR)',
                'National Share (%)',
                'SaaS Subscription MRR (IDR)',
            ]);

            foreach ($analytics['tenant_breakdown'] as $tb) {
                fputcsv($handle, [
                    $tb['tenant_id'],
                    $tb['company_name'],
                    $tb['brand_name'],
                    $tb['tier'],
                    $tb['province'],
                    $tb['gross_revenue'],
                    $tb['refund_amount'],
                    $tb['net_revenue'],
                    $tb['platform_fee'],
                    $tb['transaction_count'],
                    $tb['average_ticket'],
                    $tb['share_pct'] . '%',
                    $tb['subscription_mrr'],
                ]);
            }
            fputcsv($handle, []);

            // 3. Location Performance Breakdown
            fputcsv($handle, ['Parking Facility Breakdown']);
            fputcsv($handle, [
                'Facility ID',
                'Facility Name',
                'Tenant Operator',
                'City',
                'Province',
                'Capacity (Bays)',
                'Gross Receipts (IDR)',
                'Refunds (IDR)',
                'Net Receipts (IDR)',
                'Platform Fee 3.5% (IDR)',
                'Transactions',
                'Average Ticket (IDR)',
                'Facility Share (%)',
            ]);

            foreach ($analytics['location_breakdown'] as $lb) {
                fputcsv($handle, [
                    $lb['location_id'],
                    $lb['name'],
                    $lb['vendor_name'],
                    $lb['city'],
                    $lb['province'],
                    $lb['total_capacity'],
                    $lb['gross_revenue'],
                    $lb['refund_amount'],
                    $lb['net_revenue'],
                    $lb['platform_fee'],
                    $lb['transaction_count'],
                    $lb['average_ticket'],
                    $lb['share_pct'] . '%',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // PHASE 3, PAGE 45: SUPER ADMIN SUBSCRIPTION MANAGEMENT
    // =========================================================================

    /**
     * Display the national Subscription Management interface (Page 45).
     */
    public function subscriptions(Request $request): View
    {
        $tab = $request->query('tab', 'subscriptions');
        if (!in_array($tab, ['subscriptions', 'plans'])) {
            $tab = 'subscriptions';
        }

        $filters = [
            'q' => trim($request->query('q', '')),
            'plan' => $request->query('plan', 'all'),
            'status' => $request->query('status', 'all'),
            'interval' => $request->query('interval', 'all'),
            'sort' => $request->query('sort', 'mrr_desc'),
        ];

        // Filtered subscriptions dataset
        $allSubscriptions = $this->adminService->filterSubscriptions($filters);
        $summary = $this->adminService->getSubscriptionSummaryMetrics($allSubscriptions);

        // Baseline global metrics across entire platform fleet
        $globalSubscriptions = $this->adminService->filterSubscriptions([]);
        $globalSummary = $this->adminService->getSubscriptionSummaryMetrics($globalSubscriptions);

        // Plans catalog
        $plans = $this->adminService->getStoredSubscriptionPlans();

        // Calculate subscriber count for each plan
        $planSubscriberCounts = [];
        foreach ($plans as $p) {
            $planSubscriberCounts[$p['slug']] = 0;
            $planSubscriberCounts[$p['id']] = 0;
        }
        foreach ($globalSubscriptions as $s) {
            $slug = $s['plan_slug'] ?? '';
            $pid = $s['plan_id'] ?? '';
            if (isset($planSubscriberCounts[$slug])) $planSubscriberCounts[$slug]++;
            if (isset($planSubscriberCounts[$pid])) $planSubscriberCounts[$pid]++;
        }

        // Server-side pagination (10 subscriptions per page)
        $total = count($allSubscriptions);
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedSubscriptions = array_slice($allSubscriptions, $offset, $perPage);

        // Selected subscription for slide-over drawer inspection
        $detailId = $request->query('detail');
        $selectedSubscription = null;
        if (!empty($detailId)) {
            $selectedSubscription = $this->adminService->getSubscriptionById($detailId);
        }

        return view('admin.subscriptions', [
            'activeTab' => $tab,
            'filters' => $filters,
            'subscriptions' => $pagedSubscriptions,
            'summary' => $summary,
            'globalSummary' => $globalSummary,
            'plans' => $plans,
            'planSubscriberCounts' => $planSubscriberCounts,
            'statuses' => AdminService::SUBSCRIPTION_STATUSES,
            'selectedSubscription' => $selectedSubscription,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'from' => $total > 0 ? $offset + 1 : 0,
                'to' => min($offset + $perPage, $total),
            ],
            'lastUpdated' => now()->format('d M Y, H:i:s') . ' WIB',
        ]);
    }

    /**
     * Change a tenant's subscription plan and apply proration rules.
     */
    public function changeSubscriptionPlan(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'plan_id' => 'required|string',
            'billing_interval' => 'required|string|in:monthly,annual',
            'notes' => 'nullable|string|max:255',
        ]);

        $updated = $this->adminService->changeSubscriptionPlan(
            $id,
            $validated['plan_id'],
            $validated['billing_interval'],
            $validated['notes'] ?? null
        );

        if (!$updated) {
            return redirect()->back()->with('error', "Subscription record \"{$id}\" could not be updated.");
        }

        return redirect()->route('admin.subscriptions', [
            'detail' => $updated['id'],
            'tab' => 'subscriptions',
        ])->with('success', "Plan successfully updated to {$updated['plan_name']} ({$updated['billing_interval']}) for {$updated['vendor_name']}. New MRR: {$updated['formatted_mrr']}.");
    }

    /**
     * Extend trial period for a trialing subscription.
     */
    public function extendSubscriptionTrial(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'extra_days' => 'required|integer|min:1|max:90',
            'reason' => 'nullable|string|max:255',
        ]);

        $updated = $this->adminService->extendSubscriptionTrial(
            $id,
            (int)$validated['extra_days'],
            $validated['reason'] ?? null
        );

        if (!$updated) {
            return redirect()->back()->with('error', "Subscription record \"{$id}\" could not be found.");
        }

        return redirect()->route('admin.subscriptions', [
            'detail' => $updated['id'],
            'tab' => 'subscriptions',
        ])->with('success', "Trial for {$updated['vendor_name']} extended by +{$validated['extra_days']} days until {$updated['trial_ends_at']}.");
    }

    /**
     * Transition subscription lifecycle status (e.g. Activate, Suspend, Cancel).
     */
    public function updateSubscriptionStatus(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:active,trialing,past_due,suspended,cancelled',
            'reason' => 'nullable|string|max:255',
        ]);

        $updated = $this->adminService->updateSubscriptionStatus(
            $id,
            $validated['status'],
            $validated['reason'] ?? null
        );

        if (!$updated) {
            return redirect()->back()->with('error', "Subscription record \"{$id}\" could not be found.");
        }

        return redirect()->route('admin.subscriptions', [
            'detail' => $updated['id'],
            'tab' => 'subscriptions',
        ])->with('success', "Subscription status for {$updated['vendor_name']} transitioned to {$updated['status_label']}.");
    }

    /**
     * Toggle automatic renewal for a subscription.
     */
    public function toggleSubscriptionAutoRenew(Request $request, string $id): RedirectResponse
    {
        $updated = $this->adminService->toggleSubscriptionAutoRenew($id);

        if (!$updated) {
            return redirect()->back()->with('error', "Subscription record \"{$id}\" could not be found.");
        }

        $state = $updated['auto_renew'] ? 'Enabled' : 'Disabled';
        return redirect()->back()->with('success', "Auto-renewal is now {$state} for {$updated['vendor_name']}.");
    }

    /**
     * Update configured parameters in the master plan catalog.
     */
    public function updateSubscriptionPlanConfig(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'price_monthly' => 'required|numeric|min:0',
            'price_annual' => 'required|numeric|min:0',
            'max_facilities' => 'required|integer|min:1|max:100',
            'max_bays' => 'required|integer|min:1|max:50000',
            'max_gates' => 'required|integer|min:1|max:200',
            'max_staff' => 'required|integer|min:1|max:500',
            'sla_health' => 'nullable|string|max:20',
        ]);

        $updated = $this->adminService->updateSubscriptionPlanConfig($id, $validated);

        if (!$updated) {
            return redirect()->back()->with('error', "Plan \"{$id}\" could not be found.");
        }

        return redirect()->route('admin.subscriptions', ['tab' => 'plans'])
            ->with('success', "Plan catalog tier \"{$updated['name']}\" updated successfully.");
    }

    /**
     * API endpoint to retrieve full subscription detail for async slide-over drawer.
     */
    public function apiSubscription(Request $request, string $id): JsonResponse
    {
        $sub = $this->adminService->getSubscriptionById($id);

        if (!$sub) {
            return response()->json([
                'success' => false,
                'message' => "Subscription record \"{$id}\" not found.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'subscription' => $sub,
        ]);
    }

    /**
     * Export filtered subscription records to RFC-compliant CSV with UTF-8 BOM.
     */
    public function exportSubscriptions(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'plan' => $request->query('plan', 'all'),
            'status' => $request->query('status', 'all'),
            'interval' => $request->query('interval', 'all'),
            'sort' => $request->query('sort', 'mrr_desc'),
        ];

        $subscriptions = $this->adminService->filterSubscriptions($filters);
        $filename = 'nusapark-subscriptions-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($subscriptions) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Microsoft Excel

            fputcsv($handle, [
                'Subscription ID',
                'Subscription Code',
                'Tenant ID',
                'Tenant Name',
                'Brand Name',
                'Plan ID',
                'Plan Name',
                'Partner Tier',
                'Billing Interval',
                'Currency',
                'Monthly Recurring Revenue (IDR)',
                'Annual Contract Value (IDR)',
                'Subscription Status',
                'Auto-Renewal',
                'Start Date',
                'Current Period Start',
                'Current Period End',
                'Next Renewal Date',
                'Trial Ends At',
                'Contract Number',
                'Contract Expiry',
                'Primary Contact Name',
                'Primary Contact Email',
                'Billing Email',
                'City',
                'Province',
                'Facilities Deployed',
                'Facility Limit',
                'Bays Deployed',
                'Bay Limit',
                'Gates Deployed',
                'Gate Limit',
                'Staff Accounts',
                'Staff Limit',
                'SLA Target',
                'Invoice Status Summary',
            ]);

            foreach ($subscriptions as $s) {
                fputcsv($handle, [
                    $s['id'],
                    $s['subscription_code'],
                    $s['vendor_id'],
                    $s['vendor_name'],
                    $s['brand_name'] ?? $s['vendor_name'],
                    $s['plan_id'],
                    $s['plan_name'],
                    $s['tier'],
                    ucfirst($s['billing_interval']),
                    $s['currency'],
                    $s['mrr'],
                    $s['annual_value'] ?? ($s['mrr'] * 12),
                    strtoupper($s['status']),
                    $s['auto_renew'] ? 'YES' : 'NO',
                    $s['start_date'],
                    $s['current_period_start'],
                    $s['current_period_end'],
                    $s['next_renewal_date'],
                    $s['trial_ends_at'] ?? 'N/A',
                    $s['contract_number'],
                    $s['contract_expiry'],
                    $s['primary_contact_name'],
                    $s['primary_contact_email'],
                    $s['billing_email'],
                    $s['city'],
                    $s['province'],
                    $s['usage']['facilities'] ?? 0,
                    $s['limits']['max_facilities'] ?? 0,
                    $s['usage']['bays'] ?? 0,
                    $s['limits']['max_bays'] ?? 0,
                    $s['usage']['gates'] ?? 0,
                    $s['limits']['max_gates'] ?? 0,
                    $s['usage']['staff'] ?? 0,
                    $s['limits']['max_staff'] ?? 0,
                    $s['limits']['sla_health'] ?? '99.5%',
                    $s['invoices_summary'] ?? '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // PHASE 3, PAGE 46: SUPER ADMIN BILLING PLATFORM & INVOICE OPERATIONS
    // =========================================================================

    /**
     * Display the national Billing Platform interface (Page 46).
     */
    public function billing(Request $request): View
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'vendor' => $request->query('vendor', 'all'),
            'plan' => $request->query('plan', 'all'),
            'status' => $request->query('status', 'all'),
            'payment_status' => $request->query('payment_status', 'all'),
            'period' => $request->query('period', 'all'),
            'sort' => $request->query('sort', 'due_desc'),
        ];

        // Filtered invoices dataset
        $allInvoices = $this->adminService->filterBillingInvoices($filters);
        $summary = $this->adminService->getBillingSummaryMetrics($allInvoices);

        // Baseline global metrics across all registered invoices
        $globalInvoices = $this->adminService->filterBillingInvoices([]);
        $globalSummary = $this->adminService->getBillingSummaryMetrics($globalInvoices);

        // Server-side pagination (10 invoices per page)
        $total = count($allInvoices);
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedInvoices = array_slice($allInvoices, $offset, $perPage);

        // Selected invoice for slide-over drawer inspection
        $detailId = $request->query('detail');
        $selectedInvoice = null;
        if (!empty($detailId)) {
            $selectedInvoice = $this->adminService->getBillingInvoiceById($detailId);
        }

        // Supporting data for filters
        $tenants = $this->adminService->getStoredTenants();
        $plans = $this->adminService->getStoredSubscriptionPlans();

        return view('admin.billing', [
            'filters' => $filters,
            'invoices' => $pagedInvoices,
            'summary' => $summary,
            'globalSummary' => $globalSummary,
            'tenants' => $tenants,
            'plans' => $plans,
            'statuses' => AdminService::BILLING_INVOICE_STATUSES,
            'paymentStatuses' => AdminService::BILLING_PAYMENT_STATUSES,
            'selectedInvoice' => $selectedInvoice,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'from' => $total > 0 ? $offset + 1 : 0,
                'to' => min($offset + $perPage, $total),
            ],
            'lastUpdated' => now()->format('d M Y, H:i:s') . ' WIB',
        ]);
    }

    /**
     * Reconcile/Record verified payment for a subscription invoice.
     */
    public function reconcileBillingPayment(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'payment_method' => 'required|string|max:100',
            'payment_reference' => 'required|string|max:100',
            'notes' => 'nullable|string|max:255',
        ]);

        $updated = $this->adminService->reconcileBillingInvoicePayment($id, $validated);

        if (!$updated) {
            return redirect()->back()->with('error', "Invoice \"{$id}\" could not be reconciled.");
        }

        return redirect()->route('admin.billing', ['detail' => $updated['id']])
            ->with('success', "Invoice {$updated['invoice_number']} successfully marked as paid & reconciled via {$updated['payment_method']}. Outstanding balance cleared.");
    }

    /**
     * Void an open or overdue billing invoice.
     */
    public function voidBillingInvoice(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $updated = $this->adminService->voidBillingInvoice($id, $validated['reason']);

        if (!$updated) {
            return redirect()->back()->with('error', "Invoice \"{$id}\" could not be voided.");
        }

        return redirect()->route('admin.billing', ['detail' => $updated['id']])
            ->with('success', "Invoice {$updated['invoice_number']} was marked void. Outstanding balance reset.");
    }

    /**
     * Dispatch payment reminder notice to tenant billing contacts.
     */
    public function sendBillingReminder(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'memo' => 'nullable|string|max:255',
        ]);

        $res = $this->adminService->sendBillingReminder($id, $validated['memo'] ?? null);

        if (!$res['success']) {
            return redirect()->back()->with('error', $res['message']);
        }

        return redirect()->back()->with('success', $res['message']);
    }

    /**
     * API endpoint to retrieve full invoice payload for async drawer inspection.
     */
    public function apiBillingInvoice(Request $request, string $id): JsonResponse
    {
        $invoice = $this->adminService->getBillingInvoiceById($id);

        if (!$invoice) {
            return response()->json([
                'success' => false,
                'message' => "Invoice record \"{$id}\" not found.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'invoice' => $invoice,
        ]);
    }

    /**
     * Export filtered national subscription invoices to RFC-compliant CSV with UTF-8 BOM.
     */
    public function exportBillingInvoices(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'vendor' => $request->query('vendor', 'all'),
            'plan' => $request->query('plan', 'all'),
            'status' => $request->query('status', 'all'),
            'payment_status' => $request->query('payment_status', 'all'),
            'period' => $request->query('period', 'all'),
            'sort' => $request->query('sort', 'due_desc'),
        ];

        $invoices = $this->adminService->filterBillingInvoices($filters);
        $filename = 'nusapark-billing-invoices-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($invoices) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Microsoft Excel

            fputcsv($handle, [
                'Invoice Number',
                'Invoice Issue Date',
                'Payment Due Date',
                'Days Overdue',
                'Tenant ID',
                'Tenant Name',
                'Brand Name',
                'Subscription Plan',
                'Partner Tier',
                'Billing Period',
                'Currency',
                'Subtotal (IDR)',
                'Tax Rate (PPN %)',
                'Tax Amount (IDR)',
                'Discount Amount (IDR)',
                'Total Invoiced Amount (IDR)',
                'Amount Paid (IDR)',
                'Outstanding Balance (IDR)',
                'Invoice Status',
                'Payment Status',
                'Payment Method',
                'Payment Reference',
                'Paid Timestamp',
                'Billing Email',
                'Primary Contact Name',
                'Primary Contact Phone',
                'Contract Number',
            ]);

            foreach ($invoices as $inv) {
                fputcsv($handle, [
                    $inv['invoice_number'],
                    $inv['issue_date'],
                    $inv['due_date'],
                    $inv['days_overdue'] ?? 0,
                    $inv['vendor_id'],
                    $inv['vendor_name'],
                    $inv['brand_name'] ?? $inv['vendor_name'],
                    $inv['plan_name'],
                    $inv['tier'],
                    $inv['billing_period'],
                    $inv['currency'],
                    $inv['subtotal'],
                    $inv['tax_rate_pct'] . '%',
                    $inv['tax_amount'],
                    $inv['discount_amount'],
                    $inv['total_amount'],
                    $inv['amount_paid'],
                    $inv['outstanding_balance'],
                    strtoupper($inv['status']),
                    strtoupper($inv['payment_status']),
                    $inv['payment_method'],
                    $inv['payment_reference'],
                    $inv['paid_at'] ?? 'Unpaid',
                    $inv['recipient']['billing_email'] ?? '',
                    $inv['recipient']['contact_name'] ?? '',
                    $inv['recipient']['contact_phone'] ?? '',
                    $inv['contract_number'] ?? '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // PHASE 3, PAGE 47: SUPER ADMIN SYSTEM HEALTH & OBSERVABILITY DASHBOARD
    // =========================================================================

    /**
     * Display the national System Health & Observability interface (Page 47).
     */
    public function systemHealth(Request $request): View
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'category' => $request->query('category', 'all'),
            'status' => $request->query('status', 'all'),
            'sort' => $request->query('sort', 'latency_asc'),
        ];

        $forceRefresh = $request->boolean('refresh');
        $telemetry = $this->adminService->getSystemHealthTelemetry($filters, $forceRefresh);

        // Selected service for slide-over drawer inspection
        $detailId = $request->query('detail');
        $selectedService = null;
        if (!empty($detailId)) {
            $selectedService = $this->adminService->getServiceHealthById($detailId);
        }

        return view('admin.system-health', [
            'filters' => $filters,
            'telemetry' => $telemetry,
            'services' => $telemetry['filtered_services'],
            'overallStatus' => $telemetry['overall_status'],
            'overallLabel' => $telemetry['overall_label'],
            'overallSummary' => $telemetry['overall_summary'],
            'counts' => $telemetry['counts'],
            'performance' => $telemetry['performance'],
            'database' => $telemetry['database_diagnostics'],
            'queue' => $telemetry['queue_diagnostics'],
            'scheduledTasks' => $telemetry['scheduled_tasks'],
            'hourlyTrends' => $telemetry['hourly_trends'],
            'categories' => AdminService::SERVICE_CATEGORIES,
            'statuses' => AdminService::HEALTH_STATUSES,
            'selectedService' => $selectedService,
            'lastUpdated' => $telemetry['evaluated_at'],
            'evalDuration' => $telemetry['evaluation_duration_ms'],
        ]);
    }

    /**
     * Force a live health probe evaluation across all platform subsystems.
     */
    public function refreshSystemHealth(Request $request): RedirectResponse
    {
        $telemetry = $this->adminService->getSystemHealthTelemetry([], true);

        return redirect()->route('admin.system-health', array_filter($request->except(['_token', 'refresh'])))
            ->with('success', "Live system diagnostics completed in {$telemetry['evaluation_duration_ms']}ms. All {$telemetry['counts']['total']} platform services evaluated.");
    }

    /**
     * API endpoint returning raw telemetry for external scrapers or async refresh.
     */
    public function apiSystemHealth(Request $request): JsonResponse
    {
        $force = $request->boolean('refresh');
        $telemetry = $this->adminService->getSystemHealthTelemetry([], $force);

        return response()->json([
            'success' => true,
            'telemetry' => $telemetry,
        ]);
    }

    /**
     * API endpoint returning deep diagnostic metadata for a specific service.
     */
    public function apiServiceDetail(Request $request, string $id): JsonResponse
    {
        $service = $this->adminService->getServiceHealthById($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => "Service identifier \"{$id}\" not found in monitoring registry.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'service' => $service,
        ]);
    }

    /**
     * Export monitored platform services inventory to RFC-compliant CSV with UTF-8 BOM.
     */
    public function exportSystemHealth(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'category' => $request->query('category', 'all'),
            'status' => $request->query('status', 'all'),
            'sort' => $request->query('sort', 'latency_asc'),
        ];

        $telemetry = $this->adminService->getSystemHealthTelemetry($filters);
        $services = $telemetry['filtered_services'] ?? [];
        $filename = 'nusapark-system-health-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($services, $telemetry) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Microsoft Excel

            fputcsv($handle, [
                'Service ID',
                'Service Name',
                'Component Technology',
                'Category',
                'Health Status',
                'Response Latency (ms)',
                '30-Day SLA Uptime',
                'Error Rate',
                'Last Check Timestamp',
                'Diagnostic Message',
                'Key Dependencies',
                'Runbook Advice',
            ]);

            foreach ($services as $srv) {
                fputcsv($handle, [
                    $srv['id'],
                    $srv['name'],
                    $srv['component'],
                    $srv['category_label'] ?? $srv['category'],
                    strtoupper($srv['status']),
                    $srv['latency_ms'] . ' ms',
                    $srv['uptime_pct'] ?? '99.98%',
                    $srv['error_rate_pct'] ?? '0.00%',
                    $srv['last_checked'],
                    $srv['diagnostic_message'] ?? '',
                    implode(' | ', $srv['dependencies'] ?? []),
                    $srv['runbook'] ?? '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // PHASE 3, PAGE 48: SUPER ADMIN OPERATIONAL ALERTS & TRIAGE
    // =========================================================================

    /**
     * Display the national Operational Alerts interface (Page 48).
     */
    public function alerts(Request $request): View
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'severity' => $request->query('severity', 'all'),
            'category' => $request->query('category', 'all'),
            'vendor' => $request->query('vendor', 'all'),
            'lifecycle' => $request->query('lifecycle', 'active'),
            'sort' => $request->query('sort', 'priority_desc'),
        ];

        // Filtered alerts dataset
        $allAlerts = $this->adminService->filterAlerts($filters);
        $summary = $this->adminService->getAlertSummaryMetrics($allAlerts);

        // Server-side pagination (10 alerts per page)
        $total = count($allAlerts);
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedAlerts = array_slice($allAlerts, $offset, $perPage);

        // Selected alert for slide-over drawer inspection
        $detailId = $request->query('detail');
        $selectedAlert = null;
        if (!empty($detailId)) {
            $selectedAlert = $this->adminService->getAlertById($detailId);
        }

        // Supporting data for filters
        $tenants = $this->adminService->getStoredTenants();

        return view('admin.alerts', [
            'filters' => $filters,
            'alerts' => $pagedAlerts,
            'summary' => $summary,
            'tenants' => $tenants,
            'severities' => AdminService::ALERT_SEVERITIES,
            'categories' => AdminService::ALERT_CATEGORIES,
            'lifecycles' => AdminService::ALERT_LIFECYCLES,
            'selectedAlert' => $selectedAlert,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'from' => $total > 0 ? $offset + 1 : 0,
                'to' => min($offset + $perPage, $total),
            ],
            'lastUpdated' => now()->format('d M Y, H:i:s') . ' WIB',
        ]);
    }

    /**
     * Acknowledge an active operational alert.
     */
    public function acknowledgeAlert(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'note' => 'nullable|string|max:255',
        ]);

        $updated = $this->adminService->acknowledgeAlert($id, 'Super Admin (Ops Root)', $validated['note'] ?? null);

        if (!$updated) {
            return redirect()->back()->with('error', "Alert \"{$id}\" could not be acknowledged.");
        }

        return redirect()->route('admin.alerts', ['detail' => $updated['id']])
            ->with('success', "Alert {$updated['id']} acknowledged. Triage ownership recorded.");
    }

    /**
     * Mark an alert as resolved with resolution audit note.
     */
    public function resolveAlert(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'resolution_note' => 'required|string|max:500',
        ]);

        $updated = $this->adminService->resolveAlert($id, 'Super Admin (Ops Root)', $validated['resolution_note']);

        if (!$updated) {
            return redirect()->back()->with('error', "Alert \"{$id}\" could not be resolved.");
        }

        return redirect()->route('admin.alerts', ['detail' => $updated['id']])
            ->with('success', "Alert {$updated['id']} marked resolved. Audit note saved.");
    }

    /**
     * Suppress/Mute an alert temporarily.
     */
    public function suppressAlert(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:255',
            'hours' => 'nullable|integer|min:1|max:168',
        ]);

        $hours = (int)($validated['hours'] ?? 24);
        $updated = $this->adminService->suppressAlert($id, 'Super Admin (Ops Root)', $validated['reason'], $hours);

        if (!$updated) {
            return redirect()->back()->with('error', "Alert \"{$id}\" could not be suppressed.");
        }

        return redirect()->route('admin.alerts', ['detail' => $updated['id']])
            ->with('success', "Alert {$updated['id']} muted and suppressed for {$hours} hours.");
    }

    /**
     * Bulk triage action (Acknowledge or Resolve selected alerts).
     */
    public function bulkAlertAction(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'action' => 'required|string|in:acknowledge,resolve',
            'selected_alerts' => 'required|array|min:1',
            'selected_alerts.*' => 'string',
            'bulk_note' => 'nullable|string|max:255',
        ]);

        $action = $validated['action'];
        $ids = $validated['selected_alerts'];

        if ($action === 'acknowledge') {
            $count = $this->adminService->bulkAcknowledgeAlerts($ids, 'Super Admin (Ops Root)');
            return redirect()->route('admin.alerts')
                ->with('success', "Successfully acknowledged {$count} operational alert(s).");
        } else {
            $note = $validated['bulk_note'] ?: 'Bulk resolved by Super Admin';
            $count = $this->adminService->bulkResolveAlerts($ids, 'Super Admin (Ops Root)', $note);
            return redirect()->route('admin.alerts')
                ->with('success', "Successfully marked {$count} operational alert(s) as resolved.");
        }
    }

    /**
     * API endpoint to retrieve full alert payload for async drawer inspection.
     */
    public function apiAlert(Request $request, string $id): JsonResponse
    {
        $alert = $this->adminService->getAlertById($id);

        if (!$alert) {
            return response()->json([
                'success' => false,
                'message' => "Operational alert \"{$id}\" not found in monitoring registry.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'alert' => $alert,
        ]);
    }

    /**
     * Export filtered operational alerts to RFC-compliant CSV with UTF-8 BOM.
     */
    public function exportAlerts(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'severity' => $request->query('severity', 'all'),
            'category' => $request->query('category', 'all'),
            'vendor' => $request->query('vendor', 'all'),
            'lifecycle' => $request->query('lifecycle', 'all'),
            'sort' => $request->query('sort', 'priority_desc'),
        ];

        $alerts = $this->adminService->filterAlerts($filters);
        $filename = 'nusapark-alerts-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($alerts) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Microsoft Excel

            fputcsv($handle, [
                'Alert ID',
                'Title',
                'Severity',
                'Category',
                'Tenant Organization',
                'Location / Facility',
                'Affected Resource ID',
                'Resource Type',
                'Lifecycle State',
                'Repeat Event Count',
                'First Seen Timestamp',
                'Latest Occurrence',
                'Acknowledged By',
                'Acknowledged Timestamp',
                'Resolved By',
                'Resolved Timestamp',
                'Resolution Note',
                'Diagnostic Description',
                'Suggested Runbook',
            ]);

            foreach ($alerts as $alt) {
                fputcsv($handle, [
                    $alt['id'],
                    $alt['title'],
                    strtoupper($alt['severity']),
                    $alt['category_label'] ?? $alt['category'],
                    $alt['vendor_name'],
                    $alt['location_name'],
                    $alt['resource_id'],
                    $alt['resource_type'],
                    strtoupper($alt['lifecycle']),
                    $alt['repeat_count'] ?? 1,
                    $alt['first_seen'],
                    $alt['last_seen'],
                    $alt['acknowledged_by'] ?? 'Unacknowledged',
                    $alt['acknowledged_at'] ?? '',
                    $alt['resolved_by'] ?? '',
                    $alt['resolved_at'] ?? '',
                    $alt['resolution_note'] ?? '',
                    $alt['description'] ?? '',
                    $alt['suggested_runbook'] ?? '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // PHASE 3, PAGE 49: SUPER ADMIN INCIDENT MANAGEMENT
    // =========================================================================

    /**
     * Display the centralized incident management and response workspace (Page 49).
     */
    public function incidents(Request $request): View
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'severity' => $request->query('severity', 'all'),
            'status' => $request->query('status', 'all'),
            'responder' => $request->query('responder', 'all'),
            'vendor' => $request->query('vendor', 'all'),
            'sort' => $request->query('sort', 'priority_desc'),
        ];

        $filteredIncidents = $this->adminService->filterIncidents($filters);
        $summary = $this->adminService->getIncidentSummaryMetrics();

        // Server-side pagination (10 per page)
        $perPage = 10;
        $currentPage = (int) $request->query('page', 1);
        $total = count($filteredIncidents);
        $offset = ($currentPage - 1) * $perPage;
        $slicedItems = array_slice($filteredIncidents, $offset, $perPage);

        $paginator = new LengthAwarePaginator(
            $slicedItems,
            $total,
            $perPage,
            $currentPage,
            ['path' => route('admin.incidents'), 'query' => $request->query()]
        );

        $tenants = $this->adminService->getStoredTenants();
        $responders = AdminService::INCIDENT_RESPONDERS;
        $severities = AdminService::INCIDENT_SEVERITIES;
        $statuses = AdminService::INCIDENT_STATUSES;

        // Auto-load detail drawer payload if ?detail=INC-xxx is present
        $detailId = $request->query('detail');
        $selectedIncident = null;
        if (!empty($detailId)) {
            $selectedIncident = $this->adminService->getIncidentById($detailId);
        }

        return view('admin.incidents', [
            'filters' => $filters,
            'summary' => $summary,
            'incidents' => $paginator,
            'tenants' => $tenants,
            'responders' => $responders,
            'severities' => $severities,
            'statuses' => $statuses,
            'selectedIncident' => $selectedIncident,
            'lastUpdated' => now()->format('d M Y, H:i:s') . ' WIB',
        ]);
    }

    /**
     * Declare and register a new operational incident across platform facilities.
     */
    public function storeIncident(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'severity' => 'required|string|in:sev1,sev2,sev3,sev4',
            'vendor_id' => 'required|string',
            'location_name' => 'required|string|max:150',
            'location_city' => 'required|string|max:100',
            'affected_service' => 'required|string|max:100',
            'resource_id' => 'nullable|string|max:80',
            'impact_summary' => 'required|string|max:500',
            'assigned_responder' => 'nullable|string',
            'initial_note' => 'nullable|string|max:1000',
            'linked_alert_id' => 'nullable|string|max:80',
        ]);

        // Resolve vendor name
        $tenant = $this->adminService->getTenantById($validated['vendor_id']);
        $validated['vendor_name'] = $tenant ? $tenant['company_name'] : 'Platform Infrastructure';

        $created = $this->adminService->createIncident($validated, 'Super Admin (Ops Root)');

        return redirect()->route('admin.incidents', ['detail' => $created['id']])
            ->with('success', "Incident {$created['id']} declared successfully. SRE triage workspace opened.");
    }

    /**
     * Assign or reassign responder ownership to an incident.
     */
    public function assignIncident(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'responder_id' => 'required|string',
            'assignment_note' => 'nullable|string|max:500',
        ]);

        $updated = $this->adminService->assignIncident(
            $id,
            $validated['responder_id'],
            'Super Admin (Ops Root)'
        );

        if (!$updated) {
            return redirect()->back()->with('error', "Incident \"{$id}\" could not be assigned.");
        }

        return redirect()->route('admin.incidents', ['detail' => $updated['id']])
            ->with('success', "Incident {$updated['id']} assigned to {$updated['responder_name']}.");
    }

    /**
     * Transition operational lifecycle status of an incident.
     */
    public function updateIncidentStatus(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:open,investigating,escalated,resolved,closed',
            'reason' => 'nullable|string|max:500',
        ]);

        $updated = $this->adminService->updateIncidentStatus(
            $id,
            $validated['status'],
            'Super Admin (Ops Root)',
            $validated['reason'] ?? null
        );

        if (!$updated) {
            return redirect()->back()->with('error', "Lifecycle transition for \"{$id}\" failed.");
        }

        return redirect()->route('admin.incidents', ['detail' => $updated['id']])
            ->with('success', "Incident {$updated['id']} transitioned to \"{$updated['status_label']}\".");
    }

    /**
     * Append an investigation activity log note to an incident timeline.
     */
    public function addIncidentNote(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'note' => 'required|string|max:1000',
        ]);

        $updated = $this->adminService->addIncidentInvestigationNote(
            $id,
            $validated['note'],
            'Super Admin (Ops Root)'
        );

        if (!$updated) {
            return redirect()->back()->with('error', "Failed to record investigation note on incident \"{$id}\".");
        }

        return redirect()->route('admin.incidents', ['detail' => $updated['id']])
            ->with('success', "Investigation update recorded on {$updated['id']}.");
    }

    /**
     * Formally resolve an incident with root-cause categorization and verification audit note.
     */
    public function resolveIncident(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'root_cause_category' => 'required|string|max:100',
            'resolution_note' => 'required|string|max:1000',
        ]);

        $updated = $this->adminService->resolveIncident(
            $id,
            $validated,
            'Super Admin (Ops Root)'
        );

        if (!$updated) {
            return redirect()->back()->with('error', "Could not mark incident \"{$id}\" as resolved.");
        }

        return redirect()->route('admin.incidents', ['detail' => $updated['id']])
            ->with('success', "Incident {$updated['id']} marked as Resolved. SRE root-cause audit recorded.");
    }

    /**
     * API endpoint to retrieve full incident payload for async drawer inspection.
     */
    public function apiIncident(Request $request, string $id): JsonResponse
    {
        $incident = $this->adminService->getIncidentById($id);

        if (!$incident) {
            return response()->json([
                'success' => false,
                'message' => "Incident \"{$id}\" was not found in active operational registry.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'incident' => $incident,
        ]);
    }

    /**
     * Export filtered incidents to RFC-compliant CSV with UTF-8 BOM for Excel compatibility.
     */
    public function exportIncidents(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'severity' => $request->query('severity', 'all'),
            'status' => $request->query('status', 'all'),
            'responder' => $request->query('responder', 'all'),
            'vendor' => $request->query('vendor', 'all'),
            'sort' => $request->query('sort', 'priority_desc'),
        ];

        $incidents = $this->adminService->filterIncidents($filters);
        $filename = 'nusapark-incidents-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($incidents) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Microsoft Excel

            fputcsv($handle, [
                'Incident ID',
                'Title',
                'Severity',
                'Status',
                'Tenant Organization',
                'Facility / Location',
                'City',
                'Affected Service',
                'Resource ID',
                'Assigned Responder',
                'Responder Role',
                'Impact Summary',
                'Linked Alert IDs',
                'Root Cause Category',
                'Resolution Note',
                'Created Timestamp',
                'Last Updated Timestamp',
                'Verified Timestamp',
            ]);

            foreach ($incidents as $inc) {
                fputcsv($handle, [
                    $inc['id'],
                    $inc['title'],
                    strtoupper($inc['severity']),
                    strtoupper($inc['status']),
                    $inc['vendor_name'],
                    $inc['location_name'],
                    $inc['location_city'] ?? '',
                    $inc['affected_service'],
                    $inc['resource_id'] ?? '',
                    $inc['responder_name'] ?? 'Unassigned',
                    $inc['responder_role'] ?? '-',
                    $inc['impact_summary'] ?? '',
                    !empty($inc['linked_alert_ids']) ? implode('; ', $inc['linked_alert_ids']) : 'None',
                    $inc['root_cause_category'] ?? '-',
                    $inc['resolution_note'] ?? '-',
                    $inc['created_at'],
                    $inc['updated_at'],
                    $inc['verified_at'] ?? '-',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // PHASE 3, PAGE 50: SUPER ADMIN API MANAGEMENT & SECURITY CONTROLS
    // =========================================================================

    /**
     * Display the centralized API Management & Security Controls interface (Page 50).
     */
    public function apiManagement(Request $request): View
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'status' => $request->query('status', 'all'),
            'category' => $request->query('category', 'all'),
            'environment' => $request->query('environment', 'all'),
            'vendor' => $request->query('vendor', 'all'),
            'sort' => $request->query('sort', 'volume_desc'),
        ];

        $filteredClients = $this->adminService->filterApiClients($filters);
        $summary = $this->adminService->getApiSummaryMetrics();
        $requestLogs = $this->adminService->getStoredApiRequestLogs();

        // Server-side pagination (10 per page)
        $perPage = 10;
        $currentPage = (int) $request->query('page', 1);
        $total = count($filteredClients);
        $offset = ($currentPage - 1) * $perPage;
        $slicedItems = array_slice($filteredClients, $offset, $perPage);

        $paginator = new LengthAwarePaginator(
            $slicedItems,
            $total,
            $perPage,
            $currentPage,
            ['path' => route('admin.api-management'), 'query' => $request->query()]
        );

        $tenants = $this->adminService->getStoredTenants();
        $categories = AdminService::API_CATEGORIES;
        $environments = AdminService::API_ENVIRONMENTS;
        $statuses = AdminService::API_STATUSES;
        $tiers = AdminService::API_RATE_LIMIT_TIERS;
        $scopes = AdminService::API_SCOPES;

        // Auto-load detail drawer payload if ?detail=client-xxx is present
        $detailId = $request->query('detail');
        $selectedClient = null;
        if (!empty($detailId)) {
            $selectedClient = $this->adminService->getApiClientById($detailId);
        }

        return view('admin.api-management', [
            'filters' => $filters,
            'summary' => $summary,
            'clients' => $paginator,
            'requestLogs' => $requestLogs,
            'tenants' => $tenants,
            'categories' => $categories,
            'environments' => $environments,
            'statuses' => $statuses,
            'tiers' => $tiers,
            'scopes' => $scopes,
            'selectedClient' => $selectedClient,
            'lastUpdated' => now()->format('d M Y, H:i:s') . ' WIB',
        ]);
    }

    /**
     * Register a new API client with cryptographically generated credentials.
     * The raw client secret is flashed to session for one-time display only.
     */
    public function storeApiClient(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'vendor_id' => 'required|string',
            'category' => 'required|string|in:payment_gateway,iot_telemetry,smart_city,enterprise_erp,mobile_partner',
            'environment' => 'required|string|in:production,sandbox',
            'rate_limit_tier' => 'required|string|in:tier_standard,tier_growth,tier_enterprise,tier_smart_city',
            'scopes' => 'required|array|min:1',
            'scopes.*' => 'string',
            'allowed_ips' => 'nullable|string|max:255',
            'status_note' => 'nullable|string|max:500',
        ]);

        $tenant = $this->adminService->getTenantById($validated['vendor_id']);
        $validated['vendor_name'] = $tenant ? $tenant['company_name'] : 'Platform Infrastructure';

        $result = $this->adminService->createApiClient($validated, 'Super Admin (Ops Root)');

        session()->flash('one_time_secret', $result['plaintext_secret']);
        session()->flash('one_time_client_name', $result['client']['name']);
        session()->flash('one_time_client_id', $result['client']['client_id']);

        return redirect()->route('admin.api-management', ['detail' => $result['client']['id']])
            ->with('success', "API Client \"{$result['client']['name']}\" created. Please copy the generated client secret immediately.");
    }

    /**
     * Rotate an API client's secret credential.
     * The new raw secret is flashed to session for one-time display.
     */
    public function rotateApiClientSecret(Request $request, string $id): RedirectResponse
    {
        $result = $this->adminService->rotateApiClientSecret($id, 'Super Admin (Ops Root)');

        if (!$result) {
            return redirect()->back()->with('error', "API Client \"{$id}\" could not be found for credential rotation.");
        }

        session()->flash('one_time_secret', $result['plaintext_secret']);
        session()->flash('one_time_client_name', $result['client']['name']);
        session()->flash('one_time_client_id', $result['client']['client_id']);

        return redirect()->route('admin.api-management', ['detail' => $result['client']['id']])
            ->with('success', "Credentials rotated for \"{$result['client']['name']}\". Prior secret invalidated.");
    }

    /**
     * Transition API client status (Active, Suspended, Revoked).
     */
    public function updateApiClientStatus(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:active,suspended,revoked',
            'reason' => 'nullable|string|max:500',
        ]);

        $updated = $this->adminService->updateApiClientStatus(
            $id,
            $validated['status'],
            'Super Admin (Ops Root)',
            $validated['reason'] ?? null
        );

        if (!$updated) {
            return redirect()->back()->with('error', "Failed to update lifecycle status for \"{$id}\".");
        }

        return redirect()->route('admin.api-management', ['detail' => $updated['id']])
            ->with('success', "API Client \"{$updated['name']}\" status updated to {$updated['status']}.");
    }

    /**
     * Update access policies, rate-limit tier, OAuth2 scopes, and IP allowlist.
     */
    public function updateApiClientPolicy(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'rate_limit_tier' => 'required|string|in:tier_standard,tier_growth,tier_enterprise,tier_smart_city',
            'scopes' => 'required|array|min:1',
            'scopes.*' => 'string',
            'allowed_ips' => 'nullable|string|max:255',
        ]);

        $updated = $this->adminService->updateApiClientPolicy(
            $id,
            $validated,
            'Super Admin (Ops Root)'
        );

        if (!$updated) {
            return redirect()->back()->with('error', "Failed to update policy for \"{$id}\".");
        }

        return redirect()->route('admin.api-management', ['detail' => $updated['id']])
            ->with('success', "Access policy and rate limits updated for \"{$updated['name']}\".");
    }

    /**
     * API endpoint to retrieve full API client payload for drawer inspection (secrets masked).
     */
    public function apiClientDetail(Request $request, string $id): JsonResponse
    {
        $client = $this->adminService->getApiClientById($id);

        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => "API Client \"{$id}\" was not found.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'client' => $client,
        ]);
    }

    /**
     * Export filtered API clients metadata to CSV with UTF-8 BOM.
     */
    public function exportApiClients(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'status' => $request->query('status', 'all'),
            'category' => $request->query('category', 'all'),
            'environment' => $request->query('environment', 'all'),
            'vendor' => $request->query('vendor', 'all'),
            'sort' => $request->query('sort', 'volume_desc'),
        ];

        $clients = $this->adminService->filterApiClients($filters);
        $filename = 'nusapark-api-clients-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($clients) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Microsoft Excel

            fputcsv($handle, [
                'Internal ID',
                'Client Name',
                'Public Client ID',
                'Key Fingerprint (SHA256)',
                'Tenant Organization',
                'Category',
                'Environment',
                'Rate Limit Tier',
                'Granted Scopes',
                'Status',
                'Allowed IP CIDR',
                '30D Request Volume',
                'Today Request Volume',
                'Average Latency (ms)',
                'Error Rate (%)',
                'Rate Limited Events',
                'Created Date',
                'Expires Date',
                'Last Active',
            ]);

            foreach ($clients as $c) {
                fputcsv($handle, [
                    $c['id'],
                    $c['name'],
                    $c['client_id'],
                    $c['key_fingerprint'],
                    $c['vendor_name'] ?? '',
                    $c['category'],
                    $c['environment'],
                    $c['rate_limit_tier'],
                    implode('; ', $c['scopes'] ?? []),
                    strtoupper($c['status']),
                    $c['allowed_ips'] ?? '*',
                    $c['requests_30d'] ?? 0,
                    $c['requests_today'] ?? 0,
                    $c['avg_latency_ms'] ?? 0,
                    $c['error_rate_pct'] ?? 0,
                    $c['rate_limited_count'] ?? 0,
                    $c['created_at'],
                    $c['expires_at'] ?? '-',
                    $c['last_active'] ?? 'Never',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // PHASE 3, PAGE 51: SUPER ADMIN AUDIT LOGS & PLATFORM INTEGRITY
    // =========================================================================

    /**
     * Display the centralized Audit Logs & Security Investigation interface (Page 51).
     */
    public function auditLogs(Request $request): View
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'category' => $request->query('category', 'all'),
            'outcome' => $request->query('outcome', 'all'),
            'resource_type' => $request->query('resource_type', 'all'),
            'actor' => $request->query('actor', 'all'),
            'period' => $request->query('period', 'all'),
            'sort' => $request->query('sort', 'newest'),
        ];

        $filteredLogs = $this->adminService->filterAuditLogs($filters);
        $summary = $this->adminService->getAuditSummaryMetrics($filteredLogs);

        // Server-side pagination (10 per page)
        $perPage = 10;
        $currentPage = (int) $request->query('page', 1);
        $total = count($filteredLogs);
        $offset = ($currentPage - 1) * $perPage;
        $slicedItems = array_slice($filteredLogs, $offset, $perPage);

        $paginator = new LengthAwarePaginator(
            $slicedItems,
            $total,
            $perPage,
            $currentPage,
            ['path' => route('admin.audit-logs'), 'query' => $request->query()]
        );

        $allLogs = $this->adminService->getStoredAuditLogs();
        $actors = array_values(array_unique(array_filter(array_column($allLogs, 'actor'))));
        sort($actors);

        $categories = AdminService::AUDIT_CATEGORIES;
        $outcomes = AdminService::AUDIT_OUTCOMES;
        $resourceTypes = AdminService::AUDIT_RESOURCE_TYPES;

        // Auto-load detail drawer payload if ?detail=AUD-xxx is present
        $detailId = $request->query('detail');
        $selectedLog = null;
        if (!empty($detailId)) {
            $selectedLog = $this->adminService->getAuditLogById($detailId);
        }

        return view('admin.audit-logs', [
            'filters' => $filters,
            'summary' => $summary,
            'logs' => $paginator,
            'actors' => $actors,
            'categories' => $categories,
            'outcomes' => $outcomes,
            'resourceTypes' => $resourceTypes,
            'selectedLog' => $selectedLog,
            'lastUpdated' => now()->format('d M Y, H:i:s') . ' WIB',
        ]);
    }

    /**
     * API endpoint to retrieve full audit log event payload for drawer inspection.
     */
    public function apiAuditLogDetail(Request $request, string $id): JsonResponse
    {
        $log = $this->adminService->getAuditLogById($id);

        if (!$log) {
            return response()->json([
                'success' => false,
                'message' => "Audit Log \"{$id}\" was not found in authoritative records.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'audit_log' => $log,
        ]);
    }

    /**
     * Export filtered audit logs to RFC-compliant CSV with UTF-8 BOM.
     */
    public function exportAuditLogs(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'category' => $request->query('category', 'all'),
            'outcome' => $request->query('outcome', 'all'),
            'resource_type' => $request->query('resource_type', 'all'),
            'actor' => $request->query('actor', 'all'),
            'period' => $request->query('period', 'all'),
            'sort' => $request->query('sort', 'newest'),
        ];

        $logs = $this->adminService->filterAuditLogs($filters);
        $filename = 'nusapark-audit-logs-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($logs) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Microsoft Excel

            fputcsv($handle, [
                'Audit Log ID',
                'Timestamp (WIB)',
                'Actor Name',
                'Actor Role',
                'Actor Email',
                'Actor Type',
                'Event Key',
                'Event Label',
                'Category',
                'Resource Type',
                'Resource Identifier',
                'Resource Name',
                'Tenant Organization',
                'Outcome',
                'IP Address',
                'User Agent',
                'Correlation ID',
                'Contextual Description',
            ]);

            foreach ($logs as $l) {
                fputcsv($handle, [
                    $l['id'],
                    $l['timestamp'],
                    $l['actor'],
                    $l['actor_role'] ?? '-',
                    $l['actor_email'] ?? '-',
                    $l['actor_type'] ?? 'human',
                    $l['event'],
                    $l['event_name'],
                    $l['category'],
                    $l['resource_type'],
                    $l['resource_id'],
                    $l['resource_name'],
                    $l['vendor_name'] ?? 'Platform Core',
                    strtoupper($l['outcome']),
                    $l['ip_address'],
                    $l['user_agent'] ?? '-',
                    $l['correlation_id'],
                    $l['description'],
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // PHASE 3, PAGE 52: SUPER ADMIN ROLES & PERMISSIONS GOVERNANCE
    // =========================================================================

    /**
     * Display the centralized Roles & Permissions management workspace (Page 52).
     */
    public function rolesPermissions(Request $request): View
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'type' => $request->query('type', 'all'),
            'scope' => $request->query('scope', 'all'),
            'sort' => $request->query('sort', 'name_asc'),
        ];

        $roles = $this->adminService->filterRoles($filters);
        $summary = $this->adminService->getRoleSummaryMetrics($roles);
        $modules = AdminService::PERMISSION_MODULES;
        $allPermissions = AdminService::ALL_PERMISSIONS;

        // Group permissions by module
        $permissionsByModule = [];
        foreach ($allPermissions as $pKey => $pData) {
            $mod = $pData['module'];
            $permissionsByModule[$mod][$pKey] = $pData;
        }

        // Auto-load role detail for drawer if ?detail=role-xxx is present
        $detailId = $request->query('detail');
        $selectedRole = null;
        if (!empty($detailId)) {
            $selectedRole = $this->adminService->getRoleById($detailId);
        }

        return view('admin.roles-permissions', [
            'filters' => $filters,
            'roles' => $roles,
            'summary' => $summary,
            'modules' => $modules,
            'allPermissions' => $allPermissions,
            'permissionsByModule' => $permissionsByModule,
            'selectedRole' => $selectedRole,
            'lastUpdated' => now()->format('d M Y, H:i') . ' WIB',
        ]);
    }

    /**
     * API endpoint to retrieve full role detail with assigned users for drawer inspection.
     */
    public function apiRoleDetail(Request $request, string $id): JsonResponse
    {
        $role = $this->adminService->getRoleById($id);

        if (!$role) {
            return response()->json([
                'success' => false,
                'message' => "Role \"{$id}\" was not found in authoritative governance records.",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'role' => $role,
        ]);
    }

    /**
     * Provision a new custom platform role with initial permission grants.
     */
    public function storeRole(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:80',
            'description' => 'nullable|string|max:300',
            'scope' => 'required|in:platform,tenant,driver',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ]);

        $created = $this->adminService->createRole($validated);

        return redirect()->route('admin.roles-permissions', ['detail' => $created['id']])
            ->with('success', "Custom role '{$created['name']}' was successfully created with " . count($created['permissions']) . " initial permissions.");
    }

    /**
     * Update an existing role's permission matrix, name, or description.
     */
    public function updateRolePermissions(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:80',
            'description' => 'nullable|string|max:300',
            'scope' => 'nullable|in:platform,tenant,driver',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ]);

        $updated = $this->adminService->updateRole($id, $validated);

        if (!$updated) {
            return redirect()->route('admin.roles-permissions')
                ->with('error', "Role \"{$id}\" could not be located for updating.");
        }

        return redirect()->route('admin.roles-permissions', ['detail' => $id])
            ->with('success', "Access permissions and security policy for '{$updated['name']}' were successfully updated.");
    }

    /**
     * Delete a custom role (blocked if system-managed or active users assigned).
     */
    public function destroyRole(Request $request, string $id): RedirectResponse
    {
        $res = $this->adminService->deleteRole($id);

        if (!$res['success']) {
            return redirect()->route('admin.roles-permissions')
                ->with('error', $res['message']);
        }

        return redirect()->route('admin.roles-permissions')
            ->with('success', $res['message']);
    }

    /**
     * Export roles and permission matrix to RFC CSV with UTF-8 BOM.
     */
    public function exportRolesMatrix(Request $request)
    {
        $filters = [
            'q' => trim($request->query('q', '')),
            'type' => $request->query('type', 'all'),
            'scope' => $request->query('scope', 'all'),
            'sort' => $request->query('sort', 'name_asc'),
        ];

        $roles = $this->adminService->filterRoles($filters);
        $allPermissions = AdminService::ALL_PERMISSIONS;

        $filename = 'nusapark-roles-permissions-matrix-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($roles, $allPermissions) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // UTF-8 BOM

            // Header row: Role metadata columns + 1 column per permission
            $headerRow = [
                'Role ID',
                'Role Name',
                'Type',
                'Scope',
                'Assigned Users Count',
                'Granted Permissions Count',
                'Description',
            ];

            foreach ($allPermissions as $pKey => $pData) {
                $headerRow[] = $pData['name'] . " ({$pKey})";
            }

            fputcsv($handle, $headerRow);

            foreach ($roles as $r) {
                $row = [
                    $r['id'],
                    $r['name'],
                    strtoupper($r['type']),
                    strtoupper($r['scope']),
                    $r['user_count'] ?? 0,
                    $r['permission_count'] ?? 0,
                    $r['description'] ?? '',
                ];

                $rolePerms = $r['permissions'] ?? [];
                foreach ($allPermissions as $pKey => $pData) {
                    $row[] = in_array($pKey, $rolePerms) ? 'GRANTED' : 'NO';
                }

                fputcsv($handle, $row);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =========================================================================
    // PHASE 3, PAGE 53: SUPER ADMIN PLATFORM SETTINGS & GLOBAL CONFIGURATION
    // =========================================================================

    /**
     * Display the centralized Platform Settings & Global Defaults management interface (Page 53).
     */
    public function platformSettings(Request $request): View
    {
        $allowedTabs = [
            'general' => 'General Platform Info',
            'localization' => 'Localization & Regional',
            'operational' => 'Operational Defaults',
            'notifications' => 'Notification Channels',
            'security' => 'Security & Session Policies',
            'retention' => 'Data Retention & Legal',
            'maintenance' => 'Maintenance & Feature Flags',
            'environment' => 'Runtime & Environment',
        ];

        $activeTab = $request->query('tab', 'general');
        if (!array_key_exists($activeTab, $allowedTabs)) {
            $activeTab = 'general';
        }

        $settings = $this->adminService->getStoredPlatformSettings();
        $envInfo = $this->adminService->getRuntimeEnvironmentInfo();

        return view('admin.platform-settings', [
            'activeTab' => $activeTab,
            'tabs' => $allowedTabs,
            'settings' => $settings,
            'envInfo' => $envInfo,
            'lastUpdated' => now()->format('d M Y, H:i') . ' WIB',
        ]);
    }

    /**
     * Update a specific configuration section safely.
     */
    public function updatePlatformSettings(Request $request): RedirectResponse
    {
        $section = $request->input('section', 'general');

        // Section-specific validations
        $validationRules = match ($section) {
            'general' => [
                'platform_name' => 'required|string|max:120',
                'brand_tagline' => 'nullable|string|max:200',
                'operator_legal_entity' => 'required|string|max:150',
                'nib' => 'nullable|string|max:30',
                'npwp' => 'nullable|string|max:35',
                'headquarters_address' => 'nullable|string|max:255',
                'support_hotline' => 'required|string|max:30',
                'emergency_sre_phone' => 'nullable|string|max:30',
                'support_email' => 'required|email|max:100',
                'security_email' => 'required|email|max:100',
                'public_portal_url' => 'required|url|max:120',
            ],
            'localization' => [
                'default_language' => 'required|string|in:id,en',
                'default_timezone' => 'required|string',
                'currency_code' => 'required|string|max:5',
                'currency_symbol' => 'required|string|max:5',
                'date_format' => 'required|string|max:20',
                'time_format' => 'required|string|max:10',
                'number_decimal_separator' => 'required|string|max:1',
                'number_thousand_separator' => 'required|string|max:1',
                'map_default_lat' => 'required|numeric',
                'map_default_lng' => 'required|numeric',
                'map_default_zoom' => 'required|integer|min:4|max:18',
            ],
            'operational' => [
                'default_grace_period_mins' => 'required|integer|min:0|max:60',
                'overstay_alert_threshold_hours' => 'required|integer|min:1|max:168',
                'anpr_min_confidence_pct' => 'required|integer|min:50|max:100',
                'barrier_auto_close_delay_secs' => 'required|integer|min:1|max:30',
                'telemetry_heartbeat_interval_secs' => 'required|integer|min:5|max:120',
                'capacity_warning_threshold_pct' => 'required|integer|min:50|max:100',
                'max_booking_advance_days' => 'required|integer|min:1|max:30',
            ],
            'notifications' => [
                'sre_emergency_broadcast_msg' => 'nullable|string|max:255',
                'digest_recipients' => 'nullable|string|max:255',
            ],
            'security' => [
                'session_idle_timeout_mins' => 'required|integer|min:5|max:480',
                'max_login_attempts' => 'required|integer|min:3|max:20',
                'lockout_duration_mins' => 'required|integer|min:5|max:1440',
                'password_expiry_days' => 'required|integer|min:0|max:365',
                'ip_restriction_mode' => 'required|string|in:audit_only,enforced_whitelist',
                'admin_ip_whitelist' => 'nullable|string|max:500',
            ],
            'maintenance' => [
                'maintenance_notice_message' => 'nullable|string|max:300',
            ],
            default => [],
        };

        if (!empty($validationRules)) {
            $request->validate($validationRules);
        }

        $inputData = $request->except(['_token', '_method', 'section']);
        $this->adminService->updatePlatformSettingsSection($section, $inputData);

        return redirect()->route('admin.platform-settings', ['tab' => $section])
            ->with('success', "Platform configuration for section '{$section}' was successfully saved and synchronized across platform clusters.");
    }

    /**
     * Revert all platform configuration options to factory baseline defaults.
     */
    public function resetPlatformSettings(Request $request): RedirectResponse
    {
        $this->adminService->resetPlatformSettingsToDefaults();

        return redirect()->route('admin.platform-settings')
            ->with('success', 'All platform settings have been successfully restored to initial factory defaults.');
    }
}



