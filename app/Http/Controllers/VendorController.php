<?php

namespace App\Http\Controllers;

use App\Services\VendorService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class VendorController extends Controller
{
    protected VendorService $vendorService;

    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }

    /**
     * Display the Vendor Operations Dashboard (Page 20).
     */
    public function dashboard(Request $request): View
    {
        $facilityId = $request->query('facility', 'all');
        $period = $request->query('period', 'today');

        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();
        $metrics = $this->vendorService->getDashboardMetrics($facilityId, $period);
        $hourlyTrend = $this->vendorService->getHourlyTrend();
        $gateActivity = $this->vendorService->getRecentGateActivity();
        $alerts = $this->vendorService->getOperationalAlerts();

        // Selected facility object if filtered
        $selectedFacility = null;
        if ($facilityId !== 'all') {
            foreach ($facilities as $f) {
                if ($f['id'] === $facilityId) {
                    $selectedFacility = $f;
                    break;
                }
            }
        }

        return view('vendor.dashboard', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'selectedFacility' => $selectedFacility,
            'metrics' => $metrics,
            'hourlyTrend' => $hourlyTrend,
            'gateActivity' => $gateActivity,
            'alerts' => $alerts,
            'currentFacility' => $facilityId,
            'currentPeriod' => $period,
        ]);
    }

    /**
     * API endpoint for live telemetry refresh.
     */
    public function apiStats(Request $request): JsonResponse
    {
        $facilityId = $request->query('facility', 'all');
        $period = $request->query('period', 'today');

        $metrics = $this->vendorService->getDashboardMetrics($facilityId, $period);
        $gateActivity = $this->vendorService->getRecentGateActivity();

        return response()->json([
            'success' => true,
            'metrics' => $metrics,
            'recent_activity' => array_slice($gateActivity, 0, 4),
            'timestamp' => date('d M Y, H:i') . ' WIB',
        ]);
    }

    /**
     * Display the Vendor Locations Management page (Page 21).
     */
    public function locations(Request $request): View
    {
        $filters = [
            'q' => $request->query('q', ''),
            'status' => $request->query('status', 'all'),
            'city' => $request->query('city', 'all'),
            'type' => $request->query('type', 'all'),
            'sort' => $request->query('sort', 'name_asc'),
        ];

        $tenant = $this->vendorService->getVendorTenant();
        $locations = $this->vendorService->getManagedLocations($filters);
        $metrics = $this->vendorService->getLocationSummaryMetrics();
        $cities = $this->vendorService->getDistinctCities();

        return view('vendor.locations', [
            'tenant' => $tenant,
            'locations' => $locations,
            'metrics' => $metrics,
            'filters' => $filters,
            'cities' => $cities,
            'activeNav' => 'locations',
        ]);
    }

    /**
     * Store a newly created parking facility for this vendor.
     */
    public function storeLocation(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'code' => 'nullable|string|max:20',
            'city' => 'required|string|max:50',
            'address' => 'required|string|min:5|max:255',
            'postal_code' => 'nullable|string|max:10',
            'zone' => 'nullable|string|max:100',
            'total_capacity' => 'required|integer|min:10|max:5000',
            'operating_hours' => 'nullable|string|max:50',
            'contact_person' => 'nullable|string|max:100',
            'contact_phone' => 'nullable|string|max:30',
            'parking_types' => 'nullable|array',
            'status' => 'nullable|in:Optimal,Attention Required,Maintenance,Inactive',
            'gates_count' => 'nullable|integer|min:1|max:50',
            'cameras_count' => 'nullable|integer|min:1|max:50',
        ]);

        $created = $this->vendorService->createLocation($validated);

        return redirect()->route('vendor.locations')
            ->with('success', "Parking facility '{$created['name']}' ({$created['code']}) was registered successfully.");
    }

    /**
     * Update an authorized location's configuration.
     */
    public function updateLocation(Request $request, string $id): RedirectResponse
    {
        $location = $this->vendorService->getLocation($id);
        if (!$location) {
            return redirect()->route('vendor.locations')
                ->with('error', 'Location not found or not authorized under your vendor tenancy.');
        }

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'city' => 'required|string|max:50',
            'address' => 'required|string|min:5|max:255',
            'postal_code' => 'nullable|string|max:10',
            'zone' => 'nullable|string|max:100',
            'total_capacity' => 'required|integer|min:10|max:5000',
            'operating_hours' => 'nullable|string|max:50',
            'contact_person' => 'nullable|string|max:100',
            'contact_phone' => 'nullable|string|max:30',
            'parking_types' => 'nullable|array',
            'status' => 'required|in:Optimal,Attention Required,Maintenance,Inactive',
        ]);

        $updated = $this->vendorService->updateLocation($id, $validated);

        return redirect()->route('vendor.locations')
            ->with('success', "Location '{$updated['name']}' configuration updated successfully.");
    }

    /**
     * Toggle operational status (e.g. set Maintenance or Optimal).
     */
    public function toggleLocationStatus(Request $request, string $id): RedirectResponse
    {
        $location = $this->vendorService->getLocation($id);
        if (!$location) {
            return redirect()->route('vendor.locations')
                ->with('error', 'Location not found or not authorized.');
        }

        $validated = $request->validate([
            'status' => 'required|in:Optimal,Attention Required,Maintenance,Inactive',
        ]);

        $updated = $this->vendorService->toggleLocationStatus($id, $validated['status']);

        return redirect()->route('vendor.locations')
            ->with('success', "Operational status for '{$updated['name']}' changed to {$updated['status']}.");
    }

    /**
     * API endpoint to get details of a single authorized location.
     */
    public function apiLocation(string $id): JsonResponse
    {
        $location = $this->vendorService->getLocation($id);
        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'Location not found or not authorized.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'location' => $location,
        ]);
    }

    /**
     * Display the Vendor Parking Area Management page (Page 22).
     */
    public function areas(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();

        if (empty($facilities)) {
            return view('vendor.areas', [
                'tenant' => $tenant,
                'facilities' => [],
                'selectedFacility' => null,
                'areas' => [],
                'metrics' => [],
                'floors' => [],
                'filters' => [],
                'activeNav' => 'areas',
            ]);
        }

        // Determine requested facility, or fallback to first authorized facility
        $facilityId = $request->query('facility', $facilities[0]['id']);
        $selectedFacility = null;
        foreach ($facilities as $fac) {
            if ($fac['id'] === $facilityId) {
                $selectedFacility = $fac;
                break;
            }
        }

        if (!$selectedFacility) {
            $selectedFacility = $facilities[0];
            $facilityId = $selectedFacility['id'];
        }

        $filters = [
            'q' => $request->query('q', ''),
            'type' => $request->query('type', 'all'),
            'status' => $request->query('status', 'all'),
            'floor' => $request->query('floor', 'all'),
            'sort' => $request->query('sort', 'name_asc'),
        ];

        $areas = $this->vendorService->getParkingAreas($facilityId, $filters);
        $metrics = $this->vendorService->getAreaSummaryMetrics($facilityId);
        $floors = $this->vendorService->getDistinctFloors($facilityId);

        return view('vendor.areas', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'selectedFacility' => $selectedFacility,
            'facilityId' => $facilityId,
            'areas' => $areas,
            'metrics' => $metrics,
            'floors' => $floors,
            'filters' => $filters,
            'activeNav' => 'areas',
        ]);
    }

    /**
     * Store a newly created parking area for a facility.
     */
    public function storeParkingArea(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'facility_id' => 'required|string',
            'name' => 'required|string|min:3|max:100',
            'code' => 'nullable|string|max:20',
            'floor' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'capacity' => 'required|integer|min:5|max:2000',
            'status' => 'required|in:Optimal,Attention Required,Maintenance,Inactive',
            'description' => 'nullable|string|max:255',
            'gates_assigned' => 'nullable|string|max:100',
        ]);

        // Security: ensure the facility belongs to authorized vendor
        $facility = $this->vendorService->getLocation($validated['facility_id']);
        if (!$facility) {
            return redirect()->route('vendor.areas')
                ->with('error', 'Unauthorized facility selected.');
        }

        $newArea = $this->vendorService->createParkingArea($validated);

        return redirect()->route('vendor.areas', ['facility' => $validated['facility_id']])
            ->with('success', "Parking area '{$newArea['name']}' ({$newArea['code']}) configured successfully.");
    }

    /**
     * Update an authorized parking area.
     */
    public function updateParkingArea(Request $request, string $id): RedirectResponse
    {
        $area = $this->vendorService->getParkingArea($id);
        if (!$area) {
            return redirect()->route('vendor.areas')
                ->with('error', 'Parking area not found or not authorized.');
        }

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'floor' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'capacity' => 'required|integer|min:5|max:2000',
            'status' => 'required|in:Optimal,Attention Required,Maintenance,Inactive',
            'description' => 'nullable|string|max:255',
            'gates_assigned' => 'nullable|string|max:100',
        ]);

        $updated = $this->vendorService->updateParkingArea($id, $validated);

        return redirect()->route('vendor.areas', ['facility' => $area['facility_id']])
            ->with('success', "Parking area '{$updated['name']}' updated successfully.");
    }

    /**
     * Toggle or update a parking area operational status.
     */
    public function toggleParkingAreaStatus(Request $request, string $id): RedirectResponse
    {
        $area = $this->vendorService->getParkingArea($id);
        if (!$area) {
            return redirect()->route('vendor.areas')
                ->with('error', 'Parking area not found or not authorized.');
        }

        $validated = $request->validate([
            'status' => 'required|in:Optimal,Attention Required,Maintenance,Inactive',
        ]);

        $updated = $this->vendorService->toggleParkingAreaStatus($id, $validated['status']);

        return redirect()->route('vendor.areas', ['facility' => $area['facility_id']])
            ->with('success', "Operational status for area '{$updated['name']}' changed to {$updated['status']}.");
    }

    /**
     * API endpoint to get details of a single parking area.
     */
    public function apiParkingArea(string $id): JsonResponse
    {
        $area = $this->vendorService->getParkingArea($id);
        if (!$area) {
            return response()->json([
                'success' => false,
                'message' => 'Parking area not found or not authorized.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'area' => $area,
        ]);
    }

    /**
     * Display the Vendor Operational Parking Map (Page 23).
     */
    public function parkingMap(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();

        if (empty($facilities)) {
            return view('vendor.map', [
                'tenant' => $tenant,
                'facilities' => [],
                'selectedFacility' => null,
                'areas' => [],
                'selectedArea' => null,
                'mapData' => null,
                'activeNav' => 'map',
            ]);
        }

        // Determine requested facility or fallback to first authorized facility
        $facilityId = $request->query('facility', $facilities[0]['id']);
        $selectedFacility = null;
        foreach ($facilities as $fac) {
            if ($fac['id'] === $facilityId) {
                $selectedFacility = $fac;
                break;
            }
        }
        if (!$selectedFacility) {
            $selectedFacility = $facilities[0];
            $facilityId = $selectedFacility['id'];
        }

        $areaId = $request->query('area', null);
        $mapData = $this->vendorService->getFacilityMapData($facilityId, $areaId);

        return view('vendor.map', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'selectedFacility' => $selectedFacility,
            'facilityId' => $facilityId,
            'areaId' => $mapData['selected_area']['id'] ?? null,
            'areas' => $mapData['areas'] ?? [],
            'selectedArea' => $mapData['selected_area'] ?? null,
            'mapData' => $mapData,
            'activeNav' => 'map',
        ]);
    }

    /**
     * API endpoint to get JSON map layout & slots telemetry for an authorized facility and area.
     */
    public function apiMapData(Request $request, string $facilityId): JsonResponse
    {
        $areaId = $request->query('area', null);
        $mapData = $this->vendorService->getFacilityMapData($facilityId, $areaId);

        if (!$mapData) {
            return response()->json([
                'success' => false,
                'message' => 'Facility not found or not authorized under your vendor tenancy.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $mapData,
            'timestamp' => date('d M Y, H:i') . ' WIB',
        ]);
    }

    /**
     * Display the Vendor Parking Slots Management page (Page 24).
     */
    public function slots(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();

        if (empty($facilities)) {
            return view('vendor.slots', [
                'tenant' => $tenant,
                'facilities' => [],
                'selectedFacility' => null,
                'areas' => [],
                'selectedArea' => null,
                'slots' => [],
                'pagination' => [
                    'current_page' => 1,
                    'last_page' => 1,
                    'total' => 0,
                    'per_page' => 15,
                    'from' => 0,
                    'to' => 0,
                ],
                'metrics' => [
                    'total_slots' => 0,
                    'available_count' => 0,
                    'occupied_count' => 0,
                    'reserved_count' => 0,
                    'maintenance_count' => 0,
                    'operational_count' => 0,
                    'decommissioned_count' => 0,
                    'occupancy_rate' => 0,
                    'ev_count' => 0,
                    'vip_count' => 0,
                    'motorcycle_count' => 0,
                    'standard_count' => 0,
                ],
                'filters' => [
                    'q' => '',
                    'category' => 'all',
                    'operational_status' => 'all',
                    'occupancy_status' => 'all',
                    'sort' => 'code_asc',
                ],
                'hasActiveFilters' => false,
                'activeNav' => 'slots',
            ]);
        }

        // Determine requested facility
        $facilityId = $request->query('facility', $facilities[0]['id']);
        $selectedFacility = null;
        foreach ($facilities as $fac) {
            if ($fac['id'] === $facilityId) {
                $selectedFacility = $fac;
                break;
            }
        }
        if (!$selectedFacility) {
            $selectedFacility = $facilities[0];
            $facilityId = $selectedFacility['id'];
        }

        // Available areas in this facility
        $areas = $this->vendorService->getParkingAreas($facilityId);

        // Selected area filter
        $areaId = $request->query('area', 'all');
        $selectedArea = null;
        if ($areaId !== 'all') {
            foreach ($areas as $a) {
                if ($a['id'] === $areaId) {
                    $selectedArea = $a;
                    break;
                }
            }
        }

        // Filters
        $filters = [
            'q' => trim($request->query('q', '')),
            'category' => $request->query('category', 'all'),
            'operational_status' => $request->query('operational_status', 'all'),
            'occupancy_status' => $request->query('occupancy_status', 'all'),
            'sort' => $request->query('sort', 'code_asc'),
        ];

        $hasActiveFilters = !empty($filters['q']) 
            || ($filters['category'] !== 'all') 
            || ($filters['operational_status'] !== 'all') 
            || ($filters['occupancy_status'] !== 'all') 
            || ($areaId !== 'all') 
            || ($filters['sort'] !== 'code_asc');

        // Fetch all matching slots
        $allMatchingSlots = $this->vendorService->getParkingSlots($facilityId, $areaId, $filters);
        $total = count($allMatchingSlots);

        // Paginate results
        $perPage = 15;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedSlots = array_slice($allMatchingSlots, $offset, $perPage);
        $from = $total > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $total);

        // Operational metrics
        $metrics = $this->vendorService->getSlotSummaryMetrics($facilityId, $areaId);

        return view('vendor.slots', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'selectedFacility' => $selectedFacility,
            'facilityId' => $facilityId,
            'areas' => $areas,
            'selectedArea' => $selectedArea,
            'areaId' => $areaId,
            'slots' => $pagedSlots,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'per_page' => $perPage,
                'from' => $from,
                'to' => $to,
            ],
            'metrics' => $metrics,
            'filters' => $filters,
            'hasActiveFilters' => $hasActiveFilters,
            'activeNav' => 'slots',
        ]);
    }

    /**
     * Store a newly created parking slot.
     */
    public function storeSlot(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'facility_id' => 'required|string',
            'area_id' => 'required|string',
            'code' => 'required|string|max:20',
            'category' => 'required|string|in:standard,motorcycle,vip,ev',
            'operational_status' => 'required|string|in:Operational,Maintenance,Reserved',
            'sensor_id' => 'nullable|string|max:50',
            'maintenance_note' => 'nullable|string|max:255',
        ]);

        $code = strtoupper(trim($validated['code']));

        // Check uniqueness in the same area
        $existing = $this->vendorService->getParkingSlots($validated['facility_id'], $validated['area_id']);
        foreach ($existing as $s) {
            if (strcasecmp($s['code'], $code) === 0) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "A parking space with code '{$code}' already exists in the selected parking area.");
            }
        }

        $newSlot = $this->vendorService->createParkingSlot($validated);

        return redirect()->route('vendor.slots', [
            'facility' => $validated['facility_id'],
            'area' => $validated['area_id'],
        ])->with('success', "Parking space '{$newSlot['code']}' ({$newSlot['category_label']}) was successfully created.");
    }

    /**
     * Update an existing parking slot.
     */
    public function updateSlot(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20',
            'area_id' => 'required|string',
            'category' => 'required|string|in:standard,motorcycle,vip,ev',
            'operational_status' => 'required|string|in:Operational,Maintenance,Reserved,Decommissioned',
            'sensor_id' => 'nullable|string|max:50',
            'maintenance_note' => 'nullable|string|max:255',
        ]);

        $currentSlot = $this->vendorService->getParkingSlot($id);
        if (!$currentSlot) {
            return redirect()->back()->with('error', 'Parking space record not found.');
        }

        $code = strtoupper(trim($validated['code']));

        // If code changed or area changed, check uniqueness
        if (strcasecmp($currentSlot['code'], $code) !== 0 || $currentSlot['area_id'] !== $validated['area_id']) {
            $existing = $this->vendorService->getParkingSlots($currentSlot['facility_id'], $validated['area_id']);
            foreach ($existing as $s) {
                if ($s['id'] !== $id && strcasecmp($s['code'], $code) === 0) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Another space with code '{$code}' already exists in that area.");
                }
            }
        }

        $updated = $this->vendorService->updateParkingSlot($id, $validated);

        return redirect()->route('vendor.slots', [
            'facility' => $updated['facility_id'],
            'area' => $updated['area_id'],
        ])->with('success', "Parking space '{$updated['code']}' configuration updated successfully.");
    }

    /**
     * Quick toggle parking slot operational status.
     */
    public function toggleSlotStatus(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:Operational,Maintenance,Reserved,Decommissioned',
        ]);

        $updated = $this->vendorService->toggleParkingSlotStatus($id, $validated['status']);

        if (!$updated) {
            return redirect()->back()->with('error', 'Parking space record not found.');
        }

        return redirect()->back()->with('success', "Operational status for space '{$updated['code']}' changed to {$updated['operational_status']}.");
    }

    /**
     * Delete or archive an authorized parking slot.
     */
    public function destroySlot(Request $request, string $id): RedirectResponse
    {
        $result = $this->vendorService->deleteParkingSlot($id);

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->back()->with('success', $result['message']);
    }

    /**
     * API endpoint to get details of a single parking space.
     */
    public function apiSlot(string $id): JsonResponse
    {
        $slot = $this->vendorService->getParkingSlot($id);
        if (!$slot) {
            return response()->json([
                'success' => false,
                'message' => 'Parking space record not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'slot' => $slot,
        ]);
    }

    /**
     * Display the Vendor Gates Management & Monitoring page (Page 25).
     */
    public function gates(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();

        if (empty($facilities)) {
            return view('vendor.gates', [
                'tenant' => $tenant,
                'facilities' => [],
                'selectedFacility' => null,
                'facilityId' => 'all',
                'areas' => [],
                'gates' => [],
                'recentLogs' => [],
                'pagination' => [
                    'current_page' => 1,
                    'last_page' => 1,
                    'total' => 0,
                    'per_page' => 12,
                    'from' => 0,
                    'to' => 0,
                ],
                'metrics' => [
                    'total_gates' => 0,
                    'online_count' => 0,
                    'offline_count' => 0,
                    'degraded_count' => 0,
                    'operational_count' => 0,
                    'maintenance_count' => 0,
                    'fault_count' => 0,
                    'today_cycles_total' => 0,
                    'health_rate' => 100,
                    'last_sync' => date('d M Y, H:i') . ' WIB',
                ],
                'filters' => [
                    'q' => '',
                    'direction' => 'all',
                    'connectivity' => 'all',
                    'operational_status' => 'all',
                    'barrier_type' => 'all',
                    'sort' => 'code_asc',
                ],
                'hasActiveFilters' => false,
                'activeNav' => 'gates',
            ]);
        }

        // Determine requested facility ('all' or specific facility ID)
        $facilityId = $request->query('facility', 'all');
        $selectedFacility = null;
        if ($facilityId !== 'all') {
            foreach ($facilities as $fac) {
                if ($fac['id'] === $facilityId) {
                    $selectedFacility = $fac;
                    break;
                }
            }
            if (!$selectedFacility) {
                $facilityId = 'all';
            }
        }

        // Areas for the selected facility or all authorized areas for creation modal
        $areas = [];
        if ($facilityId !== 'all') {
            $areas = $this->vendorService->getParkingAreas($facilityId);
        } else {
            foreach ($facilities as $fac) {
                $areas = array_merge($areas, $this->vendorService->getParkingAreas($fac['id']));
            }
        }

        // Filters
        $filters = [
            'q' => trim($request->query('q', '')),
            'direction' => $request->query('direction', 'all'),
            'connectivity' => $request->query('connectivity', 'all'),
            'operational_status' => $request->query('operational_status', 'all'),
            'barrier_type' => $request->query('barrier_type', 'all'),
            'sort' => $request->query('sort', 'code_asc'),
        ];

        $hasActiveFilters = !empty($filters['q'])
            || ($filters['direction'] !== 'all')
            || ($filters['connectivity'] !== 'all')
            || ($filters['operational_status'] !== 'all')
            || ($filters['barrier_type'] !== 'all')
            || ($filters['sort'] !== 'code_asc');

        // Fetch all matching gates
        $allMatchingGates = $this->vendorService->getGates($facilityId, $filters);
        $total = count($allMatchingGates);

        // Paginate results
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedGates = array_slice($allMatchingGates, $offset, $perPage);
        $from = $total > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $total);

        // Operational summary metrics
        $metrics = $this->vendorService->getGateSummaryMetrics($facilityId);

        // Recent activity events
        $recentLogs = $this->vendorService->getGateLogs(null, $facilityId, 15);

        return view('vendor.gates', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'selectedFacility' => $selectedFacility,
            'facilityId' => $facilityId,
            'areas' => $areas,
            'gates' => $pagedGates,
            'allMatchingGates' => $allMatchingGates,
            'recentLogs' => $recentLogs,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'per_page' => $perPage,
                'from' => $from,
                'to' => $to,
            ],
            'metrics' => $metrics,
            'filters' => $filters,
            'hasActiveFilters' => $hasActiveFilters,
            'activeNav' => 'gates',
        ]);
    }

    /**
     * Store a newly created barrier gate.
     */
    public function storeGate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20',
            'name' => 'required|string|max:100',
            'facility_id' => 'required|string',
            'area_id' => 'nullable|string',
            'lane_name' => 'nullable|string|max:60',
            'direction' => 'required|string|in:entry,exit,bidirectional',
            'barrier_type' => 'required|string|max:100',
            'barrier_model' => 'nullable|string|max:100',
            'controller_id' => 'required|string|max:60',
            'ip_address' => 'required|string|max:45',
            'operational_status' => 'required|string|in:Operational,Maintenance,Fault Detected,Emergency Open',
        ]);

        // Validate facility authorization under vendor tenant
        $facilities = $this->vendorService->getFacilities();
        $authorized = false;
        foreach ($facilities as $fac) {
            if ($fac['id'] === $validated['facility_id']) {
                $authorized = true;
                break;
            }
        }

        if (!$authorized) {
            return redirect()->back()->with('error', 'Unauthorized facility selection. Device must belong to your assigned properties.');
        }

        $created = $this->vendorService->createGate($validated);

        return redirect()->route('vendor.gates', ['facility' => $created['facility_id']])
            ->with('success', "Barrier Gate '{$created['code']}' ({$created['name']}) successfully provisioned and online.");
    }

    /**
     * Update an existing barrier gate configuration.
     */
    public function updateGate(Request $request, string $id): RedirectResponse
    {
        $gate = $this->vendorService->getGate($id);
        if (!$gate) {
            return redirect()->back()->with('error', 'Gate device record not found.');
        }

        $validated = $request->validate([
            'code' => 'required|string|max:20',
            'name' => 'required|string|max:100',
            'area_id' => 'nullable|string',
            'lane_name' => 'nullable|string|max:60',
            'direction' => 'required|string|in:entry,exit,bidirectional',
            'barrier_type' => 'required|string|max:100',
            'barrier_model' => 'nullable|string|max:100',
            'controller_id' => 'required|string|max:60',
            'ip_address' => 'required|string|max:45',
            'operational_status' => 'required|string|in:Operational,Maintenance,Fault Detected,Emergency Open',
            'fault_description' => 'nullable|string|max:255',
        ]);

        $updated = $this->vendorService->updateGate($id, $validated);

        return redirect()->back()->with('success', "Barrier Gate '{$updated['code']}' configuration updated successfully.");
    }

    /**
     * Execute an operational physical command on a barrier gate with safety confirmation.
     */
    public function executeGateCommand(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'command' => 'required|string|in:raise,lower,open,close,test_cycle',
            'reason' => 'required|string|min:4|max:255',
            'safety_acknowledged' => 'required|in:1,true,on',
        ]);

        $operatorName = 'Budi Santoso (Senior Gate Operator)';
        $result = $this->vendorService->executeGateCommand($id, $validated['command'], $validated['reason'], $operatorName);

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->back()->with('success', $result['message']);
    }

    /**
     * Quick toggle gate operational status.
     */
    public function toggleGateStatus(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:Operational,Maintenance,Fault Detected,Emergency Open',
            'fault_description' => 'nullable|string|max:255',
        ]);

        $updated = $this->vendorService->toggleGateStatus($id, $validated['status'], $validated['fault_description'] ?? null);

        if (!$updated) {
            return redirect()->back()->with('error', 'Gate device record not found.');
        }

        return redirect()->back()->with('success', "Operational status for gate '{$updated['code']}' set to {$updated['operational_status']}.");
    }

    /**
     * Delete or decommission an authorized gate device.
     */
    public function destroyGate(Request $request, string $id): RedirectResponse
    {
        $result = $this->vendorService->deleteGate($id);

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->back()->with('success', $result['message']);
    }

    /**
     * API endpoint to get details of a single gate device.
     */
    public function apiGate(string $id): JsonResponse
    {
        $gate = $this->vendorService->getGate($id);
        if (!$gate) {
            return response()->json([
                'success' => false,
                'message' => 'Barrier gate record not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'gate' => $gate,
        ]);
    }

    /**
     * API endpoint to get telemetry activity logs for a gate device.
     */
    public function apiGateLogs(Request $request, string $id): JsonResponse
    {
        $gate = $this->vendorService->getGate($id);
        if (!$gate) {
            return response()->json([
                'success' => false,
                'message' => 'Barrier gate record not found.',
            ], 404);
        }

        $logs = $this->vendorService->getGateLogs($id, 'all', 20);

        return response()->json([
            'success' => true,
            'gate' => $gate,
            'logs' => $logs,
        ]);
    }

    /**
     * Display the Vendor ANPR Monitoring & Review page (Page 26).
     */
    public function anpr(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();

        if (empty($facilities)) {
            return view('vendor.anpr', [
                'tenant' => $tenant,
                'facilities' => [],
                'selectedFacility' => null,
                'facilityId' => 'all',
                'cameras' => [],
                'gates' => [],
                'events' => [],
                'pagination' => [
                    'current_page' => 1,
                    'last_page' => 1,
                    'total' => 0,
                    'per_page' => 10,
                    'from' => 0,
                    'to' => 0,
                ],
                'metrics' => [
                    'total_cameras' => 0,
                    'online_cameras' => 0,
                    'offline_cameras' => 0,
                    'degraded_cameras' => 0,
                    'camera_online_rate' => 100,
                    'total_events' => 0,
                    'successful_count' => 0,
                    'unreadable_count' => 0,
                    'no_plate_count' => 0,
                    'failed_count' => 0,
                    'review_required_count' => 0,
                    'success_rate' => 100,
                    'last_sync' => date('d M Y, H:i') . ' WIB',
                ],
                'filters' => [
                    'q' => '',
                    'camera' => 'all',
                    'gate' => 'all',
                    'direction' => 'all',
                    'outcome' => 'all',
                    'review_status' => 'all',
                    'sort' => 'timestamp_desc',
                ],
                'hasActiveFilters' => false,
                'activeNav' => 'anpr',
            ]);
        }

        // Selected facility ('all' or specific facility ID)
        $facilityId = $request->query('facility', 'all');
        $selectedFacility = null;
        if ($facilityId !== 'all') {
            foreach ($facilities as $fac) {
                if ($fac['id'] === $facilityId) {
                    $selectedFacility = $fac;
                    break;
                }
            }
            if (!$selectedFacility) {
                $facilityId = 'all';
            }
        }

        // Associated cameras and gates for filter dropdowns
        $cameras = $this->vendorService->getAnprCameras($facilityId);
        $gates = $this->vendorService->getGates($facilityId);

        // Filters
        $filters = [
            'q' => trim($request->query('q', '')),
            'camera' => $request->query('camera', 'all'),
            'gate' => $request->query('gate', 'all'),
            'direction' => $request->query('direction', 'all'),
            'outcome' => $request->query('outcome', 'all'),
            'review_status' => $request->query('review_status', 'all'),
            'sort' => $request->query('sort', 'timestamp_desc'),
        ];

        $hasActiveFilters = !empty($filters['q'])
            || ($filters['camera'] !== 'all')
            || ($filters['gate'] !== 'all')
            || ($filters['direction'] !== 'all')
            || ($filters['outcome'] !== 'all')
            || ($filters['review_status'] !== 'all')
            || ($filters['sort'] !== 'timestamp_desc');

        // Fetch matching ANPR recognition events
        $allMatchingEvents = $this->vendorService->getAnprEvents($facilityId, $filters);
        $total = count($allMatchingEvents);

        // Paginate results
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedEvents = array_slice($allMatchingEvents, $offset, $perPage);
        $from = $total > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $total);

        // Operational summary metrics
        $metrics = $this->vendorService->getAnprSummaryMetrics($facilityId);

        return view('vendor.anpr', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'selectedFacility' => $selectedFacility,
            'facilityId' => $facilityId,
            'cameras' => $cameras,
            'gates' => $gates,
            'events' => $pagedEvents,
            'allMatchingEvents' => $allMatchingEvents,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'per_page' => $perPage,
                'from' => $from,
                'to' => $to,
            ],
            'metrics' => $metrics,
            'filters' => $filters,
            'hasActiveFilters' => $hasActiveFilters,
            'activeNav' => 'anpr',
        ]);
    }

    /**
     * Submit an authoritative manual review or plate correction for an ANPR recognition event.
     */
    public function reviewEvent(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'review_status' => 'required|string|in:Verified,Manually Corrected,Flagged',
            'corrected_plate' => 'nullable|string|max:15',
            'review_reason' => 'required|string|min:4|max:255',
        ]);

        $operator = 'Budi Santoso (Operations Lead)';
        $updated = $this->vendorService->reviewAnprEvent($id, $validated, $operator);

        if (!$updated) {
            return redirect()->back()->with('error', 'Recognition event record not found.');
        }

        $plateLabel = $updated['recognized_plate'] ?: 'Unidentified';
        return redirect()->back()->with('success', "Recognition event {$updated['event_uuid']} successfully updated. Plate: {$plateLabel} marked as {$updated['review_status']}.");
    }

    /**
     * API endpoint to get details of a single ANPR event.
     */
    public function apiAnprEvent(string $id): JsonResponse
    {
        $event = $this->vendorService->getAnprEvent($id);
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Recognition event record not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'event' => $event,
        ]);
    }

    /**
     * API endpoint to get details of a single ANPR camera.
     */
    public function apiAnprCamera(string $id): JsonResponse
    {
        $camera = $this->vendorService->getAnprCamera($id);
        if (!$camera) {
            return response()->json([
                'success' => false,
                'message' => 'ANPR camera device not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'camera' => $camera,
        ]);
    }

    /**
     * Display the Vendor IoT Devices Monitoring & Inventory page (Page 27).
     */
    public function iotDevices(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();

        if (empty($facilities)) {
            return view('vendor.iot-devices', [
                'tenant' => $tenant,
                'facilities' => [],
                'selectedFacility' => null,
                'facilityId' => 'all',
                'areas' => [],
                'devices' => [],
                'allMatchingDevices' => [],
                'recentLogs' => [],
                'pagination' => [
                    'current_page' => 1,
                    'last_page' => 1,
                    'total' => 0,
                    'per_page' => 12,
                    'from' => 0,
                    'to' => 0,
                ],
                'metrics' => [
                    'total_devices' => 0,
                    'online_count' => 0,
                    'offline_count' => 0,
                    'degraded_count' => 0,
                    'healthy_count' => 0,
                    'warning_count' => 0,
                    'fault_count' => 0,
                    'maintenance_count' => 0,
                    'health_rate' => 100.0,
                    'last_sync' => date('d M Y, H:i') . ' WIB',
                ],
                'filters' => [
                    'q' => '',
                    'area' => 'all',
                    'device_type' => 'all',
                    'connectivity' => 'all',
                    'health_status' => 'all',
                    'sort' => 'code_asc',
                ],
                'hasActiveFilters' => false,
                'activeNav' => 'iot',
            ]);
        }

        // Determine requested facility
        $facilityId = $request->query('facility', 'all');
        $selectedFacility = null;
        if ($facilityId !== 'all') {
            foreach ($facilities as $fac) {
                if ($fac['id'] === $facilityId) {
                    $selectedFacility = $fac;
                    break;
                }
            }
            if (!$selectedFacility) {
                $facilityId = 'all';
            }
        }

        // Parking areas for selected facility or all facilities (for registration modal)
        $areas = [];
        if ($facilityId !== 'all') {
            $areas = $this->vendorService->getParkingAreas($facilityId);
        } else {
            foreach ($facilities as $fac) {
                $areas = array_merge($areas, $this->vendorService->getParkingAreas($fac['id']));
            }
        }

        // Filters
        $filters = [
            'q' => trim($request->query('q', '')),
            'area' => $request->query('area', 'all'),
            'device_type' => $request->query('device_type', 'all'),
            'connectivity' => $request->query('connectivity', 'all'),
            'health_status' => $request->query('health_status', 'all'),
            'sort' => $request->query('sort', 'code_asc'),
        ];

        $hasActiveFilters = !empty($filters['q'])
            || ($filters['area'] !== 'all')
            || ($filters['device_type'] !== 'all')
            || ($filters['connectivity'] !== 'all')
            || ($filters['health_status'] !== 'all')
            || ($filters['sort'] !== 'code_asc');

        // Fetch all matching devices
        $allMatchingDevices = $this->vendorService->getIotDevices($facilityId, $filters);
        $total = count($allMatchingDevices);

        // Paginate results
        $perPage = 12;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedDevices = array_slice($allMatchingDevices, $offset, $perPage);
        $from = $total > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $total);

        // Operational summary metrics
        $metrics = $this->vendorService->getIotSummaryMetrics($facilityId);

        // Recent diagnostic event logs
        $recentLogs = $this->vendorService->getIotDeviceLogs(null, $facilityId, 10);

        return view('vendor.iot-devices', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'selectedFacility' => $selectedFacility,
            'facilityId' => $facilityId,
            'areas' => $areas,
            'devices' => $pagedDevices,
            'allMatchingDevices' => $allMatchingDevices,
            'recentLogs' => $recentLogs,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'per_page' => $perPage,
                'from' => $from,
                'to' => $to,
            ],
            'metrics' => $metrics,
            'filters' => $filters,
            'hasActiveFilters' => $hasActiveFilters,
            'activeNav' => 'iot',
        ]);
    }

    /**
     * Store a newly registered IoT device.
     */
    public function storeIotDevice(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'facility_id' => 'required|string',
            'area_id' => 'nullable|string',
            'device_code' => 'required|string|max:30',
            'name' => 'required|string|max:100',
            'device_type' => 'required|string|in:barrier_controller,anpr_camera,slot_sensor,guidance_display,payment_kiosk,edge_gateway,loop_detector,safety_beam',
            'manufacturer' => 'nullable|string|max:50',
            'model' => 'nullable|string|max:80',
            'serial_number' => 'nullable|string|max:50',
            'ip_address' => 'nullable|string|max:45',
            'mac_address' => 'nullable|string|max:20',
            'protocol' => 'nullable|string|max:50',
            'associated_entity' => 'nullable|string|max:100',
        ]);

        $code = strtoupper(trim($validated['device_code']));

        // Check uniqueness across fleet
        $existing = $this->vendorService->getIotDevices('all');
        foreach ($existing as $d) {
            if (strcasecmp($d['device_code'], $code) === 0) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "An IoT device with identifier '{$code}' is already registered in your fleet.");
            }
        }

        $newDevice = $this->vendorService->createIotDevice($validated);

        return redirect()->back()->with('success', "IoT Device '{$newDevice['device_code']}' registered and provisioned successfully.");
    }

    /**
     * Update an existing IoT device configuration.
     */
    public function updateIotDevice(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'manufacturer' => 'nullable|string|max:50',
            'model' => 'nullable|string|max:80',
            'ip_address' => 'nullable|string|max:45',
            'mac_address' => 'nullable|string|max:20',
            'firmware_version' => 'nullable|string|max:30',
            'protocol' => 'nullable|string|max:50',
            'associated_entity' => 'nullable|string|max:100',
            'health_status' => 'required|string|in:Healthy,Warning,Fault,Maintenance',
            'health_note' => 'nullable|string|max:255',
        ]);

        $updated = $this->vendorService->updateIotDevice($id, $validated);

        if (!$updated) {
            return redirect()->back()->with('error', 'IoT Device record not found.');
        }

        return redirect()->back()->with('success', "Configuration for device '{$updated['device_code']}' updated successfully.");
    }

    /**
     * Toggle maintenance or operational state for an IoT device.
     */
    public function toggleIotDeviceStatus(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:Healthy,Warning,Fault,Maintenance',
        ]);

        $updated = $this->vendorService->toggleIotDeviceStatus($id, $validated['status']);

        if (!$updated) {
            return redirect()->back()->with('error', 'IoT Device record not found.');
        }

        return redirect()->back()->with('success', "Status for '{$updated['device_code']}' updated to {$updated['health_status']}.");
    }

    /**
     * Decommission / remove an IoT device from fleet.
     */
    public function destroyIotDevice(Request $request, string $id): RedirectResponse
    {
        $result = $this->vendorService->deleteIotDevice($id);

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->back()->with('success', $result['message']);
    }

    /**
     * API endpoint to get details of a single IoT device.
     */
    public function apiIotDevice(string $id): JsonResponse
    {
        $device = $this->vendorService->getIotDevice($id);
        if (!$device) {
            return response()->json([
                'success' => false,
                'message' => 'IoT Device record not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'device' => $device,
        ]);
    }

    /**
     * API endpoint to probe/ping an IoT device on-demand.
     */
    public function apiPingIotDevice(string $id): JsonResponse
    {
        $result = $this->vendorService->pingIotDevice($id);
        return response()->json($result);
    }

    /* =========================================================================
     * PHASE 2, PAGE 28: VENDOR PARKING SESSIONS
     * ========================================================================= */

    /**
     * Display the Vendor Parking Sessions operational monitoring page (Page 28).
     */
    public function sessions(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();

        if (empty($facilities)) {
            return view('vendor.parking-sessions', [
                'tenant' => $tenant,
                'facilities' => [],
                'selectedFacility' => null,
                'facilityId' => 'all',
                'areas' => [],
                'sessions' => [],
                'pagination' => [
                    'current_page' => 1,
                    'last_page' => 1,
                    'total' => 0,
                    'per_page' => 10,
                    'from' => 0,
                    'to' => 0,
                ],
                'metrics' => [
                    'active_sessions_count' => 0,
                    'completed_sessions_count' => 0,
                    'attention_required_count' => 0,
                    'total_period_fee' => 0,
                    'formatted_total_fee' => 'Rp 0',
                    'average_duration_formatted' => '0m',
                    'total_records_count' => 0,
                    'last_sync_time' => date('d M Y, H:i') . ' WIB',
                ],
                'filters' => [
                    'q' => '',
                    'period' => 'all',
                    'status' => 'all',
                    'payment_status' => 'all',
                    'area' => 'all',
                    'sort' => 'entry_desc',
                ],
                'hasActiveFilters' => false,
                'activeNav' => 'sessions',
            ]);
        }

        // Selected facility ('all' or specific facility ID)
        $facilityId = $request->query('facility', 'all');
        $selectedFacility = null;
        if ($facilityId !== 'all') {
            foreach ($facilities as $fac) {
                if ($fac['id'] === $facilityId) {
                    $selectedFacility = $fac;
                    break;
                }
            }
            if (!$selectedFacility) {
                $facilityId = 'all';
            }
        }

        // Associated parking areas for filter dropdown
        $allAreas = [];
        if ($facilityId === 'all') {
            foreach ($facilities as $fac) {
                $facilityAreas = $this->vendorService->getParkingAreas($fac['id']);
                $allAreas = array_merge($allAreas, $facilityAreas);
            }
            $areas = $allAreas;
        } else {
            $areas = $this->vendorService->getParkingAreas($facilityId);
        }

        // Filters
        $filters = [
            'q' => trim($request->query('q', '')),
            'period' => $request->query('period', 'all'),
            'status' => $request->query('status', 'all'),
            'payment_status' => $request->query('payment_status', 'all'),
            'area' => $request->query('area', 'all'),
            'sort' => $request->query('sort', 'entry_desc'),
        ];

        $hasActiveFilters = !empty($filters['q'])
            || ($filters['period'] !== 'all')
            || ($filters['status'] !== 'all')
            || ($filters['payment_status'] !== 'all')
            || ($filters['area'] !== 'all')
            || ($filters['sort'] !== 'entry_desc');

        // Fetch matching parking sessions
        $allMatchingSessions = $this->vendorService->getParkingSessions($facilityId, $filters);
        $total = count($allMatchingSessions);

        // Paginate results (10 items per page)
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedSessions = array_slice($allMatchingSessions, $offset, $perPage);
        $from = $total > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $total);

        // Summary metrics
        $metrics = $this->vendorService->getSessionSummaryMetrics($facilityId, $filters['period']);

        return view('vendor.parking-sessions', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'selectedFacility' => $selectedFacility,
            'facilityId' => $facilityId,
            'areas' => $areas,
            'sessions' => $pagedSessions,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'per_page' => $perPage,
                'from' => $from,
                'to' => $to,
            ],
            'metrics' => $metrics,
            'filters' => $filters,
            'hasActiveFilters' => $hasActiveFilters,
            'activeNav' => 'sessions',
        ]);
    }

    /**
     * API endpoint to get details of a single parking session.
     */
    public function apiSession(string $id): JsonResponse
    {
        $session = $this->vendorService->getParkingSession($id);
        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => 'Parking session record not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'session' => $session,
        ]);
    }

    /**
     * Flag a parking session for operator manual investigation.
     */
    public function flagSession(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $updated = $this->vendorService->flagParkingSession($id, $validated['reason'], $validated['notes'] ?? '');

        if (!$updated) {
            return redirect()->back()->with('error', 'Parking session record not found.');
        }

        return redirect()->back()->with('success', "Session '{$updated['session_code']}' has been flagged for operator review.");
    }

    /**
     * Resolve an operational flag on a parking session.
     */
    public function resolveSession(Request $request, string $id): RedirectResponse
    {
        $notes = $request->input('notes', '');
        $updated = $this->vendorService->resolveParkingSession($id, $notes);

        if (!$updated) {
            return redirect()->back()->with('error', 'Parking session record not found.');
        }

        return redirect()->back()->with('success', "Operational flag cleared for session '{$updated['session_code']}'.");
    }

    /**
     * Export parking sessions to CSV format.
     */
    public function exportSessions(Request $request)
    {
        $facilityId = $request->query('facility', 'all');
        $filters = [
            'q' => trim($request->query('q', '')),
            'period' => $request->query('period', 'all'),
            'status' => $request->query('status', 'all'),
            'payment_status' => $request->query('payment_status', 'all'),
            'area' => $request->query('area', 'all'),
            'sort' => $request->query('sort', 'entry_desc'),
        ];

        $sessions = $this->vendorService->getParkingSessions($facilityId, $filters);
        $filename = 'parking-sessions-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($sessions) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'Session Reference',
                'Vehicle Plate',
                'Vehicle Model',
                'Vehicle Type',
                'Facility',
                'Parking Area',
                'Slot Bay',
                'Entry Time',
                'Exit Time',
                'Duration',
                'Base Fee (IDR)',
                'Total Fee (IDR)',
                'Session Status',
                'Payment Status',
                'Payment Method',
                'Payment Ref',
            ]);

            foreach ($sessions as $s) {
                fputcsv($handle, [
                    $s['session_code'] ?? '',
                    $s['vehicle_plate'] ?? '',
                    $s['vehicle_model'] ?? '',
                    $s['vehicle_type'] ?? '',
                    $s['facility_name'] ?? '',
                    $s['area_name'] ?? '',
                    $s['slot_code'] ?? 'Unassigned',
                    $s['entry_time'] ?? '',
                    $s['exit_time'] ?? 'Currently Parked',
                    $s['duration_formatted'] ?? '',
                    $s['base_fee'] ?? 0,
                    $s['total_fee'] ?? 0,
                    $s['session_status_label'] ?? '',
                    $s['payment_status_label'] ?? '',
                    $s['payment_method'] ?? '',
                    $s['payment_reference'] ?? '-',
                ]);
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }

    /* =========================================================================
     * PHASE 2, PAGE 29: VENDOR TRANSACTIONS
     * ========================================================================= */

    /**
     * Display the Vendor Transactions monitoring and reconciliation page (Page 29).
     */
    public function transactions(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();

        if (empty($facilities)) {
            return view('vendor.transactions', [
                'tenant' => $tenant,
                'facilities' => [],
                'selectedFacility' => null,
                'facilityId' => 'all',
                'transactions' => [],
                'pagination' => [
                    'current_page' => 1,
                    'last_page' => 1,
                    'total' => 0,
                    'per_page' => 10,
                    'from' => 0,
                    'to' => 0,
                ],
                'metrics' => [
                    'total_transactions_count' => 0,
                    'successful_count' => 0,
                    'success_rate' => 100.0,
                    'pending_count' => 0,
                    'failed_count' => 0,
                    'refunded_count' => 0,
                    'disputed_count' => 0,
                    'attention_count' => 0,
                    'gross_volume' => 0,
                    'formatted_gross_volume' => 'Rp 0',
                    'refunded_volume' => 0,
                    'formatted_refunded_volume' => 'Rp 0',
                    'last_reconciled_time' => date('d M Y, H:i') . ' WIB',
                ],
                'filters' => [
                    'q' => '',
                    'period' => 'all',
                    'status' => 'all',
                    'payment_method' => 'all',
                    'settlement_status' => 'all',
                    'sort' => 'date_desc',
                ],
                'hasActiveFilters' => false,
                'activeNav' => 'transactions',
            ]);
        }

        // Selected facility ('all' or specific facility ID)
        $facilityId = $request->query('facility', 'all');
        $selectedFacility = null;
        if ($facilityId !== 'all') {
            foreach ($facilities as $fac) {
                if ($fac['id'] === $facilityId) {
                    $selectedFacility = $fac;
                    break;
                }
            }
            if (!$selectedFacility) {
                $facilityId = 'all';
            }
        }

        // Filters
        $filters = [
            'q' => trim($request->query('q', '')),
            'period' => $request->query('period', 'all'),
            'status' => $request->query('status', 'all'),
            'payment_method' => $request->query('payment_method', 'all'),
            'settlement_status' => $request->query('settlement_status', 'all'),
            'sort' => $request->query('sort', 'date_desc'),
        ];

        $hasActiveFilters = !empty($filters['q'])
            || ($filters['period'] !== 'all')
            || ($filters['status'] !== 'all')
            || ($filters['payment_method'] !== 'all')
            || ($filters['settlement_status'] !== 'all')
            || ($filters['sort'] !== 'date_desc');

        // Fetch matching transactions
        $allMatchingTransactions = $this->vendorService->getTransactions($facilityId, $filters);
        $total = count($allMatchingTransactions);

        // Paginate results (10 items per page)
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedTransactions = array_slice($allMatchingTransactions, $offset, $perPage);
        $from = $total > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $total);

        // Summary metrics
        $metrics = $this->vendorService->getTransactionSummaryMetrics($facilityId, $filters['period']);

        return view('vendor.transactions', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'selectedFacility' => $selectedFacility,
            'facilityId' => $facilityId,
            'transactions' => $pagedTransactions,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'per_page' => $perPage,
                'from' => $from,
                'to' => $to,
            ],
            'metrics' => $metrics,
            'filters' => $filters,
            'hasActiveFilters' => $hasActiveFilters,
            'activeNav' => 'transactions',
        ]);
    }

    /**
     * API endpoint to get details of a single transaction.
     */
    public function apiTransaction(string $id): JsonResponse
    {
        $transaction = $this->vendorService->getTransaction($id);
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction record not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'transaction' => $transaction,
        ]);
    }

    /**
     * Reconcile or resolve an operational investigation on a transaction.
     */
    public function reconcileTransaction(Request $request, string $id): RedirectResponse
    {
        $notes = $request->input('notes', '');
        $updated = $this->vendorService->reconcileTransaction($id, $notes);

        if (!$updated) {
            return redirect()->back()->with('error', 'Transaction record not found.');
        }

        return redirect()->back()->with('success', "Transaction '{$updated['transaction_reference']}' has been reconciled successfully.");
    }

    /**
     * Export payment transactions to CSV format.
     */
    public function exportTransactions(Request $request)
    {
        $facilityId = $request->query('facility', 'all');
        $filters = [
            'q' => trim($request->query('q', '')),
            'period' => $request->query('period', 'all'),
            'status' => $request->query('status', 'all'),
            'payment_method' => $request->query('payment_method', 'all'),
            'settlement_status' => $request->query('settlement_status', 'all'),
            'sort' => $request->query('sort', 'date_desc'),
        ];

        $transactions = $this->vendorService->getTransactions($facilityId, $filters);
        $filename = 'transactions-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($transactions) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'Transaction Reference',
                'Provider Reference',
                'Date & Time',
                'Facility',
                'Terminal / Lane',
                'Payable Type',
                'Payable Reference',
                'Vehicle Plate',
                'Vehicle Model',
                'Payment Method',
                'Payment Channel',
                'Gateway Provider',
                'Amount (IDR)',
                'Refunded (IDR)',
                'Transaction Status',
                'Settlement Status',
                'Approval Code',
            ]);

            foreach ($transactions as $t) {
                fputcsv($handle, [
                    $t['transaction_reference'] ?? '',
                    $t['provider_reference'] ?? '',
                    $t['created_at'] ?? '',
                    $t['facility_name'] ?? '',
                    $t['terminal_lane'] ?? '',
                    $t['payable_type_label'] ?? '',
                    $t['payable_reference'] ?? '',
                    $t['vehicle_plate'] ?? '',
                    $t['vehicle_model'] ?? '',
                    $t['payment_method_label'] ?? '',
                    $t['payment_channel'] ?? '',
                    $t['gateway_provider'] ?? '',
                    $t['amount'] ?? 0,
                    $t['refunded_amount'] ?? 0,
                    $t['transaction_status_label'] ?? '',
                    $t['settlement_status_label'] ?? '',
                    $t['auth_approval_code'] ?? '-',
                ]);
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }

    /**
     * Display the Vendor Revenue Analytics page (Page 30).
     */
    public function revenue(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();

        $facilityId = $request->query('facility', 'all');
        $selectedFacility = null;
        if ($facilityId !== 'all') {
            foreach ($facilities as $fac) {
                if ($fac['id'] === $facilityId) {
                    $selectedFacility = $fac;
                    break;
                }
            }
            if (!$selectedFacility) {
                $facilityId = 'all';
            }
        }

        $period = $request->query('period', 'today');
        if (!in_array($period, ['today', 'yesterday', '7days', 'month'])) {
            $period = 'today';
        }

        $compare = $request->query('compare', '1') !== '0';

        $analytics = $this->vendorService->getRevenueAnalytics($facilityId, $period, $compare);

        return view('vendor.revenue', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'selectedFacility' => $selectedFacility,
            'facilityId' => $facilityId,
            'period' => $period,
            'compare' => $compare,
            'analytics' => $analytics,
            'activeNav' => 'revenue',
        ]);
    }

    /**
     * API endpoint to get live revenue telemetry & analytics.
     */
    public function apiRevenue(Request $request): JsonResponse
    {
        $facilityId = $request->query('facility', 'all');
        $period = $request->query('period', 'today');
        $compare = $request->query('compare', '1') !== '0';

        $analytics = $this->vendorService->getRevenueAnalytics($facilityId, $period, $compare);

        return response()->json([
            'success' => true,
            'analytics' => $analytics,
        ]);
    }

    /**
     * Export revenue analytics report to CSV format.
     */
    public function exportRevenue(Request $request)
    {
        $facilityId = $request->query('facility', 'all');
        $period = $request->query('period', 'today');
        $compare = $request->query('compare', '1') !== '0';

        $analytics = $this->vendorService->getRevenueAnalytics($facilityId, $period, $compare);
        $filename = 'revenue-report-' . $period . '-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($analytics, $period) {
            $handle = fopen('php://output', 'w');

            // 1. Executive Summary
            fputcsv($handle, ['NusaPark Enterprise - Financial Revenue Analytics Report']);
            fputcsv($handle, ['Reporting Period', $analytics['period_label']]);
            fputcsv($handle, ['Facility Scope', $analytics['facility_id'] === 'all' ? 'All Authorized Facilities' : $analytics['facility_id']]);
            fputcsv($handle, ['Generated At', date('d M Y, H:i:s') . ' WIB']);
            fputcsv($handle, []);

            // 2. High-Level Financial Totals
            fputcsv($handle, ['KPI Metric', 'Amount (IDR)', 'Formatted']);
            fputcsv($handle, ['Gross Recorded Revenue', $analytics['summary']['gross_revenue'], $analytics['summary']['formatted_gross_revenue']]);
            fputcsv($handle, ['Confirmed Refunds', $analytics['summary']['refunds_amount'], $analytics['summary']['formatted_refunds_amount']]);
            fputcsv($handle, ['Net Recorded Receipts', $analytics['summary']['net_revenue'], $analytics['summary']['formatted_net_revenue']]);
            fputcsv($handle, ['Previous Period Net', $analytics['summary']['prev_net_revenue'], $analytics['summary']['formatted_prev_net_revenue']]);
            fputcsv($handle, ['Period Growth (%)', $analytics['summary']['growth_pct'] . '%', $analytics['summary']['formatted_growth_delta']]);
            fputcsv($handle, ['Successful Transactions', $analytics['summary']['successful_transactions'], number_format($analytics['summary']['successful_transactions'])]);
            fputcsv($handle, ['Average Ticket Size (ARPU)', $analytics['summary']['avg_ticket'], $analytics['summary']['formatted_avg_ticket']]);
            fputcsv($handle, ['Pending In-Flight Volume', $analytics['summary']['pending_volume'], $analytics['summary']['formatted_pending_volume']]);
            fputcsv($handle, ['Disputed Volume on Hold', $analytics['summary']['disputed_volume'], $analytics['summary']['formatted_disputed_volume']]);
            fputcsv($handle, []);

            // 3. Facility Breakdown Table
            fputcsv($handle, [
                'Facility Code',
                'Facility Name',
                'City',
                'Gross Revenue (IDR)',
                'Refunds (IDR)',
                'Net Revenue (IDR)',
                'Portfolio Share (%)',
                'Transactions Count',
                'Average Ticket (IDR)',
                'Collection Rate (%)',
            ]);

            foreach ($analytics['facility_breakdown'] as $fb) {
                fputcsv($handle, [
                    $fb['code'],
                    $fb['name'],
                    $fb['city'],
                    $fb['gross_revenue'],
                    $fb['refunds'],
                    $fb['net_revenue'],
                    $fb['portfolio_share'] . '%',
                    $fb['transactions_count'],
                    $fb['avg_ticket'],
                    $fb['collection_rate'] . '%',
                ]);
            }
            fputcsv($handle, []);

            // 4. Payment Method Distribution
            fputcsv($handle, [
                'Payment Method',
                'Description / Channel',
                'Gross Volume (IDR)',
                'Transactions Count',
                'Portfolio Share (%)',
                'Average Ticket (IDR)',
            ]);

            foreach ($analytics['payment_methods'] as $pm) {
                fputcsv($handle, [
                    $pm['label'],
                    $pm['subtext'],
                    $pm['gross_volume'],
                    $pm['count'],
                    $pm['share_pct'] . '%',
                    $pm['avg_ticket'],
                ]);
            }
            fputcsv($handle, []);

            // 5. Time-Series Trend Aggregations
            fputcsv($handle, ['Interval / Time Period', 'Current Revenue (IDR)', 'Previous Period Benchmark (IDR)']);
            foreach ($analytics['chart_data'] as $cd) {
                fputcsv($handle, [
                    $cd['label'],
                    $cd['current'],
                    $cd['previous'] ?? 0,
                ]);
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }

    /**
     * Display the Vendor Reports generation and review workspace (Page 31).
     */
    public function reports(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();

        $reportType = $request->query('type', 'sessions');
        $validTypes = ['sessions', 'transactions', 'revenue', 'facility_performance', 'gates_operational'];
        if (!in_array($reportType, $validTypes)) {
            $reportType = 'sessions';
        }

        $facilityId = $request->query('facility', 'all');
        $selectedFacility = null;
        if ($facilityId !== 'all') {
            foreach ($facilities as $fac) {
                if ($fac['id'] === $facilityId) {
                    $selectedFacility = $fac;
                    break;
                }
            }
            if (!$selectedFacility) {
                $facilityId = 'all';
            }
        }

        $period = $request->query('period', 'today');
        if (!in_array($period, ['today', 'yesterday', '7days', 'month', 'custom'])) {
            $period = 'today';
        }

        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        if ($period === 'custom' && $startDate && $endDate && $endDate < $startDate) {
            $endDate = $startDate;
        }

        $filters = [
            'q' => trim($request->query('q', '')),
            'period' => $period,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => $request->query('status', 'all'),
            'payment_method' => $request->query('payment_method', 'all'),
            'direction' => $request->query('direction', 'all'),
            'sort' => $request->query('sort', 'default'),
        ];

        $report = $this->vendorService->getReport($reportType, $facilityId, $filters);

        // Paginate preview records (10 per page)
        $allRecords = $report['records'] ?? [];
        $total = count($allRecords);
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedRecords = array_slice($allRecords, $offset, $perPage);
        $from = $total > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $total);

        return view('vendor.reports', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'selectedFacility' => $selectedFacility,
            'facilityId' => $facilityId,
            'reportType' => $reportType,
            'period' => $period,
            'filters' => $filters,
            'report' => $report,
            'records' => $pagedRecords,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'per_page' => $perPage,
                'from' => $from,
                'to' => $to,
            ],
            'activeNav' => 'reports',
        ]);
    }

    /**
     * Export selected report dataset to CSV format.
     */
    public function exportReports(Request $request)
    {
        $reportType = $request->query('type', 'sessions');
        $facilityId = $request->query('facility', 'all');
        $period = $request->query('period', 'today');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $filters = [
            'q' => trim($request->query('q', '')),
            'period' => $period,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => $request->query('status', 'all'),
            'payment_method' => $request->query('payment_method', 'all'),
            'direction' => $request->query('direction', 'all'),
        ];

        $report = $this->vendorService->getReport($reportType, $facilityId, $filters);
        $filename = 'report-' . $reportType . '-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($report) {
            $handle = fopen('php://output', 'w');

            // 1. Report Metadata
            fputcsv($handle, ['NusaPark Enterprise - Operational & Financial Report']);
            fputcsv($handle, ['Report Title', $report['report_title']]);
            fputcsv($handle, ['Report Type Code', $report['report_type']]);
            fputcsv($handle, ['Facility Scope', $report['facility_name']]);
            fputcsv($handle, ['Date Range / Period', $report['period_label']]);
            fputcsv($handle, ['Generated At', $report['generated_at']]);
            fputcsv($handle, ['Total Records Count', $report['total_count']]);
            fputcsv($handle, []);

            // 2. Summary Metrics
            fputcsv($handle, ['Metric Name', 'Metric Value', 'Notes']);
            foreach ($report['summary_metrics'] as $sm) {
                fputcsv($handle, [$sm['label'], $sm['value'], $sm['subtext']]);
            }
            fputcsv($handle, []);

            // 3. Tabular Records Header
            $headers = array_column($report['columns'], 'label');
            fputcsv($handle, $headers);

            // 4. Tabular Records Rows
            $colKeys = array_column($report['columns'], 'key');
            foreach ($report['records'] as $rec) {
                $row = [];
                foreach ($colKeys as $key) {
                    $row[] = $rec[$key] ?? '';
                }
                fputcsv($handle, $row);
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }

    /**
     * Display the Vendor Staff Management workspace (Page 32).
     */
    public function staff(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();
        $roles = $this->vendorService->getStaffRoles();

        $filters = [
            'q' => trim($request->query('q', '')),
            'role' => $request->query('role', 'all'),
            'status' => $request->query('status', 'all'),
            'facility' => $request->query('facility', 'all'),
            'sort' => $request->query('sort', 'date_desc'),
        ];

        $hasActiveFilters = !empty($filters['q'])
            || ($filters['role'] !== 'all')
            || ($filters['status'] !== 'all')
            || ($filters['facility'] !== 'all')
            || ($filters['sort'] !== 'date_desc');

        $allStaff = $this->vendorService->getStaff($filters);
        $total = count($allStaff);

        // Paginate results (10 items per page)
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedStaff = array_slice($allStaff, $offset, $perPage);
        $from = $total > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $total);

        // Summary metrics
        $metrics = $this->vendorService->getStaffSummaryMetrics();

        return view('vendor.staff', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'roles' => $roles,
            'staff' => $pagedStaff,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'per_page' => $perPage,
                'from' => $from,
                'to' => $to,
            ],
            'metrics' => $metrics,
            'filters' => $filters,
            'hasActiveFilters' => $hasActiveFilters,
            'activeNav' => 'staff',
        ]);
    }

    /**
     * Store a newly invited or created staff member.
     */
    public function storeStaff(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:30',
            'role' => 'required|string|in:administrator,supervisor,operator',
            'facility_scope' => 'required|string|in:all,custom',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string',
            'send_invite' => 'nullable',
            'notes' => 'nullable|string|max:255',
        ]);

        $validated['send_invite'] = $request->has('send_invite');

        try {
            $newMember = $this->vendorService->createStaffMember($validated);
            $actionMsg = $newMember['status'] === 'pending'
                ? "Invitation email dispatched to '{$newMember['email']}'."
                : "Staff member '{$newMember['name']}' has been added successfully.";

            return redirect()->route('vendor.staff')->with('success', $actionMsg);
        } catch (\InvalidArgumentException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Update an existing staff member.
     */
    public function updateStaff(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:30',
            'role' => 'required|string|in:owner,administrator,supervisor,operator',
            'facility_scope' => 'required|string|in:all,custom',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string',
            'status' => 'required|string|in:active,pending,suspended',
            'notes' => 'nullable|string|max:255',
        ]);

        $updated = $this->vendorService->updateStaffMember($id, $validated);

        if (!$updated) {
            return redirect()->back()->with('error', 'Staff member not found or cannot be modified.');
        }

        return redirect()->back()->with('success', "Staff record for '{$updated['name']}' has been updated.");
    }

    /**
     * Toggle or update a staff member's operational status.
     */
    public function toggleStaffStatus(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:active,suspended',
        ]);

        $updated = $this->vendorService->toggleStaffStatus($id, $validated['status']);

        if (!$updated) {
            return redirect()->back()->with('error', 'Status modification rejected: Account owner access cannot be suspended.');
        }

        $label = $validated['status'] === 'active' ? 'reactivated' : 'suspended';
        return redirect()->back()->with('success', "Access for '{$updated['name']}' has been {$label}.");
    }

    /**
     * Resend an activation invitation to a pending staff member.
     */
    public function resendInvitation(string $id): RedirectResponse
    {
        $updated = $this->vendorService->resendStaffInvitation($id);

        if (!$updated) {
            return redirect()->back()->with('error', 'Staff member not found.');
        }

        return redirect()->back()->with('success', "Activation invitation resent to '{$updated['email']}'.");
    }

    /**
     * Revoke access and remove a staff member from the vendor tenant.
     */
    public function destroyStaff(string $id): RedirectResponse
    {
        $deleted = $this->vendorService->deleteStaffMember($id);

        if (!$deleted) {
            return redirect()->back()->with('error', 'Action prohibited: Cannot remove account owner or invalid staff identifier.');
        }

        return redirect()->back()->with('success', 'Staff access has been revoked and membership removed.');
    }

    /**
     * API endpoint to retrieve full details for a single staff member.
     */
    public function apiStaffDetail(string $id): JsonResponse
    {
        $staff = $this->vendorService->getStaffMember($id);

        if (!$staff) {
            return response()->json([
                'success' => false,
                'message' => 'Staff record not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'staff' => $staff,
        ]);
    }

    /**
     * Display the Vendor Billing & Subscription Invoices workspace (Page 34).
     */
    public function billing(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $summary = $this->vendorService->getBillingSummary();

        $filters = [
            'q' => trim($request->query('q', '')),
            'status' => $request->query('status', 'all'),
            'year' => $request->query('year', 'all'),
            'sort' => $request->query('sort', 'date_desc'),
        ];

        $hasActiveFilters = !empty($filters['q'])
            || ($filters['status'] !== 'all')
            || ($filters['year'] !== 'all')
            || ($filters['sort'] !== 'date_desc');

        $allInvoices = $this->vendorService->getInvoices($filters);
        $total = count($allInvoices);

        // Paginate results (10 items per page)
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedInvoices = array_slice($allInvoices, $offset, $perPage);
        $from = $total > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $total);

        // Billing payments audit history
        $payments = $this->vendorService->getBillingPayments();

        return view('vendor.billing', [
            'tenant' => $tenant,
            'summary' => $summary,
            'subscription' => $summary['subscription'],
            'invoices' => $pagedInvoices,
            'payments' => $payments,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'per_page' => $perPage,
                'from' => $from,
                'to' => $to,
            ],
            'filters' => $filters,
            'hasActiveFilters' => $hasActiveFilters,
            'activeNav' => 'billing',
        ]);
    }

    /**
     * API endpoint to retrieve full details for a single invoice.
     */
    public function apiInvoice(string $id): JsonResponse
    {
        $invoice = $this->vendorService->getInvoice($id);

        if (!$invoice) {
            return response()->json([
                'success' => false,
                'message' => 'Subscription invoice record not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'invoice' => $invoice,
        ]);
    }

    /**
     * Pay an outstanding subscription invoice.
     */
    public function payInvoice(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'payment_method' => 'nullable|string|max:100',
        ]);

        $method = $validated['payment_method'] ?? 'Bank BCA Corporate Virtual Account';

        $paid = $this->vendorService->payInvoice($id, ['method' => $method]);

        if (!$paid) {
            return redirect()->back()->with('error', 'Invoice record not found or could not be settled.');
        }

        return redirect()->route('vendor.billing')->with('success', "Invoice {$paid['invoice_number']} has been settled successfully via {$paid['payment_method']}. Payment reference: {$paid['payment_reference']}");
    }

    /**
     * Export a single subscription invoice to an RFC-compliant CSV document.
     */
    public function exportInvoice(string $id)
    {
        $invoice = $this->vendorService->getInvoice($id);

        if (!$invoice) {
            return redirect()->back()->with('error', 'Invoice record not found.');
        }

        $filename = 'invoice-' . strtolower($invoice['invoice_number']) . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($invoice) {
            $handle = fopen('php://output', 'w');

            // 1. Invoice Document Header
            fputcsv($handle, ['NusaPark Enterprise Cloud Platform - Official Tax Invoice']);
            fputcsv($handle, ['Invoice Number', $invoice['invoice_number']]);
            fputcsv($handle, ['Billing Period', $invoice['billing_period']]);
            fputcsv($handle, ['Issue Date', $invoice['issue_date']]);
            fputcsv($handle, ['Payment Due Date', $invoice['due_date']]);
            fputcsv($handle, ['Payment Status', strtoupper($invoice['status'])]);
            if (!empty($invoice['payment_reference'])) {
                fputcsv($handle, ['Settlement Reference', $invoice['payment_reference']]);
                fputcsv($handle, ['Payment Settled Date', $invoice['paid_at']]);
            }
            fputcsv($handle, []);

            // 2. Issuer & Recipient
            fputcsv($handle, ['--- ISSUER INFORMATION ---', '--- BILLING RECIPIENT ---']);
            fputcsv($handle, [$invoice['issuer']['company'], $invoice['recipient']['company']]);
            fputcsv($handle, [$invoice['issuer']['tax_id'], $invoice['recipient']['tax_id']]);
            fputcsv($handle, [$invoice['issuer']['address'], $invoice['recipient']['address']]);
            fputcsv($handle, [$invoice['issuer']['contact_email'], $invoice['recipient']['email']]);
            fputcsv($handle, []);

            // 3. Line Items Table Header
            fputcsv($handle, ['Item / Service Name', 'Entitlement Description', 'Unit Price (IDR)', 'Qty', 'Line Total (IDR)']);
            foreach ($invoice['line_items'] as $item) {
                fputcsv($handle, [
                    $item['name'],
                    $item['description'],
                    $item['unit_price'],
                    $item['quantity'],
                    $item['total'],
                ]);
            }
            fputcsv($handle, []);

            // 4. Financial Summary
            fputcsv($handle, ['', '', '', 'Subtotal', $invoice['subtotal']]);
            fputcsv($handle, ['', '', '', 'PPN (11% VAT)', $invoice['tax_amount']]);
            if ($invoice['discount_amount'] > 0) {
                fputcsv($handle, ['', '', '', 'Promotional Credit / Discount', -$invoice['discount_amount']]);
            }
            fputcsv($handle, ['', '', '', 'Total Amount Due (IDR)', $invoice['total_amount']]);

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }

    /**
     * Export all billing statements and invoice records to CSV.
     */
    public function exportBillingLedger(Request $request)
    {
        $invoices = $this->vendorService->getInvoices();
        $filename = 'billing-ledger-' . date('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($invoices) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['NusaPark Enterprise - Subscription Billing Ledger']);
            fputcsv($handle, ['Generated At', date('d M Y, H:i') . ' WIB']);
            fputcsv($handle, ['Total Invoices Recorded', count($invoices)]);
            fputcsv($handle, []);

            fputcsv($handle, [
                'Invoice Reference',
                'Billing Period',
                'Issue Date',
                'Due Date',
                'Subtotal (IDR)',
                'PPN 11% Tax (IDR)',
                'Total Amount (IDR)',
                'Status',
                'Settlement Reference',
                'Settlement Date',
                'Payment Channel',
            ]);

            foreach ($invoices as $inv) {
                fputcsv($handle, [
                    $inv['invoice_number'],
                    $inv['billing_period'],
                    $inv['issue_date'],
                    $inv['due_date'],
                    $inv['subtotal'],
                    $inv['tax_amount'],
                    $inv['total_amount'],
                    strtoupper($inv['status']),
                    $inv['payment_reference'] ?? '-',
                    $inv['paid_at'] ?? '-',
                    $inv['payment_method'] ?? '-',
                ]);
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, $headers);
    }

    // =========================================================================
    // PHASE 2, PAGE 35: VENDOR NOTIFICATIONS & OPERATIONAL ALERTS
    // =========================================================================

    /**
     * Display the Vendor Notifications & Operational Alerts inbox (Page 35).
     */
    public function notifications(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();

        $filters = [
            'q' => trim($request->query('q', '')),
            'category' => $request->query('category', 'all'),
            'status' => $request->query('status', 'all'),
            'severity' => $request->query('severity', 'all'),
            'facility' => $request->query('facility', 'all'),
        ];

        $hasActiveFilters = !empty($filters['q'])
            || ($filters['category'] !== 'all')
            || ($filters['status'] !== 'all')
            || ($filters['severity'] !== 'all')
            || ($filters['facility'] !== 'all');

        $allNotifications = $this->vendorService->getNotifications($filters);
        $total = count($allNotifications);

        // Paginate results (10 items per page)
        $perPage = 10;
        $currentPage = max(1, (int)$request->query('page', 1));
        $totalPages = max(1, (int)ceil($total / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $pagedNotifications = array_slice($allNotifications, $offset, $perPage);
        $from = $total > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $total);

        $metrics = $this->vendorService->getNotificationMetrics();

        return view('vendor.notifications', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'notifications' => $pagedNotifications,
            'metrics' => $metrics,
            'categories' => VendorService::NOTIFICATION_CATEGORIES,
            'severities' => VendorService::NOTIFICATION_SEVERITIES,
            'pagination' => [
                'current_page' => $currentPage,
                'last_page' => $totalPages,
                'total' => $total,
                'per_page' => $perPage,
                'from' => $from,
                'to' => $to,
            ],
            'filters' => $filters,
            'hasActiveFilters' => $hasActiveFilters,
            'activeNav' => 'notifications',
        ]);
    }

    /**
     * Mark a single vendor notification as read.
     */
    public function markNotificationRead(Request $request, string $id): RedirectResponse|JsonResponse
    {
        $updated = $this->vendorService->markNotificationAsRead($id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => $updated,
                'unread' => $this->vendorService->getNotificationUnreadCount(),
            ]);
        }

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    /**
     * Mark all vendor notifications as read.
     */
    public function markAllNotificationsRead(Request $request): RedirectResponse|JsonResponse
    {
        $count = $this->vendorService->markAllNotificationsAsRead();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'updated_count' => $count,
                'unread' => 0,
            ]);
        }

        return redirect()->back()->with('success', "All {$count} operational updates marked as read.");
    }

    /**
     * Mark multiple selected notifications as read in bulk.
     */
    public function bulkMarkNotificationsRead(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'string',
        ]);

        $count = $this->vendorService->bulkMarkNotificationsAsRead($validated['ids']);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'updated_count' => $count,
                'unread' => $this->vendorService->getNotificationUnreadCount(),
            ]);
        }

        return redirect()->back()->with('success', "{$count} notifications marked as read.");
    }

    /**
     * Remove or dismiss a notification from the vendor inbox.
     */
    public function destroyNotification(Request $request, string $id): RedirectResponse|JsonResponse
    {
        $removed = $this->vendorService->removeNotification($id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => $removed,
                'unread' => $this->vendorService->getNotificationUnreadCount(),
            ]);
        }

        return redirect()->back()->with('success', 'Notification dismissed from inbox.');
    }

    /**
     * API endpoint to retrieve full details for a single notification.
     */
    public function apiNotificationDetail(string $id): JsonResponse
    {
        $notification = $this->vendorService->getNotification($id);

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification record not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'notification' => $notification,
        ]);
    }

    /**
     * API endpoint returning current authoritative unread count.
     */
    public function apiNotificationUnreadCount(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'unread' => $this->vendorService->getNotificationUnreadCount(),
        ]);
    }

    // =========================================================================
    // PHASE 2, PAGE 36: VENDOR SETTINGS & PREFERENCES
    // =========================================================================

    /**
     * Display the Vendor Settings & Organization Profile page (Page 36).
     */
    public function settings(Request $request): View
    {
        $tenant = $this->vendorService->getVendorTenant();
        $facilities = $this->vendorService->getFacilities();
        $settings = $this->vendorService->getVendorSettings();

        $validTabs = ['profile', 'contact', 'operational', 'notifications', 'security'];
        $activeTab = $request->query('tab', 'profile');
        if (!in_array($activeTab, $validTabs)) {
            $activeTab = 'profile';
        }

        return view('vendor.settings', [
            'tenant' => $tenant,
            'facilities' => $facilities,
            'settings' => $settings,
            'activeTab' => $activeTab,
            'activeNav' => 'settings',
        ]);
    }

    /**
     * Update vendor organization settings or operational preferences.
     */
    public function updateSettings(Request $request): RedirectResponse
    {
        $section = $request->input('section', 'profile');

        if ($section === 'profile') {
            $validated = $request->validate([
                'company_name' => 'required|string|min:3|max:150',
                'brand_name' => 'required|string|min:2|max:100',
                'description' => 'nullable|string|max:500',
                'logo' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:2048',
            ]);

            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $file = $request->file('logo');
                $filename = 'vdr-logo-' . time() . '.' . $file->getClientOriginalExtension();
                $destPath = public_path('uploads/vendor');
                if (!file_exists($destPath)) {
                    mkdir($destPath, 0755, true);
                }
                $file->move($destPath, $filename);
                $validated['logo_url'] = '/uploads/vendor/' . $filename;
            }

            $this->vendorService->updateSettingsSection('profile', $validated);
            $msg = 'Organization profile details and brand logo updated successfully.';
        } elseif ($section === 'contact') {
            $validated = $request->validate([
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'postal_code' => 'required|string|max:10',
                'email' => 'required|email|max:100',
                'billing_email' => 'required|email|max:100',
                'phone' => 'required|string|max:30',
                'emergency_hotline' => 'required|string|max:30',
                'website' => 'nullable|string|max:150',
            ]);
            $this->vendorService->updateSettingsSection('contact', $validated);
            $msg = 'Corporate contact information saved successfully.';
        } elseif ($section === 'operational') {
            $validated = $request->validate([
                'default_facility_id' => 'required|string',
                'anpr_confidence_threshold' => 'required|integer|min:50|max:99',
                'barrier_auto_close_delay' => 'required|integer|min:3|max:30',
                'overstay_alert_hours' => 'required|integer|min:6|max:168',
                'capacity_warning_threshold' => 'required|integer|min:50|max:98',
                'allow_manual_gate_override' => 'nullable|boolean',
                'require_anpr_two_stage' => 'nullable|boolean',
                'timezone' => 'required|string|in:Asia/Jakarta,Asia/Makassar,Asia/Jayapura',
                'locale' => 'required|string|in:id_ID,en_US',
                'date_format' => 'required|string',
            ]);
            $this->vendorService->updateSettingsSection('operational', $validated);
            $this->vendorService->updateSettingsSection('localization', $validated);
            $msg = 'Operational preferences and localization parameters saved successfully.';
        } elseif ($section === 'notifications') {
            $data = [
                'email_critical_alerts' => $request->has('email_critical_alerts'),
                'email_daily_digest' => $request->has('email_daily_digest'),
                'email_billing_invoices' => $request->has('email_billing_invoices'),
                'inapp_alerts' => $request->has('inapp_alerts'),
                'sms_emergency_dispatch' => $request->has('sms_emergency_dispatch'),
                'push_mobile_alerts' => $request->has('push_mobile_alerts'),
            ];
            $this->vendorService->updateSettingsSection('notifications', $data);
            $msg = 'Notification delivery preferences updated successfully.';
        } elseif ($section === 'security') {
            $validated = $request->validate([
                'session_timeout_hours' => 'required|integer|min:1|max:72',
                'two_factor_enabled' => 'nullable|boolean',
            ]);
            $this->vendorService->updateSettingsSection('security', $validated);
            $msg = 'Account security policy and session limits saved successfully.';
        } else {
            return redirect()->route('vendor.settings')->with('error', 'Invalid settings section specified.');
        }

        return redirect()->route('vendor.settings', ['tab' => $section])->with('success', $msg);
    }

    /**
     * Restore settings and operational preferences to factory defaults.
     */
    public function resetSettingsDefaults(Request $request): RedirectResponse
    {
        $this->vendorService->resetSettingsDefaults();
        return redirect()->route('vendor.settings')->with('success', 'All organization settings and preferences have been restored to factory defaults.');
    }

    /**
     * API endpoint returning current settings structure.
     */
    public function apiSettings(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'settings' => $this->vendorService->getVendorSettings(),
        ]);
    }
}




