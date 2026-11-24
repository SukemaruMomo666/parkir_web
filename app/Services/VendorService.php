<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class VendorService
{
    /**
     * Cache key for vendor tenant data.
     */
    protected const CACHE_KEY = 'vendor_tenant_vdr_jkt_01';

    /**
     * Cache key for vendor tenant locations.
     */
    protected const LOCATIONS_CACHE_KEY = 'vendor_locations_vdr_jkt_01';

    /**
     * Cache key for vendor tenant parking slots.
     */
    protected const SLOTS_CACHE_KEY = 'vendor_parking_slots_vdr_jkt_01';

    /**
     * Cache key for vendor tenant gates.
     */
    protected const GATES_CACHE_KEY = 'vendor_gates_vdr_jkt_01';

    /**
     * Cache key for gate activity logs.
     */
    protected const GATE_LOGS_CACHE_KEY = 'vendor_gate_logs_vdr_jkt_01';

    /**
     * Cache key for vendor tenant ANPR cameras.
     */
    protected const ANPR_CAMERAS_CACHE_KEY = 'vendor_anpr_cameras_vdr_jkt_01';

    /**
     * Cache key for vendor tenant ANPR recognition events.
     */
    protected const ANPR_EVENTS_CACHE_KEY = 'vendor_anpr_events_vdr_jkt_01';

    /**
     * Cache key for vendor tenant IoT devices.
     */
    protected const IOT_DEVICES_CACHE_KEY = 'vendor_iot_devices_vdr_jkt_01';

    /**
     * Cache key for vendor tenant IoT device diagnostic logs.
     */
    protected const IOT_LOGS_CACHE_KEY = 'vendor_iot_logs_vdr_jkt_01';

    /**
     * Cache key for vendor tenant parking sessions.
     */
    protected const SESSIONS_CACHE_KEY = 'vendor_parking_sessions_vdr_jkt_01';

    /**
     * Cache key for vendor tenant payment transactions.
     */
    protected const TRANSACTIONS_CACHE_KEY = 'vendor_transactions_vdr_jkt_01';

    /**
     * Cache key for vendor tenant staff members and invitations.
     */
    protected const STAFF_CACHE_KEY = 'vendor_staff_vdr_jkt_01';

    /**
     * Cache key for vendor tenant subscription invoices.
     */
    protected const INVOICES_CACHE_KEY = 'vendor_invoices_vdr_jkt_01';

    /**
     * Cache key for vendor tenant billing payments history.
     */
    protected const BILLING_PAYMENTS_CACHE_KEY = 'vendor_billing_payments_vdr_jkt_01';

    /**
     * Cache key for vendor tenant operational notifications.
     */
    protected const NOTIFICATIONS_CACHE_KEY = 'vendor_notifications_vdr_jkt_01';

    /**
     * Cache key for vendor tenant settings & operational preferences.
     */
    protected const SETTINGS_CACHE_KEY = 'vendor_settings_vdr_jkt_01';

    /**
     * Supported notification categories for vendor operations.
     */
    public const NOTIFICATION_CATEGORIES = [
        'all' => 'All Categories',
        'gate' => 'Barrier Gates',
        'anpr' => 'ANPR Recognition',
        'iot' => 'IoT Telemetry',
        'capacity' => 'Zone Capacity',
        'session' => 'Parking Sessions',
        'billing' => 'Subscription & Billing',
        'system' => 'System & Account',
    ];

    /**
     * Supported notification severity levels.
     */
    public const NOTIFICATION_SEVERITIES = [
        'all' => 'All Severities',
        'critical' => 'Critical',
        'warning' => 'Warning',
        'info' => 'Informational',
        'resolved' => 'Resolved',
    ];

    /**
     * Get authorized operator/vendor tenant details.
     */
    public function getVendorTenant(): array
    {
        $settings = $this->getVendorSettings();
        $prof = $settings['profile'] ?? [];
        $sec = $settings['security'] ?? [];
        $cont = $settings['contact'] ?? [];

        return [
            'id' => $prof['id'] ?? 'vdr-jkt-01',
            'company_name' => $prof['company_name'] ?? 'PT Parkir Cipta Nusantara',
            'brand_name' => $prof['brand_name'] ?? 'Cipta Parking Solutions',
            'operator_name' => $sec['operator_name'] ?? 'Budi Santoso',
            'operator_role' => $sec['operator_role'] ?? 'Operations Manager',
            'operator_email' => $sec['operator_email'] ?? 'budi.santoso@parkircipta.co.id',
            'operator_initials' => 'BS',
            'partner_tier' => $prof['partner_tier'] ?? 'Enterprise Partner',
            'contract_status' => $prof['contract_status'] ?? 'Active',
            'support_contact' => $cont['phone'] ?? '+62 21 555-8900',
        ];
    }


    /**
     * Default list of authorized managed facilities for this tenant.
     */
    protected function getDefaultLocations(): array
    {
        return [
            [
                'id' => 'fac-mall-xyz',
                'code' => 'LOC-MALL-XYZ',
                'name' => 'Mall XYZ Jakarta',
                'city' => 'Jakarta Selatan',
                'address' => 'Jl. Metro Pondok Indah Blok 3B, Kebayoran Lama',
                'postal_code' => '12310',
                'zone' => 'Zone A, B & Basement',
                'total_capacity' => 450,
                'occupied' => 328,
                'available' => 104,
                'reserved' => 14,
                'maintenance' => 4,
                'occupancy_rate' => 72.9,
                'active_sessions' => 314,
                'today_entries' => 1420,
                'today_exits' => 1092,
                'today_revenue' => 16850000,
                'formatted_revenue' => 'Rp 16.850.000',
                'gates_count' => 4,
                'gates_online' => 4,
                'cameras_count' => 4,
                'cameras_online' => 4,
                'parking_types' => ['Car', 'Motorcycle', 'EV Hub'],
                'operating_hours' => '24 Hours',
                'contact_person' => 'Ahmad Fauzi (Supervisor)',
                'contact_phone' => '+62 812-9844-1102',
                'status' => 'Optimal',
                'issue_notice' => null,
                'last_updated' => '11 Oct 2026, 12:45 WIB',
                'created_at' => '2025-01-15',
            ],
            [
                'id' => 'fac-gi-west',
                'code' => 'LOC-GI-WEST',
                'name' => 'Grand Indonesia West Mall',
                'city' => 'Jakarta Pusat',
                'address' => 'Jl. M.H. Thamrin No. 1, Menteng',
                'postal_code' => '10310',
                'zone' => 'Basement 1, 2 & Level P1',
                'total_capacity' => 600,
                'occupied' => 486,
                'available' => 92,
                'reserved' => 18,
                'maintenance' => 4,
                'occupancy_rate' => 81.0,
                'active_sessions' => 468,
                'today_entries' => 1890,
                'today_exits' => 1404,
                'today_revenue' => 24320000,
                'formatted_revenue' => 'Rp 24.320.000',
                'gates_count' => 6,
                'gates_online' => 6,
                'cameras_count' => 6,
                'cameras_online' => 5, // 1 warning
                'parking_types' => ['Car', 'Motorcycle', 'EV Hub', 'Valet VIP'],
                'operating_hours' => '24 Hours',
                'contact_person' => 'Hendra Wijaya (Site Manager)',
                'contact_phone' => '+62 813-2200-9891',
                'status' => 'Attention Required',
                'issue_notice' => 'ANPR Camera 2B lens clarity check required',
                'last_updated' => '11 Oct 2026, 12:50 WIB',
                'created_at' => '2025-03-20',
            ],
            [
                'id' => 'fac-cp-jkt',
                'code' => 'LOC-CP-JKT',
                'name' => 'Central Park Mall',
                'city' => 'Jakarta Barat',
                'address' => 'Jl. Letjen S. Parman Kav. 28, Tanjung Duren',
                'postal_code' => '11470',
                'zone' => 'Outer Lane & B1',
                'total_capacity' => 350,
                'occupied' => 210,
                'available' => 130,
                'reserved' => 8,
                'maintenance' => 2,
                'occupancy_rate' => 60.0,
                'active_sessions' => 202,
                'today_entries' => 980,
                'today_exits' => 770,
                'today_revenue' => 11240000,
                'formatted_revenue' => 'Rp 11.240.000',
                'gates_count' => 3,
                'gates_online' => 3,
                'cameras_count' => 3,
                'cameras_online' => 3,
                'parking_types' => ['Car', 'Motorcycle'],
                'operating_hours' => '06:00 - 24:00',
                'contact_person' => 'Dewi Lestari (Duty Officer)',
                'contact_phone' => '+62 811-3449-7810',
                'status' => 'Optimal',
                'issue_notice' => null,
                'last_updated' => '11 Oct 2026, 12:40 WIB',
                'created_at' => '2025-06-10',
            ],
        ];
    }

    /**
     * Load locations from cache or default.
     */
    protected function loadStoredLocations(): array
    {
        return Cache::get(self::LOCATIONS_CACHE_KEY, function () {
            $default = $this->getDefaultLocations();
            Cache::put(self::LOCATIONS_CACHE_KEY, $default, now()->addDays(30));
            return $default;
        });
    }

    /**
     * Save locations to cache.
     */
    protected function saveLocations(array $locations): void
    {
        Cache::put(self::LOCATIONS_CACHE_KEY, $locations, now()->addDays(30));
    }

    /**
     * Get list of authorized managed facilities for this tenant.
     */
    public function getFacilities(): array
    {
        return $this->loadStoredLocations();
    }

    /**
     * Query and filter locations for the vendor locations page (Page 21).
     */
    public function getManagedLocations(array $filters = []): array
    {
        $locations = $this->loadStoredLocations();

        // Keyword search (name, code, address, city)
        $query = trim(strtolower($filters['q'] ?? ''));
        if ($query !== '') {
            $locations = array_filter($locations, function ($loc) use ($query) {
                return str_contains(strtolower($loc['name']), $query)
                    || str_contains(strtolower($loc['code'] ?? ''), $query)
                    || str_contains(strtolower($loc['city']), $query)
                    || str_contains(strtolower($loc['address']), $query);
            });
        }

        // Status filter
        $status = $filters['status'] ?? 'all';
        if ($status !== 'all' && $status !== '') {
            $locations = array_filter($locations, function ($loc) use ($status) {
                return strcasecmp($loc['status'], $status) === 0;
            });
        }

        // City filter
        $city = $filters['city'] ?? 'all';
        if ($city !== 'all' && $city !== '') {
            $locations = array_filter($locations, function ($loc) use ($city) {
                return strcasecmp($loc['city'], $city) === 0;
            });
        }

        // Parking type filter
        $parkingType = $filters['type'] ?? 'all';
        if ($parkingType !== 'all' && $parkingType !== '') {
            $locations = array_filter($locations, function ($loc) use ($parkingType) {
                $types = array_map('strtolower', $loc['parking_types'] ?? []);
                return in_array(strtolower($parkingType), $types);
            });
        }

        // Convert back to indexed array
        $locations = array_values($locations);

        // Sorting
        $sort = $filters['sort'] ?? 'name_asc';
        usort($locations, function ($a, $b) use ($sort) {
            switch ($sort) {
                case 'name_desc':
                    return strcasecmp($b['name'], $a['name']);
                case 'capacity_desc':
                    return $b['total_capacity'] <=> $a['total_capacity'];
                case 'capacity_asc':
                    return $a['total_capacity'] <=> $b['total_capacity'];
                case 'occupancy_desc':
                    return $b['occupancy_rate'] <=> $a['occupancy_rate'];
                case 'occupancy_asc':
                    return $a['occupancy_rate'] <=> $b['occupancy_rate'];
                case 'updated_desc':
                    return strcmp($b['last_updated'] ?? '', $a['last_updated'] ?? '');
                case 'name_asc':
                default:
                    return strcasecmp($a['name'], $b['name']);
            }
        });

        return $locations;
    }

    /**
     * Compute summary metrics across authorized facilities.
     */
    public function getLocationSummaryMetrics(): array
    {
        $all = $this->loadStoredLocations();
        $totalFacilities = count($all);
        $operationalCount = 0;
        $attentionCount = 0;
        $maintenanceCount = 0;
        $inactiveCount = 0;
        $totalCapacity = 0;
        $totalOccupied = 0;
        $totalAvailable = 0;

        foreach ($all as $loc) {
            $status = strtolower($loc['status'] ?? '');
            if ($status === 'optimal' || $status === 'operational') {
                $operationalCount++;
            } elseif ($status === 'attention required' || $status === 'attention') {
                $attentionCount++;
            } elseif ($status === 'maintenance' || $status === 'under maintenance') {
                $maintenanceCount++;
            } else {
                $inactiveCount++;
            }

            $totalCapacity += (int)($loc['total_capacity'] ?? 0);
            $totalOccupied += (int)($loc['occupied'] ?? 0);
            $totalAvailable += (int)($loc['available'] ?? 0);
        }

        $avgOccupancyRate = $totalCapacity > 0 ? round(($totalOccupied / $totalCapacity) * 100, 1) : 0;

        return [
            'total_locations' => $totalFacilities,
            'operational_locations' => $operationalCount,
            'attention_locations' => $attentionCount,
            'maintenance_locations' => $maintenanceCount,
            'inactive_locations' => $inactiveCount,
            'total_capacity' => $totalCapacity,
            'total_occupied' => $totalOccupied,
            'total_available' => $totalAvailable,
            'avg_occupancy_rate' => $avgOccupancyRate,
            'last_sync' => date('d M Y, H:i') . ' WIB',
        ];
    }

    /**
     * Get unique cities across all authorized facilities.
     */
    public function getDistinctCities(): array
    {
        $locations = $this->loadStoredLocations();
        $cities = array_unique(array_column($locations, 'city'));
        sort($cities);
        return $cities;
    }

    /**
     * Get single authorized location by ID.
     */
    public function getLocation(string $id): ?array
    {
        $locations = $this->loadStoredLocations();
        foreach ($locations as $loc) {
            if ($loc['id'] === $id) {
                return $loc;
            }
        }
        return null;
    }

    /**
     * Create a new authorized location for this tenant.
     */
    public function createLocation(array $data): array
    {
        $locations = $this->loadStoredLocations();

        $slug = preg_replace('/[^a-z0-9]+/', '-', strtolower($data['name']));
        $slug = trim($slug, '-');
        $id = 'fac-' . $slug . '-' . substr(uniqid(), -4);

        $code = !empty($data['code']) 
            ? strtoupper(trim($data['code'])) 
            : 'LOC-' . strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $data['name']), 0, 8));

        $capacity = (int)($data['total_capacity'] ?? 200);
        $parkingTypes = !empty($data['parking_types']) && is_array($data['parking_types']) 
            ? array_values($data['parking_types']) 
            : ['Car', 'Motorcycle'];

        $newLocation = [
            'id' => $id,
            'code' => $code,
            'name' => trim($data['name']),
            'city' => trim($data['city']),
            'address' => trim($data['address']),
            'postal_code' => trim($data['postal_code'] ?? '12000'),
            'zone' => trim($data['zone'] ?? 'Standard Zone A'),
            'total_capacity' => $capacity,
            'occupied' => 0,
            'available' => $capacity,
            'reserved' => 0,
            'maintenance' => 0,
            'occupancy_rate' => 0.0,
            'active_sessions' => 0,
            'today_entries' => 0,
            'today_exits' => 0,
            'today_revenue' => 0,
            'formatted_revenue' => 'Rp 0',
            'gates_count' => (int)($data['gates_count'] ?? 2),
            'gates_online' => (int)($data['gates_count'] ?? 2),
            'cameras_count' => (int)($data['cameras_count'] ?? 2),
            'cameras_online' => (int)($data['cameras_count'] ?? 2),
            'parking_types' => $parkingTypes,
            'operating_hours' => trim($data['operating_hours'] ?? '24 Hours'),
            'contact_person' => trim($data['contact_person'] ?? 'On-Duty Supervisor'),
            'contact_phone' => trim($data['contact_phone'] ?? '+62 21 555-0199'),
            'status' => $data['status'] ?? 'Optimal',
            'issue_notice' => null,
            'last_updated' => date('d M Y, H:i') . ' WIB',
            'created_at' => date('Y-m-d'),
        ];

        // Prepend new location
        array_unshift($locations, $newLocation);
        $this->saveLocations($locations);

        return $newLocation;
    }

    /**
     * Update an authorized location.
     */
    public function updateLocation(string $id, array $data): ?array
    {
        $locations = $this->loadStoredLocations();
        $updatedLocation = null;

        foreach ($locations as $index => $loc) {
            if ($loc['id'] === $id) {
                $capacity = isset($data['total_capacity']) ? (int)$data['total_capacity'] : $loc['total_capacity'];
                $occupied = min($loc['occupied'], $capacity);
                $available = max(0, $capacity - $occupied - ($loc['reserved'] ?? 0) - ($loc['maintenance'] ?? 0));
                $rate = $capacity > 0 ? round(($occupied / $capacity) * 100, 1) : 0;

                $parkingTypes = isset($data['parking_types']) && is_array($data['parking_types']) 
                    ? array_values($data['parking_types']) 
                    : $loc['parking_types'];

                $locations[$index]['name'] = isset($data['name']) ? trim($data['name']) : $loc['name'];
                $locations[$index]['city'] = isset($data['city']) ? trim($data['city']) : $loc['city'];
                $locations[$index]['address'] = isset($data['address']) ? trim($data['address']) : $loc['address'];
                $locations[$index]['postal_code'] = isset($data['postal_code']) ? trim($data['postal_code']) : ($loc['postal_code'] ?? '12000');
                $locations[$index]['zone'] = isset($data['zone']) ? trim($data['zone']) : ($loc['zone'] ?? 'Main Zone');
                $locations[$index]['total_capacity'] = $capacity;
                $locations[$index]['occupied'] = $occupied;
                $locations[$index]['available'] = $available;
                $locations[$index]['occupancy_rate'] = $rate;
                $locations[$index]['parking_types'] = $parkingTypes;
                $locations[$index]['operating_hours'] = isset($data['operating_hours']) ? trim($data['operating_hours']) : $loc['operating_hours'];
                $locations[$index]['contact_person'] = isset($data['contact_person']) ? trim($data['contact_person']) : $loc['contact_person'];
                $locations[$index]['contact_phone'] = isset($data['contact_phone']) ? trim($data['contact_phone']) : $loc['contact_phone'];
                
                if (isset($data['status'])) {
                    $locations[$index]['status'] = $data['status'];
                    if ($data['status'] === 'Optimal') {
                        $locations[$index]['issue_notice'] = null;
                    }
                }

                $locations[$index]['last_updated'] = date('d M Y, H:i') . ' WIB';
                $updatedLocation = $locations[$index];
                break;
            }
        }

        if ($updatedLocation !== null) {
            $this->saveLocations($locations);
        }

        return $updatedLocation;
    }

    /**
     * Toggle or update location operational status.
     */
    public function toggleLocationStatus(string $id, string $newStatus): ?array
    {
        $locations = $this->loadStoredLocations();
        $updated = null;

        foreach ($locations as $index => $loc) {
            if ($loc['id'] === $id) {
                $locations[$index]['status'] = $newStatus;
                if ($newStatus === 'Optimal') {
                    $locations[$index]['issue_notice'] = null;
                } elseif ($newStatus === 'Maintenance') {
                    $locations[$index]['issue_notice'] = 'Facility temporarily in maintenance mode';
                }
                $locations[$index]['last_updated'] = date('d M Y, H:i') . ' WIB';
                $updated = $locations[$index];
                break;
            }
        }

        if ($updated !== null) {
            $this->saveLocations($locations);
        }

        return $updated;
    }

    /**
     * Compute scoped dashboard metrics based on facility and period.
     */
    public function getDashboardMetrics(string $facilityId = 'all', string $period = 'today'): array
    {
        $facilities = $this->getFacilities();

        if ($facilityId !== 'all') {
            $facilities = array_filter($facilities, fn($f) => $f['id'] === $facilityId);
            if (empty($facilities)) {
                $facilities = $this->getFacilities();
                $facilityId = 'all';
            }
        }

        $totalCapacity = 0;
        $totalOccupied = 0;
        $totalAvailable = 0;
        $totalReserved = 0;
        $totalMaintenance = 0;
        $activeSessions = 0;
        $todayEntries = 0;
        $todayExits = 0;
        $totalRevenue = 0;
        $gatesTotal = 0;
        $gatesOnline = 0;
        $camerasTotal = 0;
        $camerasOnline = 0;

        foreach ($facilities as $fac) {
            $totalCapacity += $fac['total_capacity'];
            $totalOccupied += $fac['occupied'];
            $totalAvailable += $fac['available'];
            $totalReserved += $fac['reserved'];
            $totalMaintenance += $fac['maintenance'];
            $activeSessions += $fac['active_sessions'];
            $todayEntries += $fac['today_entries'];
            $todayExits += $fac['today_exits'];
            $totalRevenue += $fac['today_revenue'];
            $gatesTotal += $fac['gates_count'];
            $gatesOnline += $fac['gates_online'];
            $camerasTotal += $fac['cameras_count'];
            $camerasOnline += $fac['cameras_online'];
        }

        // Adjust revenue multiplier if period is not 'today'
        $periodMultiplier = 1.0;
        $periodLabel = 'Today (11 Oct 2026)';
        if ($period === 'yesterday') {
            $periodMultiplier = 0.94;
            $periodLabel = 'Yesterday (10 Oct 2026)';
        } elseif ($period === '7days') {
            $periodMultiplier = 6.8;
            $periodLabel = 'Last 7 Days (05 - 11 Oct 2026)';
        } elseif ($period === 'month') {
            $periodMultiplier = 11.2;
            $periodLabel = 'October 2026 (Month to Date)';
        }

        $periodRevenue = (int)($totalRevenue * $periodMultiplier);
        $occupancyRate = $totalCapacity > 0 ? round(($totalOccupied / $totalCapacity) * 100, 1) : 0;
        $hardwareHealthRate = ($gatesTotal + $camerasTotal) > 0 
            ? round((($gatesOnline + $camerasOnline) / ($gatesTotal + $camerasTotal)) * 100, 1) 
            : 100;

        return [
            'facility_id' => $facilityId,
            'period' => $period,
            'period_label' => $periodLabel,
            'managed_locations_count' => count($facilities),
            'total_capacity' => $totalCapacity,
            'occupied' => $totalOccupied,
            'available' => $totalAvailable,
            'reserved' => $totalReserved,
            'maintenance' => $totalMaintenance,
            'occupancy_rate' => $occupancyRate,
            'active_sessions' => $activeSessions,
            'today_entries' => $todayEntries,
            'today_exits' => $todayExits,
            'period_revenue' => $periodRevenue,
            'formatted_revenue' => 'Rp ' . number_format($periodRevenue, 0, ',', '.'),
            'hardware' => [
                'gates_total' => $gatesTotal,
                'gates_online' => $gatesOnline,
                'cameras_total' => $camerasTotal,
                'cameras_online' => $camerasOnline,
                'health_rate' => $hardwareHealthRate,
            ],
            'vehicle_breakdown' => [
                'car' => (int)($totalOccupied * 0.76),
                'motorcycle' => (int)($totalOccupied * 0.20),
                'ev' => (int)($totalOccupied * 0.04),
            ],
            'last_updated' => date('d M Y, H:i') . ' WIB',
        ];
    }

    /**
     * Get hourly trend data for occupancy and revenue.
     */
    public function getHourlyTrend(): array
    {
        return [
            ['hour' => '07:00', 'traffic_in' => 120, 'traffic_out' => 15, 'occupancy' => 240, 'revenue' => 1200000],
            ['hour' => '08:00', 'traffic_in' => 310, 'traffic_out' => 30, 'occupancy' => 520, 'revenue' => 3100000],
            ['hour' => '09:00', 'traffic_in' => 450, 'traffic_out' => 85, 'occupancy' => 885, 'revenue' => 5400000],
            ['hour' => '10:00', 'traffic_in' => 510, 'traffic_out' => 160, 'occupancy' => 1024, 'revenue' => 7800000],
            ['hour' => '11:00', 'traffic_in' => 480, 'traffic_out' => 240, 'occupancy' => 1010, 'revenue' => 8900000],
            ['hour' => '12:00', 'traffic_in' => 420, 'traffic_out' => 380, 'occupancy' => 990, 'revenue' => 9400000],
            ['hour' => '13:00', 'traffic_in' => 390, 'traffic_out' => 340, 'occupancy' => 1024, 'revenue' => 9850000],
        ];
    }

    /**
     * Get live gate activity log.
     */
    public function getRecentGateActivity(): array
    {
        return [
            [
                'id' => 'act-001',
                'time' => '13:02 WIB',
                'plate' => 'B 1234 XYZ',
                'vehicle_type' => 'Car',
                'facility' => 'Mall XYZ Jakarta',
                'gate' => 'Entry Gate 1',
                'type' => 'entry',
                'method' => 'ANPR Auto-Gate',
                'status' => 'Verified Entry',
                'status_type' => 'success',
            ],
            [
                'id' => 'act-002',
                'time' => '12:59 WIB',
                'plate' => 'B 9012 EV',
                'vehicle_type' => 'EV',
                'facility' => 'Grand Indonesia West',
                'gate' => 'Entry Gate 2 (EV Lane)',
                'type' => 'entry',
                'method' => 'App Reservation',
                'status' => 'Slot Reserved',
                'status_type' => 'info',
            ],
            [
                'id' => 'act-003',
                'time' => '12:55 WIB',
                'plate' => 'B 5678 ABC',
                'vehicle_type' => 'Motorcycle',
                'facility' => 'Mall XYZ Jakarta',
                'gate' => 'Exit Gate 1',
                'type' => 'exit',
                'method' => 'QRIS Instant Pay',
                'status' => 'Paid (Rp 6.000)',
                'status_type' => 'success',
            ],
            [
                'id' => 'act-004',
                'time' => '12:51 WIB',
                'plate' => 'B 2291 TJA',
                'vehicle_type' => 'Car',
                'facility' => 'Central Park Mall',
                'gate' => 'Exit Gate 2',
                'type' => 'exit',
                'method' => 'Prepaid Card (Flazz)',
                'status' => 'Paid (Rp 18.000)',
                'status_type' => 'success',
            ],
            [
                'id' => 'act-005',
                'time' => '12:47 WIB',
                'plate' => 'D 1804 SB',
                'vehicle_type' => 'Car',
                'facility' => 'Grand Indonesia West',
                'gate' => 'Exit Gate 1',
                'type' => 'exit',
                'method' => 'Cashless Tap',
                'status' => 'Paid (Rp 24.000)',
                'status_type' => 'success',
            ],
            [
                'id' => 'act-006',
                'time' => '12:42 WIB',
                'plate' => 'B 7788 NZA',
                'vehicle_type' => 'Car',
                'facility' => 'Mall XYZ Jakarta',
                'gate' => 'Entry Gate 2',
                'type' => 'entry',
                'method' => 'ANPR Auto-Gate',
                'status' => 'Verified Entry',
                'status_type' => 'success',
            ],
        ];
    }

    /**
     * Get operational alerts and device issues.
     */
    public function getOperationalAlerts(): array
    {
        return [
            [
                'id' => 'alt-001',
                'severity' => 'warning',
                'title' => 'ANPR Camera 2B Image Clarity Degraded',
                'facility' => 'Grand Indonesia West Mall',
                'location_zone' => 'Basement 1 · Entry Lane 2',
                'timestamp' => '11 Oct 2026, 12:15 WIB',
                'description' => 'Camera lens obstruction or dirty glass detected. Recognition confidence dropped to 82%. Automated maintenance ticket #TKT-492 dispatched.',
                'action_label' => 'View Camera Stream',
            ],
            [
                'id' => 'alt-002',
                'severity' => 'info',
                'title' => 'EV Fast-Charging Bays At 80% Capacity',
                'facility' => 'Mall XYZ Jakarta',
                'location_zone' => 'Level P1 · EV Hub',
                'timestamp' => '11 Oct 2026, 11:40 WIB',
                'description' => '16 of 20 high-speed EV charging bays are actively occupied. Dynamic rate balancing active.',
                'action_label' => 'Zone Monitor',
            ],
        ];
    }

    /**
     * Cache key for vendor tenant parking areas.
     */
    protected const AREAS_CACHE_KEY = 'vendor_parking_areas_vdr_jkt_01';

    /**
     * Default configured parking areas across managed facilities.
     */
    protected function getDefaultParkingAreas(): array
    {
        return [
            // Mall XYZ Jakarta (fac-mall-xyz, 450 capacity)
            [
                'id' => 'area-xyz-b1',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'code' => 'AREA-XYZ-B1',
                'name' => 'Basement 1 - North Wing (Car & EV)',
                'floor' => 'Basement 1',
                'type' => 'Basement',
                'capacity' => 160,
                'occupied' => 128,
                'available' => 28,
                'reserved' => 4,
                'status' => 'Optimal',
                'description' => 'Primary visitor car parking with 12 fast EV charging bays and automated guidance sensors.',
                'gates_assigned' => 'Entry Gate 1, Exit Gate 1',
                'last_updated' => '11 Oct 2026, 12:45 WIB',
                'created_at' => '2025-01-20',
            ],
            [
                'id' => 'area-xyz-b2',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'code' => 'AREA-XYZ-B2',
                'name' => 'Basement 2 - South Wing (Standard)',
                'floor' => 'Basement 2',
                'type' => 'Basement',
                'capacity' => 150,
                'occupied' => 110,
                'available' => 36,
                'reserved' => 4,
                'status' => 'Optimal',
                'description' => 'Standard vehicle parking, long-stay stalls and tenant assigned bays.',
                'gates_assigned' => 'Entry Gate 2, Exit Gate 2',
                'last_updated' => '11 Oct 2026, 12:40 WIB',
                'created_at' => '2025-01-20',
            ],
            [
                'id' => 'area-xyz-gf',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'code' => 'AREA-XYZ-VIP',
                'name' => 'Ground Level - VIP & Valet Zone',
                'floor' => 'Ground Floor',
                'type' => 'VIP / Valet Area',
                'capacity' => 40,
                'occupied' => 30,
                'available' => 6,
                'reserved' => 4,
                'status' => 'Optimal',
                'description' => 'Premium valet reception and short-stay courier bays right at the main lobby entrance.',
                'gates_assigned' => 'Main Lobby Gate',
                'last_updated' => '11 Oct 2026, 12:30 WIB',
                'created_at' => '2025-02-05',
            ],
            [
                'id' => 'area-xyz-mc',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'code' => 'AREA-XYZ-MC',
                'name' => 'Outdoor West - Motorcycle Zone',
                'floor' => 'Ground / Outdoor',
                'type' => 'Motorcycle Zone',
                'capacity' => 100,
                'occupied' => 60,
                'available' => 34,
                'reserved' => 2,
                'status' => 'Optimal',
                'description' => 'Covered two-wheeler parking with automated cashless tap turnstiles.',
                'gates_assigned' => 'Motorcycle Gate 1 & 2',
                'last_updated' => '11 Oct 2026, 12:35 WIB',
                'created_at' => '2025-02-10',
            ],

            // Grand Indonesia West Mall (fac-gi-west, 600 capacity)
            [
                'id' => 'area-gi-b1',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'code' => 'AREA-GI-B1',
                'name' => 'Basement 1 - Central Zone (Cars)',
                'floor' => 'Basement 1',
                'type' => 'Basement',
                'capacity' => 220,
                'occupied' => 195,
                'available' => 18,
                'reserved' => 7,
                'status' => 'Attention Required',
                'description' => 'Main entrance level. ANPR camera 2B lens clarity check scheduled.',
                'gates_assigned' => 'Entry Lane 1 & 2, Exit Lane 1',
                'last_updated' => '11 Oct 2026, 12:50 WIB',
                'created_at' => '2025-03-25',
            ],
            [
                'id' => 'area-gi-b2',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'code' => 'AREA-GI-B2',
                'name' => 'Basement 2 - Extended Fleet Zone',
                'floor' => 'Basement 2',
                'type' => 'Basement',
                'capacity' => 200,
                'occupied' => 165,
                'available' => 27,
                'reserved' => 8,
                'status' => 'Optimal',
                'description' => 'Secondary basement tier with dynamic LED overhead guidance sensor displays.',
                'gates_assigned' => 'Internal Ramp B1-B2 Gate',
                'last_updated' => '11 Oct 2026, 12:45 WIB',
                'created_at' => '2025-03-25',
            ],
            [
                'id' => 'area-gi-p1',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'code' => 'AREA-GI-EV',
                'name' => 'Level P1 - Green EV Charging & Valet',
                'floor' => 'Level 1',
                'type' => 'EV Charging Zone',
                'capacity' => 60,
                'occupied' => 46,
                'available' => 11,
                'reserved' => 3,
                'status' => 'Optimal',
                'description' => '24 high-speed DC charging stations and reserved EV parking bays.',
                'gates_assigned' => 'Green Portal Gate',
                'last_updated' => '11 Oct 2026, 12:48 WIB',
                'created_at' => '2025-04-12',
            ],
            [
                'id' => 'area-gi-mc',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'code' => 'AREA-GI-MC',
                'name' => 'East Annexe - Two-Wheeler Pavilion',
                'floor' => 'Ground / Outdoor',
                'type' => 'Motorcycle Zone',
                'capacity' => 120,
                'occupied' => 80,
                'available' => 36,
                'reserved' => 4,
                'status' => 'Optimal',
                'description' => 'High-capacity terminal dedicated for two-wheelers and delivery fleets.',
                'gates_assigned' => 'East Annexe Entry 1 & 2',
                'last_updated' => '11 Oct 2026, 12:40 WIB',
                'created_at' => '2025-04-15',
            ],

            // Central Park Mall (fac-cp-jkt, 350 capacity)
            [
                'id' => 'area-cp-b1',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'code' => 'AREA-CP-B1',
                'name' => 'Basement 1 - Retail & Shoppers',
                'floor' => 'Basement 1',
                'type' => 'Basement',
                'capacity' => 180,
                'occupied' => 118,
                'available' => 58,
                'reserved' => 4,
                'status' => 'Optimal',
                'description' => 'Direct access to retail concourse and tunnel connection.',
                'gates_assigned' => 'Tanjung Duren Entry Gate',
                'last_updated' => '11 Oct 2026, 12:35 WIB',
                'created_at' => '2025-06-15',
            ],
            [
                'id' => 'area-cp-ol',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'code' => 'AREA-CP-OUT',
                'name' => 'Outer Lane - Surface Park & Ride',
                'floor' => 'Ground / Outdoor',
                'type' => 'Outdoor / Surface',
                'capacity' => 100,
                'occupied' => 52,
                'available' => 46,
                'reserved' => 2,
                'status' => 'Optimal',
                'description' => 'Outdoor surface lot with wide turning radiuses and quick highway exit.',
                'gates_assigned' => 'South Perimeter Gate',
                'last_updated' => '11 Oct 2026, 12:20 WIB',
                'created_at' => '2025-06-18',
            ],
            [
                'id' => 'area-cp-mc',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'code' => 'AREA-CP-MC',
                'name' => 'Sub-Level A - Motorcycle Hub',
                'floor' => 'Sub-Level A',
                'type' => 'Motorcycle Zone',
                'capacity' => 70,
                'occupied' => 40,
                'available' => 26,
                'reserved' => 2,
                'status' => 'Optimal',
                'description' => 'Dedicated two-wheeler facility with smart entry turnstile.',
                'gates_assigned' => 'Motorcycle Entry 1',
                'last_updated' => '11 Oct 2026, 12:30 WIB',
                'created_at' => '2025-06-20',
            ],
        ];
    }

    /**
     * Load stored parking areas from cache or defaults.
     */
    protected function loadStoredParkingAreas(): array
    {
        return Cache::get(self::AREAS_CACHE_KEY, function () {
            $default = $this->getDefaultParkingAreas();
            Cache::put(self::AREAS_CACHE_KEY, $default, now()->addDays(30));
            return $default;
        });
    }

    /**
     * Save parking areas to cache.
     */
    protected function saveParkingAreas(array $areas): void
    {
        Cache::put(self::AREAS_CACHE_KEY, $areas, now()->addDays(30));
    }

    /**
     * Get configured parking areas for a specific facility, with filters and search.
     */
    public function getParkingAreas(string $facilityId, array $filters = []): array
    {
        $allAreas = $this->loadStoredParkingAreas();

        // Scope strictly to authorized facility
        $areas = array_filter($allAreas, fn($a) => $a['facility_id'] === $facilityId);

        // Keyword Search (name, code, floor, description)
        $query = trim(strtolower($filters['q'] ?? ''));
        if ($query !== '') {
            $areas = array_filter($areas, function ($a) use ($query) {
                return str_contains(strtolower($a['name']), $query)
                    || str_contains(strtolower($a['code']), $query)
                    || str_contains(strtolower($a['floor']), $query)
                    || str_contains(strtolower($a['description'] ?? ''), $query);
            });
        }

        // Type filter
        $type = $filters['type'] ?? 'all';
        if ($type !== 'all' && $type !== '') {
            $areas = array_filter($areas, fn($a) => strcasecmp($a['type'], $type) === 0);
        }

        // Status filter
        $status = $filters['status'] ?? 'all';
        if ($status !== 'all' && $status !== '') {
            $areas = array_filter($areas, fn($a) => strcasecmp($a['status'], $status) === 0);
        }

        // Floor filter
        $floor = $filters['floor'] ?? 'all';
        if ($floor !== 'all' && $floor !== '') {
            $areas = array_filter($areas, fn($a) => strcasecmp($a['floor'], $floor) === 0);
        }

        $areas = array_values($areas);

        // Sorting
        $sort = $filters['sort'] ?? 'name_asc';
        usort($areas, function ($a, $b) use ($sort) {
            switch ($sort) {
                case 'name_desc':
                    return strcasecmp($b['name'], $a['name']);
                case 'capacity_desc':
                    return $b['capacity'] <=> $a['capacity'];
                case 'capacity_asc':
                    return $a['capacity'] <=> $b['capacity'];
                case 'floor_asc':
                    return strcasecmp($a['floor'], $b['floor']);
                case 'updated_desc':
                    return strcmp($b['last_updated'] ?? '', $a['last_updated'] ?? '');
                case 'name_asc':
                default:
                    return strcasecmp($a['name'], $b['name']);
            }
        });

        return $areas;
    }

    /**
     * Compute summary metrics for a facility's parking areas.
     */
    public function getAreaSummaryMetrics(string $facilityId): array
    {
        $allAreas = $this->loadStoredParkingAreas();
        $facilityAreas = array_values(array_filter($allAreas, fn($a) => $a['facility_id'] === $facilityId));
        $facility = $this->getLocation($facilityId);

        $totalAreas = count($facilityAreas);
        $activeAreas = 0;
        $attentionAreas = 0;
        $maintenanceAreas = 0;
        $totalAllocatedCapacity = 0;
        $totalOccupied = 0;
        $totalAvailable = 0;

        foreach ($facilityAreas as $area) {
            $status = strtolower($area['status'] ?? '');
            if ($status === 'optimal' || $status === 'active') {
                $activeAreas++;
            } elseif ($status === 'attention required') {
                $attentionAreas++;
            } else {
                $maintenanceAreas++;
            }

            $totalAllocatedCapacity += (int)($area['capacity'] ?? 0);
            $totalOccupied += (int)($area['occupied'] ?? 0);
            $totalAvailable += (int)($area['available'] ?? 0);
        }

        $parentCapacity = (int)($facility['total_capacity'] ?? $totalAllocatedCapacity);
        $occupancyRate = $totalAllocatedCapacity > 0 ? round(($totalOccupied / $totalAllocatedCapacity) * 100, 1) : 0;
        $allocationRate = $parentCapacity > 0 ? round(($totalAllocatedCapacity / $parentCapacity) * 100, 1) : 100;

        return [
            'total_areas' => $totalAreas,
            'active_areas' => $activeAreas,
            'attention_areas' => $attentionAreas,
            'maintenance_areas' => $maintenanceAreas,
            'allocated_capacity' => $totalAllocatedCapacity,
            'facility_capacity' => $parentCapacity,
            'total_occupied' => $totalOccupied,
            'total_available' => $totalAvailable,
            'occupancy_rate' => $occupancyRate,
            'allocation_rate' => $allocationRate,
            'is_fully_allocated' => $totalAllocatedCapacity === $parentCapacity,
            'last_sync' => date('d M Y, H:i') . ' WIB',
        ];
    }

    /**
     * Get distinct floor names for a facility.
     */
    public function getDistinctFloors(string $facilityId): array
    {
        $allAreas = $this->loadStoredParkingAreas();
        $facilityAreas = array_filter($allAreas, fn($a) => $a['facility_id'] === $facilityId);
        $floors = array_unique(array_column($facilityAreas, 'floor'));
        sort($floors);
        return array_values($floors);
    }

    /**
     * Get a single parking area by ID.
     */
    public function getParkingArea(string $id): ?array
    {
        $allAreas = $this->loadStoredParkingAreas();
        foreach ($allAreas as $area) {
            if ($area['id'] === $id) {
                return $area;
            }
        }
        return null;
    }

    /**
     * Create a new parking area under an authorized facility.
     */
    public function createParkingArea(array $data): array
    {
        $allAreas = $this->loadStoredParkingAreas();
        $facility = $this->getLocation($data['facility_id']);

        $slug = preg_replace('/[^a-z0-9]+/', '-', strtolower($data['name']));
        $slug = trim($slug, '-');
        $id = 'area-' . $slug . '-' . substr(uniqid(), -4);

        $code = !empty($data['code']) 
            ? strtoupper(trim($data['code'])) 
            : 'AREA-' . strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $data['name']), 0, 8));

        $capacity = (int)($data['capacity'] ?? 50);

        $newArea = [
            'id' => $id,
            'facility_id' => $data['facility_id'],
            'facility_name' => $facility['name'] ?? 'Authorized Facility',
            'code' => $code,
            'name' => trim($data['name']),
            'floor' => trim($data['floor'] ?? 'Basement 1'),
            'type' => trim($data['type'] ?? 'Basement'),
            'capacity' => $capacity,
            'occupied' => 0,
            'available' => $capacity,
            'reserved' => 0,
            'status' => $data['status'] ?? 'Optimal',
            'description' => trim($data['description'] ?? ''),
            'gates_assigned' => trim($data['gates_assigned'] ?? 'Main Lane'),
            'last_updated' => date('d M Y, H:i') . ' WIB',
            'created_at' => date('Y-m-d'),
        ];

        array_unshift($allAreas, $newArea);
        $this->saveParkingAreas($allAreas);

        return $newArea;
    }

    /**
     * Update an authorized parking area.
     */
    public function updateParkingArea(string $id, array $data): ?array
    {
        $allAreas = $this->loadStoredParkingAreas();
        $updated = null;

        foreach ($allAreas as $index => $area) {
            if ($area['id'] === $id) {
                $capacity = isset($data['capacity']) ? (int)$data['capacity'] : $area['capacity'];
                $occupied = min($area['occupied'], $capacity);
                $available = max(0, $capacity - $occupied - ($area['reserved'] ?? 0));

                $allAreas[$index]['name'] = isset($data['name']) ? trim($data['name']) : $area['name'];
                $allAreas[$index]['floor'] = isset($data['floor']) ? trim($data['floor']) : $area['floor'];
                $allAreas[$index]['type'] = isset($data['type']) ? trim($data['type']) : $area['type'];
                $allAreas[$index]['capacity'] = $capacity;
                $allAreas[$index]['occupied'] = $occupied;
                $allAreas[$index]['available'] = $available;
                $allAreas[$index]['description'] = isset($data['description']) ? trim($data['description']) : ($area['description'] ?? '');
                $allAreas[$index]['gates_assigned'] = isset($data['gates_assigned']) ? trim($data['gates_assigned']) : ($area['gates_assigned'] ?? '');
                
                if (isset($data['status'])) {
                    $allAreas[$index]['status'] = $data['status'];
                }

                $allAreas[$index]['last_updated'] = date('d M Y, H:i') . ' WIB';
                $updated = $allAreas[$index];
                break;
            }
        }

        if ($updated !== null) {
            $this->saveParkingAreas($allAreas);
        }

        return $updated;
    }

    /**
     * Toggle or update a parking area's operational status.
     */
    public function toggleParkingAreaStatus(string $id, string $newStatus): ?array
    {
        $allAreas = $this->loadStoredParkingAreas();
        $updated = null;

        foreach ($allAreas as $index => $area) {
            if ($area['id'] === $id) {
                $allAreas[$index]['status'] = $newStatus;
                $allAreas[$index]['last_updated'] = date('d M Y, H:i') . ' WIB';
                $updated = $allAreas[$index];
                break;
            }
        }

        if ($updated !== null) {
            $this->saveParkingAreas($allAreas);
        }

        return $updated;
    }

    /**
     * Get operational facility parking map data (Page 23).
     */
    public function getFacilityMapData(string $facilityId, ?string $areaId = null): ?array
    {
        $facility = $this->getLocation($facilityId);
        if (!$facility) {
            return null;
        }

        $areas = $this->getParkingAreas($facilityId);
        if (empty($areas)) {
            return [
                'facility' => $facility,
                'areas' => [],
                'selected_area' => null,
                'slots' => [],
                'lanes' => [],
                'landmarks' => [],
                'summary' => [
                    'total_slots' => 0,
                    'available_count' => 0,
                    'occupied_count' => 0,
                    'reserved_count' => 0,
                    'maintenance_count' => 0,
                    'occupancy_rate' => 0,
                ],
                'last_updated' => date('d M Y, H:i') . ' WIB',
            ];
        }

        // Find requested area, or fallback to first area
        $selectedArea = null;
        if ($areaId) {
            foreach ($areas as $a) {
                if ($a['id'] === $areaId) {
                    $selectedArea = $a;
                    break;
                }
            }
        }
        if (!$selectedArea) {
            $selectedArea = $areas[0];
        }

        // Load shared stored slots for this area
        $allSlots = $this->loadStoredParkingSlots();
        $slots = array_values(array_filter($allSlots, fn($s) => ($s['area_id'] ?? '') === $selectedArea['id']));

        // If no slots exist for this area, generate default rows
        if (empty($slots)) {
            $slots = $this->generateDefaultAreaSlots($facility, $selectedArea);
            $allSlots = array_merge($allSlots, $slots);
            $this->saveParkingSlots($allSlots);
        }

        $totalSlots = count($slots);
        $availCount = 0;
        $occCount = 0;
        $resCount = 0;
        $maintCount = 0;

        foreach ($slots as $s) {
            $st = strtolower($s['occupancy_status'] ?? $s['status'] ?? 'available');
            if ($st === 'occupied') {
                $occCount++;
            } elseif ($st === 'reserved') {
                $resCount++;
            } elseif ($st === 'maintenance') {
                $maintCount++;
            } else {
                $availCount++;
            }
        }

        $occPercentage = $totalSlots > 0 ? round(($occCount / $totalSlots) * 100, 1) : 0;

        return [
            'facility' => $facility,
            'areas' => $areas,
            'selected_area' => $selectedArea,
            'summary' => [
                'total_slots' => $totalSlots,
                'available_count' => $availCount,
                'occupied_count' => $occCount,
                'reserved_count' => $resCount,
                'maintenance_count' => $maintCount,
                'occupancy_rate' => $occPercentage,
            ],
            'lanes' => [
                ['name' => 'Inbound Entrance Lane', 'type' => 'entry', 'width' => '100%'],
                ['name' => 'Central Two-Way Driveway (3.5m clearance)', 'type' => 'driveway', 'width' => '100%'],
                ['name' => 'Outbound Barrier Exit Lane', 'type' => 'exit', 'width' => '100%'],
            ],
            'landmarks' => [
                ['name' => 'Barrier Gate 1 (ANPR)', 'type' => 'gate_entry', 'status' => 'Online'],
                ['name' => 'Exit Gate 1 (Payment Tap)', 'type' => 'gate_exit', 'status' => 'Online'],
                ['name' => 'Elevator Core & Lobby A', 'type' => 'elevator', 'status' => 'Pedestrian Hub'],
                ['name' => 'Internal Vehicle Ramp', 'type' => 'ramp', 'status' => 'Two-Way Ramp'],
            ],
            'slots' => $slots,
            'last_updated' => date('d M Y, H:i') . ' WIB',
        ];
    }

    /**
     * Generate default slots matrix for an area.
     */
    protected function generateDefaultAreaSlots(array $facility, array $area): array
    {
        $slots = [];
        $areaCodePrefix = strtoupper(substr(str_replace('fac-', '', $facility['id']), 0, 3));
        $areaType = strtolower($area['type'] ?? 'basement');

        if (str_contains($areaType, 'motorcycle')) {
            $rowConfigs = [
                ['prefix' => 'MC-A', 'name' => 'Motorcycle Row A', 'count' => 12, 'category' => 'motorcycle', 'category_label' => 'Motorcycle Bay'],
                ['prefix' => 'MC-B', 'name' => 'Motorcycle Row B', 'count' => 12, 'category' => 'motorcycle', 'category_label' => 'Motorcycle Bay'],
            ];
        } elseif (str_contains($areaType, 'valet') || str_contains($areaType, 'vip')) {
            $rowConfigs = [
                ['prefix' => 'VALET', 'name' => 'Valet Reception Row', 'count' => 8, 'category' => 'standard', 'category_label' => 'Valet Drop-off Bay'],
                ['prefix' => 'VIP', 'name' => 'VIP Executive Row', 'count' => 6, 'category' => 'vip', 'category_label' => 'VIP & Accessible Bay'],
            ];
        } elseif (str_contains($areaType, 'ev')) {
            $rowConfigs = [
                ['prefix' => 'EV-F', 'name' => 'EV Fast DC Charging (120kW)', 'count' => 8, 'category' => 'ev', 'category_label' => 'EV Fast Charging (120kW DC)'],
                ['prefix' => 'EV-S', 'name' => 'EV AC Destination Bay', 'count' => 8, 'category' => 'ev', 'category_label' => 'EV AC Charging (22kW)'],
                ['prefix' => 'VIP', 'name' => 'VIP EV Reserved Bay', 'count' => 4, 'category' => 'vip', 'category_label' => 'VIP & Accessible Bay'],
            ];
        } elseif (str_contains($areaType, 'outdoor')) {
            $rowConfigs = [
                ['prefix' => 'OUT-A', 'name' => 'Outer Perimeter A', 'count' => 12, 'category' => 'standard', 'category_label' => 'Standard Surface Bay'],
                ['prefix' => 'OUT-B', 'name' => 'Outer Perimeter B', 'count' => 12, 'category' => 'standard', 'category_label' => 'Standard Surface Bay'],
            ];
        } else {
            // Standard Basement / Deck
            $rowConfigs = [
                ['prefix' => 'A', 'name' => 'Bay Row A (North)', 'count' => 12, 'category' => 'standard', 'category_label' => 'Standard Car Bay'],
                ['prefix' => 'B', 'name' => 'Bay Row B (Central)', 'count' => 12, 'category' => 'standard', 'category_label' => 'Standard Car Bay'],
                ['prefix' => 'VIP', 'name' => 'Bay Row VIP (Lobby Access)', 'count' => 6, 'category' => 'vip', 'category_label' => 'VIP & Accessible Bay'],
                ['prefix' => 'EV', 'name' => 'EV Fast-Charging Row', 'count' => 6, 'category' => 'ev', 'category_label' => 'EV Fast Charging (22kW DC)'],
            ];
        }

        $targetOccRate = $area['capacity'] > 0 ? ($area['occupied'] / $area['capacity']) : 0.65;

        foreach ($rowConfigs as $row) {
            for ($i = 1; $i <= $row['count']; $i++) {
                $slotCode = sprintf('%s-%02d', $row['prefix'], $i);
                $slotId = sprintf('slot-%s-%s-%d', strtolower($area['id']), strtolower(str_replace('-', '', $row['prefix'])), $i);
                $hashVal = crc32($area['id'] . '-' . $slotCode);
                $prob = ($hashVal % 100) / 100.0;

                // Deterministic status selection
                if ($i === 4 && $row['prefix'] === 'B' && str_contains(strtolower($area['status'] ?? ''), 'attention')) {
                    $status = 'maintenance';
                    $opStatus = 'Maintenance';
                } elseif ($prob < 0.05) {
                    $status = 'maintenance';
                    $opStatus = 'Maintenance';
                } elseif ($prob < 0.12) {
                    $status = 'reserved';
                    $opStatus = 'Reserved';
                } elseif ($prob < (0.12 + ($targetOccRate * 0.88))) {
                    $status = 'occupied';
                    $opStatus = 'Operational';
                } else {
                    $status = 'available';
                    $opStatus = 'Operational';
                }

                $vehicle = null;
                if ($status === 'occupied') {
                    $carTypes = ['SUV', 'Sedan', 'EV', 'City Car', 'MPV'];
                    $vType = $row['category'] === 'ev' ? 'EV' : ($row['category'] === 'motorcycle' ? 'Motorcycle' : $carTypes[$hashVal % count($carTypes)]);
                    $durMinutes = 25 + ($hashVal % 240);
                    $h = floor($durMinutes / 60);
                    $m = $durMinutes % 60;
                    $durationStr = $h > 0 ? "{$h}h {$m}m" : "{$m}m";

                    $vehicle = [
                        'plate' => sprintf('B %d*** %s', 1000 + ($hashVal % 8999), chr(65 + ($hashVal % 26)) . chr(65 + (($hashVal + 3) % 26))),
                        'type' => $vType,
                        'duration' => $durationStr,
                        'entry_time' => sprintf('%02d:%02d WIB', (10 + floor($durMinutes / 60)) % 24, $durMinutes % 60),
                    ];
                }

                $slots[] = [
                    'id' => $slotId,
                    'code' => $slotCode,
                    'facility_id' => $facility['id'],
                    'facility_name' => $facility['name'],
                    'area_id' => $area['id'],
                    'area_name' => $area['name'],
                    'floor' => $area['floor'],
                    'row' => $row['name'],
                    'row_prefix' => $row['prefix'],
                    'index' => $i,
                    'status' => $status,
                    'operational_status' => $opStatus,
                    'occupancy_status' => ucfirst($status),
                    'category' => $row['category'],
                    'category_label' => $row['category_label'],
                    'sensor_id' => sprintf('SEN-%s-%s%02d', $areaCodePrefix, str_replace('-', '', $row['prefix']), $i),
                    'sensor_status' => $status === 'maintenance' ? 'Degraded Signal' : 'Active (Online)',
                    'last_heartbeat' => 'Just now',
                    'vehicle' => $vehicle,
                    'reservation' => $status === 'reserved' ? [
                        'code' => sprintf('RES-%d', 8000 + ($hashVal % 1999)),
                        'holder' => 'Driver ' . chr(65 + ($hashVal % 26)) . '.',
                        'valid_until' => '14:30 WIB',
                    ] : null,
                    'maintenance_note' => $status === 'maintenance' ? 'Ultrasonic bay sensor calibration ticket #TKT-884' : null,
                    'last_updated' => date('d M Y, H:i') . ' WIB',
                    'created_at' => $area['created_at'] ?? '2025-01-20',
                ];
            }
        }

        return $slots;
    }

    /**
     * Default configured parking slots across all managed facilities and areas.
     */
    protected function getDefaultParkingSlots(): array
    {
        $allSlots = [];
        $facilities = $this->getDefaultLocations();
        $areas = $this->getDefaultParkingAreas();

        $facilitiesMap = [];
        foreach ($facilities as $f) {
            $facilitiesMap[$f['id']] = $f;
        }

        foreach ($areas as $area) {
            $facility = $facilitiesMap[$area['facility_id']] ?? [
                'id' => $area['facility_id'],
                'name' => $area['facility_name'],
            ];
            $areaSlots = $this->generateDefaultAreaSlots($facility, $area);
            $allSlots = array_merge($allSlots, $areaSlots);
        }

        return $allSlots;
    }

    /**
     * Load stored parking slots from cache or defaults.
     */
    protected function loadStoredParkingSlots(): array
    {
        return Cache::get(self::SLOTS_CACHE_KEY, function () {
            $default = $this->getDefaultParkingSlots();
            Cache::put(self::SLOTS_CACHE_KEY, $default, now()->addDays(30));
            return $default;
        });
    }

    /**
     * Save parking slots to cache.
     */
    protected function saveParkingSlots(array $slots): void
    {
        Cache::put(self::SLOTS_CACHE_KEY, $slots, now()->addDays(30));
    }

    /**
     * Get parking slots with filtering, search, and sorting (Page 24).
     */
    public function getParkingSlots(string $facilityId, ?string $areaId = null, array $filters = []): array
    {
        $allSlots = $this->loadStoredParkingSlots();

        // Scope to authorized facility
        $slots = array_filter($allSlots, fn($s) => ($s['facility_id'] ?? '') === $facilityId);

        // Area filter
        if ($areaId && $areaId !== 'all') {
            $slots = array_filter($slots, fn($s) => ($s['area_id'] ?? '') === $areaId);
        }

        // Keyword Search (code, sensor_id, area_name, floor, vehicle plate)
        $query = trim(strtolower($filters['q'] ?? ''));
        if ($query !== '') {
            $slots = array_filter($slots, function ($s) use ($query) {
                return str_contains(strtolower($s['code'] ?? ''), $query)
                    || str_contains(strtolower($s['sensor_id'] ?? ''), $query)
                    || str_contains(strtolower($s['area_name'] ?? ''), $query)
                    || str_contains(strtolower($s['floor'] ?? ''), $query)
                    || str_contains(strtolower($s['category_label'] ?? ''), $query)
                    || (isset($s['vehicle']['plate']) && str_contains(strtolower($s['vehicle']['plate']), $query));
            });
        }

        // Category filter
        $category = $filters['category'] ?? 'all';
        if ($category !== 'all' && $category !== '') {
            $slots = array_filter($slots, fn($s) => strcasecmp($s['category'] ?? '', $category) === 0);
        }

        // Operational status filter
        $opStatus = $filters['operational_status'] ?? 'all';
        if ($opStatus !== 'all' && $opStatus !== '') {
            $slots = array_filter($slots, fn($s) => strcasecmp($s['operational_status'] ?? '', $opStatus) === 0);
        }

        // Live Occupancy status filter
        $occStatus = $filters['occupancy_status'] ?? 'all';
        if ($occStatus !== 'all' && $occStatus !== '') {
            $slots = array_filter($slots, fn($s) => strcasecmp($s['occupancy_status'] ?? $s['status'] ?? '', $occStatus) === 0);
        }

        $slots = array_values($slots);

        // Sorting
        $sort = $filters['sort'] ?? 'code_asc';
        usort($slots, function ($a, $b) use ($sort) {
            switch ($sort) {
                case 'code_desc':
                    return strcasecmp($b['code'] ?? '', $a['code'] ?? '');
                case 'category_asc':
                    return strcasecmp($a['category_label'] ?? '', $b['category_label'] ?? '');
                case 'status_asc':
                    return strcasecmp($a['operational_status'] ?? '', $b['operational_status'] ?? '');
                case 'occupancy_asc':
                    return strcasecmp($a['occupancy_status'] ?? '', $b['occupancy_status'] ?? '');
                case 'updated_desc':
                    return strcmp($b['last_updated'] ?? '', $a['last_updated'] ?? '');
                case 'code_asc':
                default:
                    return strnatcasecmp($a['code'] ?? '', $b['code'] ?? '');
            }
        });

        return $slots;
    }

    /**
     * Compute operational summary metrics for slots in a facility and optional area.
     */
    public function getSlotSummaryMetrics(string $facilityId, ?string $areaId = null): array
    {
        $allSlots = $this->loadStoredParkingSlots();
        $scoped = array_filter($allSlots, fn($s) => ($s['facility_id'] ?? '') === $facilityId);

        if ($areaId && $areaId !== 'all') {
            $scoped = array_filter($scoped, fn($s) => ($s['area_id'] ?? '') === $areaId);
        }

        $totalSlots = count($scoped);
        $availableCount = 0;
        $occupiedCount = 0;
        $reservedCount = 0;
        $maintenanceCount = 0;
        $operationalCount = 0;
        $decommissionedCount = 0;
        $evCount = 0;
        $vipCount = 0;
        $motorcycleCount = 0;
        $standardCount = 0;

        foreach ($scoped as $s) {
            $occ = strtolower($s['occupancy_status'] ?? $s['status'] ?? 'available');
            if ($occ === 'occupied') {
                $occupiedCount++;
            } elseif ($occ === 'reserved') {
                $reservedCount++;
            } elseif ($occ === 'maintenance') {
                $maintenanceCount++;
            } else {
                $availableCount++;
            }

            $op = strtolower($s['operational_status'] ?? 'operational');
            if ($op === 'operational') {
                $operationalCount++;
            } elseif ($op === 'decommissioned') {
                $decommissionedCount++;
            }

            $cat = strtolower($s['category'] ?? 'standard');
            if ($cat === 'ev') {
                $evCount++;
            } elseif ($cat === 'vip') {
                $vipCount++;
            } elseif ($cat === 'motorcycle') {
                $motorcycleCount++;
            } else {
                $standardCount++;
            }
        }

        $occupancyRate = $totalSlots > 0 ? round(($occupiedCount / $totalSlots) * 100, 1) : 0;

        return [
            'total_slots' => $totalSlots,
            'available_count' => $availableCount,
            'occupied_count' => $occupiedCount,
            'reserved_count' => $reservedCount,
            'maintenance_count' => $maintenanceCount,
            'operational_count' => $operationalCount,
            'decommissioned_count' => $decommissionedCount,
            'occupancy_rate' => $occupancyRate,
            'ev_count' => $evCount,
            'vip_count' => $vipCount,
            'motorcycle_count' => $motorcycleCount,
            'standard_count' => $standardCount,
            'last_sync' => date('d M Y, H:i') . ' WIB',
        ];
    }

    /**
     * Get a single parking slot by ID.
     */
    public function getParkingSlot(string $id): ?array
    {
        $allSlots = $this->loadStoredParkingSlots();
        foreach ($allSlots as $slot) {
            if ($slot['id'] === $id) {
                return $slot;
            }
        }
        return null;
    }

    /**
     * Create a new parking slot under an authorized area.
     */
    public function createParkingSlot(array $data): array
    {
        $allSlots = $this->loadStoredParkingSlots();
        $facility = $this->getLocation($data['facility_id']);
        $area = $this->getParkingArea($data['area_id']);

        $code = strtoupper(trim($data['code']));
        $category = $data['category'] ?? 'standard';
        $opStatus = $data['operational_status'] ?? 'Operational';
        
        $catLabels = [
            'standard' => 'Standard Car Bay',
            'motorcycle' => 'Motorcycle Bay',
            'vip' => 'VIP & Accessible Bay',
            'ev' => 'EV Fast Charging (22kW DC)',
        ];

        $occupancyStatus = $opStatus === 'Maintenance' ? 'Maintenance' : ($opStatus === 'Reserved' ? 'Reserved' : 'Available');

        $slugArea = $area ? $area['id'] : $data['area_id'];
        $cleanCode = strtolower(preg_replace('/[^a-z0-9]/', '', $code));
        $id = 'slot-' . $slugArea . '-' . $cleanCode;

        $sensorId = !empty($data['sensor_id']) 
            ? strtoupper(trim($data['sensor_id'])) 
            : sprintf('SEN-%s-%s', strtoupper(substr(str_replace('fac-', '', $data['facility_id']), 0, 3)), str_replace('-', '', $code));

        $newSlot = [
            'id' => $id,
            'code' => $code,
            'facility_id' => $data['facility_id'],
            'facility_name' => $facility['name'] ?? 'Authorized Facility',
            'area_id' => $data['area_id'],
            'area_name' => $area['name'] ?? 'Authorized Area',
            'floor' => $area['floor'] ?? 'Floor 1',
            'row' => 'Bay ' . $code,
            'row_prefix' => substr($code, 0, 2),
            'index' => count($allSlots) + 1,
            'category' => $category,
            'category_label' => $catLabels[$category] ?? 'Standard Car Bay',
            'operational_status' => $opStatus,
            'occupancy_status' => $occupancyStatus,
            'status' => strtolower($occupancyStatus),
            'sensor_id' => $sensorId,
            'sensor_status' => $opStatus === 'Maintenance' ? 'Degraded Signal' : 'Active (Online)',
            'last_heartbeat' => 'Just now',
            'vehicle' => null,
            'reservation' => null,
            'maintenance_note' => !empty($data['maintenance_note']) ? trim($data['maintenance_note']) : null,
            'last_updated' => date('d M Y, H:i') . ' WIB',
            'created_at' => date('Y-m-d'),
        ];

        array_unshift($allSlots, $newSlot);
        $this->saveParkingSlots($allSlots);

        return $newSlot;
    }

    /**
     * Update an existing parking slot.
     */
    public function updateParkingSlot(string $id, array $data): ?array
    {
        $allSlots = $this->loadStoredParkingSlots();
        $updated = null;

        $catLabels = [
            'standard' => 'Standard Car Bay',
            'motorcycle' => 'Motorcycle Bay',
            'vip' => 'VIP & Accessible Bay',
            'ev' => 'EV Fast Charging (22kW DC)',
        ];

        foreach ($allSlots as $index => $slot) {
            if ($slot['id'] === $id) {
                if (isset($data['code'])) {
                    $allSlots[$index]['code'] = strtoupper(trim($data['code']));
                }
                if (isset($data['category'])) {
                    $allSlots[$index]['category'] = $data['category'];
                    $allSlots[$index]['category_label'] = $catLabels[$data['category']] ?? $slot['category_label'];
                }
                if (isset($data['area_id']) && $data['area_id'] !== $slot['area_id']) {
                    $area = $this->getParkingArea($data['area_id']);
                    if ($area) {
                        $allSlots[$index]['area_id'] = $area['id'];
                        $allSlots[$index]['area_name'] = $area['name'];
                        $allSlots[$index]['floor'] = $area['floor'];
                    }
                }
                if (isset($data['sensor_id'])) {
                    $allSlots[$index]['sensor_id'] = strtoupper(trim($data['sensor_id']));
                }
                if (isset($data['maintenance_note'])) {
                    $allSlots[$index]['maintenance_note'] = trim($data['maintenance_note']) ?: null;
                }
                if (isset($data['operational_status'])) {
                    $newOp = $data['operational_status'];
                    $allSlots[$index]['operational_status'] = $newOp;
                    if ($newOp === 'Maintenance') {
                        $allSlots[$index]['occupancy_status'] = 'Maintenance';
                        $allSlots[$index]['status'] = 'maintenance';
                        $allSlots[$index]['sensor_status'] = 'Degraded Signal';
                    } elseif ($newOp === 'Operational' && $slot['occupancy_status'] === 'Maintenance') {
                        $allSlots[$index]['occupancy_status'] = 'Available';
                        $allSlots[$index]['status'] = 'available';
                        $allSlots[$index]['sensor_status'] = 'Active (Online)';
                    }
                }

                $allSlots[$index]['last_updated'] = date('d M Y, H:i') . ' WIB';
                $updated = $allSlots[$index];
                break;
            }
        }

        if ($updated !== null) {
            $this->saveParkingSlots($allSlots);
        }

        return $updated;
    }

    /**
     * Toggle or update a slot's operational status.
     */
    public function toggleParkingSlotStatus(string $id, string $newStatus): ?array
    {
        $allSlots = $this->loadStoredParkingSlots();
        $updated = null;

        foreach ($allSlots as $index => $slot) {
            if ($slot['id'] === $id) {
                $allSlots[$index]['operational_status'] = $newStatus;
                if ($newStatus === 'Maintenance') {
                    $allSlots[$index]['occupancy_status'] = 'Maintenance';
                    $allSlots[$index]['status'] = 'maintenance';
                    $allSlots[$index]['sensor_status'] = 'Degraded Signal';
                    $allSlots[$index]['maintenance_note'] = 'Scheduled hardware diagnostic check';
                } elseif ($newStatus === 'Operational') {
                    $allSlots[$index]['occupancy_status'] = 'Available';
                    $allSlots[$index]['status'] = 'available';
                    $allSlots[$index]['sensor_status'] = 'Active (Online)';
                    $allSlots[$index]['maintenance_note'] = null;
                } elseif ($newStatus === 'Reserved') {
                    $allSlots[$index]['occupancy_status'] = 'Reserved';
                    $allSlots[$index]['status'] = 'reserved';
                }

                $allSlots[$index]['last_updated'] = date('d M Y, H:i') . ' WIB';
                $updated = $allSlots[$index];
                break;
            }
        }

        if ($updated !== null) {
            $this->saveParkingSlots($allSlots);
        }

        return $updated;
    }

    /**
     * Delete or archive an authorized parking slot with dependency validation.
     */
    public function deleteParkingSlot(string $id): array
    {
        $allSlots = $this->loadStoredParkingSlots();
        $targetSlot = null;
        $targetIndex = null;

        foreach ($allSlots as $index => $slot) {
            if ($slot['id'] === $id) {
                $targetSlot = $slot;
                $targetIndex = $index;
                break;
            }
        }

        if (!$targetSlot) {
            return [
                'success' => false,
                'message' => 'Parking space record not found or already deleted.',
            ];
        }

        // Safety Dependency Check: Cannot delete if occupied or active reservation
        if (strtolower($targetSlot['occupancy_status'] ?? '') === 'occupied') {
            $plate = $targetSlot['vehicle']['plate'] ?? 'Unknown vehicle';
            return [
                'success' => false,
                'message' => "Cannot delete space '{$targetSlot['code']}': A vehicle ({$plate}) is currently parked in this bay. Close the active parking session first.",
            ];
        }

        if (strtolower($targetSlot['occupancy_status'] ?? '') === 'reserved' && !empty($targetSlot['reservation'])) {
            $resCode = $targetSlot['reservation']['code'] ?? 'Active';
            return [
                'success' => false,
                'message' => "Cannot delete space '{$targetSlot['code']}': Active reservation ({$resCode}) is pending for this bay. Cancel or complete the reservation first.",
            ];
        }

        array_splice($allSlots, $targetIndex, 1);
        $this->saveParkingSlots($allSlots);

        return [
            'success' => true,
            'message' => "Parking space '{$targetSlot['code']}' has been permanently deleted from {$targetSlot['area_name']}.",
        ];
    }

    /**
     * Default list of authorized barrier gates across managed facilities (Page 25).
     */
    protected function getDefaultGates(): array
    {
        return [
            // Mall XYZ Jakarta (fac-mall-xyz - 4 configured gates)
            [
                'id' => 'gate-xyz-in-01',
                'code' => 'GATE-XYZ-IN-01',
                'name' => 'Entry Gate 1 (Main Inbound)',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'lane_name' => 'Inbound Primary Lane 1',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'barrier_type' => 'High-Speed Servo Boom (1.2s)',
                'barrier_model' => 'ServoDrive B-120 Pro',
                'controller_id' => 'CTR-XYZ-IN01',
                'ip_address' => '192.168.10.11',
                'mac_address' => '70:B3:D5:49:10:A1',
                'firmware_version' => 'v4.8.2-PRO',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Occupied', // Vehicle present on inductive loop
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 18,
                'today_cycles' => 1420,
                'total_lifetime_cycles' => 842500,
                'last_heartbeat' => 'Just now (4s ago)',
                'last_activity_time' => '13:02 WIB',
                'last_action_desc' => 'Vehicle verified entry via ANPR Auto-Gate',
                'fault_description' => null,
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (34°C)',
                'last_updated' => '11 Oct 2026, 13:02 WIB',
                'created_at' => '2025-01-18',
            ],
            [
                'id' => 'gate-xyz-in-02',
                'code' => 'GATE-XYZ-IN-02',
                'name' => 'Entry Gate 2 (North Ramp & Express)',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'lane_name' => 'Inbound Secondary Lane 2',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'barrier_type' => 'High-Speed Servo Boom (1.2s)',
                'barrier_model' => 'ServoDrive B-120 Pro',
                'controller_id' => 'CTR-XYZ-IN02',
                'ip_address' => '192.168.10.12',
                'mac_address' => '70:B3:D5:49:10:A2',
                'firmware_version' => 'v4.8.2-PRO',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Clear',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 22,
                'today_cycles' => 890,
                'total_lifetime_cycles' => 512000,
                'last_heartbeat' => 'Just now (9s ago)',
                'last_activity_time' => '12:42 WIB',
                'last_action_desc' => 'Barrier arm cycle completed (B 7788 NZA)',
                'fault_description' => null,
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (32°C)',
                'last_updated' => '11 Oct 2026, 12:42 WIB',
                'created_at' => '2025-01-18',
            ],
            [
                'id' => 'gate-xyz-out-01',
                'code' => 'GATE-XYZ-OUT-01',
                'name' => 'Exit Gate 1 (Payment Tap Concourse)',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'lane_name' => 'Outbound Primary Lane 1',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'barrier_type' => 'Standard Servo Barrier (2.5s)',
                'barrier_model' => 'ServoDrive S-200 Heavy',
                'controller_id' => 'CTR-XYZ-OUT01',
                'ip_address' => '192.168.10.21',
                'mac_address' => '70:B3:D5:49:10:B1',
                'firmware_version' => 'v4.8.2-PRO',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Clear',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 15,
                'today_cycles' => 1092,
                'total_lifetime_cycles' => 690400,
                'last_heartbeat' => 'Just now (6s ago)',
                'last_activity_time' => '12:55 WIB',
                'last_action_desc' => 'Exit payment confirmed via QRIS Instant (B 5678 ABC)',
                'fault_description' => null,
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (35°C)',
                'last_updated' => '11 Oct 2026, 12:55 WIB',
                'created_at' => '2025-01-18',
            ],
            [
                'id' => 'gate-xyz-out-02',
                'code' => 'GATE-XYZ-OUT-02',
                'name' => 'Exit Gate 2 (South Ramp Tap)',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b2',
                'area_name' => 'Basement 2 - South Wing (Standard)',
                'lane_name' => 'Outbound Secondary Lane 2',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'barrier_type' => 'Standard Servo Barrier (2.5s)',
                'barrier_model' => 'ServoDrive S-200 Heavy',
                'controller_id' => 'CTR-XYZ-OUT02',
                'ip_address' => '192.168.10.22',
                'mac_address' => '70:B3:D5:49:10:B2',
                'firmware_version' => 'v4.8.2-PRO',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Clear',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 24,
                'today_cycles' => 740,
                'total_lifetime_cycles' => 420100,
                'last_heartbeat' => 'Just now (12s ago)',
                'last_activity_time' => '12:35 WIB',
                'last_action_desc' => 'Cashless Tap verified (Rp 12.000)',
                'fault_description' => null,
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (33°C)',
                'last_updated' => '11 Oct 2026, 12:35 WIB',
                'created_at' => '2025-01-18',
            ],

            // Grand Indonesia West Mall (fac-gi-west - 6 configured gates)
            [
                'id' => 'gate-gi-in-01',
                'code' => 'GATE-GI-IN-01',
                'name' => 'Entry Gate 1 (Thamrin Main Inbound)',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b1',
                'area_name' => 'Basement 1 - Central Zone (Cars)',
                'lane_name' => 'Thamrin Boulevard Entry 1',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'barrier_type' => 'High-Speed Servo Boom (1.2s)',
                'barrier_model' => 'ServoDrive B-120 Pro',
                'controller_id' => 'CTR-GI-IN01',
                'ip_address' => '192.168.20.11',
                'mac_address' => '70:B3:D5:55:20:A1',
                'firmware_version' => 'v4.8.2-PRO',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Clear',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 14,
                'today_cycles' => 1890,
                'total_lifetime_cycles' => 1140000,
                'last_heartbeat' => 'Just now (5s ago)',
                'last_activity_time' => '13:04 WIB',
                'last_action_desc' => 'Vehicle verified entry via ANPR Auto-Gate',
                'fault_description' => null,
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (36°C)',
                'last_updated' => '11 Oct 2026, 13:04 WIB',
                'created_at' => '2025-03-22',
            ],
            [
                'id' => 'gate-gi-in-02',
                'code' => 'GATE-GI-IN-02',
                'name' => 'Entry Gate 2 (EV Hub & Express Lane)',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-p1',
                'area_name' => 'Level P1 - Green EV Charging & Valet',
                'lane_name' => 'EV Fast-Track Lane 2',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'barrier_type' => 'High-Speed Servo Boom (1.2s)',
                'barrier_model' => 'ServoDrive B-120 Pro',
                'controller_id' => 'CTR-GI-IN02',
                'ip_address' => '192.168.20.12',
                'mac_address' => '70:B3:D5:55:20:A2',
                'firmware_version' => 'v4.8.2-PRO',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Occupied',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 17,
                'today_cycles' => 960,
                'total_lifetime_cycles' => 482000,
                'last_heartbeat' => 'Just now (8s ago)',
                'last_activity_time' => '12:59 WIB',
                'last_action_desc' => 'App Reservation hold verified (B 9012 EV)',
                'fault_description' => null,
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (33°C)',
                'last_updated' => '11 Oct 2026, 12:59 WIB',
                'created_at' => '2025-03-22',
            ],
            [
                'id' => 'gate-gi-in-03',
                'code' => 'GATE-GI-IN-03',
                'name' => 'Entry Gate 3 (Basement 2 Direct Ramp)',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b2',
                'area_name' => 'Basement 2 - Extended Fleet Zone',
                'lane_name' => 'Basement 2 Direct Ramp In',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'barrier_type' => 'Standard Servo Barrier (2.5s)',
                'barrier_model' => 'ServoDrive S-200 Heavy',
                'controller_id' => 'CTR-GI-IN03',
                'ip_address' => '192.168.20.13',
                'mac_address' => '70:B3:D5:55:20:A3',
                'firmware_version' => 'v4.8.1-PRO',
                'connectivity' => 'degraded',
                'connectivity_label' => 'Degraded Signal',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Clear',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 142,
                'today_cycles' => 610,
                'total_lifetime_cycles' => 312000,
                'last_heartbeat' => '42s ago',
                'last_activity_time' => '12:20 WIB',
                'last_action_desc' => 'Loop pulse detected; network latency spike (142ms)',
                'fault_description' => 'Sub-level PLC switch packet retransmission notice',
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (38°C)',
                'last_updated' => '11 Oct 2026, 12:20 WIB',
                'created_at' => '2025-03-22',
            ],
            [
                'id' => 'gate-gi-out-01',
                'code' => 'GATE-GI-OUT-01',
                'name' => 'Exit Gate 1 (Thamrin Main Concourse)',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b1',
                'area_name' => 'Basement 1 - Central Zone (Cars)',
                'lane_name' => 'Thamrin Boulevard Exit 1',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'barrier_type' => 'Standard Servo Barrier (2.5s)',
                'barrier_model' => 'ServoDrive S-200 Heavy',
                'controller_id' => 'CTR-GI-OUT01',
                'ip_address' => '192.168.20.21',
                'mac_address' => '70:B3:D5:55:20:B1',
                'firmware_version' => 'v4.8.2-PRO',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Clear',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 16,
                'today_cycles' => 1404,
                'total_lifetime_cycles' => 910200,
                'last_heartbeat' => 'Just now (5s ago)',
                'last_activity_time' => '12:47 WIB',
                'last_action_desc' => 'Exit payment tap verified (Rp 24.000)',
                'fault_description' => null,
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (34°C)',
                'last_updated' => '11 Oct 2026, 12:47 WIB',
                'created_at' => '2025-03-22',
            ],
            [
                'id' => 'gate-gi-out-02',
                'code' => 'GATE-GI-OUT-02',
                'name' => 'Exit Gate 2 (Kebon Kacang Cashless)',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b1',
                'area_name' => 'Basement 1 - Central Zone (Cars)',
                'lane_name' => 'Kebon Kacang Exit Lane 2',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'barrier_type' => 'Standard Servo Barrier (2.5s)',
                'barrier_model' => 'ServoDrive S-200 Heavy',
                'controller_id' => 'CTR-GI-OUT02',
                'ip_address' => '192.168.20.22',
                'mac_address' => '70:B3:D5:55:20:B2',
                'firmware_version' => 'v4.8.2-PRO',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Clear',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 20,
                'today_cycles' => 820,
                'total_lifetime_cycles' => 520400,
                'last_heartbeat' => 'Just now (11s ago)',
                'last_activity_time' => '12:15 WIB',
                'last_action_desc' => 'Exit payment tap verified (Rp 18.000)',
                'fault_description' => null,
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (32°C)',
                'last_updated' => '11 Oct 2026, 12:15 WIB',
                'created_at' => '2025-03-22',
            ],
            [
                'id' => 'gate-gi-out-03',
                'code' => 'GATE-GI-OUT-03',
                'name' => 'Exit Gate 3 (Service & Loading Exit)',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b2',
                'area_name' => 'Basement 2 - Extended Fleet Zone',
                'lane_name' => 'Loading Dock Service Out',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'barrier_type' => 'Heavy Duty Flap Gate',
                'barrier_model' => 'BarrierTech HD-400',
                'controller_id' => 'CTR-GI-OUT03',
                'ip_address' => '192.168.20.23',
                'mac_address' => '70:B3:D5:55:20:B3',
                'firmware_version' => 'v4.7.9-LTS',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Maintenance',
                'barrier_position' => 'open', // Safely held open during maintenance
                'loop_detector_a' => 'Clear',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Calibration Mode',
                'ping_latency_ms' => 25,
                'today_cycles' => 140,
                'total_lifetime_cycles' => 180200,
                'last_heartbeat' => 'Just now (14s ago)',
                'last_activity_time' => '11:30 WIB',
                'last_action_desc' => 'Safety optical sensor calibration ticket #TKT-492 dispatched',
                'fault_description' => 'Infrared safety beam re-alignment required',
                'terminal_rfid_status' => 'Bypassed',
                'thermal_status' => 'Normal (29°C)',
                'last_updated' => '11 Oct 2026, 11:30 WIB',
                'created_at' => '2025-03-22',
            ],

            // Central Park Mall (fac-cp-jkt - 4 configured gates)
            [
                'id' => 'gate-cp-in-01',
                'code' => 'GATE-CP-IN-01',
                'name' => 'Tanjung Duren Entry Gate 1',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-b1',
                'area_name' => 'Basement 1 - Retail & Shoppers',
                'lane_name' => 'Tanjung Duren Main Entry',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'barrier_type' => 'High-Speed Servo Boom (1.2s)',
                'barrier_model' => 'ServoDrive B-120 Pro',
                'controller_id' => 'CTR-CP-IN01',
                'ip_address' => '192.168.30.11',
                'mac_address' => '70:B3:D5:60:30:A1',
                'firmware_version' => 'v4.8.2-PRO',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Clear',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 19,
                'today_cycles' => 1120,
                'total_lifetime_cycles' => 540000,
                'last_heartbeat' => 'Just now (7s ago)',
                'last_activity_time' => '12:50 WIB',
                'last_action_desc' => 'Vehicle verified entry via ANPR Auto-Gate',
                'fault_description' => null,
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (32°C)',
                'last_updated' => '11 Oct 2026, 12:50 WIB',
                'created_at' => '2025-06-16',
            ],
            [
                'id' => 'gate-cp-in-02',
                'code' => 'GATE-CP-IN-02',
                'name' => 'South Perimeter Entry Gate 2',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-ol',
                'area_name' => 'Outer Lane - Surface Park & Ride',
                'lane_name' => 'South Outer Perimeter Lane',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'barrier_type' => 'Standard Servo Barrier (2.5s)',
                'barrier_model' => 'ServoDrive S-200 Heavy',
                'controller_id' => 'CTR-CP-IN02',
                'ip_address' => '192.168.30.12',
                'mac_address' => '70:B3:D5:60:30:A2',
                'firmware_version' => 'v4.8.2-PRO',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Clear',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 21,
                'today_cycles' => 710,
                'total_lifetime_cycles' => 380200,
                'last_heartbeat' => 'Just now (10s ago)',
                'last_activity_time' => '12:28 WIB',
                'last_action_desc' => 'Vehicle verified entry via Cashless Tap',
                'fault_description' => null,
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (31°C)',
                'last_updated' => '11 Oct 2026, 12:28 WIB',
                'created_at' => '2025-06-16',
            ],
            [
                'id' => 'gate-cp-out-01',
                'code' => 'GATE-CP-OUT-01',
                'name' => 'Tanjung Duren Exit Gate 1',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-b1',
                'area_name' => 'Basement 1 - Retail & Shoppers',
                'lane_name' => 'Tanjung Duren Main Exit',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'barrier_type' => 'Standard Servo Barrier (2.5s)',
                'barrier_model' => 'ServoDrive S-200 Heavy',
                'controller_id' => 'CTR-CP-OUT01',
                'ip_address' => '192.168.30.21',
                'mac_address' => '70:B3:D5:60:30:B1',
                'firmware_version' => 'v4.8.2-PRO',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Clear',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 16,
                'today_cycles' => 980,
                'total_lifetime_cycles' => 495000,
                'last_heartbeat' => 'Just now (8s ago)',
                'last_activity_time' => '12:51 WIB',
                'last_action_desc' => 'Exit payment tap verified (B 2291 TJA - Rp 18.000)',
                'fault_description' => null,
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (33°C)',
                'last_updated' => '11 Oct 2026, 12:51 WIB',
                'created_at' => '2025-06-16',
            ],
            [
                'id' => 'gate-cp-out-02',
                'code' => 'GATE-CP-OUT-02',
                'name' => 'South Perimeter Exit Gate 2',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-ol',
                'area_name' => 'Outer Lane - Surface Park & Ride',
                'lane_name' => 'South Outer Perimeter Exit',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'barrier_type' => 'Standard Servo Barrier (2.5s)',
                'barrier_model' => 'ServoDrive S-200 Heavy',
                'controller_id' => 'CTR-CP-OUT02',
                'ip_address' => '192.168.30.22',
                'mac_address' => '70:B3:D5:60:30:B2',
                'firmware_version' => 'v4.8.2-PRO',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'operational_status' => 'Operational',
                'barrier_position' => 'closed',
                'loop_detector_a' => 'Clear',
                'loop_detector_b' => 'Clear',
                'safety_beam' => 'Aligned (OK)',
                'ping_latency_ms' => 20,
                'today_cycles' => 640,
                'total_lifetime_cycles' => 312500,
                'last_heartbeat' => 'Just now (12s ago)',
                'last_activity_time' => '12:22 WIB',
                'last_action_desc' => 'Cashless exit tap verified (Rp 12.000)',
                'fault_description' => null,
                'terminal_rfid_status' => 'Online',
                'thermal_status' => 'Normal (30°C)',
                'last_updated' => '11 Oct 2026, 12:22 WIB',
                'created_at' => '2025-06-16',
            ],
        ];
    }

    /**
     * Default list of gate activity logs (Page 25).
     */
    protected function getDefaultGateLogs(): array
    {
        return [
            [
                'id' => 'glog-001',
                'gate_id' => 'gate-xyz-in-01',
                'gate_code' => 'GATE-XYZ-IN-01',
                'gate_name' => 'Entry Gate 1 (Main Inbound)',
                'facility_id' => 'fac-mall-xyz',
                'timestamp' => '11 Oct 2026, 13:02 WIB',
                'time_ago' => 'Just now',
                'direction' => 'entry',
                'event_type' => 'vehicle_pass',
                'event_label' => 'Vehicle Pass Verified',
                'trigger_method' => 'ANPR Auto-Gate',
                'vehicle_plate' => 'B 1234 XYZ',
                'status' => 'Success',
                'status_type' => 'success',
                'operator' => 'Auto Gate System',
            ],
            [
                'id' => 'glog-002',
                'gate_id' => 'gate-gi-in-02',
                'gate_code' => 'GATE-GI-IN-02',
                'gate_name' => 'Entry Gate 2 (EV Hub & Express Lane)',
                'facility_id' => 'fac-gi-west',
                'timestamp' => '11 Oct 2026, 12:59 WIB',
                'time_ago' => '5m ago',
                'direction' => 'entry',
                'event_type' => 'vehicle_pass',
                'event_label' => 'EV Fast-Track Access',
                'trigger_method' => 'App Reservation QR',
                'vehicle_plate' => 'B 9012 EV',
                'status' => 'Success',
                'status_type' => 'success',
                'operator' => 'Smart Inbound Controller',
            ],
            [
                'id' => 'glog-003',
                'gate_id' => 'gate-xyz-out-01',
                'gate_code' => 'GATE-XYZ-OUT-01',
                'gate_name' => 'Exit Gate 1 (Payment Tap Concourse)',
                'facility_id' => 'fac-mall-xyz',
                'timestamp' => '11 Oct 2026, 12:55 WIB',
                'time_ago' => '9m ago',
                'direction' => 'exit',
                'event_type' => 'vehicle_pass',
                'event_label' => 'Payment Tap Out',
                'trigger_method' => 'QRIS Instant Pay',
                'vehicle_plate' => 'B 5678 ABC',
                'status' => 'Success (Paid Rp 6.000)',
                'status_type' => 'success',
                'operator' => 'Cashless Barrier Terminal',
            ],
            [
                'id' => 'glog-004',
                'gate_id' => 'gate-cp-out-01',
                'gate_code' => 'GATE-CP-OUT-01',
                'gate_name' => 'Tanjung Duren Exit Gate 1',
                'facility_id' => 'fac-cp-jkt',
                'timestamp' => '11 Oct 2026, 12:51 WIB',
                'time_ago' => '13m ago',
                'direction' => 'exit',
                'event_type' => 'vehicle_pass',
                'event_label' => 'Prepaid Card Tap Out',
                'trigger_method' => 'Prepaid Card (Flazz)',
                'vehicle_plate' => 'B 2291 TJA',
                'status' => 'Success (Paid Rp 18.000)',
                'status_type' => 'success',
                'operator' => 'Outbound Barrier Controller',
            ],
            [
                'id' => 'glog-005',
                'gate_id' => 'gate-gi-out-03',
                'gate_code' => 'GATE-GI-OUT-03',
                'gate_name' => 'Exit Gate 3 (Service & Loading Exit)',
                'facility_id' => 'fac-gi-west',
                'timestamp' => '11 Oct 2026, 11:30 WIB',
                'time_ago' => '1h 34m ago',
                'direction' => 'exit',
                'event_type' => 'status_change',
                'event_label' => 'Status Changed to Maintenance',
                'trigger_method' => 'Diagnostic Dispatch',
                'vehicle_plate' => null,
                'status' => 'Safety Sensor Calibration',
                'status_type' => 'warning',
                'operator' => 'Budi Santoso (Supervisor)',
            ],
        ];
    }

    /**
     * Load stored gates from cache or defaults.
     */
    protected function loadStoredGates(): array
    {
        return Cache::get(self::GATES_CACHE_KEY, function () {
            $default = $this->getDefaultGates();
            Cache::put(self::GATES_CACHE_KEY, $default, now()->addDays(30));
            return $default;
        });
    }

    /**
     * Save gates to cache.
     */
    protected function saveGates(array $gates): void
    {
        Cache::put(self::GATES_CACHE_KEY, $gates, now()->addDays(30));
    }

    /**
     * Load stored gate logs from cache or defaults.
     */
    protected function loadStoredGateLogs(): array
    {
        return Cache::get(self::GATE_LOGS_CACHE_KEY, function () {
            $default = $this->getDefaultGateLogs();
            Cache::put(self::GATE_LOGS_CACHE_KEY, $default, now()->addDays(30));
            return $default;
        });
    }

    /**
     * Save gate logs to cache.
     */
    protected function saveGateLogs(array $logs): void
    {
        Cache::put(self::GATE_LOGS_CACHE_KEY, $logs, now()->addDays(30));
    }

    /**
     * Append a new gate operational or command log.
     */
    public function recordGateLog(string $gateId, string $eventType, string $description, string $method, string $status, ?string $plate = null, ?string $operator = null): array
    {
        $gate = $this->getGate($gateId);
        $logs = $this->loadStoredGateLogs();

        $newLog = [
            'id' => 'glog-' . uniqid(),
            'gate_id' => $gateId,
            'gate_code' => $gate['code'] ?? 'GATE',
            'gate_name' => $gate['name'] ?? 'Gate Device',
            'facility_id' => $gate['facility_id'] ?? 'fac-mall-xyz',
            'timestamp' => date('d M Y, H:i') . ' WIB',
            'time_ago' => 'Just now',
            'direction' => $gate['direction'] ?? 'entry',
            'event_type' => $eventType,
            'event_label' => $description,
            'trigger_method' => $method,
            'vehicle_plate' => $plate,
            'status' => $status,
            'status_type' => str_contains(strtolower($status), 'fail') ? 'error' : (str_contains(strtolower($status), 'warn') ? 'warning' : 'success'),
            'operator' => $operator ?? 'Operations Staff',
        ];

        array_unshift($logs, $newLog);
        $logs = array_slice($logs, 0, 100); // Retain top 100 logs
        $this->saveGateLogs($logs);

        return $newLog;
    }

    /**
     * Get gates with filtering, searching, and sorting (Page 25).
     */
    public function getGates(string $facilityId = 'all', array $filters = []): array
    {
        $allGates = $this->loadStoredGates();

        // Scope to facility if specified
        $gates = $allGates;
        if ($facilityId !== 'all') {
            $gates = array_filter($gates, fn($g) => ($g['facility_id'] ?? '') === $facilityId);
        }

        // Keyword query (code, name, controller_id, ip_address, lane_name)
        $query = trim(strtolower($filters['q'] ?? ''));
        if ($query !== '') {
            $gates = array_filter($gates, function ($g) use ($query) {
                return str_contains(strtolower($g['code'] ?? ''), $query)
                    || str_contains(strtolower($g['name'] ?? ''), $query)
                    || str_contains(strtolower($g['controller_id'] ?? ''), $query)
                    || str_contains(strtolower($g['ip_address'] ?? ''), $query)
                    || str_contains(strtolower($g['lane_name'] ?? ''), $query)
                    || str_contains(strtolower($g['facility_name'] ?? ''), $query);
            });
        }

        // Direction filter (entry, exit, bidirectional)
        $dir = $filters['direction'] ?? 'all';
        if ($dir !== 'all' && $dir !== '') {
            $gates = array_filter($gates, fn($g) => strcasecmp($g['direction'] ?? '', $dir) === 0);
        }

        // Connectivity filter (online, offline, degraded)
        $conn = $filters['connectivity'] ?? 'all';
        if ($conn !== 'all' && $conn !== '') {
            $gates = array_filter($gates, fn($g) => strcasecmp($g['connectivity'] ?? '', $conn) === 0);
        }

        // Operational Status filter (Operational, Maintenance, Fault Detected, Emergency Open)
        $opStatus = $filters['operational_status'] ?? 'all';
        if ($opStatus !== 'all' && $opStatus !== '') {
            $gates = array_filter($gates, fn($g) => strcasecmp($g['operational_status'] ?? '', $opStatus) === 0);
        }

        // Barrier Type filter
        $barrierType = $filters['barrier_type'] ?? 'all';
        if ($barrierType !== 'all' && $barrierType !== '') {
            $gates = array_filter($gates, fn($g) => str_contains(strtolower($g['barrier_type'] ?? ''), strtolower($barrierType)));
        }

        $gates = array_values($gates);

        // Sorting
        $sort = $filters['sort'] ?? 'code_asc';
        usort($gates, function ($a, $b) use ($sort) {
            switch ($sort) {
                case 'code_desc':
                    return strcasecmp($b['code'] ?? '', $a['code'] ?? '');
                case 'name_asc':
                    return strcasecmp($a['name'] ?? '', $b['name'] ?? '');
                case 'cycles_desc':
                    return ($b['today_cycles'] ?? 0) <=> ($a['today_cycles'] ?? 0);
                case 'connectivity_asc':
                    return strcasecmp($a['connectivity'] ?? '', $b['connectivity'] ?? '');
                case 'status_asc':
                    return strcasecmp($a['operational_status'] ?? '', $b['operational_status'] ?? '');
                case 'updated_desc':
                    return strcmp($b['last_updated'] ?? '', $a['last_updated'] ?? '');
                case 'code_asc':
                default:
                    return strnatcasecmp($a['code'] ?? '', $b['code'] ?? '');
            }
        });

        return $gates;
    }

    /**
     * Compute operational summary metrics for gates in a facility.
     */
    public function getGateSummaryMetrics(string $facilityId = 'all'): array
    {
        $allGates = $this->loadStoredGates();
        $scoped = $allGates;
        if ($facilityId !== 'all') {
            $scoped = array_filter($scoped, fn($g) => ($g['facility_id'] ?? '') === $facilityId);
        }

        $totalGates = count($scoped);
        $onlineCount = 0;
        $offlineCount = 0;
        $degradedCount = 0;
        $operationalCount = 0;
        $maintenanceCount = 0;
        $faultCount = 0;
        $todayCyclesTotal = 0;

        foreach ($scoped as $g) {
            $conn = strtolower($g['connectivity'] ?? 'online');
            if ($conn === 'online') {
                $onlineCount++;
            } elseif ($conn === 'degraded') {
                $degradedCount++;
            } else {
                $offlineCount++;
            }

            $op = strtolower($g['operational_status'] ?? 'operational');
            if ($op === 'operational') {
                $operationalCount++;
            } elseif ($op === 'maintenance') {
                $maintenanceCount++;
            } elseif (str_contains($op, 'fault') || !empty($g['fault_description'])) {
                $faultCount++;
            }

            $todayCyclesTotal += (int)($g['today_cycles'] ?? 0);
        }

        $healthRate = $totalGates > 0 ? round(($onlineCount / $totalGates) * 100, 1) : 100;

        return [
            'total_gates' => $totalGates,
            'online_count' => $onlineCount,
            'offline_count' => $offlineCount,
            'degraded_count' => $degradedCount,
            'operational_count' => $operationalCount,
            'maintenance_count' => $maintenanceCount,
            'fault_count' => $faultCount,
            'today_cycles_total' => $todayCyclesTotal,
            'health_rate' => $healthRate,
            'last_sync' => date('d M Y, H:i') . ' WIB',
        ];
    }

    /**
     * Get a single gate by ID.
     */
    public function getGate(string $id): ?array
    {
        $allGates = $this->loadStoredGates();
        foreach ($allGates as $gate) {
            if ($gate['id'] === $id) {
                return $gate;
            }
        }
        return null;
    }

    /**
     * Get recent gate activity logs.
     */
    public function getGateLogs(?string $gateId = null, string $facilityId = 'all', int $limit = 20): array
    {
        $allLogs = $this->loadStoredGateLogs();

        if ($gateId) {
            $allLogs = array_filter($allLogs, fn($l) => ($l['gate_id'] ?? '') === $gateId);
        } elseif ($facilityId !== 'all') {
            $allLogs = array_filter($allLogs, fn($l) => ($l['facility_id'] ?? '') === $facilityId);
        }

        return array_slice(array_values($allLogs), 0, $limit);
    }

    /**
     * Create a new parking barrier gate.
     */
    public function createGate(array $data): array
    {
        $allGates = $this->loadStoredGates();
        $facility = $this->getLocation($data['facility_id']);
        $area = isset($data['area_id']) ? $this->getParkingArea($data['area_id']) : null;

        $code = strtoupper(trim($data['code']));
        $cleanCode = strtolower(preg_replace('/[^a-z0-9]/', '', $code));
        $id = 'gate-' . substr(str_replace('fac-', '', $data['facility_id']), 0, 3) . '-' . $cleanCode;

        $direction = strtolower($data['direction'] ?? 'entry');
        $dirLabel = $direction === 'exit' ? 'Exit (Outbound)' : ($direction === 'bidirectional' ? 'Bidirectional Lane' : 'Entry (Inbound)');

        $newGate = [
            'id' => $id,
            'code' => $code,
            'name' => trim($data['name']),
            'facility_id' => $data['facility_id'],
            'facility_name' => $facility['name'] ?? 'Authorized Facility',
            'area_id' => $data['area_id'] ?? '',
            'area_name' => $area['name'] ?? 'Main Entrance Concourse',
            'lane_name' => trim($data['lane_name'] ?? ('Lane ' . $code)),
            'direction' => $direction,
            'direction_label' => $dirLabel,
            'barrier_type' => trim($data['barrier_type'] ?? 'High-Speed Servo Boom (1.2s)'),
            'barrier_model' => trim($data['barrier_model'] ?? 'ServoDrive B-120 Pro'),
            'controller_id' => strtoupper(trim($data['controller_id'] ?? ('CTR-' . $code))),
            'ip_address' => trim($data['ip_address'] ?? '192.168.10.50'),
            'mac_address' => sprintf('70:B3:D5:%02X:%02X:%02X', rand(10, 99), rand(10, 99), rand(10, 99)),
            'firmware_version' => 'v4.8.2-PRO',
            'connectivity' => 'online',
            'connectivity_label' => 'Online',
            'operational_status' => $data['operational_status'] ?? 'Operational',
            'barrier_position' => 'closed',
            'loop_detector_a' => 'Clear',
            'loop_detector_b' => 'Clear',
            'safety_beam' => 'Aligned (OK)',
            'ping_latency_ms' => rand(15, 28),
            'today_cycles' => 0,
            'total_lifetime_cycles' => 0,
            'last_heartbeat' => 'Just now',
            'last_activity_time' => date('H:i') . ' WIB',
            'last_action_desc' => 'Device configured and registered into fleet',
            'fault_description' => null,
            'terminal_rfid_status' => 'Online',
            'thermal_status' => 'Normal (30°C)',
            'last_updated' => date('d M Y, H:i') . ' WIB',
            'created_at' => date('Y-m-d'),
        ];

        array_unshift($allGates, $newGate);
        $this->saveGates($allGates);

        $this->recordGateLog($newGate['id'], 'device_registered', "Gate {$newGate['code']} registered into facility", 'System Provisioning', 'Success');

        return $newGate;
    }

    /**
     * Update an existing gate configuration.
     */
    public function updateGate(string $id, array $data): ?array
    {
        $allGates = $this->loadStoredGates();
        $updated = null;

        foreach ($allGates as $index => $gate) {
            if ($gate['id'] === $id) {
                if (isset($data['code'])) {
                    $allGates[$index]['code'] = strtoupper(trim($data['code']));
                }
                if (isset($data['name'])) {
                    $allGates[$index]['name'] = trim($data['name']);
                }
                if (isset($data['lane_name'])) {
                    $allGates[$index]['lane_name'] = trim($data['lane_name']);
                }
                if (isset($data['direction'])) {
                    $dir = strtolower($data['direction']);
                    $allGates[$index]['direction'] = $dir;
                    $allGates[$index]['direction_label'] = $dir === 'exit' ? 'Exit (Outbound)' : ($dir === 'bidirectional' ? 'Bidirectional Lane' : 'Entry (Inbound)');
                }
                if (isset($data['barrier_type'])) {
                    $allGates[$index]['barrier_type'] = trim($data['barrier_type']);
                }
                if (isset($data['barrier_model'])) {
                    $allGates[$index]['barrier_model'] = trim($data['barrier_model']);
                }
                if (isset($data['controller_id'])) {
                    $allGates[$index]['controller_id'] = strtoupper(trim($data['controller_id']));
                }
                if (isset($data['ip_address'])) {
                    $allGates[$index]['ip_address'] = trim($data['ip_address']);
                }
                if (isset($data['area_id']) && $data['area_id'] !== $gate['area_id']) {
                    $area = $this->getParkingArea($data['area_id']);
                    if ($area) {
                        $allGates[$index]['area_id'] = $area['id'];
                        $allGates[$index]['area_name'] = $area['name'];
                    }
                }
                if (isset($data['operational_status'])) {
                    $allGates[$index]['operational_status'] = $data['operational_status'];
                }
                if (isset($data['fault_description'])) {
                    $allGates[$index]['fault_description'] = trim($data['fault_description']) ?: null;
                }

                $allGates[$index]['last_updated'] = date('d M Y, H:i') . ' WIB';
                $updated = $allGates[$index];
                break;
            }
        }

        if ($updated !== null) {
            $this->saveGates($allGates);
            $this->recordGateLog($id, 'config_update', "Configuration modified for gate {$updated['code']}", 'Operator Console', 'Success');
        }

        return $updated;
    }

    /**
     * Execute an authorized physical command on a barrier gate with safety audit.
     */
    public function executeGateCommand(string $id, string $command, string $reason, string $operator = 'Budi Santoso (Operator)'): array
    {
        $allGates = $this->loadStoredGates();
        $targetGate = null;
        $targetIndex = null;

        foreach ($allGates as $index => $g) {
            if ($g['id'] === $id) {
                $targetGate = $g;
                $targetIndex = $index;
                break;
            }
        }

        if (!$targetGate) {
            return [
                'success' => false,
                'message' => 'Barrier gate device record not found.',
                'gate' => null,
            ];
        }

        // Safety Interlock Check
        if ($targetGate['connectivity'] === 'offline') {
            return [
                'success' => false,
                'message' => "Command rejected: Controller {$targetGate['controller_id']} is currently OFFLINE. Cannot establish hardware handshake.",
                'gate' => $targetGate,
            ];
        }

        $cmdNormalized = strtolower($command);

        if ($cmdNormalized === 'raise' || $cmdNormalized === 'open') {
            $allGates[$targetIndex]['barrier_position'] = 'open';
            $allGates[$targetIndex]['today_cycles'] = ($targetGate['today_cycles'] ?? 0) + 1;
            $allGates[$targetIndex]['last_action_desc'] = "Remote barrier raise executed: " . trim($reason);
            
            if (str_contains(strtolower($reason), 'emergency')) {
                $allGates[$targetIndex]['operational_status'] = 'Emergency Open';
            }

            $allGates[$targetIndex]['last_updated'] = date('d M Y, H:i') . ' WIB';
            $this->saveGates($allGates);

            $this->recordGateLog($id, 'barrier_raise', "Remote Barrier Raised: {$reason}", 'Manual Operator Command', 'Acknowledged & Executed', null, $operator);

            return [
                'success' => true,
                'message' => "Command ACK: Barrier arm for {$targetGate['name']} has been RAISED. Controller logged command acknowledge.",
                'gate' => $allGates[$targetIndex],
            ];
        }

        if ($cmdNormalized === 'lower' || $cmdNormalized === 'close') {
            // Safety check: Cannot lower if Loop Detector A detects an active vehicle under arm
            if (($targetGate['loop_detector_a'] ?? '') === 'Occupied') {
                return [
                    'success' => false,
                    'message' => "Safety Interlock Tripped: Inductive Loop A detects a physical vehicle under the barrier. Lowering aborted to prevent property damage.",
                    'gate' => $targetGate,
                ];
            }

            $allGates[$targetIndex]['barrier_position'] = 'closed';
            $allGates[$targetIndex]['operational_status'] = 'Operational';
            $allGates[$targetIndex]['last_action_desc'] = "Remote barrier lower and auto mode reset: " . trim($reason);
            $allGates[$targetIndex]['last_updated'] = date('d M Y, H:i') . ' WIB';
            $this->saveGates($allGates);

            $this->recordGateLog($id, 'barrier_lower', "Remote Barrier Lowered: {$reason}", 'Manual Operator Command', 'Acknowledged & Executed', null, $operator);

            return [
                'success' => true,
                'message' => "Command ACK: Barrier arm for {$targetGate['name']} has been LOWERED. System restored to normal operational cycle.",
                'gate' => $allGates[$targetIndex],
            ];
        }

        if ($cmdNormalized === 'test_cycle') {
            $allGates[$targetIndex]['today_cycles'] = ($targetGate['today_cycles'] ?? 0) + 1;
            $allGates[$targetIndex]['ping_latency_ms'] = rand(14, 22);
            $allGates[$targetIndex]['last_action_desc'] = "Self-diagnostic hardware cycle verified (OK)";
            $allGates[$targetIndex]['last_updated'] = date('d M Y, H:i') . ' WIB';
            $this->saveGates($allGates);

            $this->recordGateLog($id, 'diagnostic_test', "Controller self-test ping cycle executed", 'PLC Diagnostic Probe', 'Pass (22ms latency)', null, $operator);

            return [
                'success' => true,
                'message' => "Diagnostic Pass: Self-test cycle verified. Controller responded in {$allGates[$targetIndex]['ping_latency_ms']}ms. Optical safety beams aligned.",
                'gate' => $allGates[$targetIndex],
            ];
        }

        return [
            'success' => false,
            'message' => "Unrecognized hardware command '{$command}'.",
            'gate' => $targetGate,
        ];
    }

    /**
     * Toggle or update a gate's operational status.
     */
    public function toggleGateStatus(string $id, string $newStatus, ?string $faultDesc = null): ?array
    {
        $allGates = $this->loadStoredGates();
        $updated = null;

        foreach ($allGates as $index => $g) {
            if ($g['id'] === $id) {
                $allGates[$index]['operational_status'] = $newStatus;
                if ($newStatus === 'Maintenance') {
                    $allGates[$index]['barrier_position'] = 'open'; // held open for safe servicing
                    $allGates[$index]['fault_description'] = $faultDesc ?? 'Under scheduled technician service';
                } elseif ($newStatus === 'Operational') {
                    $allGates[$index]['barrier_position'] = 'closed';
                    $allGates[$index]['fault_description'] = null;
                }

                $allGates[$index]['last_updated'] = date('d M Y, H:i') . ' WIB';
                $updated = $allGates[$index];
                break;
            }
        }

        if ($updated !== null) {
            $this->saveGates($allGates);
            $this->recordGateLog($id, 'status_toggle', "Operational status set to {$newStatus}", 'Operator Console', 'Success');
        }

        return $updated;
    }

    /**
     * Delete an authorized gate record with safety dependencies.
     */
    public function deleteGate(string $id): array
    {
        $allGates = $this->loadStoredGates();
        $targetGate = null;
        $targetIndex = null;

        foreach ($allGates as $index => $g) {
            if ($g['id'] === $id) {
                $targetGate = $g;
                $targetIndex = $index;
                break;
            }
        }

        if (!$targetGate) {
            return [
                'success' => false,
                'message' => 'Gate device record not found or already deleted.',
            ];
        }

        // Safety Dependency Check: Cannot delete if vehicle currently present on loop
        if (($targetGate['loop_detector_a'] ?? '') === 'Occupied') {
            return [
                'success' => false,
                'message' => "Cannot remove gate '{$targetGate['code']}': A vehicle is currently positioned on the entry/exit loop detector. Wait until the lane is clear.",
            ];
        }

        array_splice($allGates, $targetIndex, 1);
        $this->saveGates($allGates);

        $this->recordGateLog($id, 'gate_decommissioned', "Gate {$targetGate['code']} removed from facility fleet", 'Administration', 'Decommissioned');

        return [
            'success' => true,
            'message' => "Barrier gate '{$targetGate['code']}' ({$targetGate['name']}) has been successfully decommissioned.",
        ];
    }

    /* =========================================================================
     * PHASE 2, PAGE 26: VENDOR ANPR CAMERAS & RECOGNITION MONITORING
     * ========================================================================= */

    /**
     * Default list of configured ANPR cameras across authorized facilities.
     */
    protected function getDefaultAnprCameras(): array
    {
        return [
            // Mall XYZ Jakarta (fac-jkt-01)
            [
                'id' => 'cam-xyz-in-01',
                'camera_code' => 'CAM-XYZ-IN01',
                'name' => 'ANPR Inbound 01 - North Portal',
                'facility_id' => 'fac-jkt-01',
                'facility_name' => 'Mall XYZ Jakarta',
                'gate_id' => 'gate-xyz-in-01',
                'gate_code' => 'GATE-XYZ-IN-01',
                'lane_name' => 'Lane 1 (North Inbound)',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'camera_model' => 'Hikvision iDS-2CD7A46G0/P-IZHS',
                'ip_address' => '192.168.10.101',
                'mac_address' => '70:B3:D5:44:A1:01',
                'resolution' => '4MP (2560x1440) @ 30fps',
                'shutter_speed' => '1/1000s (Anti-Motion Blur)',
                'lens_fov' => '2.8-12mm Varifocal (88°)',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'health_status' => 'Optimal',
                'health_status_label' => 'Optical Alignment OK',
                'recognition_accuracy_rate' => 98.7,
                'today_reads_count' => 1420,
                'unreadable_today_count' => 18,
                'last_heartbeat' => 'Just now (6s ago)',
                'last_capture_time' => '15:34 WIB',
                'stream_protocol' => 'RTSP / H.265 (Authorized)',
                'installed_date' => '2025-01-15',
            ],
            [
                'id' => 'cam-xyz-in-02',
                'camera_code' => 'CAM-XYZ-IN02',
                'name' => 'ANPR Inbound 02 - VIP / Express',
                'facility_id' => 'fac-jkt-01',
                'facility_name' => 'Mall XYZ Jakarta',
                'gate_id' => 'gate-xyz-in-02',
                'gate_code' => 'GATE-XYZ-IN-02',
                'lane_name' => 'Lane 2 (Express RFID)',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'camera_model' => 'Hikvision iDS-2CD7A46G0/P-IZHS',
                'ip_address' => '192.168.10.102',
                'mac_address' => '70:B3:D5:44:A1:02',
                'resolution' => '4MP (2560x1440) @ 30fps',
                'shutter_speed' => '1/1000s (Anti-Motion Blur)',
                'lens_fov' => '2.8-12mm Varifocal (82°)',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'health_status' => 'Optimal',
                'health_status_label' => 'Optical Alignment OK',
                'recognition_accuracy_rate' => 99.1,
                'today_reads_count' => 1180,
                'unreadable_today_count' => 11,
                'last_heartbeat' => 'Just now (12s ago)',
                'last_capture_time' => '15:32 WIB',
                'stream_protocol' => 'RTSP / H.265 (Authorized)',
                'installed_date' => '2025-01-15',
            ],
            [
                'id' => 'cam-xyz-out-01',
                'camera_code' => 'CAM-XYZ-OUT01',
                'name' => 'ANPR Outbound 01 - Kuningan Exit',
                'facility_id' => 'fac-jkt-01',
                'facility_name' => 'Mall XYZ Jakarta',
                'gate_id' => 'gate-xyz-out-01',
                'gate_code' => 'GATE-XYZ-OUT-01',
                'lane_name' => 'Exit Lane 1 (Kuningan Raya)',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'camera_model' => 'Dahua DHI-ITC413-PW4D-Z1',
                'ip_address' => '192.168.10.103',
                'mac_address' => '70:B3:D5:44:A1:03',
                'resolution' => '4MP (2688x1520) @ 25fps',
                'shutter_speed' => '1/800s (Motion Priority)',
                'lens_fov' => '4.7-47mm Telephoto (58°)',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'health_status' => 'Optimal',
                'health_status_label' => 'Optical Alignment OK',
                'recognition_accuracy_rate' => 97.9,
                'today_reads_count' => 1390,
                'unreadable_today_count' => 29,
                'last_heartbeat' => 'Just now (15s ago)',
                'last_capture_time' => '15:31 WIB',
                'stream_protocol' => 'RTSP / H.264 (Authorized)',
                'installed_date' => '2025-01-18',
            ],
            [
                'id' => 'cam-xyz-out-02',
                'camera_code' => 'CAM-XYZ-OUT02',
                'name' => 'ANPR Outbound 02 - Cashless Lane',
                'facility_id' => 'fac-jkt-01',
                'facility_name' => 'Mall XYZ Jakarta',
                'gate_id' => 'gate-xyz-out-02',
                'gate_code' => 'GATE-XYZ-OUT-02',
                'lane_name' => 'Exit Lane 2 (Auto-Cashless)',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'camera_model' => 'Dahua DHI-ITC413-PW4D-Z1',
                'ip_address' => '192.168.10.104',
                'mac_address' => '70:B3:D5:44:A1:04',
                'resolution' => '4MP (2688x1520) @ 25fps',
                'shutter_speed' => '1/800s (Motion Priority)',
                'lens_fov' => '4.7-47mm Telephoto (58°)',
                'connectivity' => 'degraded',
                'connectivity_label' => 'Degraded (High Jitter)',
                'health_status' => 'High Exposure',
                'health_status_label' => 'Afternoon Glare / Auto-Iris Lag',
                'recognition_accuracy_rate' => 94.2,
                'today_reads_count' => 950,
                'unreadable_today_count' => 55,
                'last_heartbeat' => '1m ago (Packet Loss 4%)',
                'last_capture_time' => '15:20 WIB',
                'stream_protocol' => 'RTSP / H.264 (Authorized)',
                'installed_date' => '2025-01-18',
            ],

            // Grand Indonesia West Mall (fac-gi-west)
            [
                'id' => 'cam-gi-in-01',
                'camera_code' => 'CAM-GI-IN01',
                'name' => 'ANPR Thamrin Main Concourse',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'gate_id' => 'gate-gi-in-01',
                'gate_code' => 'GATE-GI-IN-01',
                'lane_name' => 'Thamrin Inbound Lane 1',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'camera_model' => 'Bosch DINION IP 7000 HD ANPR',
                'ip_address' => '192.168.20.101',
                'mac_address' => '70:B3:D5:55:B2:01',
                'resolution' => '5MP (3072x1728) @ 30fps',
                'shutter_speed' => '1/1200s (High-Precision OCR)',
                'lens_fov' => '3.8-16mm Motorized (92°)',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'health_status' => 'Optimal',
                'health_status_label' => 'Dual IR Illuminator OK',
                'recognition_accuracy_rate' => 99.4,
                'today_reads_count' => 2140,
                'unreadable_today_count' => 13,
                'last_heartbeat' => 'Just now (4s ago)',
                'last_capture_time' => '15:35 WIB',
                'stream_protocol' => 'RTSP / H.265 (Authorized)',
                'installed_date' => '2025-02-10',
            ],
            [
                'id' => 'cam-gi-in-02',
                'camera_code' => 'CAM-GI-IN02',
                'name' => 'ANPR West Lobby Inbound',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'gate_id' => 'gate-gi-in-02',
                'gate_code' => 'GATE-GI-IN-02',
                'lane_name' => 'West Lobby Lane 2',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'camera_model' => 'Bosch DINION IP 7000 HD ANPR',
                'ip_address' => '192.168.20.102',
                'mac_address' => '70:B3:D5:55:B2:02',
                'resolution' => '5MP (3072x1728) @ 30fps',
                'shutter_speed' => '1/1200s (High-Precision OCR)',
                'lens_fov' => '3.8-16mm Motorized (92°)',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'health_status' => 'Optimal',
                'health_status_label' => 'Dual IR Illuminator OK',
                'recognition_accuracy_rate' => 98.8,
                'today_reads_count' => 1890,
                'unreadable_today_count' => 23,
                'last_heartbeat' => 'Just now (9s ago)',
                'last_capture_time' => '15:33 WIB',
                'stream_protocol' => 'RTSP / H.265 (Authorized)',
                'installed_date' => '2025-02-10',
            ],
            [
                'id' => 'cam-gi-out-01',
                'camera_code' => 'CAM-GI-OUT01',
                'name' => 'ANPR Thamrin Exit 01',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'gate_id' => 'gate-gi-out-01',
                'gate_code' => 'GATE-GI-OUT-01',
                'lane_name' => 'Thamrin Outbound Lane 1',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'camera_model' => 'Bosch DINION IP 7000 HD ANPR',
                'ip_address' => '192.168.20.103',
                'mac_address' => '70:B3:D5:55:B2:03',
                'resolution' => '5MP (3072x1728) @ 30fps',
                'shutter_speed' => '1/1200s (High-Precision OCR)',
                'lens_fov' => '3.8-16mm Motorized (92°)',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'health_status' => 'Optimal',
                'health_status_label' => 'Optical Alignment OK',
                'recognition_accuracy_rate' => 98.1,
                'today_reads_count' => 2090,
                'unreadable_today_count' => 40,
                'last_heartbeat' => 'Just now (11s ago)',
                'last_capture_time' => '15:34 WIB',
                'stream_protocol' => 'RTSP / H.265 (Authorized)',
                'installed_date' => '2025-02-12',
            ],
            [
                'id' => 'cam-gi-out-03',
                'camera_code' => 'CAM-GI-OUT03',
                'name' => 'ANPR GI Loading Dock Exit',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'gate_id' => 'gate-gi-out-03',
                'gate_code' => 'GATE-GI-OUT-03',
                'lane_name' => 'Loading Dock Service Out',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'camera_model' => 'Hikvision iDS-2CD7A46G0/P-IZHS',
                'ip_address' => '192.168.20.104',
                'mac_address' => '70:B3:D5:55:B2:04',
                'resolution' => '4MP (2560x1440) @ 30fps',
                'shutter_speed' => '1/1000s (Anti-Motion Blur)',
                'lens_fov' => '2.8-12mm Varifocal (78°)',
                'connectivity' => 'offline',
                'connectivity_label' => 'Offline (Optical Cable Cut)',
                'health_status' => 'Offline',
                'health_status_label' => 'Fiber Switch Link Down in Basement 2',
                'recognition_accuracy_rate' => 0.0,
                'today_reads_count' => 0,
                'unreadable_today_count' => 0,
                'last_heartbeat' => 'Offline for 4h 12m',
                'last_capture_time' => '11:22 WIB',
                'stream_protocol' => 'RTSP / H.265 (Authorized)',
                'installed_date' => '2025-02-12',
            ],

            // Central Park Mall (fac-cp-mall)
            [
                'id' => 'cam-cp-in-01',
                'camera_code' => 'CAM-CP-IN01',
                'name' => 'ANPR S. Parman Inbound Main',
                'facility_id' => 'fac-cp-mall',
                'facility_name' => 'Central Park Mall',
                'gate_id' => 'gate-cp-in-01',
                'gate_code' => 'GATE-CP-IN-01',
                'lane_name' => 'S. Parman Inbound Lane 1',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'camera_model' => 'Uniview IPC2222EBR5-DUPF40-C',
                'ip_address' => '192.168.30.101',
                'mac_address' => '70:B3:D5:66:C3:01',
                'resolution' => '4MP (2560x1440) @ 30fps',
                'shutter_speed' => '1/1000s (Starlight Sensor)',
                'lens_fov' => '4.0mm Fixed (86°)',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'health_status' => 'Optimal',
                'health_status_label' => 'Optical Alignment OK',
                'recognition_accuracy_rate' => 98.3,
                'today_reads_count' => 1650,
                'unreadable_today_count' => 28,
                'last_heartbeat' => 'Just now (7s ago)',
                'last_capture_time' => '15:32 WIB',
                'stream_protocol' => 'RTSP / H.265 (Authorized)',
                'installed_date' => '2025-03-01',
            ],
            [
                'id' => 'cam-cp-out-01',
                'camera_code' => 'CAM-CP-OUT01',
                'name' => 'ANPR Tanjung Duren Outbound',
                'facility_id' => 'fac-cp-mall',
                'facility_name' => 'Central Park Mall',
                'gate_id' => 'gate-cp-out-01',
                'gate_code' => 'GATE-CP-OUT-01',
                'lane_name' => 'Tanjung Duren Exit Lane 1',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'camera_model' => 'Uniview IPC2222EBR5-DUPF40-C',
                'ip_address' => '192.168.30.102',
                'mac_address' => '70:B3:D5:66:C3:02',
                'resolution' => '4MP (2560x1440) @ 30fps',
                'shutter_speed' => '1/1000s (Starlight Sensor)',
                'lens_fov' => '4.0mm Fixed (86°)',
                'connectivity' => 'online',
                'connectivity_label' => 'Online',
                'health_status' => 'Optimal',
                'health_status_label' => 'Optical Alignment OK',
                'recognition_accuracy_rate' => 97.6,
                'today_reads_count' => 1580,
                'unreadable_today_count' => 38,
                'last_heartbeat' => 'Just now (14s ago)',
                'last_capture_time' => '15:33 WIB',
                'stream_protocol' => 'RTSP / H.265 (Authorized)',
                'installed_date' => '2025-03-01',
            ],
        ];
    }

    /**
     * Default list of ANPR recognition events.
     */
    protected function getDefaultAnprEvents(): array
    {
        return [
            [
                'id' => 'anpr-evt-101',
                'event_uuid' => 'EVT-20261011-094182',
                'facility_id' => 'fac-jkt-01',
                'facility_name' => 'Mall XYZ Jakarta',
                'camera_id' => 'cam-xyz-in-01',
                'camera_code' => 'CAM-XYZ-IN01',
                'gate_id' => 'gate-xyz-in-01',
                'gate_code' => 'GATE-XYZ-IN-01',
                'lane_name' => 'Lane 1 (North Inbound)',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'timestamp' => '11 Oct 2026, 15:34:12 WIB',
                'time_ago' => '2 mins ago',
                'recognized_plate' => 'B 1892 KRF',
                'original_recognized_plate' => 'B 1892 KRF',
                'vehicle_type' => 'Car (SUV/Sedan)',
                'vehicle_color' => 'Pearl White',
                'plate_type' => 'Standard Black/White (Pribadi)',
                'confidence_score' => 98.4,
                'confidence_level' => 'High',
                'outcome' => 'Recognized',
                'review_status' => 'Verified',
                'parking_session_id' => 'SES-20261011-0491',
                'reviewed_by' => 'Automated Engine OCR-v5',
                'reviewed_at' => '11 Oct 2026, 15:34 WIB',
                'review_reason' => 'High confidence match (>98%) on approach induction',
                'crop_coordinates' => ['ymin' => 0.62, 'xmin' => 0.38, 'ymax' => 0.74, 'xmax' => 0.62],
            ],
            [
                'id' => 'anpr-evt-102',
                'event_uuid' => 'EVT-20261011-094181',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'camera_id' => 'cam-gi-in-01',
                'camera_code' => 'CAM-GI-IN01',
                'gate_id' => 'gate-gi-in-01',
                'gate_code' => 'GATE-GI-IN-01',
                'lane_name' => 'Thamrin Inbound Lane 1',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'timestamp' => '11 Oct 2026, 15:33:04 WIB',
                'time_ago' => '3 mins ago',
                'recognized_plate' => 'B 1024 EV',
                'original_recognized_plate' => 'B 1024 EV',
                'vehicle_type' => 'Electric Vehicle (EV)',
                'vehicle_color' => 'Obsidian Black',
                'plate_type' => 'Electric Green Stripe (EV)',
                'confidence_score' => 99.2,
                'confidence_level' => 'High',
                'outcome' => 'Recognized',
                'review_status' => 'Verified',
                'parking_session_id' => 'SES-20261011-0490',
                'reviewed_by' => 'Automated Engine OCR-v5',
                'reviewed_at' => '11 Oct 2026, 15:33 WIB',
                'review_reason' => 'EV plate format recognized with valid National Registry tag',
                'crop_coordinates' => ['ymin' => 0.60, 'xmin' => 0.35, 'ymax' => 0.72, 'xmax' => 0.65],
            ],
            [
                'id' => 'anpr-evt-103',
                'event_uuid' => 'EVT-20261011-094180',
                'facility_id' => 'fac-jkt-01',
                'facility_name' => 'Mall XYZ Jakarta',
                'camera_id' => 'cam-xyz-out-02',
                'camera_code' => 'CAM-XYZ-OUT02',
                'gate_id' => 'gate-xyz-out-02',
                'gate_code' => 'GATE-XYZ-OUT-02',
                'lane_name' => 'Exit Lane 2 (Auto-Cashless)',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'timestamp' => '11 Oct 2026, 15:30:28 WIB',
                'time_ago' => '6 mins ago',
                'recognized_plate' => 'B 8931 UTR',
                'original_recognized_plate' => 'B 8*31 UTR',
                'vehicle_type' => 'Car (MPV)',
                'vehicle_color' => 'Silver Metallic',
                'plate_type' => 'Standard Black/White (Pribadi)',
                'confidence_score' => 76.5,
                'confidence_level' => 'Medium',
                'outcome' => 'Recognized',
                'review_status' => 'Manually Corrected',
                'parking_session_id' => 'SES-20261011-0312',
                'reviewed_by' => 'Budi Santoso (Operations Lead)',
                'reviewed_at' => '11 Oct 2026, 15:31 WIB',
                'review_reason' => 'Reflection glare obscured digit 9 as asterisk. Operator verified via high-res frame.',
                'crop_coordinates' => ['ymin' => 0.58, 'xmin' => 0.40, 'ymax' => 0.70, 'xmax' => 0.60],
            ],
            [
                'id' => 'anpr-evt-104',
                'event_uuid' => 'EVT-20261011-094179',
                'facility_id' => 'fac-cp-mall',
                'facility_name' => 'Central Park Mall',
                'camera_id' => 'cam-cp-in-01',
                'camera_code' => 'CAM-CP-IN01',
                'gate_id' => 'gate-cp-in-01',
                'gate_code' => 'GATE-CP-IN-01',
                'lane_name' => 'S. Parman Inbound Lane 1',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'timestamp' => '11 Oct 2026, 15:28:15 WIB',
                'time_ago' => '8 mins ago',
                'recognized_plate' => 'D 1104 ABC',
                'original_recognized_plate' => 'D 1104 ABC',
                'vehicle_type' => 'Car (Sedan)',
                'vehicle_color' => 'Dark Blue',
                'plate_type' => 'Standard Black/White (Pribadi)',
                'confidence_score' => 96.8,
                'confidence_level' => 'High',
                'outcome' => 'Recognized',
                'review_status' => 'Verified',
                'parking_session_id' => 'SES-20261011-0489',
                'reviewed_by' => 'Automated Engine OCR-v5',
                'reviewed_at' => '11 Oct 2026, 15:28 WIB',
                'review_reason' => 'Clean optical detection on approach loop',
                'crop_coordinates' => ['ymin' => 0.63, 'xmin' => 0.36, 'ymax' => 0.75, 'xmax' => 0.64],
            ],
            [
                'id' => 'anpr-evt-105',
                'event_uuid' => 'EVT-20261011-094178',
                'facility_id' => 'fac-jkt-01',
                'facility_name' => 'Mall XYZ Jakarta',
                'camera_id' => 'cam-xyz-in-01',
                'camera_code' => 'CAM-XYZ-IN01',
                'gate_id' => 'gate-xyz-in-01',
                'gate_code' => 'GATE-XYZ-IN-01',
                'lane_name' => 'Lane 1 (North Inbound)',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'timestamp' => '11 Oct 2026, 15:25:50 WIB',
                'time_ago' => '11 mins ago',
                'recognized_plate' => null,
                'original_recognized_plate' => null,
                'vehicle_type' => 'Car (Commercial Van)',
                'vehicle_color' => 'Grey',
                'plate_type' => 'Unknown',
                'confidence_score' => null,
                'confidence_level' => 'Low',
                'outcome' => 'Unreadable',
                'review_status' => 'Pending Review',
                'parking_session_id' => null,
                'reviewed_by' => null,
                'reviewed_at' => null,
                'review_reason' => 'Plate surface covered by mud spatter; OCR segmentation threshold failed (<40%)',
                'crop_coordinates' => ['ymin' => 0.55, 'xmin' => 0.32, 'ymax' => 0.68, 'xmax' => 0.58],
            ],
            [
                'id' => 'anpr-evt-106',
                'event_uuid' => 'EVT-20261011-094177',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'camera_id' => 'cam-gi-out-01',
                'camera_code' => 'CAM-GI-OUT01',
                'gate_id' => 'gate-gi-out-01',
                'gate_code' => 'GATE-GI-OUT-01',
                'lane_name' => 'Thamrin Outbound Lane 1',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'timestamp' => '11 Oct 2026, 15:22:19 WIB',
                'time_ago' => '14 mins ago',
                'recognized_plate' => 'B 2291 TJA',
                'original_recognized_plate' => 'B 2291 TJA',
                'vehicle_type' => 'Car (Hatchback)',
                'vehicle_color' => 'Red',
                'plate_type' => 'Standard Black/White (Pribadi)',
                'confidence_score' => 97.4,
                'confidence_level' => 'High',
                'outcome' => 'Recognized',
                'review_status' => 'Verified',
                'parking_session_id' => 'SES-20261011-0308',
                'reviewed_by' => 'Automated Engine OCR-v5',
                'reviewed_at' => '11 Oct 2026, 15:22 WIB',
                'review_reason' => 'Payment match confirmed; gate actuated',
                'crop_coordinates' => ['ymin' => 0.61, 'xmin' => 0.37, 'ymax' => 0.73, 'xmax' => 0.63],
            ],
            [
                'id' => 'anpr-evt-107',
                'event_uuid' => 'EVT-20261011-094176',
                'facility_id' => 'fac-cp-mall',
                'facility_name' => 'Central Park Mall',
                'camera_id' => 'cam-cp-out-01',
                'camera_code' => 'CAM-CP-OUT01',
                'gate_id' => 'gate-cp-out-01',
                'gate_code' => 'GATE-CP-OUT-01',
                'lane_name' => 'Tanjung Duren Exit Lane 1',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'timestamp' => '11 Oct 2026, 15:19:33 WIB',
                'time_ago' => '17 mins ago',
                'recognized_plate' => null,
                'original_recognized_plate' => null,
                'vehicle_type' => 'Motorcycle',
                'vehicle_color' => 'Matte Black',
                'plate_type' => 'None Detected',
                'confidence_score' => null,
                'confidence_level' => 'Low',
                'outcome' => 'No Plate Detected',
                'review_status' => 'Flagged',
                'parking_session_id' => null,
                'reviewed_by' => null,
                'reviewed_at' => null,
                'review_reason' => 'Front induction loop triggered but vehicle lacks front license plate mount',
                'crop_coordinates' => ['ymin' => 0.50, 'xmin' => 0.30, 'ymax' => 0.70, 'xmax' => 0.70],
            ],
            [
                'id' => 'anpr-evt-108',
                'event_uuid' => 'EVT-20261011-094175',
                'facility_id' => 'fac-jkt-01',
                'facility_name' => 'Mall XYZ Jakarta',
                'camera_id' => 'cam-xyz-in-02',
                'camera_code' => 'CAM-XYZ-IN02',
                'gate_id' => 'gate-xyz-in-02',
                'gate_code' => 'GATE-XYZ-IN-02',
                'lane_name' => 'Lane 2 (Express RFID)',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'timestamp' => '11 Oct 2026, 15:15:02 WIB',
                'time_ago' => '21 mins ago',
                'recognized_plate' => 'B 1 RI',
                'original_recognized_plate' => 'B 1 RI',
                'vehicle_type' => 'Government VIP Convoy',
                'vehicle_color' => 'Black',
                'plate_type' => 'Government Red / State (RI)',
                'confidence_score' => 99.8,
                'confidence_level' => 'High',
                'outcome' => 'Recognized',
                'review_status' => 'Verified',
                'parking_session_id' => 'SES-20261011-0485',
                'reviewed_by' => 'Automated Engine OCR-v5',
                'reviewed_at' => '11 Oct 2026, 15:15 WIB',
                'review_reason' => 'VIP VIP/State Registry match; express arm clearance granted',
                'crop_coordinates' => ['ymin' => 0.60, 'xmin' => 0.40, 'ymax' => 0.72, 'xmax' => 0.60],
            ],
            [
                'id' => 'anpr-evt-109',
                'event_uuid' => 'EVT-20261011-094174',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'camera_id' => 'cam-gi-in-02',
                'camera_code' => 'CAM-GI-IN02',
                'gate_id' => 'gate-gi-in-02',
                'gate_code' => 'GATE-GI-IN-02',
                'lane_name' => 'West Lobby Lane 2',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'timestamp' => '11 Oct 2026, 15:10:48 WIB',
                'time_ago' => '26 mins ago',
                'recognized_plate' => 'F 1450 LK',
                'original_recognized_plate' => 'F 1450 LK',
                'vehicle_type' => 'Car (SUV)',
                'vehicle_color' => 'Dark Grey',
                'plate_type' => 'Standard Black/White (Pribadi)',
                'confidence_score' => 95.3,
                'confidence_level' => 'High',
                'outcome' => 'Recognized',
                'review_status' => 'Verified',
                'parking_session_id' => 'SES-20261011-0481',
                'reviewed_by' => 'Automated Engine OCR-v5',
                'reviewed_at' => '11 Oct 2026, 15:10 WIB',
                'review_reason' => 'Clean optical entry scan',
                'crop_coordinates' => ['ymin' => 0.62, 'xmin' => 0.36, 'ymax' => 0.74, 'xmax' => 0.64],
            ],
            [
                'id' => 'anpr-evt-110',
                'event_uuid' => 'EVT-20261011-094173',
                'facility_id' => 'fac-jkt-01',
                'facility_name' => 'Mall XYZ Jakarta',
                'camera_id' => 'cam-xyz-out-01',
                'camera_code' => 'CAM-XYZ-OUT01',
                'gate_id' => 'gate-xyz-out-01',
                'gate_code' => 'GATE-XYZ-OUT-01',
                'lane_name' => 'Exit Lane 1 (Kuningan Raya)',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'timestamp' => '11 Oct 2026, 15:04:12 WIB',
                'time_ago' => '32 mins ago',
                'recognized_plate' => 'B 7712 SS',
                'original_recognized_plate' => 'B 7712 SS',
                'vehicle_type' => 'Car (Sedan)',
                'vehicle_color' => 'Silver',
                'plate_type' => 'Standard Black/White (Pribadi)',
                'confidence_score' => 98.1,
                'confidence_level' => 'High',
                'outcome' => 'Recognized',
                'review_status' => 'Verified',
                'parking_session_id' => 'SES-20261011-0299',
                'reviewed_by' => 'Automated Engine OCR-v5',
                'reviewed_at' => '11 Oct 2026, 15:04 WIB',
                'review_reason' => 'Exit reconciliation matched in 18ms',
                'crop_coordinates' => ['ymin' => 0.60, 'xmin' => 0.38, 'ymax' => 0.72, 'xmax' => 0.62],
            ],
            [
                'id' => 'anpr-evt-111',
                'event_uuid' => 'EVT-20261011-094172',
                'facility_id' => 'fac-jkt-01',
                'facility_name' => 'Mall XYZ Jakarta',
                'camera_id' => 'cam-xyz-out-02',
                'camera_code' => 'CAM-XYZ-OUT02',
                'gate_id' => 'gate-xyz-out-02',
                'gate_code' => 'GATE-XYZ-OUT-02',
                'lane_name' => 'Exit Lane 2 (Auto-Cashless)',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'timestamp' => '11 Oct 2026, 14:58:30 WIB',
                'time_ago' => '38 mins ago',
                'recognized_plate' => null,
                'original_recognized_plate' => null,
                'vehicle_type' => 'Car (MPV)',
                'vehicle_color' => 'Black',
                'plate_type' => 'Corrupted Stream Packet',
                'confidence_score' => null,
                'confidence_level' => 'Low',
                'outcome' => 'Processing Failed',
                'review_status' => 'Flagged',
                'parking_session_id' => null,
                'reviewed_by' => null,
                'reviewed_at' => null,
                'review_reason' => 'RTSP frame drop during exposure spike; OCR payload CRC mismatch',
                'crop_coordinates' => ['ymin' => 0.45, 'xmin' => 0.25, 'ymax' => 0.75, 'xmax' => 0.75],
            ],
            [
                'id' => 'anpr-evt-112',
                'event_uuid' => 'EVT-20261011-094171',
                'facility_id' => 'fac-cp-mall',
                'facility_name' => 'Central Park Mall',
                'camera_id' => 'cam-cp-in-01',
                'camera_code' => 'CAM-CP-IN01',
                'gate_id' => 'gate-cp-in-01',
                'gate_code' => 'GATE-CP-IN-01',
                'lane_name' => 'S. Parman Inbound Lane 1',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'timestamp' => '11 Oct 2026, 14:51:19 WIB',
                'time_ago' => '45 mins ago',
                'recognized_plate' => 'B 9012 KOP',
                'original_recognized_plate' => 'B 9012 KOP',
                'vehicle_type' => 'Car (SUV)',
                'vehicle_color' => 'White',
                'plate_type' => 'Standard Black/White (Pribadi)',
                'confidence_score' => 97.2,
                'confidence_level' => 'High',
                'outcome' => 'Recognized',
                'review_status' => 'Verified',
                'parking_session_id' => 'SES-20261011-0460',
                'reviewed_by' => 'Automated Engine OCR-v5',
                'reviewed_at' => '11 Oct 2026, 14:51 WIB',
                'review_reason' => 'Valid entry session created',
                'crop_coordinates' => ['ymin' => 0.63, 'xmin' => 0.38, 'ymax' => 0.75, 'xmax' => 0.62],
            ],
            [
                'id' => 'anpr-evt-113',
                'event_uuid' => 'EVT-20261011-094170',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'camera_id' => 'cam-gi-in-01',
                'camera_code' => 'CAM-GI-IN01',
                'gate_id' => 'gate-gi-in-01',
                'gate_code' => 'GATE-GI-IN-01',
                'lane_name' => 'Thamrin Inbound Lane 1',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'timestamp' => '11 Oct 2026, 14:44:02 WIB',
                'time_ago' => '52 mins ago',
                'recognized_plate' => 'L 1822 XY',
                'original_recognized_plate' => 'L 1822 XY',
                'vehicle_type' => 'Car (Sedan)',
                'vehicle_color' => 'Silver',
                'plate_type' => 'Standard Black/White (Pribadi)',
                'confidence_score' => 98.9,
                'confidence_level' => 'High',
                'outcome' => 'Recognized',
                'review_status' => 'Verified',
                'parking_session_id' => 'SES-20261011-0455',
                'reviewed_by' => 'Automated Engine OCR-v5',
                'reviewed_at' => '11 Oct 2026, 14:44 WIB',
                'review_reason' => 'Inter-city plate format (Surabaya) parsed successfully',
                'crop_coordinates' => ['ymin' => 0.61, 'xmin' => 0.37, 'ymax' => 0.73, 'xmax' => 0.63],
            ],
            [
                'id' => 'anpr-evt-114',
                'event_uuid' => 'EVT-20261011-094169',
                'facility_id' => 'fac-jkt-01',
                'facility_name' => 'Mall XYZ Jakarta',
                'camera_id' => 'cam-xyz-in-01',
                'camera_code' => 'CAM-XYZ-IN01',
                'gate_id' => 'gate-xyz-in-01',
                'gate_code' => 'GATE-XYZ-IN-01',
                'lane_name' => 'Lane 1 (North Inbound)',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'timestamp' => '11 Oct 2026, 14:38:51 WIB',
                'time_ago' => '58 mins ago',
                'recognized_plate' => 'B 3042 ZZZ',
                'original_recognized_plate' => 'B 3042 ZZZ',
                'vehicle_type' => 'Car (MPV)',
                'vehicle_color' => 'Bronze Brown',
                'plate_type' => 'Standard Black/White (Pribadi)',
                'confidence_score' => 96.5,
                'confidence_level' => 'High',
                'outcome' => 'Recognized',
                'review_status' => 'Verified',
                'parking_session_id' => 'SES-20261011-0448',
                'reviewed_by' => 'Automated Engine OCR-v5',
                'reviewed_at' => '11 Oct 2026, 14:38 WIB',
                'review_reason' => 'Automatic entry match',
                'crop_coordinates' => ['ymin' => 0.62, 'xmin' => 0.38, 'ymax' => 0.74, 'xmax' => 0.62],
            ],
            [
                'id' => 'anpr-evt-115',
                'event_uuid' => 'EVT-20261011-094168',
                'facility_id' => 'fac-jkt-01',
                'facility_name' => 'Mall XYZ Jakarta',
                'camera_id' => 'cam-xyz-out-01',
                'camera_code' => 'CAM-XYZ-OUT01',
                'gate_id' => 'gate-xyz-out-01',
                'gate_code' => 'GATE-XYZ-OUT-01',
                'lane_name' => 'Exit Lane 1 (Kuningan Raya)',
                'direction' => 'exit',
                'direction_label' => 'Exit (Outbound)',
                'timestamp' => '11 Oct 2026, 14:30:17 WIB',
                'time_ago' => '1h 6m ago',
                'recognized_plate' => 'B 1414 QWE',
                'original_recognized_plate' => 'B 1414 QWE',
                'vehicle_type' => 'Car (Hatchback)',
                'vehicle_color' => 'Yellow',
                'plate_type' => 'Standard Black/White (Pribadi)',
                'confidence_score' => 98.7,
                'confidence_level' => 'High',
                'outcome' => 'Recognized',
                'review_status' => 'Verified',
                'parking_session_id' => 'SES-20261011-0280',
                'reviewed_by' => 'Automated Engine OCR-v5',
                'reviewed_at' => '11 Oct 2026, 14:30 WIB',
                'review_reason' => 'E-Money tap and plate verified',
                'crop_coordinates' => ['ymin' => 0.60, 'xmin' => 0.38, 'ymax' => 0.72, 'xmax' => 0.62],
            ],
            [
                'id' => 'anpr-evt-116',
                'event_uuid' => 'EVT-20261011-094167',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'camera_id' => 'cam-gi-in-01',
                'camera_code' => 'CAM-GI-IN01',
                'gate_id' => 'gate-gi-in-01',
                'gate_code' => 'GATE-GI-IN-01',
                'lane_name' => 'Thamrin Inbound Lane 1',
                'direction' => 'entry',
                'direction_label' => 'Entry (Inbound)',
                'timestamp' => '11 Oct 2026, 14:22:45 WIB',
                'time_ago' => '1h 14m ago',
                'recognized_plate' => 'B 6620 PLK',
                'original_recognized_plate' => 'B 6620 PLK',
                'vehicle_type' => 'Car (SUV)',
                'vehicle_color' => 'White',
                'plate_type' => 'Standard Black/White (Pribadi)',
                'confidence_score' => 97.8,
                'confidence_level' => 'High',
                'outcome' => 'Recognized',
                'review_status' => 'Verified',
                'parking_session_id' => 'SES-20261011-0435',
                'reviewed_by' => 'Automated Engine OCR-v5',
                'reviewed_at' => '11 Oct 2026, 14:22 WIB',
                'review_reason' => 'Clean scan',
                'crop_coordinates' => ['ymin' => 0.61, 'xmin' => 0.37, 'ymax' => 0.73, 'xmax' => 0.63],
            ],
        ];
    }

    /**
     * Load stored ANPR cameras from cache or defaults.
     */
    protected function loadStoredAnprCameras(): array
    {
        return Cache::get(self::ANPR_CAMERAS_CACHE_KEY, function () {
            $default = $this->getDefaultAnprCameras();
            Cache::put(self::ANPR_CAMERAS_CACHE_KEY, $default, now()->addDays(30));
            return $default;
        });
    }

    /**
     * Save ANPR cameras to cache.
     */
    protected function saveAnprCameras(array $cameras): void
    {
        Cache::put(self::ANPR_CAMERAS_CACHE_KEY, $cameras, now()->addDays(30));
    }

    /**
     * Load stored ANPR events from cache or defaults.
     */
    protected function loadStoredAnprEvents(): array
    {
        return Cache::get(self::ANPR_EVENTS_CACHE_KEY, function () {
            $default = $this->getDefaultAnprEvents();
            Cache::put(self::ANPR_EVENTS_CACHE_KEY, $default, now()->addDays(30));
            return $default;
        });
    }

    /**
     * Save ANPR events to cache.
     */
    protected function saveAnprEvents(array $events): void
    {
        Cache::put(self::ANPR_EVENTS_CACHE_KEY, $events, now()->addDays(30));
    }

    /**
     * Get configured ANPR cameras scoped to authorized facilities.
     */
    public function getAnprCameras(string $facilityId = 'all'): array
    {
        $allCameras = $this->loadStoredAnprCameras();
        if ($facilityId === 'all') {
            return $allCameras;
        }

        return array_values(array_filter($allCameras, fn($c) => ($c['facility_id'] ?? '') === $facilityId));
    }

    /**
     * Get single ANPR camera record by ID.
     */
    public function getAnprCamera(string $id): ?array
    {
        $allCameras = $this->loadStoredAnprCameras();
        foreach ($allCameras as $camera) {
            if ($camera['id'] === $id) {
                return $camera;
            }
        }

        return null;
    }

    /**
     * Compute ANPR operational summary metrics for authorized facilities.
     */
    public function getAnprSummaryMetrics(string $facilityId = 'all', string $timeRange = 'today'): array
    {
        $cameras = $this->getAnprCameras($facilityId);
        $events = $this->loadStoredAnprEvents();

        if ($facilityId !== 'all') {
            $events = array_filter($events, fn($e) => ($e['facility_id'] ?? '') === $facilityId);
        }

        $totalCameras = count($cameras);
        $onlineCameras = 0;
        $offlineCameras = 0;
        $degradedCameras = 0;

        foreach ($cameras as $c) {
            $conn = strtolower($c['connectivity'] ?? 'online');
            if ($conn === 'online') {
                $onlineCameras++;
            } elseif ($conn === 'degraded') {
                $degradedCameras++;
            } else {
                $offlineCameras++;
            }
        }

        $totalEvents = count($events);
        $successfulCount = 0;
        $unreadableCount = 0;
        $noPlateCount = 0;
        $failedCount = 0;
        $reviewRequiredCount = 0;

        foreach ($events as $e) {
            $outcome = strtolower($e['outcome'] ?? '');
            if ($outcome === 'recognized') {
                $successfulCount++;
            } elseif ($outcome === 'unreadable') {
                $unreadableCount++;
            } elseif ($outcome === 'no plate detected') {
                $noPlateCount++;
            } else {
                $failedCount++;
            }

            $revStatus = strtolower($e['review_status'] ?? '');
            if ($revStatus === 'pending review' || $revStatus === 'flagged') {
                $reviewRequiredCount++;
            }
        }

        $successRate = $totalEvents > 0 ? round(($successfulCount / $totalEvents) * 100, 1) : 100;
        $cameraOnlineRate = $totalCameras > 0 ? round(($onlineCameras / $totalCameras) * 100, 1) : 100;

        return [
            'total_cameras' => $totalCameras,
            'online_cameras' => $onlineCameras,
            'offline_cameras' => $offlineCameras,
            'degraded_cameras' => $degradedCameras,
            'camera_online_rate' => $cameraOnlineRate,
            'total_events' => $totalEvents,
            'successful_count' => $successfulCount,
            'unreadable_count' => $unreadableCount,
            'no_plate_count' => $noPlateCount,
            'failed_count' => $failedCount,
            'review_required_count' => $reviewRequiredCount,
            'success_rate' => $successRate,
            'last_sync' => date('d M Y, H:i') . ' WIB',
        ];
    }

    /**
     * Get ANPR recognition events with filtering, search, and sorting.
     */
    public function getAnprEvents(string $facilityId = 'all', array $filters = []): array
    {
        $events = $this->loadStoredAnprEvents();

        if ($facilityId !== 'all') {
            $events = array_filter($events, fn($e) => ($e['facility_id'] ?? '') === $facilityId);
        }

        // Search query (plate number, event UUID, camera code, gate code)
        $query = trim(strtolower($filters['q'] ?? ''));
        if ($query !== '') {
            $cleanQ = preg_replace('/[^a-z0-9]/', '', $query);
            $events = array_filter($events, function ($e) use ($query, $cleanQ) {
                $plate = strtolower($e['recognized_plate'] ?? '');
                $cleanPlate = preg_replace('/[^a-z0-9]/', '', $plate);

                return str_contains($plate, $query)
                    || ($cleanQ !== '' && str_contains($cleanPlate, $cleanQ))
                    || str_contains(strtolower($e['event_uuid'] ?? ''), $query)
                    || str_contains(strtolower($e['camera_code'] ?? ''), $query)
                    || str_contains(strtolower($e['gate_code'] ?? ''), $query)
                    || str_contains(strtolower($e['lane_name'] ?? ''), $query);
            });
        }

        // Camera Filter
        $camera = $filters['camera'] ?? 'all';
        if ($camera !== 'all' && $camera !== '') {
            $events = array_filter($events, fn($e) => ($e['camera_id'] ?? '') === $camera || ($e['camera_code'] ?? '') === $camera);
        }

        // Gate Filter
        $gate = $filters['gate'] ?? 'all';
        if ($gate !== 'all' && $gate !== '') {
            $events = array_filter($events, fn($e) => ($e['gate_id'] ?? '') === $gate || ($e['gate_code'] ?? '') === $gate);
        }

        // Direction Filter
        $dir = $filters['direction'] ?? 'all';
        if ($dir !== 'all' && $dir !== '') {
            $events = array_filter($events, fn($e) => strcasecmp($e['direction'] ?? '', $dir) === 0);
        }

        // Outcome Filter
        $outcome = $filters['outcome'] ?? 'all';
        if ($outcome !== 'all' && $outcome !== '') {
            $events = array_filter($events, fn($e) => strcasecmp($e['outcome'] ?? '', $outcome) === 0);
        }

        // Review Status Filter
        $reviewStatus = $filters['review_status'] ?? 'all';
        if ($reviewStatus !== 'all' && $reviewStatus !== '') {
            $events = array_filter($events, fn($e) => strcasecmp($e['review_status'] ?? '', $reviewStatus) === 0);
        }

        $events = array_values($events);

        // Sorting
        $sort = $filters['sort'] ?? 'timestamp_desc';
        usort($events, function ($a, $b) use ($sort) {
            switch ($sort) {
                case 'timestamp_asc':
                    return strcmp($a['timestamp'] ?? '', $b['timestamp'] ?? '');
                case 'plate_asc':
                    return strcasecmp($a['recognized_plate'] ?? 'ZZZ', $b['recognized_plate'] ?? 'ZZZ');
                case 'confidence_desc':
                    return ($b['confidence_score'] ?? 0) <=> ($a['confidence_score'] ?? 0);
                case 'confidence_asc':
                    return ($a['confidence_score'] ?? 0) <=> ($b['confidence_score'] ?? 0);
                case 'timestamp_desc':
                default:
                    return strcmp($b['timestamp'] ?? '', $a['timestamp'] ?? '');
            }
        });

        return $events;
    }

    /**
     * Get single ANPR event by ID.
     */
    public function getAnprEvent(string $id): ?array
    {
        $allEvents = $this->loadStoredAnprEvents();
        foreach ($allEvents as $event) {
            if ($event['id'] === $id) {
                return $event;
            }
        }

        return null;
    }

    /**
     * Perform an authoritative manual review or plate correction on an ANPR event.
     */
    public function reviewAnprEvent(string $id, array $reviewData, string $operator = 'Budi Santoso (Operations Lead)'): ?array
    {
        $allEvents = $this->loadStoredAnprEvents();
        $updated = null;

        foreach ($allEvents as $index => $e) {
            if ($e['id'] === $id) {
                // If plate is being corrected or confirmed
                if (!empty($reviewData['corrected_plate'])) {
                    $newPlate = strtoupper(trim($reviewData['corrected_plate']));
                    $allEvents[$index]['recognized_plate'] = $newPlate;
                    $allEvents[$index]['outcome'] = 'Recognized';
                    $allEvents[$index]['review_status'] = 'Manually Corrected';
                } elseif (!empty($reviewData['confirm_existing'])) {
                    $allEvents[$index]['review_status'] = 'Verified';
                } else {
                    $allEvents[$index]['review_status'] = $reviewData['review_status'] ?? 'Verified';
                }

                $allEvents[$index]['review_reason'] = trim($reviewData['review_reason'] ?? 'Manual operator verification');
                $allEvents[$index]['reviewed_by'] = $operator;
                $allEvents[$index]['reviewed_at'] = date('d M Y, H:i') . ' WIB';

                $updated = $allEvents[$index];
                break;
            }
        }

        if ($updated !== null) {
            $this->saveAnprEvents($allEvents);
        }

        return $updated;
    }

    // =========================================================================
    // PHASE 2, PAGE 27: VENDOR IOT DEVICES MONITORING & INVENTORY ENGINE
    // =========================================================================

    /**
     * Default hardware inventory of IoT devices across authorized facilities.
     */
    protected function getDefaultIotDevices(): array
    {
        return [
            // --- FACILITY 1: MALL XYZ JAKARTA ---
            [
                'id' => 'dev-xyz-ctr-01',
                'device_code' => 'DEV-CTR-XYZ-01',
                'name' => 'North Entry Barrier Controller PLC 01',
                'device_type' => 'barrier_controller',
                'device_type_label' => 'Barrier Controller',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'associated_entity' => 'Gate GATE-XYZ-IN-01',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Operating within normal thermal parameters (32°C)',
                'manufacturer' => 'Advantech',
                'model' => 'WISE-4050 Industrial IoT PLC',
                'serial_number' => 'SN-ADV-9021481',
                'ip_address' => '192.168.10.11',
                'mac_address' => '70:B3:D5:49:10:A1',
                'firmware_version' => 'v4.8.2-PRO',
                'protocol' => 'Modbus TCP / MQTT',
                'last_heartbeat' => 'Just now (4s ago)',
                'telemetry_data' => [
                    'temperature_c' => 32,
                    'cpu_load_pct' => 14,
                    'memory_usage_pct' => 38,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 14,
                    'power_source' => '24V DC Industrial PSU • 8.4W',
                    'uptime_days' => 48,
                ],
                'installed_date' => '2025-01-18',
            ],
            [
                'id' => 'dev-xyz-cam-01',
                'device_code' => 'DEV-CAM-XYZ-01',
                'name' => 'ANPR HD Optical Sensor 01 - North Portal',
                'device_type' => 'anpr_camera',
                'device_type_label' => 'ANPR Camera',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'associated_entity' => 'Gate GATE-XYZ-IN-01 • Camera CAM-XYZ-IN01',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Optical lens clean • Shutter exposure verified (1/1000s)',
                'manufacturer' => 'Hikvision',
                'model' => 'iDS-2CD7A46G0/P-IZHS DeepinView',
                'serial_number' => 'SN-HIK-8401928',
                'ip_address' => '192.168.10.101',
                'mac_address' => '70:B3:D5:44:A1:01',
                'firmware_version' => 'v5.7.12-AI',
                'protocol' => 'RTSP / H.265 / ONVIF',
                'last_heartbeat' => 'Just now (6s ago)',
                'telemetry_data' => [
                    'temperature_c' => 38,
                    'cpu_load_pct' => 44,
                    'memory_usage_pct' => 62,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 18,
                    'power_source' => 'PoE+ (IEEE 802.3at) • 16.5W',
                    'uptime_days' => 48,
                ],
                'installed_date' => '2025-01-15',
            ],
            [
                'id' => 'dev-xyz-loop-01',
                'device_code' => 'DEV-LOOP-XYZ-01',
                'name' => 'Dual Channel Vehicle Induction Loop 01',
                'device_type' => 'loop_detector',
                'device_type_label' => 'Loop Detector',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'associated_entity' => 'Gate GATE-XYZ-IN-01 • Approach & Safety',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Resonance frequency calibrated (48 kHz) • Normal sensitivity',
                'manufacturer' => 'Nedap',
                'model' => 'NV-800 Dual Channel Loop Hub',
                'serial_number' => 'SN-NDP-2094112',
                'ip_address' => '192.168.10.201',
                'mac_address' => '70:B3:D5:49:20:01',
                'firmware_version' => 'v2.1.0',
                'protocol' => 'Modbus RTU over TCP',
                'last_heartbeat' => 'Just now (8s ago)',
                'telemetry_data' => [
                    'temperature_c' => 29,
                    'cpu_load_pct' => 8,
                    'memory_usage_pct' => 24,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 12,
                    'power_source' => '12V DC • 3.2W',
                    'uptime_days' => 120,
                ],
                'installed_date' => '2025-01-18',
            ],
            [
                'id' => 'dev-xyz-beam-01',
                'device_code' => 'DEV-BEAM-XYZ-01',
                'name' => 'Optical Safety Infrared Curtain Sensor 01',
                'device_type' => 'safety_beam',
                'device_type_label' => 'Safety Beam',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'associated_entity' => 'Gate GATE-XYZ-IN-01 • Anti-Tailgating',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Emitter/Receiver optical axis perfectly aligned',
                'manufacturer' => 'Omron',
                'model' => 'E3Z-R81 Multi-Beam Curtain',
                'serial_number' => 'SN-OMR-7740192',
                'ip_address' => '192.168.10.211',
                'mac_address' => '70:B3:D5:49:21:01',
                'firmware_version' => 'v1.4.0',
                'protocol' => 'Digital I/O to Controller',
                'last_heartbeat' => 'Just now (10s ago)',
                'telemetry_data' => [
                    'temperature_c' => 28,
                    'cpu_load_pct' => 5,
                    'memory_usage_pct' => 18,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 10,
                    'power_source' => '24V DC • 2.5W',
                    'uptime_days' => 120,
                ],
                'installed_date' => '2025-01-18',
            ],
            [
                'id' => 'dev-xyz-vms-01',
                'device_code' => 'DEV-VMS-XYZ-01',
                'name' => 'Variable Message Guidance LED Display - Portal A',
                'device_type' => 'guidance_display',
                'device_type_label' => 'VMS LED Display',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'associated_entity' => 'North Portal Overhead Truss',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Matrix refresh rate 120Hz • Auto-dimming ambient sensor active',
                'manufacturer' => 'Hikvision',
                'model' => 'DS-TVL121 Full-Color VMS Hub',
                'serial_number' => 'SN-HIK-5510294',
                'ip_address' => '192.168.10.231',
                'mac_address' => '70:B3:D5:44:E1:01',
                'firmware_version' => 'v3.2.4',
                'protocol' => 'MQTT / TCP Socket',
                'last_heartbeat' => '12s ago',
                'telemetry_data' => [
                    'temperature_c' => 34,
                    'cpu_load_pct' => 18,
                    'memory_usage_pct' => 45,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 16,
                    'power_source' => '220V AC Mains • 45W',
                    'uptime_days' => 90,
                ],
                'installed_date' => '2025-01-20',
            ],
            [
                'id' => 'dev-xyz-aps-01',
                'device_code' => 'DEV-APS-XYZ-01',
                'name' => 'Automated Pay Station Kiosk 01 - Elevator Lobby B1',
                'device_type' => 'payment_kiosk',
                'device_type_label' => 'Payment Terminal',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'associated_entity' => 'Central Lift Lobby Zone',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'QRIS scanner & NFC contactless card reader OK • Receipt roll 84%',
                'manufacturer' => 'GRGBanking',
                'model' => 'H68N Cashless Automated Pay Station',
                'serial_number' => 'SN-GRG-9021102',
                'ip_address' => '192.168.10.241',
                'mac_address' => '70:B3:D5:49:F1:01',
                'firmware_version' => 'v6.1.0-PCI-PTS',
                'protocol' => 'HTTPS REST / WebSocket',
                'last_heartbeat' => 'Just now (3s ago)',
                'telemetry_data' => [
                    'temperature_c' => 31,
                    'cpu_load_pct' => 22,
                    'memory_usage_pct' => 54,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 15,
                    'power_source' => 'UPS 220V AC Online • 65W',
                    'uptime_days' => 45,
                ],
                'installed_date' => '2025-02-01',
            ],
            [
                'id' => 'dev-xyz-snr-01',
                'device_code' => 'DEV-SNR-XYZ-01',
                'name' => 'Ultrasonic Space Occupancy Sensor Hub - Zone B1-A',
                'device_type' => 'slot_sensor',
                'device_type_label' => 'Slot Sensor Hub',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'associated_entity' => 'Slots B1-001 to B1-032 (32 nodes)',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => '32 of 32 nodes reporting telemetry • RS-485 bus impedance OK',
                'manufacturer' => 'SensorPark',
                'model' => 'SP-US32 Dual-Color LED Concentrator',
                'serial_number' => 'SN-SPK-3341029',
                'ip_address' => '192.168.10.51',
                'mac_address' => '70:B3:D5:49:51:01',
                'firmware_version' => 'v2.8.1',
                'protocol' => 'MQTT / RS-485 Modbus',
                'last_heartbeat' => '15s ago',
                'telemetry_data' => [
                    'temperature_c' => 29,
                    'cpu_load_pct' => 12,
                    'memory_usage_pct' => 31,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 20,
                    'power_source' => 'PoE (IEEE 802.3af) • 12W',
                    'uptime_days' => 60,
                ],
                'installed_date' => '2025-02-10',
            ],
            [
                'id' => 'dev-xyz-gw-01',
                'device_code' => 'DEV-GW-XYZ-01',
                'name' => 'Industrial IoT Local Edge Gateway Node',
                'device_type' => 'edge_gateway',
                'device_type_label' => 'Edge Gateway',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'associated_entity' => 'Main Server Rack M1 • Facility Master',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Primary fiber uplink 1000 Mbps • Cellular 5G fallback standby',
                'manufacturer' => 'Teltonika',
                'model' => 'RUT956 Industrial Cellular & Ethernet Gateway',
                'serial_number' => 'SN-TEL-8891042',
                'ip_address' => '192.168.10.1',
                'mac_address' => '70:B3:D5:49:01:01',
                'firmware_version' => 'v7.05.2-RutOS',
                'protocol' => 'MQTT Broker / OpenVPN / HTTPS',
                'last_heartbeat' => 'Just now (1s ago)',
                'telemetry_data' => [
                    'temperature_c' => 36,
                    'cpu_load_pct' => 28,
                    'memory_usage_pct' => 49,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 8,
                    'power_source' => 'Dual Redundant 24V DC PSU • 15W',
                    'uptime_days' => 180,
                ],
                'installed_date' => '2025-01-10',
            ],
            [
                'id' => 'dev-xyz-ctr-03',
                'device_code' => 'DEV-CTR-XYZ-03',
                'name' => 'South Exit Barrier Controller PLC 01',
                'device_type' => 'barrier_controller',
                'device_type_label' => 'Barrier Controller',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'associated_entity' => 'Gate GATE-XYZ-OUT-01',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Controller logic cycle time 12ms • All interlocks closed',
                'manufacturer' => 'Advantech',
                'model' => 'WISE-4050 Industrial IoT PLC',
                'serial_number' => 'SN-ADV-9021483',
                'ip_address' => '192.168.10.13',
                'mac_address' => '70:B3:D5:49:10:A3',
                'firmware_version' => 'v4.8.2-PRO',
                'protocol' => 'Modbus TCP / MQTT',
                'last_heartbeat' => 'Just now (5s ago)',
                'telemetry_data' => [
                    'temperature_c' => 33,
                    'cpu_load_pct' => 15,
                    'memory_usage_pct' => 39,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 15,
                    'power_source' => '24V DC Industrial PSU • 8.4W',
                    'uptime_days' => 48,
                ],
                'installed_date' => '2025-01-18',
            ],

            // --- FACILITY 2: GRAND INDONESIA WEST MALL ---
            [
                'id' => 'dev-gi-ctr-01',
                'device_code' => 'DEV-CTR-GI-01',
                'name' => 'West Main Inbound Barrier PLC Controller 01',
                'device_type' => 'barrier_controller',
                'device_type_label' => 'Barrier Controller',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b1',
                'area_name' => 'Basement 1 - Premium & Valet Zone',
                'associated_entity' => 'Gate GATE-GI-IN-01',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Servo motor brake response 0.9s • Optimal torque curve',
                'manufacturer' => 'Advantech',
                'model' => 'WISE-4050 Industrial IoT PLC',
                'serial_number' => 'SN-ADV-9022011',
                'ip_address' => '192.168.20.11',
                'mac_address' => '70:B3:D5:49:20:11',
                'firmware_version' => 'v4.8.2-PRO',
                'protocol' => 'Modbus TCP / MQTT',
                'last_heartbeat' => 'Just now (7s ago)',
                'telemetry_data' => [
                    'temperature_c' => 34,
                    'cpu_load_pct' => 16,
                    'memory_usage_pct' => 41,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 18,
                    'power_source' => '24V DC Industrial PSU • 9.0W',
                    'uptime_days' => 64,
                ],
                'installed_date' => '2025-03-22',
            ],
            [
                'id' => 'dev-gi-cam-01',
                'device_code' => 'DEV-CAM-GI-01',
                'name' => 'Inbound ANPR AI Camera 01 - West Portal',
                'device_type' => 'anpr_camera',
                'device_type_label' => 'ANPR Camera',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b1',
                'area_name' => 'Basement 1 - Premium & Valet Zone',
                'associated_entity' => 'Gate GATE-GI-IN-01 • Camera CAM-GI-IN01',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Recognition accuracy 99.1% • Optical alignment verified',
                'manufacturer' => 'Dahua',
                'model' => 'DHI-ITC413-PW4D-IZ3 Traffic Pro',
                'serial_number' => 'SN-DAH-4410928',
                'ip_address' => '192.168.20.101',
                'mac_address' => '70:B3:D5:44:B1:01',
                'firmware_version' => 'v3.100.0001',
                'protocol' => 'RTSP / H.265 / ONVIF',
                'last_heartbeat' => 'Just now (5s ago)',
                'telemetry_data' => [
                    'temperature_c' => 37,
                    'cpu_load_pct' => 42,
                    'memory_usage_pct' => 58,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 20,
                    'power_source' => 'PoE+ (IEEE 802.3at) • 17.0W',
                    'uptime_days' => 64,
                ],
                'installed_date' => '2025-03-20',
            ],
            [
                'id' => 'dev-gi-cam-02',
                'device_code' => 'DEV-CAM-GI-02',
                'name' => 'Inbound ANPR AI Camera 02 - West VIP Lane',
                'device_type' => 'anpr_camera',
                'device_type_label' => 'ANPR Camera',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b1',
                'area_name' => 'Basement 1 - Premium & Valet Zone',
                'associated_entity' => 'Gate GATE-GI-IN-02 • Camera CAM-GI-IN02',
                'connectivity' => 'degraded',
                'health_status' => 'Warning',
                'health_note' => 'High network jitter (240ms) • Optical lens inspection recommended',
                'manufacturer' => 'Dahua',
                'model' => 'DHI-ITC413-PW4D-IZ3 Traffic Pro',
                'serial_number' => 'SN-DAH-4410929',
                'ip_address' => '192.168.20.102',
                'mac_address' => '70:B3:D5:44:B1:02',
                'firmware_version' => 'v3.100.0001',
                'protocol' => 'RTSP / H.265 / ONVIF',
                'last_heartbeat' => '2 mins ago',
                'telemetry_data' => [
                    'temperature_c' => 42,
                    'cpu_load_pct' => 68,
                    'memory_usage_pct' => 74,
                    'packet_loss_pct' => 4.2,
                    'ping_ms' => 240,
                    'power_source' => 'PoE+ (IEEE 802.3at) • 18.2W',
                    'uptime_days' => 14,
                ],
                'installed_date' => '2025-03-20',
            ],
            [
                'id' => 'dev-gi-beam-03',
                'device_code' => 'DEV-BEAM-GI-03',
                'name' => 'Optical Safety Curtain Beam 03 - Service Exit',
                'device_type' => 'safety_beam',
                'device_type_label' => 'Safety Beam',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-p1',
                'area_name' => 'Level P1 - Valet Hub',
                'associated_entity' => 'Gate GATE-GI-OUT-03',
                'connectivity' => 'offline',
                'health_status' => 'Fault',
                'health_note' => 'Physical beam obstruction or misalignment • Arm safety interlock engaged',
                'manufacturer' => 'Omron',
                'model' => 'E3Z-R81 Multi-Beam Curtain',
                'serial_number' => 'SN-OMR-7740201',
                'ip_address' => '192.168.20.213',
                'mac_address' => '70:B3:D5:49:21:03',
                'firmware_version' => 'v1.4.0',
                'protocol' => 'Digital I/O',
                'last_heartbeat' => '3 hours ago',
                'telemetry_data' => [
                    'temperature_c' => 26,
                    'cpu_load_pct' => 0,
                    'memory_usage_pct' => 0,
                    'packet_loss_pct' => 100.0,
                    'ping_ms' => 0,
                    'power_source' => '24V DC • Disconnected',
                    'uptime_days' => 0,
                ],
                'installed_date' => '2025-03-25',
            ],
            [
                'id' => 'dev-gi-aps-01',
                'device_code' => 'DEV-APS-GI-01',
                'name' => 'Cashless Paystation Kiosk - B2 Central Atrium',
                'device_type' => 'payment_kiosk',
                'device_type_label' => 'Payment Terminal',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b2',
                'area_name' => 'Basement 2 - General Parking',
                'associated_entity' => 'Central Escalator Hub B2',
                'connectivity' => 'online',
                'health_status' => 'Maintenance',
                'health_note' => 'Routine hardware servicing: Receipt printer paper replacement underway',
                'manufacturer' => 'GRGBanking',
                'model' => 'H68N Cashless Automated Pay Station',
                'serial_number' => 'SN-GRG-9022041',
                'ip_address' => '192.168.20.241',
                'mac_address' => '70:B3:D5:49:F2:01',
                'firmware_version' => 'v6.1.0-PCI-PTS',
                'protocol' => 'HTTPS REST / WebSocket',
                'last_heartbeat' => 'Just now (8s ago)',
                'telemetry_data' => [
                    'temperature_c' => 30,
                    'cpu_load_pct' => 10,
                    'memory_usage_pct' => 48,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 14,
                    'power_source' => 'UPS 220V AC Online • 60W',
                    'uptime_days' => 30,
                ],
                'installed_date' => '2025-03-25',
            ],
            [
                'id' => 'dev-gi-vms-01',
                'device_code' => 'DEV-VMS-GI-01',
                'name' => 'Overhead VMS Guidance Display - Ramp B1/B2',
                'device_type' => 'guidance_display',
                'device_type_label' => 'VMS LED Display',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b1',
                'area_name' => 'Basement 1 - Premium & Valet Zone',
                'associated_entity' => 'Main Descending Ramp Junction',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Dynamic space availability feed sync OK (<1s refresh)',
                'manufacturer' => 'Hikvision',
                'model' => 'DS-TVL121 Full-Color VMS Hub',
                'serial_number' => 'SN-HIK-5510444',
                'ip_address' => '192.168.20.231',
                'mac_address' => '70:B3:D5:44:E2:01',
                'firmware_version' => 'v3.2.4',
                'protocol' => 'MQTT / TCP Socket',
                'last_heartbeat' => '18s ago',
                'telemetry_data' => [
                    'temperature_c' => 35,
                    'cpu_load_pct' => 19,
                    'memory_usage_pct' => 46,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 18,
                    'power_source' => '220V AC Mains • 48W',
                    'uptime_days' => 64,
                ],
                'installed_date' => '2025-03-22',
            ],
            [
                'id' => 'dev-gi-gw-01',
                'device_code' => 'DEV-GW-GI-01',
                'name' => 'West Wing Central IoT Edge Gateway Hub',
                'device_type' => 'edge_gateway',
                'device_type_label' => 'Edge Gateway',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b1',
                'area_name' => 'Basement 1 - Premium & Valet Zone',
                'associated_entity' => 'Tech Room West • Network Core',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Dual WAN failover active • 12 downstream Modbus nodes connected',
                'manufacturer' => 'Teltonika',
                'model' => 'RUT956 Industrial Cellular & Ethernet Gateway',
                'serial_number' => 'SN-TEL-8892110',
                'ip_address' => '192.168.20.1',
                'mac_address' => '70:B3:D5:49:02:01',
                'firmware_version' => 'v7.05.2-RutOS',
                'protocol' => 'MQTT Broker / OpenVPN / HTTPS',
                'last_heartbeat' => 'Just now (2s ago)',
                'telemetry_data' => [
                    'temperature_c' => 37,
                    'cpu_load_pct' => 31,
                    'memory_usage_pct' => 52,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 10,
                    'power_source' => 'Dual 24V DC PSU • 16W',
                    'uptime_days' => 150,
                ],
                'installed_date' => '2025-03-15',
            ],

            // --- FACILITY 3: CENTRAL PARK MALL ---
            [
                'id' => 'dev-cp-ctr-01',
                'device_code' => 'DEV-CTR-CP-01',
                'name' => 'East Inbound Barrier PLC Controller 01',
                'device_type' => 'barrier_controller',
                'device_type_label' => 'Barrier Controller',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-b1',
                'area_name' => 'Basement 1 - Podomoro Area',
                'associated_entity' => 'Gate GATE-CP-IN-01',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Controller PLC operational • High-speed servo cycle 1.1s',
                'manufacturer' => 'Advantech',
                'model' => 'WISE-4050 Industrial IoT PLC',
                'serial_number' => 'SN-ADV-9023011',
                'ip_address' => '192.168.30.11',
                'mac_address' => '70:B3:D5:49:30:11',
                'firmware_version' => 'v4.8.2-PRO',
                'protocol' => 'Modbus TCP / MQTT',
                'last_heartbeat' => 'Just now (4s ago)',
                'telemetry_data' => [
                    'temperature_c' => 31,
                    'cpu_load_pct' => 13,
                    'memory_usage_pct' => 37,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 16,
                    'power_source' => '24V DC Industrial PSU • 8.2W',
                    'uptime_days' => 92,
                ],
                'installed_date' => '2025-06-12',
            ],
            [
                'id' => 'dev-cp-cam-01',
                'device_code' => 'DEV-CAM-CP-01',
                'name' => 'East Inbound ANPR Camera 01 - Outer Portal',
                'device_type' => 'anpr_camera',
                'device_type_label' => 'ANPR Camera',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-b1',
                'area_name' => 'Basement 1 - Podomoro Area',
                'associated_entity' => 'Gate GATE-CP-IN-01 • Camera CAM-CP-IN01',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Optical lens aligned • Infrared night-vision LEDs operational',
                'manufacturer' => 'Bosch',
                'model' => 'DINION IP 7000 LPR HD',
                'serial_number' => 'SN-BOS-1902481',
                'ip_address' => '192.168.30.101',
                'mac_address' => '70:B3:D5:44:C1:01',
                'firmware_version' => 'v7.82.0019',
                'protocol' => 'RTSP / H.264 / ONVIF',
                'last_heartbeat' => 'Just now (8s ago)',
                'telemetry_data' => [
                    'temperature_c' => 35,
                    'cpu_load_pct' => 36,
                    'memory_usage_pct' => 54,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 19,
                    'power_source' => 'PoE (IEEE 802.3af) • 13.8W',
                    'uptime_days' => 92,
                ],
                'installed_date' => '2025-06-10',
            ],
            [
                'id' => 'dev-cp-vms-01',
                'device_code' => 'DEV-VMS-CP-01',
                'name' => 'Outer Portal VMS Space Availability Display',
                'device_type' => 'guidance_display',
                'device_type_label' => 'VMS LED Display',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-b1',
                'area_name' => 'Basement 1 - Podomoro Area',
                'associated_entity' => 'Outer Ring Road Inbound Portal',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Display modules 100% operational • Sensor telemetry synced',
                'manufacturer' => 'Hikvision',
                'model' => 'DS-TVL121 Full-Color VMS Hub',
                'serial_number' => 'SN-HIK-5510611',
                'ip_address' => '192.168.30.231',
                'mac_address' => '70:B3:D5:44:E3:01',
                'firmware_version' => 'v3.2.4',
                'protocol' => 'MQTT / TCP Socket',
                'last_heartbeat' => '22s ago',
                'telemetry_data' => [
                    'temperature_c' => 33,
                    'cpu_load_pct' => 17,
                    'memory_usage_pct' => 44,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 17,
                    'power_source' => '220V AC Mains • 42W',
                    'uptime_days' => 92,
                ],
                'installed_date' => '2025-06-15',
            ],
            [
                'id' => 'dev-cp-gw-01',
                'device_code' => 'DEV-GW-CP-01',
                'name' => 'Central Park Security Post IoT Edge Node',
                'device_type' => 'edge_gateway',
                'device_type_label' => 'Edge Gateway',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-b1',
                'area_name' => 'Basement 1 - Podomoro Area',
                'associated_entity' => 'Main Security Control Command Post',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Edge message broker active • 0 dropped packets past 24h',
                'manufacturer' => 'Teltonika',
                'model' => 'RUT956 Industrial Cellular & Ethernet Gateway',
                'serial_number' => 'SN-TEL-8893019',
                'ip_address' => '192.168.30.1',
                'mac_address' => '70:B3:D5:49:03:01',
                'firmware_version' => 'v7.05.2-RutOS',
                'protocol' => 'MQTT Broker / OpenVPN / HTTPS',
                'last_heartbeat' => 'Just now (3s ago)',
                'telemetry_data' => [
                    'temperature_c' => 35,
                    'cpu_load_pct' => 24,
                    'memory_usage_pct' => 48,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 11,
                    'power_source' => '24V DC PSU • 14W',
                    'uptime_days' => 110,
                ],
                'installed_date' => '2025-06-10',
            ],
            [
                'id' => 'dev-cp-snr-01',
                'device_code' => 'DEV-SNR-CP-01',
                'name' => 'Outdoor Zone Parking Magnetic Sensor Concentrator',
                'device_type' => 'slot_sensor',
                'device_type_label' => 'Slot Sensor Hub',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-b1',
                'area_name' => 'Basement 1 - Podomoro Area',
                'associated_entity' => 'Outdoor Surface Parking Bays (24 slots)',
                'connectivity' => 'online',
                'health_status' => 'Healthy',
                'health_note' => 'Wireless LoRaWAN gateway receiver: RSSI -68 dBm (Strong)',
                'manufacturer' => 'SensorPark',
                'model' => 'SP-MAG24 LoRa Surface Concentrator',
                'serial_number' => 'SN-SPK-3342011',
                'ip_address' => '192.168.30.51',
                'mac_address' => '70:B3:D5:49:53:01',
                'firmware_version' => 'v2.6.0',
                'protocol' => 'LoRaWAN / MQTT',
                'last_heartbeat' => '35s ago',
                'telemetry_data' => [
                    'temperature_c' => 32,
                    'cpu_load_pct' => 11,
                    'memory_usage_pct' => 33,
                    'packet_loss_pct' => 0.0,
                    'ping_ms' => 22,
                    'power_source' => 'Solar Battery + PoE Backup • 9W',
                    'uptime_days' => 75,
                ],
                'installed_date' => '2025-06-20',
            ],
        ];
    }

    /**
     * Default hardware diagnostic activity logs.
     */
    protected function getDefaultIotLogs(): array
    {
        return [
            [
                'id' => 'log-iot-001',
                'device_id' => 'dev-xyz-ctr-01',
                'device_code' => 'DEV-CTR-XYZ-01',
                'facility_id' => 'fac-mall-xyz',
                'event_type' => 'heartbeat',
                'severity' => 'info',
                'message' => 'Keepalive heartbeat acknowledged via Modbus TCP (14ms response)',
                'timestamp' => '11 Oct 2026, 16:50:12 WIB',
            ],
            [
                'id' => 'log-iot-002',
                'device_id' => 'dev-gi-cam-02',
                'device_code' => 'DEV-CAM-GI-02',
                'facility_id' => 'fac-gi-west',
                'event_type' => 'latency_warning',
                'severity' => 'warning',
                'message' => 'Network jitter threshold exceeded (>200ms) on RTSP video stream',
                'timestamp' => '11 Oct 2026, 16:48:33 WIB',
            ],
            [
                'id' => 'log-iot-003',
                'device_id' => 'dev-gi-beam-03',
                'device_code' => 'DEV-BEAM-GI-03',
                'facility_id' => 'fac-gi-west',
                'event_type' => 'sensor_fault',
                'severity' => 'error',
                'message' => 'Optical safety curtain beam obstructed continuously >180s • Arm safety interlock triggered',
                'timestamp' => '11 Oct 2026, 13:42:10 WIB',
            ],
            [
                'id' => 'log-iot-004',
                'device_id' => 'dev-gi-aps-01',
                'device_code' => 'DEV-APS-GI-01',
                'facility_id' => 'fac-gi-west',
                'event_type' => 'maintenance_mode',
                'severity' => 'warning',
                'message' => 'Device status switched to Maintenance Mode by Operator (Budi Santoso)',
                'timestamp' => '11 Oct 2026, 15:30:00 WIB',
            ],
            [
                'id' => 'log-iot-005',
                'device_id' => 'dev-xyz-aps-01',
                'device_code' => 'DEV-APS-XYZ-01',
                'facility_id' => 'fac-mall-xyz',
                'event_type' => 'payment_telemetry',
                'severity' => 'info',
                'message' => 'Automated contactless QRIS transaction validated successfully',
                'timestamp' => '11 Oct 2026, 16:44:21 WIB',
            ],
            [
                'id' => 'log-iot-006',
                'device_id' => 'dev-cp-gw-01',
                'device_code' => 'DEV-GW-CP-01',
                'facility_id' => 'fac-cp-jkt',
                'event_type' => 'gateway_sync',
                'severity' => 'info',
                'message' => 'MQTT broker queue processed 1,420 device packets • 0 dropped',
                'timestamp' => '11 Oct 2026, 16:40:00 WIB',
            ],
        ];
    }

    /**
     * Load IoT devices from cache or initialize defaults.
     */
    protected function loadStoredIotDevices(): array
    {
        return Cache::get(self::IOT_DEVICES_CACHE_KEY, function () {
            $default = $this->getDefaultIotDevices();
            Cache::put(self::IOT_DEVICES_CACHE_KEY, $default, now()->addDays(30));
            return $default;
        });
    }

    /**
     * Save IoT devices to cache.
     */
    protected function saveIotDevices(array $devices): void
    {
        Cache::put(self::IOT_DEVICES_CACHE_KEY, $devices, now()->addDays(30));
    }

    /**
     * Load IoT logs from cache or initialize defaults.
     */
    protected function loadStoredIotLogs(): array
    {
        return Cache::get(self::IOT_LOGS_CACHE_KEY, function () {
            $default = $this->getDefaultIotLogs();
            Cache::put(self::IOT_LOGS_CACHE_KEY, $default, now()->addDays(30));
            return $default;
        });
    }

    /**
     * Save IoT logs to cache.
     */
    protected function saveIotLogs(array $logs): void
    {
        Cache::put(self::IOT_LOGS_CACHE_KEY, $logs, now()->addDays(30));
    }

    /**
     * Query and filter IoT devices for Page 27.
     */
    public function getIotDevices(string $facilityId = 'all', array $filters = []): array
    {
        $devices = $this->loadStoredIotDevices();

        // Facility Scope
        if ($facilityId !== 'all' && $facilityId !== '') {
            $devices = array_filter($devices, fn($d) => ($d['facility_id'] ?? '') === $facilityId);
        }

        // Search Query
        $q = trim($filters['q'] ?? '');
        if ($q !== '') {
            $devices = array_filter($devices, function ($d) use ($q) {
                return stripos($d['name'] ?? '', $q) !== false
                    || stripos($d['device_code'] ?? '', $q) !== false
                    || stripos($d['model'] ?? '', $q) !== false
                    || stripos($d['manufacturer'] ?? '', $q) !== false
                    || stripos($d['ip_address'] ?? '', $q) !== false
                    || stripos($d['associated_entity'] ?? '', $q) !== false;
            });
        }

        // Area Filter
        $area = $filters['area'] ?? 'all';
        if ($area !== 'all' && $area !== '') {
            $devices = array_filter($devices, fn($d) => ($d['area_id'] ?? '') === $area);
        }

        // Device Type Filter
        $type = $filters['device_type'] ?? 'all';
        if ($type !== 'all' && $type !== '') {
            $devices = array_filter($devices, fn($d) => strcasecmp($d['device_type'] ?? '', $type) === 0);
        }

        // Connectivity Filter
        $conn = $filters['connectivity'] ?? 'all';
        if ($conn !== 'all' && $conn !== '') {
            $devices = array_filter($devices, fn($d) => strcasecmp($d['connectivity'] ?? '', $conn) === 0);
        }

        // Health Status Filter
        $health = $filters['health_status'] ?? 'all';
        if ($health !== 'all' && $health !== '') {
            $devices = array_filter($devices, fn($d) => strcasecmp($d['health_status'] ?? '', $health) === 0);
        }

        $devices = array_values($devices);

        // Sorting
        $sort = $filters['sort'] ?? 'code_asc';
        usort($devices, function ($a, $b) use ($sort) {
            switch ($sort) {
                case 'code_desc':
                    return strcmp($b['device_code'] ?? '', $a['device_code'] ?? '');
                case 'name_asc':
                    return strcasecmp($a['name'] ?? '', $b['name'] ?? '');
                case 'type_asc':
                    return strcasecmp($a['device_type_label'] ?? '', $b['device_type_label'] ?? '');
                case 'connectivity_asc':
                    return strcmp($a['connectivity'] ?? '', $b['connectivity'] ?? '');
                case 'health_asc':
                    return strcmp($a['health_status'] ?? '', $b['health_status'] ?? '');
                case 'code_asc':
                default:
                    return strcmp($a['device_code'] ?? '', $b['device_code'] ?? '');
            }
        });

        return $devices;
    }

    /**
     * Get single IoT device by ID.
     */
    public function getIotDevice(string $id): ?array
    {
        $all = $this->loadStoredIotDevices();
        foreach ($all as $d) {
            if ($d['id'] === $id) {
                return $d;
            }
        }
        return null;
    }

    /**
     * Compute operational summary metrics for IoT devices.
     */
    public function getIotSummaryMetrics(string $facilityId = 'all'): array
    {
        $devices = $this->loadStoredIotDevices();
        if ($facilityId !== 'all') {
            $devices = array_filter($devices, fn($d) => ($d['facility_id'] ?? '') === $facilityId);
        }

        $total = count($devices);
        $online = 0;
        $offline = 0;
        $degraded = 0;
        $healthy = 0;
        $warning = 0;
        $fault = 0;
        $maintenance = 0;

        foreach ($devices as $d) {
            $c = strtolower($d['connectivity'] ?? '');
            if ($c === 'online') $online++;
            elseif ($c === 'degraded') $degraded++;
            else $offline++;

            $h = strtolower($d['health_status'] ?? '');
            if ($h === 'healthy') $healthy++;
            elseif ($h === 'warning') $warning++;
            elseif ($h === 'fault') $fault++;
            elseif ($h === 'maintenance') $maintenance++;
        }

        $healthRate = $total > 0 ? round(($healthy / $total) * 100, 1) : 100.0;

        return [
            'total_devices' => $total,
            'online_count' => $online,
            'offline_count' => $offline,
            'degraded_count' => $degraded,
            'healthy_count' => $healthy,
            'warning_count' => $warning,
            'fault_count' => $fault,
            'maintenance_count' => $maintenance,
            'health_rate' => $healthRate,
            'last_sync' => date('d M Y, H:i') . ' WIB',
        ];
    }

    /**
     * Register a new IoT device in the vendor fleet.
     */
    public function createIotDevice(array $data): array
    {
        $devices = $this->loadStoredIotDevices();
        $newId = 'dev-' . strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $data['device_code'])) . '-' . time();

        $typeLabels = [
            'barrier_controller' => 'Barrier Controller',
            'anpr_camera' => 'ANPR Camera',
            'slot_sensor' => 'Slot Sensor Hub',
            'guidance_display' => 'VMS LED Display',
            'payment_kiosk' => 'Payment Terminal',
            'edge_gateway' => 'Edge Gateway',
            'loop_detector' => 'Loop Detector',
            'safety_beam' => 'Safety Beam',
        ];

        // Resolve facility name
        $facilities = $this->getFacilities();
        $facilityName = 'Authorized Facility';
        foreach ($facilities as $fac) {
            if ($fac['id'] === $data['facility_id']) {
                $facilityName = $fac['name'];
                break;
            }
        }

        // Resolve area name
        $areas = $this->getParkingAreas($data['facility_id']);
        $areaName = 'General Parking Zone';
        if (!empty($data['area_id'])) {
            foreach ($areas as $ar) {
                if ($ar['id'] === $data['area_id']) {
                    $areaName = $ar['name'];
                    break;
                }
            }
        }

        $newDevice = [
            'id' => $newId,
            'device_code' => strtoupper(trim($data['device_code'])),
            'name' => trim($data['name']),
            'device_type' => $data['device_type'],
            'device_type_label' => $typeLabels[$data['device_type']] ?? ucwords(str_replace('_', ' ', $data['device_type'])),
            'facility_id' => $data['facility_id'],
            'facility_name' => $facilityName,
            'area_id' => $data['area_id'] ?? '',
            'area_name' => $areaName,
            'associated_entity' => trim($data['associated_entity'] ?? 'Standard Field Placement'),
            'connectivity' => 'online',
            'health_status' => 'Healthy',
            'health_note' => 'Provisioned and telemetry sync verified',
            'manufacturer' => trim($data['manufacturer'] ?? 'Generic Industrial'),
            'model' => trim($data['model'] ?? 'Standard IoT Terminal'),
            'serial_number' => trim($data['serial_number'] ?? ('SN-' . strtoupper(substr(md5(uniqid()), 0, 8)))),
            'ip_address' => trim($data['ip_address'] ?? '192.168.10.250'),
            'mac_address' => trim($data['mac_address'] ?? '70:B3:D5:49:00:FF'),
            'firmware_version' => trim($data['firmware_version'] ?? 'v1.0.0-PRO'),
            'protocol' => trim($data['protocol'] ?? 'MQTT / TLS'),
            'last_heartbeat' => 'Just now',
            'telemetry_data' => [
                'temperature_c' => 30,
                'cpu_load_pct' => 10,
                'memory_usage_pct' => 25,
                'packet_loss_pct' => 0.0,
                'ping_ms' => 12,
                'power_source' => 'PoE / DC PSU',
                'uptime_days' => 1,
            ],
            'installed_date' => date('Y-m-d'),
        ];

        array_unshift($devices, $newDevice);
        $this->saveIotDevices($devices);

        // Record log
        $logs = $this->loadStoredIotLogs();
        array_unshift($logs, [
            'id' => 'log-iot-' . time(),
            'device_id' => $newId,
            'device_code' => $newDevice['device_code'],
            'facility_id' => $newDevice['facility_id'],
            'event_type' => 'device_provisioned',
            'severity' => 'info',
            'message' => "Device {$newDevice['device_code']} successfully registered in fleet inventory",
            'timestamp' => date('d M Y, H:i:s') . ' WIB',
        ]);
        $this->saveIotLogs($logs);

        return $newDevice;
    }

    /**
     * Update an existing IoT device.
     */
    public function updateIotDevice(string $id, array $data): ?array
    {
        $devices = $this->loadStoredIotDevices();
        $updated = null;

        foreach ($devices as $index => $d) {
            if ($d['id'] === $id) {
                if (isset($data['name'])) $devices[$index]['name'] = trim($data['name']);
                if (isset($data['model'])) $devices[$index]['model'] = trim($data['model']);
                if (isset($data['manufacturer'])) $devices[$index]['manufacturer'] = trim($data['manufacturer']);
                if (isset($data['ip_address'])) $devices[$index]['ip_address'] = trim($data['ip_address']);
                if (isset($data['mac_address'])) $devices[$index]['mac_address'] = trim($data['mac_address']);
                if (isset($data['firmware_version'])) $devices[$index]['firmware_version'] = trim($data['firmware_version']);
                if (isset($data['protocol'])) $devices[$index]['protocol'] = trim($data['protocol']);
                if (isset($data['associated_entity'])) $devices[$index]['associated_entity'] = trim($data['associated_entity']);
                if (isset($data['health_status'])) $devices[$index]['health_status'] = $data['health_status'];
                if (isset($data['health_note'])) $devices[$index]['health_note'] = trim($data['health_note']);

                $updated = $devices[$index];
                break;
            }
        }

        if ($updated) {
            $this->saveIotDevices($devices);
        }

        return $updated;
    }

    /**
     * Toggle maintenance or operational state of an IoT device.
     */
    public function toggleIotDeviceStatus(string $id, string $status): ?array
    {
        $devices = $this->loadStoredIotDevices();
        $updated = null;

        foreach ($devices as $index => $d) {
            if ($d['id'] === $id) {
                $devices[$index]['health_status'] = $status;
                if ($status === 'Maintenance') {
                    $devices[$index]['health_note'] = 'Device placed in maintenance mode for calibration/servicing';
                } elseif ($status === 'Healthy') {
                    $devices[$index]['health_note'] = 'Device restored to active operational status';
                }

                $updated = $devices[$index];
                break;
            }
        }

        if ($updated) {
            $this->saveIotDevices($devices);

            // Record log
            $logs = $this->loadStoredIotLogs();
            array_unshift($logs, [
                'id' => 'log-iot-' . time(),
                'device_id' => $id,
                'device_code' => $updated['device_code'],
                'facility_id' => $updated['facility_id'],
                'event_type' => 'status_change',
                'severity' => $status === 'Maintenance' ? 'warning' : 'info',
                'message' => "Operational status changed to {$status} by operator",
                'timestamp' => date('d M Y, H:i:s') . ' WIB',
            ]);
            $this->saveIotLogs($logs);
        }

        return $updated;
    }

    /**
     * Decommission / remove an IoT device from fleet.
     */
    public function deleteIotDevice(string $id): array
    {
        $devices = $this->loadStoredIotDevices();
        $target = null;
        $filtered = [];

        foreach ($devices as $d) {
            if ($d['id'] === $id) {
                $target = $d;
            } else {
                $filtered[] = $d;
            }
        }

        if (!$target) {
            return ['success' => false, 'message' => 'IoT Device record not found.'];
        }

        $this->saveIotDevices($filtered);

        // Record log
        $logs = $this->loadStoredIotLogs();
        array_unshift($logs, [
            'id' => 'log-iot-' . time(),
            'device_id' => $id,
            'device_code' => $target['device_code'],
            'facility_id' => $target['facility_id'],
            'event_type' => 'device_decommissioned',
            'severity' => 'warning',
            'message' => "Device {$target['device_code']} was decommissioned from the fleet",
            'timestamp' => date('d M Y, H:i:s') . ' WIB',
        ]);
        $this->saveIotLogs($logs);

        return ['success' => true, 'message' => "IoT Device '{$target['device_code']}' decommissioned successfully."];
    }

    /**
     * Query recent diagnostic event logs for IoT devices.
     */
    public function getIotDeviceLogs(?string $deviceId = null, ?string $facilityId = null, int $limit = 20): array
    {
        $logs = $this->loadStoredIotLogs();

        if ($deviceId) {
            $logs = array_filter($logs, fn($l) => ($l['device_id'] ?? '') === $deviceId);
        }

        if ($facilityId && $facilityId !== 'all') {
            $logs = array_filter($logs, fn($l) => ($l['facility_id'] ?? '') === $facilityId);
        }

        return array_slice(array_values($logs), 0, $limit);
    }

    /**
     * Perform an on-demand ping & diagnostic probe on an IoT device.
     */
    /* =========================================================================
     * PHASE 2, PAGE 28: VENDOR PARKING SESSIONS MANAGEMENT
     * ========================================================================= */

    /**
     * Default list of parking sessions across authorized facilities.
     */
    protected function getDefaultParkingSessions(): array
    {
        return [
            // --- 1. ACTIVE SESSIONS (TODAY, PARKED INSIDE) ---
            [
                'id' => 'ses-20261011-0088',
                'session_code' => 'SES-20261011-0088',
                'vehicle_plate' => 'B 1234 XYZ',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Toyota Fortuner 2.8 GR Sport',
                'vehicle_color' => 'Attitude Black Mica',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'slot_code' => 'B1-C-01',
                'entry_time' => '11 Oct 2026, 14:15 WIB',
                'entry_time_raw' => '2026-10-11 14:15:00',
                'entry_gate_code' => 'GATE-XYZ-IN-01',
                'entry_gate_name' => 'North Inbound Gate 01',
                'entry_camera_code' => 'CAM-XYZ-IN01',
                'entry_anpr_confidence' => 99.4,
                'exit_time' => null,
                'exit_time_raw' => null,
                'exit_gate_code' => null,
                'exit_gate_name' => null,
                'exit_camera_code' => null,
                'exit_anpr_confidence' => null,
                'duration_minutes' => 105,
                'duration_formatted' => '1h 45m',
                'duration_type' => 'elapsed',
                'rate_hourly' => 5000,
                'base_fee' => 10000,
                'service_fee' => 0,
                'total_fee' => 10000,
                'formatted_fee' => 'Rp 10.000',
                'session_status' => 'active',
                'session_status_label' => 'Active (Parked)',
                'payment_status' => 'pending',
                'payment_status_label' => 'Pending (In Progress)',
                'payment_method' => 'NusaPark In-App Auto-Pay Linked',
                'payment_reference' => null,
                'paid_at' => null,
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'A*** W***',
                'driver_phone' => '+62 812-****-9812',
                'timeline' => [
                    ['time' => '14:15:02 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'CAM-XYZ-IN01 captured plate B 1234 XYZ (99.4% confidence)', 'status' => 'success'],
                    ['time' => '14:15:06 WIB', 'event' => 'Barrier Gate Raised', 'details' => 'GATE-XYZ-IN-01 controller triggered automatic boom lift', 'status' => 'success'],
                    ['time' => '14:17:30 WIB', 'event' => 'Slot Sensor Triggered', 'details' => 'Ultrasonic Sensor B1-C-01 reported vehicle stationary occupancy', 'status' => 'info'],
                ],
            ],
            [
                'id' => 'ses-20261011-0085',
                'session_code' => 'SES-20261011-0085',
                'vehicle_plate' => 'B 9012 EV',
                'vehicle_type' => 'EV',
                'vehicle_model' => 'Hyundai Ioniq 5 Signature Long Range',
                'vehicle_color' => 'Gravity Gold Matte',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b1',
                'area_name' => 'Basement 1 - EV Fast Hub',
                'slot_code' => 'GI-B1-05',
                'entry_time' => '11 Oct 2026, 13:30 WIB',
                'entry_time_raw' => '2026-10-11 13:30:00',
                'entry_gate_code' => 'GATE-GI-IN-01',
                'entry_gate_name' => 'Main Inbound West Gate 01',
                'entry_camera_code' => 'CAM-GI-IN01',
                'entry_anpr_confidence' => 99.8,
                'exit_time' => null,
                'exit_time_raw' => null,
                'exit_gate_code' => null,
                'exit_gate_name' => null,
                'exit_camera_code' => null,
                'exit_anpr_confidence' => null,
                'duration_minutes' => 150,
                'duration_formatted' => '2h 30m',
                'duration_type' => 'elapsed',
                'rate_hourly' => 6000,
                'base_fee' => 18000,
                'service_fee' => 0,
                'total_fee' => 18000,
                'formatted_fee' => 'Rp 18.000',
                'session_status' => 'active',
                'session_status_label' => 'Active (Parked)',
                'payment_status' => 'pending',
                'payment_status_label' => 'Pending (In Progress)',
                'payment_method' => 'App Reservation Fast-Lane',
                'payment_reference' => null,
                'paid_at' => null,
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'K*** T***',
                'driver_phone' => '+62 813-****-4411',
                'timeline' => [
                    ['time' => '13:30:10 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'CAM-GI-IN01 identified EV plate B 9012 EV with pre-reserved slot token', 'status' => 'success'],
                    ['time' => '13:30:14 WIB', 'event' => 'Fast Barrier Raised', 'details' => 'GATE-GI-IN-01 opened for EV lane ingress', 'status' => 'success'],
                    ['time' => '13:32:00 WIB', 'event' => 'EV Fast-Charger Coupled', 'details' => 'AC Type 2 connection established at bay GI-B1-05', 'status' => 'info'],
                ],
            ],
            [
                'id' => 'ses-20261011-0082',
                'session_code' => 'SES-20261011-0082',
                'vehicle_plate' => 'B 7788 NZA',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Honda CR-V e:HEV RS',
                'vehicle_color' => 'Platinum White Pearl',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'slot_code' => 'B1-C-02',
                'entry_time' => '11 Oct 2026, 12:42 WIB',
                'entry_time_raw' => '2026-10-11 12:42:00',
                'entry_gate_code' => 'GATE-XYZ-IN-02',
                'entry_gate_name' => 'Inbound Express Gate 02',
                'entry_camera_code' => 'CAM-XYZ-IN02',
                'entry_anpr_confidence' => 99.1,
                'exit_time' => null,
                'exit_time_raw' => null,
                'exit_gate_code' => null,
                'exit_gate_name' => null,
                'exit_camera_code' => null,
                'exit_anpr_confidence' => null,
                'duration_minutes' => 198,
                'duration_formatted' => '3h 18m',
                'duration_type' => 'elapsed',
                'rate_hourly' => 5000,
                'base_fee' => 20000,
                'service_fee' => 0,
                'total_fee' => 20000,
                'formatted_fee' => 'Rp 20.000',
                'session_status' => 'active',
                'session_status_label' => 'Active (Parked)',
                'payment_status' => 'pending',
                'payment_status_label' => 'Pending (In Progress)',
                'payment_method' => 'Tap on Exit (Prepaid Card / QRIS)',
                'payment_reference' => null,
                'paid_at' => null,
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'R*** P***',
                'driver_phone' => '+62 811-****-7019',
                'timeline' => [
                    ['time' => '12:42:05 WIB', 'event' => 'Ingress Camera Capture', 'details' => 'CAM-XYZ-IN02 confirmed plate match B 7788 NZA', 'status' => 'success'],
                    ['time' => '12:42:09 WIB', 'event' => 'Barrier Gate Lifted', 'details' => 'GATE-XYZ-IN-02 opened successfully', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0078',
                'session_code' => 'SES-20261011-0078',
                'vehicle_plate' => 'B 1982 KLP',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Mitsubishi Pajero Sport Dakar 4x2',
                'vehicle_color' => 'Deep Bronze Metallic',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-p1',
                'area_name' => 'Parking Building P1',
                'slot_code' => 'CP-P1-01',
                'entry_time' => '11 Oct 2026, 12:10 WIB',
                'entry_time_raw' => '2026-10-11 12:10:00',
                'entry_gate_code' => 'GATE-CP-IN-01',
                'entry_gate_name' => 'Main North Inbound Gate',
                'entry_camera_code' => 'CAM-CP-IN01',
                'entry_anpr_confidence' => 98.7,
                'exit_time' => null,
                'exit_time_raw' => null,
                'exit_gate_code' => null,
                'exit_gate_name' => null,
                'exit_camera_code' => null,
                'exit_anpr_confidence' => null,
                'duration_minutes' => 230,
                'duration_formatted' => '3h 50m',
                'duration_type' => 'elapsed',
                'rate_hourly' => 5000,
                'base_fee' => 20000,
                'service_fee' => 0,
                'total_fee' => 20000,
                'formatted_fee' => 'Rp 20.000',
                'session_status' => 'active',
                'session_status_label' => 'Active (Parked)',
                'payment_status' => 'pending',
                'payment_status_label' => 'Pending (In Progress)',
                'payment_method' => 'Cashless Tap',
                'payment_reference' => null,
                'paid_at' => null,
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'H*** S***',
                'driver_phone' => '+62 817-****-1234',
                'timeline' => [
                    ['time' => '12:10:00 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'CAM-CP-IN01 verified vehicle license plate', 'status' => 'success'],
                    ['time' => '12:10:04 WIB', 'event' => 'Boom Gate Lifted', 'details' => 'GATE-CP-IN-01 opened', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0075',
                'session_code' => 'SES-20261011-0075',
                'vehicle_plate' => 'B 3102 PQR',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Honda HR-V 1.5 RS Turbo',
                'vehicle_color' => 'Ignite Red Metallic',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b2',
                'area_name' => 'Basement 2 - South Wing (Standard)',
                'slot_code' => 'B2-C-15',
                'entry_time' => '11 Oct 2026, 11:45 WIB',
                'entry_time_raw' => '2026-10-11 11:45:00',
                'entry_gate_code' => 'GATE-XYZ-IN-01',
                'entry_gate_name' => 'North Inbound Gate 01',
                'entry_camera_code' => 'CAM-XYZ-IN01',
                'entry_anpr_confidence' => 99.0,
                'exit_time' => null,
                'exit_time_raw' => null,
                'exit_gate_code' => null,
                'exit_gate_name' => null,
                'exit_camera_code' => null,
                'exit_anpr_confidence' => null,
                'duration_minutes' => 255,
                'duration_formatted' => '4h 15m',
                'duration_type' => 'elapsed',
                'rate_hourly' => 5000,
                'base_fee' => 25000,
                'service_fee' => 0,
                'total_fee' => 25000,
                'formatted_fee' => 'Rp 25.000',
                'session_status' => 'active',
                'session_status_label' => 'Active (Parked)',
                'payment_status' => 'pending',
                'payment_status_label' => 'Pending (In Progress)',
                'payment_method' => 'NusaPark In-App Auto-Pay Linked',
                'payment_reference' => null,
                'paid_at' => null,
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'Y*** M***',
                'driver_phone' => '+62 818-****-5520',
                'timeline' => [
                    ['time' => '11:45:12 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'CAM-XYZ-IN01 verified plate B 3102 PQR', 'status' => 'success'],
                    ['time' => '11:45:15 WIB', 'event' => 'Gate Raised', 'details' => 'GATE-XYZ-IN-01 opened', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0070',
                'session_code' => 'SES-20261011-0070',
                'vehicle_plate' => 'B 2841 SKT',
                'vehicle_type' => 'EV',
                'vehicle_model' => 'Wuling BinguoEV 333km Premium',
                'vehicle_color' => 'Milk Tea White',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b2',
                'area_name' => 'Basement 2 - Standard Zone',
                'slot_code' => 'GI-B2-02',
                'entry_time' => '11 Oct 2026, 11:15 WIB',
                'entry_time_raw' => '2026-10-11 11:15:00',
                'entry_gate_code' => 'GATE-GI-IN-01',
                'entry_gate_name' => 'Main Inbound West Gate 01',
                'entry_camera_code' => 'CAM-GI-IN01',
                'entry_anpr_confidence' => 98.4,
                'exit_time' => null,
                'exit_time_raw' => null,
                'exit_gate_code' => null,
                'exit_gate_name' => null,
                'exit_camera_code' => null,
                'exit_anpr_confidence' => null,
                'duration_minutes' => 285,
                'duration_formatted' => '4h 45m',
                'duration_type' => 'elapsed',
                'rate_hourly' => 6000,
                'base_fee' => 30000,
                'service_fee' => 0,
                'total_fee' => 30000,
                'formatted_fee' => 'Rp 30.000',
                'session_status' => 'active',
                'session_status_label' => 'Active (Parked)',
                'payment_status' => 'pending',
                'payment_status_label' => 'Pending (In Progress)',
                'payment_method' => 'Cashless Tap',
                'payment_reference' => null,
                'paid_at' => null,
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'F*** N***',
                'driver_phone' => '+62 812-****-3041',
                'timeline' => [
                    ['time' => '11:15:20 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'CAM-GI-IN01 recorded plate B 2841 SKT', 'status' => 'success'],
                    ['time' => '11:15:24 WIB', 'event' => 'Barrier Gate Lifted', 'details' => 'GATE-GI-IN-01 opened', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0065',
                'session_code' => 'SES-20261011-0065',
                'vehicle_plate' => 'B 6712 UYX',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Toyota Yaris Cross 1.5 HEV',
                'vehicle_color' => 'Silver Metallic',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-p2',
                'area_name' => 'Parking Building P2',
                'slot_code' => 'CP-P2-10',
                'entry_time' => '11 Oct 2026, 10:30 WIB',
                'entry_time_raw' => '2026-10-11 10:30:00',
                'entry_gate_code' => 'GATE-CP-IN-01',
                'entry_gate_name' => 'Main North Inbound Gate',
                'entry_camera_code' => 'CAM-CP-IN01',
                'entry_anpr_confidence' => 99.2,
                'exit_time' => null,
                'exit_time_raw' => null,
                'exit_gate_code' => null,
                'exit_gate_name' => null,
                'exit_camera_code' => null,
                'exit_anpr_confidence' => null,
                'duration_minutes' => 330,
                'duration_formatted' => '5h 30m',
                'duration_type' => 'elapsed',
                'rate_hourly' => 5000,
                'base_fee' => 30000,
                'service_fee' => 0,
                'total_fee' => 30000,
                'formatted_fee' => 'Rp 30.000',
                'session_status' => 'active',
                'session_status_label' => 'Active (Parked)',
                'payment_status' => 'pending',
                'payment_status_label' => 'Pending (In Progress)',
                'payment_method' => 'Prepaid Card Flazz',
                'payment_reference' => null,
                'paid_at' => null,
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'L*** K***',
                'driver_phone' => '+62 819-****-6721',
                'timeline' => [
                    ['time' => '10:30:00 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'CAM-CP-IN01 verified vehicle license plate', 'status' => 'success'],
                    ['time' => '10:30:04 WIB', 'event' => 'Boom Gate Lifted', 'details' => 'GATE-CP-IN-01 opened', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0060',
                'session_code' => 'SES-20261011-0060',
                'vehicle_plate' => 'B 5420 WQA',
                'vehicle_type' => 'Motorcycle',
                'vehicle_model' => 'Honda PCX 160 ABS',
                'vehicle_color' => 'Matte Suit Black',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-mc',
                'area_name' => 'Outdoor West - Motorcycle Zone',
                'slot_code' => 'Unassigned Bay',
                'entry_time' => '11 Oct 2026, 09:50 WIB',
                'entry_time_raw' => '2026-10-11 09:50:00',
                'entry_gate_code' => 'GATE-XYZ-IN-01',
                'entry_gate_name' => 'Motorcycle Inbound Lane 1',
                'entry_camera_code' => 'CAM-XYZ-IN01',
                'entry_anpr_confidence' => 97.9,
                'exit_time' => null,
                'exit_time_raw' => null,
                'exit_gate_code' => null,
                'exit_gate_name' => null,
                'exit_camera_code' => null,
                'exit_anpr_confidence' => null,
                'duration_minutes' => 370,
                'duration_formatted' => '6h 10m',
                'duration_type' => 'elapsed',
                'rate_hourly' => 2000,
                'base_fee' => 14000,
                'service_fee' => 0,
                'total_fee' => 14000,
                'formatted_fee' => 'Rp 14.000',
                'session_status' => 'active',
                'session_status_label' => 'Active (Parked)',
                'payment_status' => 'pending',
                'payment_status_label' => 'Pending (In Progress)',
                'payment_method' => 'Cashless Tap',
                'payment_reference' => null,
                'paid_at' => null,
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'D*** I***',
                'driver_phone' => '+62 811-****-9018',
                'timeline' => [
                    ['time' => '09:50:00 WIB', 'event' => 'Motorcycle Ingress Turnstile', 'details' => 'Tap card detected at West Turnstile', 'status' => 'success'],
                ],
            ],

            // --- 2. ATTENTION REQUIRED SESSIONS (OVERSTAY / OPERATIONAL ISSUES) ---
            [
                'id' => 'ses-20261010-0012',
                'session_code' => 'SES-20261010-0012',
                'vehicle_plate' => 'B 8821 RFS',
                'vehicle_type' => 'VIP / Luxury',
                'vehicle_model' => 'Mercedes-Benz E 300 AMG Line',
                'vehicle_color' => 'Obsidian Black',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-gf',
                'area_name' => 'Ground Level - VIP & Valet Zone',
                'slot_code' => 'B1-VIP-01',
                'entry_time' => '10 Oct 2026, 10:20 WIB',
                'entry_time_raw' => '2026-10-10 10:20:00',
                'entry_gate_code' => 'GATE-XYZ-IN-02',
                'entry_gate_name' => 'Inbound Express Gate 02',
                'entry_camera_code' => 'CAM-XYZ-IN02',
                'entry_anpr_confidence' => 99.6,
                'exit_time' => null,
                'exit_time_raw' => null,
                'exit_gate_code' => null,
                'exit_gate_name' => null,
                'exit_camera_code' => null,
                'exit_anpr_confidence' => null,
                'duration_minutes' => 1780,
                'duration_formatted' => '29h 40m',
                'duration_type' => 'elapsed',
                'rate_hourly' => 10000,
                'base_fee' => 300000,
                'service_fee' => 0,
                'total_fee' => 300000,
                'formatted_fee' => 'Rp 300.000',
                'session_status' => 'attention_required',
                'session_status_label' => 'Overstay (>24h)',
                'payment_status' => 'disputed',
                'payment_status_label' => 'Overdue Disputed',
                'payment_method' => 'Valet Counter Billing Pending',
                'payment_reference' => null,
                'paid_at' => null,
                'is_flagged' => true,
                'flag_reason' => 'Continuous parking exceeded 24 hours without prior overnight declaration. Site security notified.',
                'flag_status' => 'Open Review',
                'driver_name' => 'B*** K***',
                'driver_phone' => '+62 812-****-8821',
                'timeline' => [
                    ['time' => '10 Oct 10:20 WIB', 'event' => 'VIP Lane Ingress', 'details' => 'CAM-XYZ-IN02 logged luxury sedan B 8821 RFS', 'status' => 'success'],
                    ['time' => '11 Oct 10:20 WIB', 'event' => 'Overstay Automated Alert', 'details' => 'System triggered overstay rule #OST-24H. Attendant inspection required.', 'status' => 'warning'],
                ],
            ],
            [
                'id' => 'ses-20261011-0052',
                'session_code' => 'SES-20261011-0052',
                'vehicle_plate' => 'D 1999 ZZZ',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Daihatsu Rocky 1.0T R TC',
                'vehicle_color' => 'Compagno Red',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-p1',
                'area_name' => 'Parking Building P1',
                'slot_code' => 'CP-P1-08',
                'entry_time' => '11 Oct 2026, 08:30 WIB',
                'entry_time_raw' => '2026-10-11 08:30:00',
                'entry_gate_code' => 'GATE-CP-IN-01',
                'entry_gate_name' => 'Main North Inbound Gate',
                'entry_camera_code' => 'CAM-CP-IN01',
                'entry_anpr_confidence' => 98.8,
                'exit_time' => null,
                'exit_time_raw' => null,
                'exit_gate_code' => 'GATE-CP-OUT-01',
                'exit_gate_name' => 'Exit Gate 2 (Outbound)',
                'exit_camera_code' => 'CAM-CP-OUT01',
                'exit_anpr_confidence' => 99.0,
                'duration_minutes' => 450,
                'duration_formatted' => '7h 30m',
                'duration_type' => 'elapsed',
                'rate_hourly' => 5000,
                'base_fee' => 40000,
                'service_fee' => 0,
                'total_fee' => 40000,
                'formatted_fee' => 'Rp 40.000',
                'session_status' => 'attention_required',
                'session_status_label' => 'Payment Discrepancy',
                'payment_status' => 'disputed',
                'payment_status_label' => 'Insufficient Balance',
                'payment_method' => 'Tap on Exit (Flazz)',
                'payment_reference' => null,
                'paid_at' => null,
                'is_flagged' => true,
                'flag_reason' => 'Prepaid card tap failed due to insufficient balance at exit barrier. Manual supervisor assistance needed.',
                'flag_status' => 'Open Review',
                'driver_name' => 'A*** R***',
                'driver_phone' => '+62 856-****-1999',
                'timeline' => [
                    ['time' => '08:30:10 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'CAM-CP-IN01 plate verification OK', 'status' => 'success'],
                    ['time' => '16:00:22 WIB', 'event' => 'Outbound Barrier Interlock', 'details' => 'Insufficient card balance detected at GATE-CP-OUT-01. Boom arm held in locked closed position.', 'status' => 'warning'],
                ],
            ],

            // --- 3. COMPLETED SESSIONS (TODAY, EXITED & SETTLED) ---
            [
                'id' => 'ses-20261011-0058',
                'session_code' => 'SES-20261011-0058',
                'vehicle_plate' => 'B 5678 ABC',
                'vehicle_type' => 'Motorcycle',
                'vehicle_model' => 'Honda Vario 160 CBS',
                'vehicle_color' => 'Active Black Matte',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-mc',
                'area_name' => 'Outdoor West - Motorcycle Zone',
                'slot_code' => 'Unassigned Bay',
                'entry_time' => '11 Oct 2026, 11:20 WIB',
                'entry_time_raw' => '2026-10-11 11:20:00',
                'entry_gate_code' => 'GATE-XYZ-IN-01',
                'entry_gate_name' => 'Motorcycle Inbound Lane 1',
                'entry_camera_code' => 'CAM-XYZ-IN01',
                'entry_anpr_confidence' => 98.2,
                'exit_time' => '11 Oct 2026, 12:55 WIB',
                'exit_time_raw' => '2026-10-11 12:55:00',
                'exit_gate_code' => 'GATE-XYZ-OUT-01',
                'exit_gate_name' => 'South Outbound Gate 01',
                'exit_camera_code' => 'CAM-XYZ-OUT01',
                'exit_anpr_confidence' => 98.5,
                'duration_minutes' => 95,
                'duration_formatted' => '1h 35m',
                'duration_type' => 'billed',
                'rate_hourly' => 3000,
                'base_fee' => 6000,
                'service_fee' => 0,
                'total_fee' => 6000,
                'formatted_fee' => 'Rp 6.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid (Settled)',
                'payment_method' => 'QRIS Instant Pay',
                'payment_reference' => 'TRX-QRIS-20261011-9912',
                'paid_at' => '11 Oct 2026, 12:54 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'M*** A***',
                'driver_phone' => '+62 878-****-5678',
                'timeline' => [
                    ['time' => '11:20:00 WIB', 'event' => 'Ingress Camera Capture', 'details' => 'CAM-XYZ-IN01 recorded plate', 'status' => 'success'],
                    ['time' => '12:54:15 WIB', 'event' => 'QRIS Dynamic Pay Cleared', 'details' => 'Settled Rp 6.000 via QRIS Network', 'status' => 'success'],
                    ['time' => '12:55:02 WIB', 'event' => 'Exit Barrier Raised', 'details' => 'GATE-XYZ-OUT-01 opened for egress', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0055',
                'session_code' => 'SES-20261011-0055',
                'vehicle_plate' => 'B 2291 TJA',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Toyota Kijang Innova Zenix 2.0 V',
                'vehicle_color' => 'Attitude Black Mica',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-p1',
                'area_name' => 'Parking Building P1',
                'slot_code' => 'CP-P1-04',
                'entry_time' => '11 Oct 2026, 10:15 WIB',
                'entry_time_raw' => '2026-10-11 10:15:00',
                'entry_gate_code' => 'GATE-CP-IN-01',
                'entry_gate_name' => 'Main North Inbound Gate',
                'entry_camera_code' => 'CAM-CP-IN01',
                'entry_anpr_confidence' => 99.4,
                'exit_time' => '11 Oct 2026, 12:51 WIB',
                'exit_time_raw' => '2026-10-11 12:51:00',
                'exit_gate_code' => 'GATE-CP-OUT-01',
                'exit_gate_name' => 'Exit Gate 2 (Outbound)',
                'exit_camera_code' => 'CAM-CP-OUT01',
                'exit_anpr_confidence' => 99.1,
                'duration_minutes' => 156,
                'duration_formatted' => '2h 36m',
                'duration_type' => 'billed',
                'rate_hourly' => 6000,
                'base_fee' => 18000,
                'service_fee' => 0,
                'total_fee' => 18000,
                'formatted_fee' => 'Rp 18.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid (Settled)',
                'payment_method' => 'Prepaid Card (BCA Flazz)',
                'payment_reference' => 'TRX-FLZ-8041920',
                'paid_at' => '11 Oct 2026, 12:50 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'S*** H***',
                'driver_phone' => '+62 812-****-2291',
                'timeline' => [
                    ['time' => '10:15:00 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'CAM-CP-IN01 plate verification OK', 'status' => 'success'],
                    ['time' => '12:50:40 WIB', 'event' => 'Contactless Card Tap Cleared', 'details' => 'Deducted Rp 18.000 from BCA Flazz', 'status' => 'success'],
                    ['time' => '12:51:00 WIB', 'event' => 'Outbound Barrier Opened', 'details' => 'GATE-CP-OUT-01 boom arm raised', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0051',
                'session_code' => 'SES-20261011-0051',
                'vehicle_plate' => 'D 1804 SB',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Honda Civic RS 1.5 Turbo',
                'vehicle_color' => 'Meteoroid Gray Metallic',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b1',
                'area_name' => 'Basement 1 - EV Fast Hub',
                'slot_code' => 'GI-B1-02',
                'entry_time' => '11 Oct 2026, 09:40 WIB',
                'entry_time_raw' => '2026-10-11 09:40:00',
                'entry_gate_code' => 'GATE-GI-IN-01',
                'entry_gate_name' => 'Main Inbound West Gate 01',
                'entry_camera_code' => 'CAM-GI-IN01',
                'entry_anpr_confidence' => 99.5,
                'exit_time' => '11 Oct 2026, 12:47 WIB',
                'exit_time_raw' => '2026-10-11 12:47:00',
                'exit_gate_code' => 'GATE-GI-OUT-01',
                'exit_gate_name' => 'Exit Gate 1 (Thamrin)',
                'exit_camera_code' => 'CAM-GI-OUT01',
                'exit_anpr_confidence' => 99.3,
                'duration_minutes' => 187,
                'duration_formatted' => '3h 07m',
                'duration_type' => 'billed',
                'rate_hourly' => 6000,
                'base_fee' => 24000,
                'service_fee' => 0,
                'total_fee' => 24000,
                'formatted_fee' => 'Rp 24.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid (Settled)',
                'payment_method' => 'Cashless Tap (Mandiri e-Money)',
                'payment_reference' => 'TRX-EMN-771920',
                'paid_at' => '11 Oct 2026, 12:46 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'T*** W***',
                'driver_phone' => '+62 813-****-1804',
                'timeline' => [
                    ['time' => '09:40:00 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'CAM-GI-IN01 plate verification OK', 'status' => 'success'],
                    ['time' => '12:46:30 WIB', 'event' => 'Mandiri e-Money Tap', 'details' => 'Rp 24.000 debited successfully', 'status' => 'success'],
                    ['time' => '12:47:05 WIB', 'event' => 'Exit Barrier Raised', 'details' => 'GATE-GI-OUT-01 confirmed vehicle departure', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0048',
                'session_code' => 'SES-20261011-0048',
                'vehicle_plate' => 'B 1120 FGH',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Hyundai Creta Prime Two-Tone',
                'vehicle_color' => 'Dragon Red Pearl',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'slot_code' => 'B1-C-08',
                'entry_time' => '11 Oct 2026, 09:15 WIB',
                'entry_time_raw' => '2026-10-11 09:15:00',
                'entry_gate_code' => 'GATE-XYZ-IN-01',
                'entry_gate_name' => 'North Inbound Gate 01',
                'entry_camera_code' => 'CAM-XYZ-IN01',
                'entry_anpr_confidence' => 99.7,
                'exit_time' => '11 Oct 2026, 12:30 WIB',
                'exit_time_raw' => '2026-10-11 12:30:00',
                'exit_gate_code' => 'GATE-XYZ-OUT-02',
                'exit_gate_name' => 'East Outbound Gate 02',
                'exit_camera_code' => 'CAM-XYZ-OUT02',
                'exit_anpr_confidence' => 99.2,
                'duration_minutes' => 195,
                'duration_formatted' => '3h 15m',
                'duration_type' => 'billed',
                'rate_hourly' => 5000,
                'base_fee' => 20000,
                'service_fee' => 0,
                'total_fee' => 20000,
                'formatted_fee' => 'Rp 20.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'auto_debited',
                'payment_status_label' => 'Auto-Debited (App)',
                'payment_method' => 'NusaPark In-App Auto-Pay',
                'payment_reference' => 'TRX-NUSA-20261011-4011',
                'paid_at' => '11 Oct 2026, 12:29 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'D*** F***',
                'driver_phone' => '+62 811-****-1120',
                'timeline' => [
                    ['time' => '09:15:00 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'Seamless camera entry without ticket', 'status' => 'success'],
                    ['time' => '12:29:45 WIB', 'event' => 'In-App Auto-Debit Cleared', 'details' => 'Direct debit linked GoPay balance (Rp 20.000)', 'status' => 'success'],
                    ['time' => '12:30:00 WIB', 'event' => 'Express Egress Boom Lifted', 'details' => 'GATE-XYZ-OUT-02 opened smoothly', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0044',
                'session_code' => 'SES-20261011-0044',
                'vehicle_plate' => 'B 9801 PLM',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'BMW 330i M Sport Pro',
                'vehicle_color' => 'Portimao Blue Metallic',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b2',
                'area_name' => 'Basement 2 - Standard Zone',
                'slot_code' => 'GI-B2-11',
                'entry_time' => '11 Oct 2026, 08:50 WIB',
                'entry_time_raw' => '2026-10-11 08:50:00',
                'entry_gate_code' => 'GATE-GI-IN-01',
                'entry_gate_name' => 'Main Inbound West Gate 01',
                'entry_camera_code' => 'CAM-GI-IN01',
                'entry_anpr_confidence' => 99.8,
                'exit_time' => '11 Oct 2026, 12:15 WIB',
                'exit_time_raw' => '2026-10-11 12:15:00',
                'exit_gate_code' => 'GATE-GI-OUT-01',
                'exit_gate_name' => 'Exit Gate 1 (Thamrin)',
                'exit_camera_code' => 'CAM-GI-OUT01',
                'exit_anpr_confidence' => 99.6,
                'duration_minutes' => 205,
                'duration_formatted' => '3h 25m',
                'duration_type' => 'billed',
                'rate_hourly' => 7000,
                'base_fee' => 28000,
                'service_fee' => 0,
                'total_fee' => 28000,
                'formatted_fee' => 'Rp 28.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'auto_debited',
                'payment_status_label' => 'Auto-Debited (App)',
                'payment_method' => 'NusaPark In-App Auto-Pay',
                'payment_reference' => 'TRX-NUSA-20261011-3820',
                'paid_at' => '11 Oct 2026, 12:14 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'M*** R***',
                'driver_phone' => '+62 812-****-9801',
                'timeline' => [
                    ['time' => '08:50:00 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'CAM-GI-IN01 license verification OK', 'status' => 'success'],
                    ['time' => '12:14:50 WIB', 'event' => 'Auto-Debit Succeeded', 'details' => 'Rp 28.000 settled', 'status' => 'success'],
                    ['time' => '12:15:05 WIB', 'event' => 'Gate Raised', 'details' => 'GATE-GI-OUT-01 opened', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0040',
                'session_code' => 'SES-20261011-0040',
                'vehicle_plate' => 'B 4419 JKL',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Toyota Avanza 1.5 G CVT',
                'vehicle_color' => 'Silver Mica Metallic',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-p2',
                'area_name' => 'Parking Building P2',
                'slot_code' => 'CP-P2-03',
                'entry_time' => '11 Oct 2026, 08:20 WIB',
                'entry_time_raw' => '2026-10-11 08:20:00',
                'entry_gate_code' => 'GATE-CP-IN-01',
                'entry_gate_name' => 'Main North Inbound Gate',
                'entry_camera_code' => 'CAM-CP-IN01',
                'entry_anpr_confidence' => 98.9,
                'exit_time' => '11 Oct 2026, 11:45 WIB',
                'exit_time_raw' => '2026-10-11 11:45:00',
                'exit_gate_code' => 'GATE-CP-OUT-01',
                'exit_gate_name' => 'Exit Gate 2 (Outbound)',
                'exit_camera_code' => 'CAM-CP-OUT01',
                'exit_anpr_confidence' => 98.6,
                'duration_minutes' => 205,
                'duration_formatted' => '3h 25m',
                'duration_type' => 'billed',
                'rate_hourly' => 5000,
                'base_fee' => 20000,
                'service_fee' => 0,
                'total_fee' => 20000,
                'formatted_fee' => 'Rp 20.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid (Settled)',
                'payment_method' => 'QRIS Instant Pay',
                'payment_reference' => 'TRX-QRIS-20261011-3001',
                'paid_at' => '11 Oct 2026, 11:44 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'B*** S***',
                'driver_phone' => '+62 813-****-4419',
                'timeline' => [
                    ['time' => '08:20:00 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'Plate matched', 'status' => 'success'],
                    ['time' => '11:44:30 WIB', 'event' => 'QRIS Transaction Cleared', 'details' => 'Rp 20.000 paid', 'status' => 'success'],
                    ['time' => '11:45:00 WIB', 'event' => 'Exit Barrier Raised', 'details' => 'Departed', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0036',
                'session_code' => 'SES-20261011-0036',
                'vehicle_plate' => 'B 1602 OPQ',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Suzuki Ertiga Hybrid GX',
                'vehicle_color' => 'Brave Khaki Pearl',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b2',
                'area_name' => 'Basement 2 - South Wing (Standard)',
                'slot_code' => 'B2-C-05',
                'entry_time' => '11 Oct 2026, 08:05 WIB',
                'entry_time_raw' => '2026-10-11 08:05:00',
                'entry_gate_code' => 'GATE-XYZ-IN-01',
                'entry_gate_name' => 'North Inbound Gate 01',
                'entry_camera_code' => 'CAM-XYZ-IN01',
                'entry_anpr_confidence' => 99.2,
                'exit_time' => '11 Oct 2026, 11:10 WIB',
                'exit_time_raw' => '2026-10-11 11:10:00',
                'exit_gate_code' => 'GATE-XYZ-OUT-01',
                'exit_gate_name' => 'South Outbound Gate 01',
                'exit_camera_code' => 'CAM-XYZ-OUT01',
                'exit_anpr_confidence' => 99.0,
                'duration_minutes' => 185,
                'duration_formatted' => '3h 05m',
                'duration_type' => 'billed',
                'rate_hourly' => 5000,
                'base_fee' => 20000,
                'service_fee' => 0,
                'total_fee' => 20000,
                'formatted_fee' => 'Rp 20.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid (Settled)',
                'payment_method' => 'Mandiri e-Money Tap',
                'payment_reference' => 'TRX-EMN-28104',
                'paid_at' => '11 Oct 2026, 11:09 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'I*** P***',
                'driver_phone' => '+62 812-****-1602',
                'timeline' => [
                    ['time' => '08:05:00 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'Ingress logged', 'status' => 'success'],
                    ['time' => '11:09:50 WIB', 'event' => 'Card Tap Cleared', 'details' => 'Settled Rp 20.000', 'status' => 'success'],
                    ['time' => '11:10:00 WIB', 'event' => 'Gate Raised', 'details' => 'Departed', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0030',
                'session_code' => 'SES-20261011-0030',
                'vehicle_plate' => 'B 7192 RST',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Mazda CX-5 Kuro Edition',
                'vehicle_color' => 'Rhodium White Metallic',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b1',
                'area_name' => 'Basement 1 - EV Fast Hub',
                'slot_code' => 'GI-B1-09',
                'entry_time' => '11 Oct 2026, 07:45 WIB',
                'entry_time_raw' => '2026-10-11 07:45:00',
                'entry_gate_code' => 'GATE-GI-IN-01',
                'entry_gate_name' => 'Main Inbound West Gate 01',
                'entry_camera_code' => 'CAM-GI-IN01',
                'entry_anpr_confidence' => 99.4,
                'exit_time' => '11 Oct 2026, 10:30 WIB',
                'exit_time_raw' => '2026-10-11 10:30:00',
                'exit_gate_code' => 'GATE-GI-OUT-01',
                'exit_gate_name' => 'Exit Gate 1 (Thamrin)',
                'exit_camera_code' => 'CAM-GI-OUT01',
                'exit_anpr_confidence' => 99.1,
                'duration_minutes' => 165,
                'duration_formatted' => '2h 45m',
                'duration_type' => 'billed',
                'rate_hourly' => 7000,
                'base_fee' => 21000,
                'service_fee' => 0,
                'total_fee' => 21000,
                'formatted_fee' => 'Rp 21.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid (Settled)',
                'payment_method' => 'BCA Flazz Tap',
                'payment_reference' => 'TRX-FLZ-99120',
                'paid_at' => '11 Oct 2026, 10:29 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'V*** A***',
                'driver_phone' => '+62 813-****-7192',
                'timeline' => [
                    ['time' => '07:45:00 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'Ingress logged', 'status' => 'success'],
                    ['time' => '10:29:40 WIB', 'event' => 'BCA Flazz Cleared', 'details' => 'Rp 21.000 paid', 'status' => 'success'],
                    ['time' => '10:30:00 WIB', 'event' => 'Exit Gate Opened', 'details' => 'Departed', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0025',
                'session_code' => 'SES-20261011-0025',
                'vehicle_plate' => 'B 3918 UVW',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Honda Brio RS Urbanite',
                'vehicle_color' => 'Carnival Yellow II',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-p1',
                'area_name' => 'Parking Building P1',
                'slot_code' => 'CP-P1-12',
                'entry_time' => '11 Oct 2026, 07:15 WIB',
                'entry_time_raw' => '2026-10-11 07:15:00',
                'entry_gate_code' => 'GATE-CP-IN-01',
                'entry_gate_name' => 'Main North Inbound Gate',
                'entry_camera_code' => 'CAM-CP-IN01',
                'entry_anpr_confidence' => 99.0,
                'exit_time' => '11 Oct 2026, 09:45 WIB',
                'exit_time_raw' => '2026-10-11 09:45:00',
                'exit_gate_code' => 'GATE-CP-OUT-01',
                'exit_gate_name' => 'Exit Gate 2 (Outbound)',
                'exit_camera_code' => 'CAM-CP-OUT01',
                'exit_anpr_confidence' => 98.9,
                'duration_minutes' => 150,
                'duration_formatted' => '2h 30m',
                'duration_type' => 'billed',
                'rate_hourly' => 5000,
                'base_fee' => 15000,
                'service_fee' => 0,
                'total_fee' => 15000,
                'formatted_fee' => 'Rp 15.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid (Settled)',
                'payment_method' => 'QRIS Instant Pay',
                'payment_reference' => 'TRX-QRIS-20261011-1820',
                'paid_at' => '11 Oct 2026, 09:44 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'E*** B***',
                'driver_phone' => '+62 857-****-3918',
                'timeline' => [
                    ['time' => '07:15:00 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'Ingress logged', 'status' => 'success'],
                    ['time' => '09:44:20 WIB', 'event' => 'QRIS Cleared', 'details' => 'Rp 15.000 paid', 'status' => 'success'],
                    ['time' => '09:45:00 WIB', 'event' => 'Exit Barrier Raised', 'details' => 'Departed', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261011-0020',
                'session_code' => 'SES-20261011-0020',
                'vehicle_plate' => 'B 8201 XYZ',
                'vehicle_type' => 'VIP / Luxury',
                'vehicle_model' => 'Lexus RX 350h Luxury',
                'vehicle_color' => 'Sonic Titanium',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-gf',
                'area_name' => 'Ground Level - VIP & Valet Zone',
                'slot_code' => 'B1-VIP-02',
                'entry_time' => '11 Oct 2026, 07:00 WIB',
                'entry_time_raw' => '2026-10-11 07:00:00',
                'entry_gate_code' => 'GATE-XYZ-IN-02',
                'entry_gate_name' => 'Inbound Express Gate 02',
                'entry_camera_code' => 'CAM-XYZ-IN02',
                'entry_anpr_confidence' => 99.9,
                'exit_time' => '11 Oct 2026, 09:15 WIB',
                'exit_time_raw' => '2026-10-11 09:15:00',
                'exit_gate_code' => 'GATE-XYZ-OUT-01',
                'exit_gate_name' => 'South Outbound Gate 01',
                'exit_camera_code' => 'CAM-XYZ-OUT01',
                'exit_anpr_confidence' => 99.8,
                'duration_minutes' => 135,
                'duration_formatted' => '2h 15m',
                'duration_type' => 'billed',
                'rate_hourly' => 10000,
                'base_fee' => 30000,
                'service_fee' => 0,
                'total_fee' => 30000,
                'formatted_fee' => 'Rp 30.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'auto_debited',
                'payment_status_label' => 'Auto-Debited (App)',
                'payment_method' => 'NusaPark In-App Auto-Pay',
                'payment_reference' => 'TRX-NUSA-20261011-1002',
                'paid_at' => '11 Oct 2026, 09:14 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'J*** L***',
                'driver_phone' => '+62 811-****-8201',
                'timeline' => [
                    ['time' => '07:00:00 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'VIP express ingress recognized', 'status' => 'success'],
                    ['time' => '09:14:30 WIB', 'event' => 'Auto-Debit Cleared', 'details' => 'Rp 30.000 debited', 'status' => 'success'],
                    ['time' => '09:15:00 WIB', 'event' => 'Gate Raised', 'details' => 'Departed', 'status' => 'success'],
                ],
            ],

            // --- 4. HISTORICAL SESSIONS (YESTERDAY & PAST 7 DAYS) ---
            [
                'id' => 'ses-20261010-0095',
                'session_code' => 'SES-20261010-0095',
                'vehicle_plate' => 'B 6301 BCD',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Toyota Corolla Cross Hybrid',
                'vehicle_color' => 'Platinum White Pearl',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'slot_code' => 'B1-C-14',
                'entry_time' => '10 Oct 2026, 16:20 WIB',
                'entry_time_raw' => '2026-10-10 16:20:00',
                'entry_gate_code' => 'GATE-XYZ-IN-01',
                'entry_gate_name' => 'North Inbound Gate 01',
                'entry_camera_code' => 'CAM-XYZ-IN01',
                'entry_anpr_confidence' => 99.3,
                'exit_time' => '10 Oct 2026, 19:40 WIB',
                'exit_time_raw' => '2026-10-10 19:40:00',
                'exit_gate_code' => 'GATE-XYZ-OUT-01',
                'exit_gate_name' => 'South Outbound Gate 01',
                'exit_camera_code' => 'CAM-XYZ-OUT01',
                'exit_anpr_confidence' => 99.1,
                'duration_minutes' => 200,
                'duration_formatted' => '3h 20m',
                'duration_type' => 'billed',
                'rate_hourly' => 5000,
                'base_fee' => 20000,
                'service_fee' => 0,
                'total_fee' => 20000,
                'formatted_fee' => 'Rp 20.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid (Settled)',
                'payment_method' => 'Mandiri e-Money Tap',
                'payment_reference' => 'TRX-EMN-1010-8812',
                'paid_at' => '10 Oct 2026, 19:39 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'C*** H***',
                'driver_phone' => '+62 812-****-6301',
                'timeline' => [
                    ['time' => '10 Oct 16:20 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'Ingress logged', 'status' => 'success'],
                    ['time' => '10 Oct 19:39 WIB', 'event' => 'Payment Cleared', 'details' => 'Rp 20.000 paid', 'status' => 'success'],
                    ['time' => '10 Oct 19:40 WIB', 'event' => 'Exit Barrier Raised', 'details' => 'Departed', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261010-0088',
                'session_code' => 'SES-20261010-0088',
                'vehicle_plate' => 'B 2419 EFG',
                'vehicle_type' => 'EV',
                'vehicle_model' => 'Kia EV6 GT-Line AWD',
                'vehicle_color' => 'Moonscape Matte',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'area_id' => 'area-gi-b1',
                'area_name' => 'Basement 1 - EV Fast Hub',
                'slot_code' => 'GI-B1-03',
                'entry_time' => '10 Oct 2026, 14:10 WIB',
                'entry_time_raw' => '2026-10-10 14:10:00',
                'entry_gate_code' => 'GATE-GI-IN-01',
                'entry_gate_name' => 'Main Inbound West Gate 01',
                'entry_camera_code' => 'CAM-GI-IN01',
                'entry_anpr_confidence' => 99.7,
                'exit_time' => '10 Oct 2026, 18:25 WIB',
                'exit_time_raw' => '2026-10-10 18:25:00',
                'exit_gate_code' => 'GATE-GI-OUT-01',
                'exit_gate_name' => 'Exit Gate 1 (Thamrin)',
                'exit_camera_code' => 'CAM-GI-OUT01',
                'exit_anpr_confidence' => 99.4,
                'duration_minutes' => 255,
                'duration_formatted' => '4h 15m',
                'duration_type' => 'billed',
                'rate_hourly' => 8000,
                'base_fee' => 32000,
                'service_fee' => 0,
                'total_fee' => 32000,
                'formatted_fee' => 'Rp 32.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'auto_debited',
                'payment_status_label' => 'Auto-Debited (App)',
                'payment_method' => 'NusaPark In-App Auto-Pay',
                'payment_reference' => 'TRX-NUSA-1010-4491',
                'paid_at' => '10 Oct 2026, 18:24 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'R*** D***',
                'driver_phone' => '+62 813-****-2419',
                'timeline' => [
                    ['time' => '10 Oct 14:10 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'Ingress logged', 'status' => 'success'],
                    ['time' => '10 Oct 18:24 WIB', 'event' => 'Auto-Debit Cleared', 'details' => 'Rp 32.000 paid', 'status' => 'success'],
                    ['time' => '10 Oct 18:25 WIB', 'event' => 'Exit Gate Opened', 'details' => 'Departed', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261009-0072',
                'session_code' => 'SES-20261009-0072',
                'vehicle_plate' => 'B 5182 HIJ',
                'vehicle_type' => 'Car',
                'vehicle_model' => 'Mitsubishi Xpander Ultimate CVT',
                'vehicle_color' => 'Quartz White Pearl',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'area_id' => 'area-cp-p2',
                'area_name' => 'Parking Building P2',
                'slot_code' => 'CP-P2-08',
                'entry_time' => '09 Oct 2026, 13:00 WIB',
                'entry_time_raw' => '2026-10-09 13:00:00',
                'entry_gate_code' => 'GATE-CP-IN-01',
                'entry_gate_name' => 'Main North Inbound Gate',
                'entry_camera_code' => 'CAM-CP-IN01',
                'entry_anpr_confidence' => 98.6,
                'exit_time' => '09 Oct 2026, 16:30 WIB',
                'exit_time_raw' => '2026-10-09 16:30:00',
                'exit_gate_code' => 'GATE-CP-OUT-01',
                'exit_gate_name' => 'Exit Gate 2 (Outbound)',
                'exit_camera_code' => 'CAM-CP-OUT01',
                'exit_anpr_confidence' => 98.3,
                'duration_minutes' => 210,
                'duration_formatted' => '3h 30m',
                'duration_type' => 'billed',
                'rate_hourly' => 5000,
                'base_fee' => 20000,
                'service_fee' => 0,
                'total_fee' => 20000,
                'formatted_fee' => 'Rp 20.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid (Settled)',
                'payment_method' => 'Cashless Tap',
                'payment_reference' => 'TRX-FLZ-0910-1892',
                'paid_at' => '09 Oct 2026, 16:29 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'W*** K***',
                'driver_phone' => '+62 811-****-5182',
                'timeline' => [
                    ['time' => '09 Oct 13:00 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'Ingress logged', 'status' => 'success'],
                    ['time' => '09 Oct 16:30 WIB', 'event' => 'Exit Barrier Raised', 'details' => 'Departed', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'ses-20261008-0061',
                'session_code' => 'SES-20261008-0061',
                'vehicle_plate' => 'B 9371 KLM',
                'vehicle_type' => 'EV',
                'vehicle_model' => 'BYD Seal Performance AWD',
                'vehicle_color' => 'Aurora White',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'area_id' => 'area-xyz-b1',
                'area_name' => 'Basement 1 - North Wing (Car & EV)',
                'slot_code' => 'B1-EV-04',
                'entry_time' => '08 Oct 2026, 11:30 WIB',
                'entry_time_raw' => '2026-10-08 11:30:00',
                'entry_gate_code' => 'GATE-XYZ-IN-01',
                'entry_gate_name' => 'North Inbound Gate 01',
                'entry_camera_code' => 'CAM-XYZ-IN01',
                'entry_anpr_confidence' => 99.8,
                'exit_time' => '08 Oct 2026, 15:45 WIB',
                'exit_time_raw' => '2026-10-08 15:45:00',
                'exit_gate_code' => 'GATE-XYZ-OUT-01',
                'exit_gate_name' => 'South Outbound Gate 01',
                'exit_camera_code' => 'CAM-XYZ-OUT01',
                'exit_anpr_confidence' => 99.5,
                'duration_minutes' => 255,
                'duration_formatted' => '4h 15m',
                'duration_type' => 'billed',
                'rate_hourly' => 6000,
                'base_fee' => 25000,
                'service_fee' => 0,
                'total_fee' => 25000,
                'formatted_fee' => 'Rp 25.000',
                'session_status' => 'completed',
                'session_status_label' => 'Completed',
                'payment_status' => 'auto_debited',
                'payment_status_label' => 'Auto-Debited (App)',
                'payment_method' => 'NusaPark In-App Auto-Pay',
                'payment_reference' => 'TRX-NUSA-0810-7718',
                'paid_at' => '08 Oct 2026, 15:44 WIB',
                'is_flagged' => false,
                'flag_reason' => null,
                'flag_status' => 'None',
                'driver_name' => 'G*** T***',
                'driver_phone' => '+62 812-****-9371',
                'timeline' => [
                    ['time' => '08 Oct 11:30 WIB', 'event' => 'ANPR Ingress Detected', 'details' => 'Ingress logged', 'status' => 'success'],
                    ['time' => '08 Oct 15:45 WIB', 'event' => 'Exit Barrier Raised', 'details' => 'Departed', 'status' => 'success'],
                ],
            ],
        ];
    }

    /**
     * Load stored parking sessions from cache or default.
     */
    protected function loadStoredSessions(): array
    {
        return Cache::get(self::SESSIONS_CACHE_KEY, function () {
            $default = $this->getDefaultParkingSessions();
            Cache::put(self::SESSIONS_CACHE_KEY, $default, now()->addDays(30));
            return $default;
        });
    }

    /**
     * Save parking sessions to cache.
     */
    protected function saveSessions(array $sessions): void
    {
        Cache::put(self::SESSIONS_CACHE_KEY, $sessions, now()->addDays(30));
    }

    /**
     * Query and filter parking sessions for Page 28.
     */
    public function getParkingSessions(string $facilityId = 'all', array $filters = []): array
    {
        $sessions = $this->loadStoredSessions();

        // 1. Facility filter
        if ($facilityId !== 'all') {
            $sessions = array_filter($sessions, fn($s) => ($s['facility_id'] ?? '') === $facilityId);
        }

        // 2. Parking Area filter
        $area = $filters['area'] ?? 'all';
        if ($area !== 'all') {
            $sessions = array_filter($sessions, fn($s) => ($s['area_id'] ?? '') === $area);
        }

        // 3. Session Status filter (all, active, completed, attention)
        $status = $filters['status'] ?? 'all';
        if ($status !== 'all') {
            if ($status === 'attention') {
                $sessions = array_filter($sessions, fn($s) => ($s['session_status'] ?? '') === 'attention_required' || !empty($s['is_flagged']));
            } else {
                $sessions = array_filter($sessions, fn($s) => ($s['session_status'] ?? '') === $status);
            }
        }

        // 4. Payment Status filter (all, paid, pending, auto_debited, disputed)
        $paymentStatus = $filters['payment_status'] ?? 'all';
        if ($paymentStatus !== 'all') {
            $sessions = array_filter($sessions, fn($s) => ($s['payment_status'] ?? '') === $paymentStatus);
        }

        // 5. Date Period filter (today, yesterday, 7days, all)
        $period = $filters['period'] ?? 'all';
        if ($period !== 'all') {
            if ($period === 'today') {
                $sessions = array_filter($sessions, function($s) {
                    return str_contains($s['entry_time_raw'] ?? '', '2026-10-11')
                        || str_contains($s['entry_time'] ?? '', '11 Oct 2026');
                });
            } elseif ($period === 'yesterday') {
                $sessions = array_filter($sessions, function($s) {
                    return str_contains($s['entry_time_raw'] ?? '', '2026-10-10')
                        || str_contains($s['entry_time'] ?? '', '10 Oct 2026');
                });
            } elseif ($period === '7days') {
                $sessions = array_filter($sessions, function($s) {
                    $raw = $s['entry_time_raw'] ?? '';
                    return str_contains($raw, '2026-10-08')
                        || str_contains($raw, '2026-10-09')
                        || str_contains($raw, '2026-10-10')
                        || str_contains($raw, '2026-10-11');
                });
            }
        }

        // 6. Free text query search (plate, code, model, driver)
        $query = trim(strtolower($filters['q'] ?? ''));
        if ($query !== '') {
            $sessions = array_filter($sessions, function($s) use ($query) {
                return str_contains(strtolower($s['session_code'] ?? ''), $query)
                    || str_contains(strtolower(str_replace(' ', '', $s['vehicle_plate'] ?? '')), str_replace(' ', '', $query))
                    || str_contains(strtolower($s['vehicle_plate'] ?? ''), $query)
                    || str_contains(strtolower($s['vehicle_model'] ?? ''), $query)
                    || str_contains(strtolower($s['slot_code'] ?? ''), $query)
                    || str_contains(strtolower($s['facility_name'] ?? ''), $query)
                    || str_contains(strtolower($s['payment_method'] ?? ''), $query);
            });
        }

        // 7. Sorting
        $sort = $filters['sort'] ?? 'entry_desc';
        usort($sessions, function($a, $b) use ($sort) {
            switch ($sort) {
                case 'entry_asc':
                    return strcmp($a['entry_time_raw'] ?? '', $b['entry_time_raw'] ?? '');
                case 'entry_desc':
                    return strcmp($b['entry_time_raw'] ?? '', $a['entry_time_raw'] ?? '');
                case 'duration_desc':
                    return ($b['duration_minutes'] ?? 0) <=> ($a['duration_minutes'] ?? 0);
                case 'duration_asc':
                    return ($a['duration_minutes'] ?? 0) <=> ($b['duration_minutes'] ?? 0);
                case 'fee_desc':
                    return ($b['total_fee'] ?? 0) <=> ($a['total_fee'] ?? 0);
                case 'plate_asc':
                    return strcmp($a['vehicle_plate'] ?? '', $b['vehicle_plate'] ?? '');
                default:
                    return strcmp($b['entry_time_raw'] ?? '', $a['entry_time_raw'] ?? '');
            }
        });

        return array_values($sessions);
    }

    /**
     * Get single parking session by ID or code.
     */
    public function getParkingSession(string $id): ?array
    {
        $sessions = $this->loadStoredSessions();
        foreach ($sessions as $s) {
            if ($s['id'] === $id || ($s['session_code'] ?? '') === $id) {
                return $s;
            }
        }
        return null;
    }

    /**
     * Get operational summary metrics for Page 28.
     */
    public function getSessionSummaryMetrics(string $facilityId = 'all', string $period = 'all'): array
    {
        $all = $this->loadStoredSessions();

        if ($facilityId !== 'all') {
            $all = array_filter($all, fn($s) => ($s['facility_id'] ?? '') === $facilityId);
        }

        $activeCount = 0;
        $completedCount = 0;
        $attentionCount = 0;
        $totalFees = 0;
        $totalDurationMinutes = 0;
        $sessionCountForDuration = 0;

        foreach ($all as $s) {
            // Check period match for counts
            $isPeriodMatch = true;
            if ($period === 'today') {
                $isPeriodMatch = str_contains($s['entry_time_raw'] ?? '', '2026-10-11');
            } elseif ($period === 'yesterday') {
                $isPeriodMatch = str_contains($s['entry_time_raw'] ?? '', '2026-10-10');
            } elseif ($period === '7days') {
                $raw = $s['entry_time_raw'] ?? '';
                $isPeriodMatch = str_contains($raw, '2026-10-08')
                    || str_contains($raw, '2026-10-09')
                    || str_contains($raw, '2026-10-10')
                    || str_contains($raw, '2026-10-11');
            }

            if ($s['session_status'] === 'active') {
                $activeCount++;
            }

            if ($s['session_status'] === 'attention_required' || !empty($s['is_flagged'])) {
                $attentionCount++;
            }

            if ($isPeriodMatch) {
                if ($s['session_status'] === 'completed') {
                    $completedCount++;
                }
                $totalFees += ($s['total_fee'] ?? 0);
                $totalDurationMinutes += ($s['duration_minutes'] ?? 0);
                $sessionCountForDuration++;
            }
        }

        $avgMinutes = $sessionCountForDuration > 0 ? (int)round($totalDurationMinutes / $sessionCountForDuration) : 0;
        $avgHours = floor($avgMinutes / 60);
        $avgRemMin = $avgMinutes % 60;
        $formattedAvgDuration = $avgHours > 0 ? "{$avgHours}h {$avgRemMin}m" : "{$avgRemMin}m";

        return [
            'facility_id' => $facilityId,
            'period' => $period,
            'active_sessions_count' => $activeCount,
            'completed_sessions_count' => $completedCount,
            'attention_required_count' => $attentionCount,
            'total_period_fee' => $totalFees,
            'formatted_total_fee' => 'Rp ' . number_format($totalFees, 0, ',', '.'),
            'average_duration_formatted' => $formattedAvgDuration,
            'total_records_count' => count($all),
            'last_sync_time' => date('d M Y, H:i') . ' WIB',
        ];
    }

    /**
     * Operator action to flag a parking session for manual investigation.
     */
    public function flagParkingSession(string $id, string $reason, string $notes = ''): ?array
    {
        $sessions = $this->loadStoredSessions();
        $target = null;

        foreach ($sessions as &$s) {
            if ($s['id'] === $id || ($s['session_code'] ?? '') === $id) {
                $s['is_flagged'] = true;
                $s['flag_reason'] = $reason;
                $s['flag_status'] = 'Open Review';
                $s['session_status'] = 'attention_required';
                $s['session_status_label'] = 'Attention Required';
                $s['operator_notes'] = $notes;

                $s['timeline'][] = [
                    'time' => date('H:i:s') . ' WIB',
                    'event' => 'Operator Flag Raised',
                    'details' => "Flagged by Operations Lead: {$reason}" . ($notes ? " ({$notes})" : ""),
                    'status' => 'warning',
                ];

                $target = $s;
                break;
            }
        }

        if ($target) {
            $this->saveSessions($sessions);
        }

        return $target;
    }

    /**
     * Operator action to resolve an attention/flag on a parking session.
     */
    public function resolveParkingSession(string $id, string $notes = ''): ?array
    {
        $sessions = $this->loadStoredSessions();
        $target = null;

        foreach ($sessions as &$s) {
            if ($s['id'] === $id || ($s['session_code'] ?? '') === $id) {
                $s['is_flagged'] = false;
                $s['flag_status'] = 'Resolved';
                $s['session_status'] = $s['exit_time'] ? 'completed' : 'active';
                $s['session_status_label'] = $s['exit_time'] ? 'Completed' : 'Active (Parked)';
                $s['resolved_at'] = date('d M Y, H:i:s') . ' WIB';
                $s['operator_notes'] = $notes;

                $s['timeline'][] = [
                    'time' => date('H:i:s') . ' WIB',
                    'event' => 'Operational Flag Cleared',
                    'details' => 'Flag cleared by operator: ' . ($notes ?: 'Verification completed satisfactorily.'),
                    'status' => 'success',
                ];

                $target = $s;
                break;
            }
        }

        if ($target) {
            $this->saveSessions($sessions);
        }

        return $target;
    }

    /**
     * Perform an on-demand ping & diagnostic probe on an IoT device.
     */
    public function pingIotDevice(string $id): array
    {
        $device = $this->getIotDevice($id);
        if (!$device) {
            return ['success' => false, 'message' => 'Device not found.'];
        }

        $isOnline = strtolower($device['connectivity']) !== 'offline';
        $latency = $isOnline ? rand(8, 26) : 0;

        return [
            'success' => $isOnline,
            'device_id' => $device['id'],
            'device_code' => $device['device_code'],
            'ip_address' => $device['ip_address'],
            'latency_ms' => $latency,
            'packet_loss' => $isOnline ? 0 : 100,
            'protocol' => $device['protocol'],
            'status' => $isOnline ? 'Probe Success (ACK)' : 'Host Unreachable (Timeout)',
            'timestamp' => date('d M Y, H:i:s') . ' WIB',
        ];
    }

    /* =========================================================================
     * PHASE 2, PAGE 29: VENDOR PAYMENT TRANSACTIONS
     * ========================================================================= */

    /**
     * Default list of payment transactions across authorized facilities.
     */
    protected function getDefaultTransactions(): array
    {
        return [
            // --- 1. TODAY'S TRANSACTIONS (11 OCT 2026) ---
            [
                'id' => 'trx-20261011-9912',
                'transaction_reference' => 'TRX-QRIS-20261011-9912',
                'provider_reference' => 'MDT-QRIS-992140182',
                'created_at' => '11 Oct 2026, 12:54 WIB',
                'created_at_raw' => '2026-10-11 12:54:15',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'terminal_lane' => 'Exit Lane 1 (South Gate)',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261011-0058',
                'vehicle_plate' => 'B 5678 ABC',
                'vehicle_model' => 'Honda Vario 160 CBS',
                'vehicle_type' => 'Motorcycle',
                'amount' => 6000,
                'formatted_amount' => 'Rp 6.000',
                'base_fee' => 6000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'qris',
                'payment_method_label' => 'QRIS Instant Pay',
                'payment_channel' => 'BCA Mobile (via QRIS Network)',
                'gateway_provider' => 'Midtrans Payment Gateway',
                'gateway_acquirer' => 'Bank Central Asia (BCA)',
                'auth_approval_code' => 'BCA-QR-904122',
                'transaction_status' => 'successful',
                'transaction_status_label' => 'Successful',
                'settlement_status' => 'settled',
                'settlement_status_label' => 'Settled (Funds Cleared)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => null,
                'customer_mask' => 'M*** A*** (BCA Mobile user)',
                'timeline' => [
                    ['time' => '12:54:02 WIB', 'event' => 'Dynamic QRIS Generated', 'details' => 'Payable Rp 6.000 generated for session SES-20261011-0058', 'status' => 'info'],
                    ['time' => '12:54:15 WIB', 'event' => 'Payment Captured & Verified', 'details' => 'Midtrans callback ACK received with approval BCA-QR-904122', 'status' => 'success'],
                    ['time' => '12:54:18 WIB', 'event' => 'Barrier Gate Trigger ACK', 'details' => 'Loop detector signal sent to GATE-XYZ-OUT-01', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'trx-20261011-8891',
                'transaction_reference' => 'TRX-NUSA-20261011-8891',
                'provider_reference' => 'NUSA-ALPR-AUTOPAY-0088',
                'created_at' => '11 Oct 2026, 14:15 WIB',
                'created_at_raw' => '2026-10-11 14:15:00',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'terminal_lane' => 'Entry Lane 1 (North Portal)',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261011-0088',
                'vehicle_plate' => 'B 1234 XYZ',
                'vehicle_model' => 'Toyota Fortuner 2.8 GR Sport',
                'vehicle_type' => 'Car',
                'amount' => 10000,
                'formatted_amount' => 'Rp 10.000',
                'base_fee' => 10000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'auto_pay',
                'payment_method_label' => 'In-App Auto-Pay',
                'payment_channel' => 'NusaPark GoPay Linked Wallet',
                'gateway_provider' => 'NusaPark Seamless Auto-Debit Engine',
                'gateway_acquirer' => 'GoTo Financial / GoPay',
                'auth_approval_code' => 'PENDING-EXIT-CAPTURE',
                'transaction_status' => 'pending',
                'transaction_status_label' => 'Pending (In Progress)',
                'settlement_status' => 'pending_settlement',
                'settlement_status_label' => 'Pre-Authorized (Awaiting Exit)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => 'Pre-authorization token active; final charge computed upon outbound egress.',
                'customer_mask' => 'A*** W*** (Linked GoPay +62 812-****-9812)',
                'timeline' => [
                    ['time' => '14:15:02 WIB', 'event' => 'Pre-Authorization Token Bound', 'details' => 'ALPR ingress camera CAM-XYZ-IN01 validated driver wallet balance', 'status' => 'info'],
                    ['time' => '14:15:06 WIB', 'event' => 'Session Ingress Verified', 'details' => 'Vehicle parked inside Basement 1. Ongoing accrual.', 'status' => 'info'],
                ],
            ],
            [
                'id' => 'trx-20261011-8041',
                'transaction_reference' => 'TRX-FLZ-8041920',
                'provider_reference' => 'BCA-FLZ-SAM-209481',
                'created_at' => '11 Oct 2026, 12:50 WIB',
                'created_at_raw' => '2026-10-11 12:50:40',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'terminal_lane' => 'Exit Lane 2 (Outbound)',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261011-0055',
                'vehicle_plate' => 'B 2291 TJA',
                'vehicle_model' => 'Toyota Kijang Innova Zenix 2.0 V',
                'vehicle_type' => 'Car',
                'amount' => 18000,
                'formatted_amount' => 'Rp 18.000',
                'base_fee' => 18000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'nfc_card',
                'payment_method_label' => 'BCA Flazz Tap',
                'payment_channel' => 'Contactless NFC POS SAM Reader',
                'gateway_provider' => 'Bank Central Asia Contactless Host',
                'gateway_acquirer' => 'BCA Electronic Money Network',
                'auth_approval_code' => 'FLZ-APPR-77041',
                'transaction_status' => 'successful',
                'transaction_status_label' => 'Successful',
                'settlement_status' => 'settled',
                'settlement_status_label' => 'Settled (Funds Cleared)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => null,
                'customer_mask' => 'Flazz Chip UID: 04-A2-89-**-**-60',
                'timeline' => [
                    ['time' => '12:50:38 WIB', 'event' => 'Contactless Card Read', 'details' => 'SAM security module decrypted purse balance', 'status' => 'info'],
                    ['time' => '12:50:40 WIB', 'event' => 'Offline Purse Deducted', 'details' => 'Deducted Rp 18.000 (Remaining balance Rp 142.000)', 'status' => 'success'],
                    ['time' => '12:50:42 WIB', 'event' => 'Boom Gate Lifted', 'details' => 'GATE-CP-OUT-01 raised boom arm', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'trx-20261011-7719',
                'transaction_reference' => 'TRX-EMN-771920',
                'provider_reference' => 'MDR-EMN-SAM-491029',
                'created_at' => '11 Oct 2026, 12:46 WIB',
                'created_at_raw' => '2026-10-11 12:46:30',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'terminal_lane' => 'Exit Gate 1 (Thamrin)',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261011-0051',
                'vehicle_plate' => 'D 1804 SB',
                'vehicle_model' => 'Honda Civic RS 1.5 Turbo',
                'vehicle_type' => 'Car',
                'amount' => 24000,
                'formatted_amount' => 'Rp 24.000',
                'base_fee' => 24000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'nfc_card',
                'payment_method_label' => 'Mandiri e-Money Tap',
                'payment_channel' => 'Mandiri Secure SAM Terminal',
                'gateway_provider' => 'Bank Mandiri e-Money Gateway',
                'gateway_acquirer' => 'Bank Mandiri',
                'auth_approval_code' => 'MDR-EMN-109283',
                'transaction_status' => 'successful',
                'transaction_status_label' => 'Successful',
                'settlement_status' => 'settled',
                'settlement_status_label' => 'Settled (Funds Cleared)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => null,
                'customer_mask' => 'e-Money Serial: 6032-98**-****-4410',
                'timeline' => [
                    ['time' => '12:46:25 WIB', 'event' => 'SAM Chip Handshake', 'details' => 'SAM security validation OK', 'status' => 'info'],
                    ['time' => '12:46:30 WIB', 'event' => 'Purse Debit Succeeded', 'details' => 'Captured Rp 24.000 from electronic purse', 'status' => 'success'],
                    ['time' => '12:46:34 WIB', 'event' => 'Egress Verified', 'details' => 'Vehicle cleared GATE-GI-OUT-01', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'trx-20261011-4011',
                'transaction_reference' => 'TRX-NUSA-20261011-4011',
                'provider_reference' => 'NUSA-ALPR-20261011-901',
                'created_at' => '11 Oct 2026, 12:29 WIB',
                'created_at_raw' => '2026-10-11 12:29:45',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'terminal_lane' => 'Exit Lane 2 (East Outbound)',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261011-0048',
                'vehicle_plate' => 'B 1120 FGH',
                'vehicle_model' => 'Hyundai Creta Prime Two-Tone',
                'vehicle_type' => 'Car',
                'amount' => 20000,
                'formatted_amount' => 'Rp 20.000',
                'base_fee' => 20000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'auto_pay',
                'payment_method_label' => 'In-App Auto-Pay',
                'payment_channel' => 'NusaPark In-App Linked GoPay',
                'gateway_provider' => 'Midtrans Direct Debit Host',
                'gateway_acquirer' => 'GoPay / Bank Jago',
                'auth_approval_code' => 'MDT-JAGO-881902',
                'transaction_status' => 'successful',
                'transaction_status_label' => 'Successful',
                'settlement_status' => 'settled',
                'settlement_status_label' => 'Settled (Funds Cleared)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => null,
                'customer_mask' => 'D*** F*** (Verified NusaPark user)',
                'timeline' => [
                    ['time' => '12:29:40 WIB', 'event' => 'Exit Optical Match', 'details' => 'CAM-XYZ-OUT02 confirmed plate match B 1120 FGH (99.2%)', 'status' => 'info'],
                    ['time' => '12:29:45 WIB', 'event' => 'Auto-Debit Captured', 'details' => 'Charged Rp 20.000 via linked GoPay account', 'status' => 'success'],
                    ['time' => '12:29:48 WIB', 'event' => 'Express Egress Boom Lifted', 'details' => 'GATE-XYZ-OUT-02 opened automatically', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'trx-20261011-3820',
                'transaction_reference' => 'TRX-NUSA-20261011-3820',
                'provider_reference' => 'NUSA-ALPR-20261011-744',
                'created_at' => '11 Oct 2026, 12:14 WIB',
                'created_at_raw' => '2026-10-11 12:14:50',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'terminal_lane' => 'Exit Gate 1 (Thamrin)',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261011-0044',
                'vehicle_plate' => 'B 9801 PLM',
                'vehicle_model' => 'BMW 330i M Sport Pro',
                'vehicle_type' => 'Car',
                'amount' => 28000,
                'formatted_amount' => 'Rp 28.000',
                'base_fee' => 28000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'auto_pay',
                'payment_method_label' => 'In-App Auto-Pay',
                'payment_channel' => 'NusaPark OVO Direct Debit',
                'gateway_provider' => 'Xendit E-Wallet Engine',
                'gateway_acquirer' => 'OVO / GrabPay Network',
                'auth_approval_code' => 'XND-OVO-399104',
                'transaction_status' => 'successful',
                'transaction_status_label' => 'Successful',
                'settlement_status' => 'settled',
                'settlement_status_label' => 'Settled (Funds Cleared)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => null,
                'customer_mask' => 'M*** R*** (OVO user)',
                'timeline' => [
                    ['time' => '12:14:48 WIB', 'event' => 'Exit Optical Match', 'details' => 'CAM-GI-OUT01 matched plate B 9801 PLM', 'status' => 'info'],
                    ['time' => '12:14:50 WIB', 'event' => 'OVO Direct Debit Cleared', 'details' => 'Deducted Rp 28.000 from customer wallet', 'status' => 'success'],
                    ['time' => '12:14:55 WIB', 'event' => 'Barrier Gate Raised', 'details' => 'GATE-GI-OUT-01 opened', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'trx-20261011-3001',
                'transaction_reference' => 'TRX-QRIS-20261011-3001',
                'provider_reference' => 'XND-QRIS-7740192',
                'created_at' => '11 Oct 2026, 11:44 WIB',
                'created_at_raw' => '2026-10-11 11:44:30',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'terminal_lane' => 'Exit Gate 2 (Outbound)',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261011-0040',
                'vehicle_plate' => 'B 4419 JKL',
                'vehicle_model' => 'Toyota Avanza 1.5 G CVT',
                'vehicle_type' => 'Car',
                'amount' => 20000,
                'formatted_amount' => 'Rp 20.000',
                'base_fee' => 20000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'qris',
                'payment_method_label' => 'QRIS Instant Pay',
                'payment_channel' => 'Mandiri Livin (via QRIS Network)',
                'gateway_provider' => 'Xendit QRIS Gateway',
                'gateway_acquirer' => 'Bank Mandiri (Persero) Tbk',
                'auth_approval_code' => 'MDR-QR-38104',
                'transaction_status' => 'successful',
                'transaction_status_label' => 'Successful',
                'settlement_status' => 'settled',
                'settlement_status_label' => 'Settled (Funds Cleared)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => null,
                'customer_mask' => 'B*** S*** (Mandiri Livin)',
                'timeline' => [
                    ['time' => '11:44:20 WIB', 'event' => 'Dynamic QRIS Generated', 'details' => 'Payable Rp 20.000 rendered on POS display', 'status' => 'info'],
                    ['time' => '11:44:30 WIB', 'event' => 'QRIS Settlement Cleared', 'details' => 'Payment received successfully', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'trx-20261011-4210',
                'transaction_reference' => 'TRX-RSV-20261011-4210',
                'provider_reference' => 'MDT-CC-8092144',
                'created_at' => '11 Oct 2026, 11:20 WIB',
                'created_at_raw' => '2026-10-11 11:20:10',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'terminal_lane' => 'Mobile App Advance Booking',
                'payable_type' => 'reservation',
                'payable_type_label' => 'Advance Reservation',
                'payable_reference' => 'NP-20261011-00421',
                'vehicle_plate' => 'B 9012 EV',
                'vehicle_model' => 'Hyundai Ioniq 5 Signature Long Range',
                'vehicle_type' => 'EV',
                'amount' => 35000,
                'formatted_amount' => 'Rp 35.000',
                'base_fee' => 30000,
                'service_fee' => 5000,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'ewallet',
                'payment_method_label' => 'E-Wallet (GoPay)',
                'payment_channel' => 'GoPay Online Checkout',
                'gateway_provider' => 'Midtrans Online Payments',
                'gateway_acquirer' => 'GoTo Financial',
                'auth_approval_code' => 'MDT-GP-772102',
                'transaction_status' => 'successful',
                'transaction_status_label' => 'Successful',
                'settlement_status' => 'settled',
                'settlement_status_label' => 'Settled (Funds Cleared)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => null,
                'customer_mask' => 'K*** T*** (Advance EV bay reservation)',
                'timeline' => [
                    ['time' => '11:20:05 WIB', 'event' => 'Reservation Token Issued', 'details' => 'Slot GI-B1-05 reserved for 13:30 ingress', 'status' => 'info'],
                    ['time' => '11:20:10 WIB', 'event' => 'Booking Fee Captured', 'details' => 'Rp 35.000 settled', 'status' => 'success'],
                ],
            ],

            // --- 2. ANOMALY / DISPUTED / FAILED TRANSACTIONS (REQUIRING ATTENTION) ---
            [
                'id' => 'trx-20261011-0052',
                'transaction_reference' => 'TRX-FLZ-1011-0052',
                'provider_reference' => 'BCA-FLZ-ERR-10029',
                'created_at' => '11 Oct 2026, 16:00 WIB',
                'created_at_raw' => '2026-10-11 16:00:22',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'terminal_lane' => 'Exit Gate 2 (Outbound)',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261011-0052',
                'vehicle_plate' => 'D 1999 ZZZ',
                'vehicle_model' => 'Daihatsu Rocky 1.0T R TC',
                'vehicle_type' => 'Car',
                'amount' => 40000,
                'formatted_amount' => 'Rp 40.000',
                'base_fee' => 40000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'nfc_card',
                'payment_method_label' => 'BCA Flazz Tap',
                'payment_channel' => 'Contactless NFC POS Terminal',
                'gateway_provider' => 'Bank Central Asia Contactless Host',
                'gateway_acquirer' => 'BCA Electronic Money Network',
                'auth_approval_code' => 'DECLINED-INSUFFICIENT-FUNDS',
                'transaction_status' => 'failed',
                'transaction_status_label' => 'Declined (Failed)',
                'settlement_status' => 'on_hold',
                'settlement_status_label' => 'Declined by Host',
                'reconciliation_flag' => true,
                'reconciliation_notes' => 'Card balance (Rp 8.500) insufficient for total fare Rp 40.000. Customer attending cash payment counter.',
                'customer_mask' => 'A*** R*** (Flazz 04-99-**-**)',
                'timeline' => [
                    ['time' => '16:00:20 WIB', 'event' => 'NFC Contactless Card Tapped', 'details' => 'Card presented at GATE-CP-OUT-01 terminal', 'status' => 'info'],
                    ['time' => '16:00:22 WIB', 'event' => 'Transaction Declined', 'details' => 'Host returned code 51: Insufficient purse balance', 'status' => 'warning'],
                    ['time' => '16:00:25 WIB', 'event' => 'Barrier Interlock Engaged', 'details' => 'Gate remained closed; attendant dispatched', 'status' => 'warning'],
                ],
            ],
            [
                'id' => 'trx-20261010-0012',
                'transaction_reference' => 'TRX-VAL-1010-0012',
                'provider_reference' => 'PENDING-SETTLEMENT-RECON',
                'created_at' => '10 Oct 2026, 10:20 WIB',
                'created_at_raw' => '2026-10-10 10:20:00',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'terminal_lane' => 'Valet Cashier Counter Desk',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261010-0012',
                'vehicle_plate' => 'B 8821 RFS',
                'vehicle_model' => 'Mercedes-Benz E 300 AMG Line',
                'vehicle_type' => 'VIP / Luxury',
                'amount' => 300000,
                'formatted_amount' => 'Rp 300.000',
                'base_fee' => 300000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'cashless_kiosk',
                'payment_method_label' => 'Valet Counter Billing',
                'payment_channel' => 'VIP Reception Desk',
                'gateway_provider' => 'Mall Valet Management System',
                'gateway_acquirer' => 'On-Site Terminal',
                'auth_approval_code' => 'HOLD-OVERSTAY-DISPUTE',
                'transaction_status' => 'disputed',
                'transaction_status_label' => 'Disputed (On Hold)',
                'settlement_status' => 'on_hold',
                'settlement_status_label' => 'Audit Hold',
                'reconciliation_flag' => true,
                'reconciliation_notes' => 'Vehicle parked over 24 hours without declaration. Settlement pending driver counter check-out.',
                'customer_mask' => 'B*** K*** (VIP Valet token #V-082)',
                'timeline' => [
                    ['time' => '10 Oct 10:20 WIB', 'event' => 'Valet Check-in Token Created', 'details' => 'VIP pass issued', 'status' => 'info'],
                    ['time' => '11 Oct 10:20 WIB', 'event' => 'Overstay Audit Flag Raised', 'details' => 'Tariff recalculated to Rp 300.000. Supervisor investigation needed.', 'status' => 'warning'],
                ],
            ],

            // --- 3. REFUNDED TRANSACTIONS ---
            [
                'id' => 'trx-20261010-3881',
                'transaction_reference' => 'TRX-RSV-20261010-3881',
                'provider_reference' => 'XND-RFD-20261010-091',
                'created_at' => '10 Oct 2026, 14:00 WIB',
                'created_at_raw' => '2026-10-10 14:00:00',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'terminal_lane' => 'Mobile App Online Booking',
                'payable_type' => 'reservation',
                'payable_type_label' => 'Advance Reservation',
                'payable_reference' => 'NP-20261010-00388',
                'vehicle_plate' => 'B 2841 SKT',
                'vehicle_model' => 'Wuling BinguoEV 333km Premium',
                'vehicle_type' => 'EV',
                'amount' => 25000,
                'formatted_amount' => 'Rp 25.000',
                'base_fee' => 25000,
                'service_fee' => 0,
                'refunded_amount' => 25000,
                'formatted_refunded_amount' => 'Rp 25.000',
                'payment_method' => 'ewallet',
                'payment_method_label' => 'E-Wallet (GoPay)',
                'payment_channel' => 'GoPay In-App Refund',
                'gateway_provider' => 'Xendit E-Wallet Engine',
                'gateway_acquirer' => 'GoTo Financial',
                'auth_approval_code' => 'RFD-XND-77192',
                'transaction_status' => 'refunded',
                'transaction_status_label' => 'Refunded',
                'settlement_status' => 'refunded',
                'settlement_status_label' => 'Reversed (100% Refunded)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => 'Customer cancelled reservation >2h prior to booking window. Automatic 100% policy refund issued.',
                'customer_mask' => 'F*** N*** (+62 812-****-3041)',
                'timeline' => [
                    ['time' => '10 Oct 14:00 WIB', 'event' => 'Initial Reservation Paid', 'details' => 'Captured Rp 25.000 via GoPay', 'status' => 'success'],
                    ['time' => '10 Oct 14:45 WIB', 'event' => 'Cancellation Requested', 'details' => 'Customer triggered self-service cancellation', 'status' => 'info'],
                    ['time' => '10 Oct 14:46 WIB', 'event' => 'Refund Succeeded', 'details' => 'Full Rp 25.000 returned to GoPay wallet (Ref RFD-XND-77192)', 'status' => 'success'],
                ],
            ],

            // --- 4. PREVIOUS HISTORICAL TRANSACTIONS (PAST 7 DAYS) ---
            [
                'id' => 'trx-20261010-8812',
                'transaction_reference' => 'TRX-EMN-1010-8812',
                'provider_reference' => 'MDR-EMN-SAM-901412',
                'created_at' => '10 Oct 2026, 19:39 WIB',
                'created_at_raw' => '2026-10-10 19:39:10',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'terminal_lane' => 'South Outbound Gate 01',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261010-0095',
                'vehicle_plate' => 'B 6301 BCD',
                'vehicle_model' => 'Toyota Corolla Cross Hybrid',
                'vehicle_type' => 'Car',
                'amount' => 20000,
                'formatted_amount' => 'Rp 20.000',
                'base_fee' => 20000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'nfc_card',
                'payment_method_label' => 'Mandiri e-Money Tap',
                'payment_channel' => 'Mandiri Secure SAM Terminal',
                'gateway_provider' => 'Bank Mandiri e-Money Gateway',
                'gateway_acquirer' => 'Bank Mandiri',
                'auth_approval_code' => 'MDR-EMN-88120',
                'transaction_status' => 'successful',
                'transaction_status_label' => 'Successful',
                'settlement_status' => 'settled',
                'settlement_status_label' => 'Settled (Funds Cleared)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => null,
                'customer_mask' => 'C*** H*** (e-Money user)',
                'timeline' => [
                    ['time' => '10 Oct 19:39 WIB', 'event' => 'Purse Debit Succeeded', 'details' => 'Captured Rp 20.000', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'trx-20261010-4491',
                'transaction_reference' => 'TRX-NUSA-1010-4491',
                'provider_reference' => 'NUSA-ALPR-1010-332',
                'created_at' => '10 Oct 2026, 18:24 WIB',
                'created_at_raw' => '2026-10-10 18:24:00',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'terminal_lane' => 'Exit Gate 1 (Thamrin)',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261010-0088',
                'vehicle_plate' => 'B 2419 EFG',
                'vehicle_model' => 'Kia EV6 GT-Line AWD',
                'vehicle_type' => 'EV',
                'amount' => 32000,
                'formatted_amount' => 'Rp 32.000',
                'base_fee' => 32000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'auto_pay',
                'payment_method_label' => 'In-App Auto-Pay',
                'payment_channel' => 'NusaPark In-App Linked Wallet',
                'gateway_provider' => 'Midtrans Direct Debit Host',
                'gateway_acquirer' => 'GoPay / Bank Jago',
                'auth_approval_code' => 'MDT-JAGO-1010-449',
                'transaction_status' => 'successful',
                'transaction_status_label' => 'Successful',
                'settlement_status' => 'settled',
                'settlement_status_label' => 'Settled (Funds Cleared)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => null,
                'customer_mask' => 'R*** D*** (NusaPark Auto-Pay)',
                'timeline' => [
                    ['time' => '10 Oct 18:24 WIB', 'event' => 'Auto-Debit Succeeded', 'details' => 'Captured Rp 32.000', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'trx-20261009-1892',
                'transaction_reference' => 'TRX-FLZ-0910-1892',
                'provider_reference' => 'BCA-FLZ-SAM-0910-112',
                'created_at' => '09 Oct 2026, 16:29 WIB',
                'created_at_raw' => '2026-10-09 16:29:00',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'terminal_lane' => 'Exit Gate 2 (Outbound)',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261009-0072',
                'vehicle_plate' => 'B 5182 HIJ',
                'vehicle_model' => 'Mitsubishi Xpander Ultimate CVT',
                'vehicle_type' => 'Car',
                'amount' => 20000,
                'formatted_amount' => 'Rp 20.000',
                'base_fee' => 20000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'nfc_card',
                'payment_method_label' => 'BCA Flazz Tap',
                'payment_channel' => 'Contactless NFC POS SAM Reader',
                'gateway_provider' => 'Bank Central Asia Contactless Host',
                'gateway_acquirer' => 'BCA Electronic Money Network',
                'auth_approval_code' => 'FLZ-APPR-0910',
                'transaction_status' => 'successful',
                'transaction_status_label' => 'Successful',
                'settlement_status' => 'settled',
                'settlement_status_label' => 'Settled (Funds Cleared)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => null,
                'customer_mask' => 'W*** K*** (Flazz 04-51-**-**)',
                'timeline' => [
                    ['time' => '09 Oct 16:29 WIB', 'event' => 'Purse Debit Succeeded', 'details' => 'Captured Rp 20.000', 'status' => 'success'],
                ],
            ],
            [
                'id' => 'trx-20261008-7718',
                'transaction_reference' => 'TRX-NUSA-0810-7718',
                'provider_reference' => 'NUSA-ALPR-0810-192',
                'created_at' => '08 Oct 2026, 15:44 WIB',
                'created_at_raw' => '2026-10-08 15:44:00',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'terminal_lane' => 'South Outbound Gate 01',
                'payable_type' => 'session',
                'payable_type_label' => 'Parking Session',
                'payable_reference' => 'SES-20261008-0061',
                'vehicle_plate' => 'B 9371 KLM',
                'vehicle_model' => 'BYD Seal Performance AWD',
                'vehicle_type' => 'EV',
                'amount' => 25000,
                'formatted_amount' => 'Rp 25.000',
                'base_fee' => 25000,
                'service_fee' => 0,
                'refunded_amount' => 0,
                'formatted_refunded_amount' => 'Rp 0',
                'payment_method' => 'auto_pay',
                'payment_method_label' => 'In-App Auto-Pay',
                'payment_channel' => 'NusaPark Linked Wallet',
                'gateway_provider' => 'Midtrans Direct Debit Host',
                'gateway_acquirer' => 'GoPay / Bank Jago',
                'auth_approval_code' => 'MDT-0810-771',
                'transaction_status' => 'successful',
                'transaction_status_label' => 'Successful',
                'settlement_status' => 'settled',
                'settlement_status_label' => 'Settled (Funds Cleared)',
                'reconciliation_flag' => false,
                'reconciliation_notes' => null,
                'customer_mask' => 'G*** T*** (NusaPark Auto-Pay)',
                'timeline' => [
                    ['time' => '08 Oct 15:44 WIB', 'event' => 'Auto-Debit Succeeded', 'details' => 'Captured Rp 25.000', 'status' => 'success'],
                ],
            ],
        ];
    }

    /**
     * Load stored payment transactions from cache or default.
     */
    protected function loadStoredTransactions(): array
    {
        return Cache::get(self::TRANSACTIONS_CACHE_KEY, function () {
            $default = $this->getDefaultTransactions();
            Cache::put(self::TRANSACTIONS_CACHE_KEY, $default, now()->addDays(30));
            return $default;
        });
    }

    /**
     * Save payment transactions to cache.
     */
    protected function saveTransactions(array $transactions): void
    {
        Cache::put(self::TRANSACTIONS_CACHE_KEY, $transactions, now()->addDays(30));
    }

    /**
     * Query and filter payment transactions for Page 29.
     */
    public function getTransactions(string $facilityId = 'all', array $filters = []): array
    {
        $transactions = $this->loadStoredTransactions();

        // 1. Facility filter
        if ($facilityId !== 'all') {
            $transactions = array_filter($transactions, fn($t) => ($t['facility_id'] ?? '') === $facilityId);
        }

        // 2. Transaction Status filter (successful, pending, failed, refunded, disputed)
        $status = $filters['status'] ?? 'all';
        if ($status !== 'all') {
            $transactions = array_filter($transactions, fn($t) => ($t['transaction_status'] ?? '') === $status);
        }

        // 3. Payment Method filter (qris, nfc_card, auto_pay, ewallet, cashless_kiosk)
        $method = $filters['payment_method'] ?? 'all';
        if ($method !== 'all') {
            $transactions = array_filter($transactions, fn($t) => ($t['payment_method'] ?? '') === $method);
        }

        // 4. Settlement Status filter (settled, pending_settlement, on_hold, refunded)
        $settlement = $filters['settlement_status'] ?? 'all';
        if ($settlement !== 'all') {
            $transactions = array_filter($transactions, fn($t) => ($t['settlement_status'] ?? '') === $settlement);
        }

        // 5. Date Period filter (today, yesterday, 7days, all)
        $period = $filters['period'] ?? 'all';
        if ($period !== 'all') {
            if ($period === 'today') {
                $transactions = array_filter($transactions, function($t) {
                    return str_contains($t['created_at_raw'] ?? '', '2026-10-11')
                        || str_contains($t['created_at'] ?? '', '11 Oct 2026');
                });
            } elseif ($period === 'yesterday') {
                $transactions = array_filter($transactions, function($t) {
                    return str_contains($t['created_at_raw'] ?? '', '2026-10-10')
                        || str_contains($t['created_at'] ?? '', '10 Oct 2026');
                });
            } elseif ($period === '7days') {
                $transactions = array_filter($transactions, function($t) {
                    $raw = $t['created_at_raw'] ?? '';
                    return str_contains($raw, '2026-10-08')
                        || str_contains($raw, '2026-10-09')
                        || str_contains($raw, '2026-10-10')
                        || str_contains($raw, '2026-10-11');
                });
            }
        }

        // 6. Free text query search (reference, provider ref, payable ref, plate, model)
        $query = trim(strtolower($filters['q'] ?? ''));
        if ($query !== '') {
            $transactions = array_filter($transactions, function($t) use ($query) {
                return str_contains(strtolower($t['transaction_reference'] ?? ''), $query)
                    || str_contains(strtolower($t['provider_reference'] ?? ''), $query)
                    || str_contains(strtolower($t['payable_reference'] ?? ''), $query)
                    || str_contains(strtolower(str_replace(' ', '', $t['vehicle_plate'] ?? '')), str_replace(' ', '', $query))
                    || str_contains(strtolower($t['vehicle_plate'] ?? ''), $query)
                    || str_contains(strtolower($t['vehicle_model'] ?? ''), $query)
                    || str_contains(strtolower($t['facility_name'] ?? ''), $query)
                    || str_contains(strtolower($t['gateway_provider'] ?? ''), $query);
            });
        }

        // 7. Sorting
        $sort = $filters['sort'] ?? 'date_desc';
        usort($transactions, function($a, $b) use ($sort) {
            switch ($sort) {
                case 'date_asc':
                    return strcmp($a['created_at_raw'] ?? '', $b['created_at_raw'] ?? '');
                case 'date_desc':
                    return strcmp($b['created_at_raw'] ?? '', $a['created_at_raw'] ?? '');
                case 'amount_desc':
                    return ($b['amount'] ?? 0) <=> ($a['amount'] ?? 0);
                case 'amount_asc':
                    return ($a['amount'] ?? 0) <=> ($b['amount'] ?? 0);
                case 'status_asc':
                    return strcmp($a['transaction_status'] ?? '', $b['transaction_status'] ?? '');
                default:
                    return strcmp($b['created_at_raw'] ?? '', $a['created_at_raw'] ?? '');
            }
        });

        return array_values($transactions);
    }

    /**
     * Get single transaction by ID or reference.
     */
    public function getTransaction(string $id): ?array
    {
        $transactions = $this->loadStoredTransactions();
        foreach ($transactions as $t) {
            if ($t['id'] === $id || ($t['transaction_reference'] ?? '') === $id) {
                return $t;
            }
        }
        return null;
    }

    /**
     * Get summary metrics for Page 29 Vendor Transactions.
     */
    public function getTransactionSummaryMetrics(string $facilityId = 'all', string $period = 'all'): array
    {
        $all = $this->loadStoredTransactions();

        if ($facilityId !== 'all') {
            $all = array_filter($all, fn($t) => ($t['facility_id'] ?? '') === $facilityId);
        }

        $totalCount = 0;
        $successCount = 0;
        $pendingCount = 0;
        $failedCount = 0;
        $refundedCount = 0;
        $disputedCount = 0;
        $grossVolume = 0;
        $refundedVolume = 0;

        foreach ($all as $t) {
            // Period check
            $isPeriodMatch = true;
            if ($period === 'today') {
                $isPeriodMatch = str_contains($t['created_at_raw'] ?? '', '2026-10-11');
            } elseif ($period === 'yesterday') {
                $isPeriodMatch = str_contains($t['created_at_raw'] ?? '', '2026-10-10');
            } elseif ($period === '7days') {
                $raw = $t['created_at_raw'] ?? '';
                $isPeriodMatch = str_contains($raw, '2026-10-08')
                    || str_contains($raw, '2026-10-09')
                    || str_contains($raw, '2026-10-10')
                    || str_contains($raw, '2026-10-11');
            }

            if (!$isPeriodMatch) {
                continue;
            }

            $totalCount++;
            $status = $t['transaction_status'] ?? '';

            if ($status === 'successful') {
                $successCount++;
                $grossVolume += ($t['amount'] ?? 0);
            } elseif ($status === 'pending') {
                $pendingCount++;
            } elseif ($status === 'failed') {
                $failedCount++;
            } elseif ($status === 'refunded') {
                $refundedCount++;
                $refundedVolume += ($t['refunded_amount'] ?? $t['amount'] ?? 0);
            } elseif ($status === 'disputed') {
                $disputedCount++;
            }
        }

        $successRate = $totalCount > 0 ? round(($successCount / $totalCount) * 100, 1) : 100.0;
        $reconciliationAttentionCount = $failedCount + $disputedCount;

        return [
            'facility_id' => $facilityId,
            'period' => $period,
            'total_transactions_count' => $totalCount,
            'successful_count' => $successCount,
            'success_rate' => $successRate,
            'pending_count' => $pendingCount,
            'failed_count' => $failedCount,
            'refunded_count' => $refundedCount,
            'disputed_count' => $disputedCount,
            'attention_count' => $reconciliationAttentionCount,
            'gross_volume' => $grossVolume,
            'formatted_gross_volume' => 'Rp ' . number_format($grossVolume, 0, ',', '.'),
            'refunded_volume' => $refundedVolume,
            'formatted_refunded_volume' => 'Rp ' . number_format($refundedVolume, 0, ',', '.'),
            'last_reconciled_time' => date('d M Y, H:i') . ' WIB',
        ];
    }

    /**
     * Reconcile / resolve an investigation on a transaction.
     */
    public function reconcileTransaction(string $id, string $notes = ''): ?array
    {
        $transactions = $this->loadStoredTransactions();
        $target = null;

        foreach ($transactions as &$t) {
            if ($t['id'] === $id || ($t['transaction_reference'] ?? '') === $id) {
                $t['reconciliation_flag'] = false;
                $t['settlement_status'] = 'settled';
                $t['settlement_status_label'] = 'Reconciled & Cleared';
                $t['reconciliation_notes'] = $notes ?: 'Resolved and reconciled by operations supervisor.';
                $t['reconciled_at'] = date('d M Y, H:i:s') . ' WIB';

                $t['timeline'][] = [
                    'time' => date('H:i:s') . ' WIB',
                    'event' => 'Manual Reconciliation Confirmed',
                    'details' => 'Reconciled by Operations Lead: ' . ($notes ?: 'Discrepancy verified and cleared.'),
                    'status' => 'success',
                ];

                $target = $t;
                break;
            }
        }

        if ($target) {
            $this->saveTransactions($transactions);
        }

        return $target;
    }

    /**
     * Compute comprehensive financial revenue analytics for Page 30.
     */
    public function getRevenueAnalytics(string $facilityId = 'all', string $period = 'today', bool $compare = true): array
    {
        $allFacilities = $this->getFacilities();
        $scopedFacilities = $allFacilities;

        if ($facilityId !== 'all') {
            $scopedFacilities = array_filter($allFacilities, fn($f) => $f['id'] === $facilityId);
            if (empty($scopedFacilities)) {
                $scopedFacilities = $allFacilities;
                $facilityId = 'all';
            }
        }

        // Authoritative base values from facilities
        $baseTodayRevenue = 0;
        $totalCapacity = 0;
        $totalEntries = 0;
        $totalExits = 0;

        foreach ($scopedFacilities as $f) {
            $baseTodayRevenue += (int)($f['today_revenue'] ?? 0);
            $totalCapacity += (int)($f['total_capacity'] ?? 0);
            $totalEntries += (int)($f['today_entries'] ?? 0);
            $totalExits += (int)($f['today_exits'] ?? 0);
        }

        // Period multipliers & labels
        $currentMultiplier = 1.0;
        $previousMultiplier = 0.94;
        $periodLabel = 'Today (11 Oct 2026)';
        $previousPeriodLabel = 'Yesterday (10 Oct 2026)';
        $refundRatio = 0.0016; // 0.16% refund rate

        if ($period === 'yesterday') {
            $currentMultiplier = 0.94;
            $previousMultiplier = 0.91;
            $periodLabel = 'Yesterday (10 Oct 2026)';
            $previousPeriodLabel = 'Previous Day (09 Oct 2026)';
            $refundRatio = 0.0015;
        } elseif ($period === '7days') {
            $currentMultiplier = 6.8;
            $previousMultiplier = 6.4;
            $periodLabel = 'Last 7 Days (05 - 11 Oct 2026)';
            $previousPeriodLabel = 'Prior 7 Days (28 Sep - 04 Oct 2026)';
            $refundRatio = 0.0013;
        } elseif ($period === 'month') {
            $currentMultiplier = 11.2;
            $previousMultiplier = 10.4;
            $periodLabel = 'October 2026 (Month to Date)';
            $previousPeriodLabel = 'September 2026 (Equivalent MTD)';
            $refundRatio = 0.0014;
        }

        // 1. Gross & Net Revenue calculations
        $grossRevenue = (int)($baseTodayRevenue * $currentMultiplier);
        $refundAmount = (int)($grossRevenue * $refundRatio);
        $netRevenue = $grossRevenue - $refundAmount;

        // Previous comparison period
        $prevGrossRevenue = (int)($baseTodayRevenue * $previousMultiplier);
        $prevRefundAmount = (int)($prevGrossRevenue * $refundRatio);
        $prevNetRevenue = $prevGrossRevenue - $prevRefundAmount;

        $revenueDelta = $netRevenue - $prevNetRevenue;
        $revenueGrowthPct = $prevNetRevenue > 0 ? round((($netRevenue - $prevNetRevenue) / $prevNetRevenue) * 100, 1) : 0.0;

        // Transactions volume & average ticket
        $avgTicketBase = 18500; // Average IDR per parking session
        $successfulTransactionsCount = max(1, (int)round($grossRevenue / $avgTicketBase));
        $refundCount = max(1, (int)ceil($refundAmount / 25000));
        $avgTicket = (int)round($netRevenue / $successfulTransactionsCount);

        // Pending and Disputed in-flight amounts (distinct from captured revenue)
        $pendingVolume = (int)round($grossRevenue * 0.008); // 0.8% in gateway clearing
        $pendingCount = max(1, (int)ceil($pendingVolume / 20000));
        $disputedVolume = (int)round($grossRevenue * 0.005); // 0.5% in audit hold
        $disputedCount = max(1, (int)ceil($disputedVolume / 150000));

        // 2. Time-Series Trend Chart Data
        $chartData = [];
        if ($period === 'today' || $period === 'yesterday') {
            // Hourly series from 07:00 to 22:00
            $hourlyWeights = [
                '07:00' => 0.024,
                '08:00' => 0.062,
                '09:00' => 0.088,
                '10:00' => 0.104,
                '11:00' => 0.098,
                '12:00' => 0.092,
                '13:00' => 0.085,
                '14:00' => 0.076,
                '15:00' => 0.071,
                '16:00' => 0.084,
                '17:00' => 0.095,
                '18:00' => 0.068,
                '19:00' => 0.045,
                '20:00' => 0.035,
                '21:00' => 0.026,
                '22:00' => 0.017,
            ];

            $cumulativeCurrent = 0;
            $cumulativePrev = 0;

            foreach ($hourlyWeights as $hour => $weight) {
                $hourAmount = (int)round($grossRevenue * $weight);
                $prevHourAmount = (int)round($prevGrossRevenue * $weight);
                $cumulativeCurrent += $hourAmount;
                $cumulativePrev += $prevHourAmount;

                $chartData[] = [
                    'label' => $hour,
                    'current' => $hourAmount,
                    'previous' => $prevHourAmount,
                    'cumulative' => $cumulativeCurrent,
                    'cumulative_prev' => $cumulativePrev,
                    'formatted_current' => 'Rp ' . number_format($hourAmount, 0, ',', '.'),
                    'formatted_cumulative' => 'Rp ' . number_format($cumulativeCurrent, 0, ',', '.'),
                ];
            }
        } elseif ($period === '7days') {
            // 7-day daily progression
            $days = [
                ['label' => '05 Oct (Sun)', 'weight' => 0.165],
                ['label' => '06 Oct (Mon)', 'weight' => 0.132],
                ['label' => '07 Oct (Tue)', 'weight' => 0.138],
                ['label' => '08 Oct (Wed)', 'weight' => 0.142],
                ['label' => '09 Oct (Thu)', 'weight' => 0.146],
                ['label' => '10 Oct (Fri)', 'weight' => 0.138],
                ['label' => '11 Oct (Sat)', 'weight' => 0.139],
            ];

            foreach ($days as $d) {
                $dayAmount = (int)round($grossRevenue * $d['weight']);
                $prevDayAmount = (int)round($prevGrossRevenue * $d['weight']);
                $dayRefund = (int)round($dayAmount * $refundRatio);
                $dayNet = $dayAmount - $dayRefund;

                $chartData[] = [
                    'label' => $d['label'],
                    'current' => $dayNet,
                    'previous' => $prevDayAmount,
                    'gross' => $dayAmount,
                    'refund' => $dayRefund,
                    'formatted_current' => 'Rp ' . number_format($dayNet, 0, ',', '.'),
                    'formatted_previous' => 'Rp ' . number_format($prevDayAmount, 0, ',', '.'),
                ];
            }
        } else {
            // Month progression (4 weeks)
            $weeks = [
                ['label' => 'Week 1 (01-07 Oct)', 'weight' => 0.62],
                ['label' => 'Week 2 (08-11 Oct MTD)', 'weight' => 0.38],
            ];

            foreach ($weeks as $w) {
                $weekAmount = (int)round($grossRevenue * $w['weight']);
                $prevWeekAmount = (int)round($prevGrossRevenue * $w['weight']);

                $chartData[] = [
                    'label' => $w['label'],
                    'current' => $weekAmount,
                    'previous' => $prevWeekAmount,
                    'formatted_current' => 'Rp ' . number_format($weekAmount, 0, ',', '.'),
                    'formatted_previous' => 'Rp ' . number_format($prevWeekAmount, 0, ',', '.'),
                ];
            }
        }

        // 3. Facility Revenue Breakdown
        $facilityBreakdown = [];
        $totalAllFacilitiesNet = 0;

        foreach ($allFacilities as $f) {
            $fBase = (int)($f['today_revenue'] ?? 0);
            $fGross = (int)round($fBase * $currentMultiplier);
            $fRefund = (int)round($fGross * $refundRatio);
            $fNet = $fGross - $fRefund;
            $totalAllFacilitiesNet += $fNet;

            $facilityBreakdown[$f['id']] = [
                'id' => $f['id'],
                'code' => $f['code'] ?? 'LOC',
                'name' => $f['name'],
                'city' => $f['city'],
                'gross_revenue' => $fGross,
                'refunds' => $fRefund,
                'net_revenue' => $fNet,
                'formatted_gross' => 'Rp ' . number_format($fGross, 0, ',', '.'),
                'formatted_net' => 'Rp ' . number_format($fNet, 0, ',', '.'),
                'formatted_refunds' => 'Rp ' . number_format($fRefund, 0, ',', '.'),
                'transactions_count' => (int)round($fGross / $avgTicketBase),
                'active_sessions' => (int)($f['active_sessions'] ?? 0),
                'avg_ticket' => (int)round($fNet / max(1, (int)round($fGross / $avgTicketBase))),
                'formatted_avg_ticket' => 'Rp ' . number_format((int)round($fNet / max(1, (int)round($fGross / $avgTicketBase))), 0, ',', '.'),
                'collection_rate' => 99.8,
                'top_method' => $f['id'] === 'fac-gi-west' ? 'NFC Tap & Auto-Pay' : 'QRIS & NFC Tap',
                'is_selected' => ($facilityId === 'all' || $facilityId === $f['id']),
            ];
        }

        // Calculate portfolio share %
        foreach ($facilityBreakdown as &$fb) {
            $fb['portfolio_share'] = $totalAllFacilitiesNet > 0 
                ? round(($fb['net_revenue'] / $totalAllFacilitiesNet) * 100, 1) 
                : 0.0;
        }
        unset($fb);

        // Filter facility breakdown to selected facility if not 'all'
        $filteredFacilityBreakdown = array_values(array_filter($facilityBreakdown, fn($fb) => $fb['is_selected']));

        // 4. Payment Method Distribution
        $paymentMethods = [
            [
                'key' => 'nfc_card',
                'label' => 'NFC Contactless Card',
                'subtext' => 'BCA Flazz, Mandiri e-Money, TapCash',
                'share_pct' => 38.5,
                'badge' => 'bg-amber-50 text-amber-800 border-amber-200',
            ],
            [
                'key' => 'qris',
                'label' => 'QRIS Dynamic',
                'subtext' => 'BCA Mobile, Livin\', GoPay QRIS',
                'share_pct' => 31.8,
                'badge' => 'bg-sky-50 text-sky-700 border-sky-200',
            ],
            [
                'key' => 'auto_pay',
                'label' => 'In-App Auto-Pay',
                'subtext' => 'Express Optical ANPR Plate Debit',
                'share_pct' => 19.2,
                'badge' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            ],
            [
                'key' => 'ewallet',
                'label' => 'E-Wallet Direct',
                'subtext' => 'GoPay, OVO, ShopeePay Online',
                'share_pct' => 8.3,
                'badge' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
            ],
            [
                'key' => 'cashless_kiosk',
                'label' => 'Cashless Lane POS / Valet',
                'subtext' => 'Attendant POS / Desk Reader',
                'share_pct' => 2.2,
                'badge' => 'bg-slate-100 text-slate-700 border-slate-200',
            ],
        ];

        $paymentMethodBreakdown = [];
        foreach ($paymentMethods as $pm) {
            $mGross = (int)round($grossRevenue * ($pm['share_pct'] / 100));
            $mCount = max(1, (int)round($mGross / $avgTicketBase));
            $mAvg = (int)round($mGross / $mCount);

            $paymentMethodBreakdown[] = [
                'key' => $pm['key'],
                'label' => $pm['label'],
                'subtext' => $pm['subtext'],
                'share_pct' => $pm['share_pct'],
                'gross_volume' => $mGross,
                'formatted_gross' => 'Rp ' . number_format($mGross, 0, ',', '.'),
                'count' => $mCount,
                'avg_ticket' => $mAvg,
                'formatted_avg_ticket' => 'Rp ' . number_format($mAvg, 0, ',', '.'),
                'badge_class' => $pm['badge'],
            ];
        }

        // 5. Service / Payable Type Breakdown
        $payableBreakdown = [
            [
                'type' => 'session',
                'label' => 'Drive-up Parking Sessions',
                'share_pct' => 86.8,
                'amount' => (int)round($grossRevenue * 0.868),
                'formatted_amount' => 'Rp ' . number_format((int)round($grossRevenue * 0.868), 0, ',', '.'),
                'count' => (int)round($successfulTransactionsCount * 0.88),
            ],
            [
                'type' => 'reservation',
                'label' => 'Advance Space Reservations & EV Hubs',
                'share_pct' => 13.2,
                'amount' => (int)round($grossRevenue * 0.132),
                'formatted_amount' => 'Rp ' . number_format((int)round($grossRevenue * 0.132), 0, ',', '.'),
                'count' => (int)round($successfulTransactionsCount * 0.12),
            ],
        ];

        // 6. Settlement Status Telemetry
        $settlementTelemetry = [
            'settled_volume' => (int)round($netRevenue * 0.885),
            'formatted_settled_volume' => 'Rp ' . number_format((int)round($netRevenue * 0.885), 0, ',', '.'),
            'settled_pct' => 88.5,
            'clearing_volume' => (int)round($netRevenue * 0.092), // T+1 clearing
            'formatted_clearing_volume' => 'Rp ' . number_format((int)round($netRevenue * 0.092), 0, ',', '.'),
            'clearing_pct' => 9.2,
            'on_hold_volume' => (int)round($netRevenue * 0.023),
            'formatted_on_hold_volume' => 'Rp ' . number_format((int)round($netRevenue * 0.023), 0, ',', '.'),
            'on_hold_pct' => 2.3,
        ];

        return [
            'facility_id' => $facilityId,
            'period' => $period,
            'period_label' => $periodLabel,
            'previous_period_label' => $previousPeriodLabel,
            'compare_enabled' => $compare,
            'summary' => [
                'gross_revenue' => $grossRevenue,
                'formatted_gross_revenue' => 'Rp ' . number_format($grossRevenue, 0, ',', '.'),
                'refunds_amount' => $refundAmount,
                'formatted_refunds_amount' => 'Rp ' . number_format($refundAmount, 0, ',', '.'),
                'refund_count' => $refundCount,
                'net_revenue' => $netRevenue,
                'formatted_net_revenue' => 'Rp ' . number_format($netRevenue, 0, ',', '.'),
                'prev_net_revenue' => $prevNetRevenue,
                'formatted_prev_net_revenue' => 'Rp ' . number_format($prevNetRevenue, 0, ',', '.'),
                'growth_pct' => $revenueGrowthPct,
                'growth_delta' => $revenueDelta,
                'formatted_growth_delta' => ($revenueDelta >= 0 ? '+' : '') . 'Rp ' . number_format($revenueDelta, 0, ',', '.'),
                'successful_transactions' => $successfulTransactionsCount,
                'avg_ticket' => $avgTicket,
                'formatted_avg_ticket' => 'Rp ' . number_format($avgTicket, 0, ',', '.'),
                'pending_volume' => $pendingVolume,
                'formatted_pending_volume' => 'Rp ' . number_format($pendingVolume, 0, ',', '.'),
                'pending_count' => $pendingCount,
                'disputed_volume' => $disputedVolume,
                'formatted_disputed_volume' => 'Rp ' . number_format($disputedVolume, 0, ',', '.'),
                'disputed_count' => $disputedCount,
            ],
            'chart_data' => $chartData,
            'facility_breakdown' => $filteredFacilityBreakdown,
            'all_facilities_breakdown' => array_values($facilityBreakdown),
            'payment_methods' => $paymentMethodBreakdown,
            'payable_types' => $payableBreakdown,
            'settlement' => $settlementTelemetry,
            'last_sync' => date('d M Y, H:i') . ' WIB',
        ];
    }

    /**
     * Generate structured operational and financial report data for Page 31.
     */
    public function getReport(string $reportType = 'sessions', string $facilityId = 'all', array $filters = []): array
    {
        $validTypes = ['sessions', 'transactions', 'revenue', 'facility_performance', 'gates_operational'];
        if (!in_array($reportType, $validTypes)) {
            $reportType = 'sessions';
        }

        $allFacilities = $this->getFacilities();
        $facilityName = 'All Authorized Facilities (' . count($allFacilities) . ')';
        if ($facilityId !== 'all') {
            foreach ($allFacilities as $f) {
                if ($f['id'] === $facilityId) {
                    $facilityName = $f['name'] . ' (' . $f['city'] . ')';
                    break;
                }
            }
        }

        $period = $filters['period'] ?? 'today';
        $startDate = $filters['start_date'] ?? null;
        $endDate = $filters['end_date'] ?? null;
        $periodLabel = 'Today (11 Oct 2026)';

        if ($period === 'yesterday') {
            $periodLabel = 'Yesterday (10 Oct 2026)';
        } elseif ($period === '7days') {
            $periodLabel = 'Last 7 Days (05 - 11 Oct 2026)';
        } elseif ($period === 'month') {
            $periodLabel = 'October 2026 (Month to Date)';
        } elseif ($period === 'custom' && $startDate && $endDate) {
            if ($endDate < $startDate) {
                $endDate = $startDate;
            }
            $periodLabel = date('d M Y', strtotime($startDate)) . ' - ' . date('d M Y', strtotime($endDate));
        }

        $summaryMetrics = [];
        $records = [];
        $columns = [];
        $reportTitle = 'Report';
        $reportDescription = 'Report description';

        switch ($reportType) {
            case 'sessions':
                $reportTitle = 'Parking Sessions Report';
                $reportDescription = 'Detailed vehicle parking sessions, duration, fee calculation, and ingress/egress barrier telemetry.';
                
                // Get sessions with filters
                $sessions = $this->getParkingSessions($facilityId, $filters);
                $records = $sessions;
                
                // Summary calculation
                $totalSessions = count($sessions);
                $activeCount = 0;
                $completedCount = 0;
                $attentionCount = 0;
                $totalFees = 0;
                $totalDurationMin = 0;

                foreach ($sessions as $s) {
                    if (($s['session_status'] ?? '') === 'active') {
                        $activeCount++;
                    } elseif (($s['session_status'] ?? '') === 'completed') {
                        $completedCount++;
                    }
                    if (!empty($s['is_flagged']) || ($s['session_status'] ?? '') === 'attention_required') {
                        $attentionCount++;
                    }
                    $totalFees += (int)($s['total_fee'] ?? 0);
                    $totalDurationMin += (int)($s['duration_minutes'] ?? 0);
                }

                $avgDurationMin = $totalSessions > 0 ? (int)round($totalDurationMin / $totalSessions) : 0;
                $avgHours = floor($avgDurationMin / 60);
                $avgRemMinutes = $avgDurationMin % 60;
                $avgDurationFormatted = $avgHours > 0 ? "{$avgHours}h {$avgRemMinutes}m" : "{$avgRemMinutes}m";

                $summaryMetrics = [
                    [
                        'key' => 'total_sessions',
                        'label' => 'Total Sessions',
                        'value' => number_format($totalSessions),
                        'subtext' => 'Vehicle cycles recorded',
                        'badge' => 'bg-blue-50 text-blue-700',
                    ],
                    [
                        'key' => 'active_sessions',
                        'label' => 'Active On-Site',
                        'value' => number_format($activeCount),
                        'subtext' => 'Currently in parking bays',
                        'badge' => 'bg-emerald-50 text-emerald-700',
                    ],
                    [
                        'key' => 'completed_sessions',
                        'label' => 'Completed / Exited',
                        'value' => number_format($completedCount),
                        'subtext' => 'Departed via exit gates',
                        'badge' => 'bg-slate-100 text-slate-700',
                    ],
                    [
                        'key' => 'total_fees',
                        'label' => 'Total Accrued Fees',
                        'value' => 'Rp ' . number_format($totalFees, 0, ',', '.'),
                        'subtext' => 'Recorded session charges',
                        'badge' => 'bg-purple-50 text-purple-700',
                    ],
                    [
                        'key' => 'avg_duration',
                        'label' => 'Average Duration',
                        'value' => $avgDurationFormatted,
                        'subtext' => 'Per parked vehicle',
                        'badge' => 'bg-sky-50 text-sky-700',
                    ],
                ];

                $columns = [
                    ['key' => 'session_code', 'label' => 'Session Code', 'align' => 'left'],
                    ['key' => 'vehicle_plate', 'label' => 'Vehicle Plate', 'align' => 'left'],
                    ['key' => 'facility_name', 'label' => 'Facility', 'align' => 'left'],
                    ['key' => 'entry_time', 'label' => 'Ingress Time', 'align' => 'left'],
                    ['key' => 'exit_time', 'label' => 'Egress Time', 'align' => 'left'],
                    ['key' => 'duration_formatted', 'label' => 'Duration', 'align' => 'left'],
                    ['key' => 'formatted_fee', 'label' => 'Billed Fee', 'align' => 'right'],
                    ['key' => 'session_status_label', 'label' => 'Session Status', 'align' => 'center'],
                    ['key' => 'payment_status_label', 'label' => 'Payment Status', 'align' => 'center'],
                ];
                break;

            case 'transactions':
                $reportTitle = 'Payment Transactions Report';
                $reportDescription = 'Audit ledger of cashless payments, acquirer networks, approval codes, and settlement reconciliation.';
                
                $transactions = $this->getTransactions($facilityId, $filters);
                $records = $transactions;

                $totalTxns = count($transactions);
                $successfulCount = 0;
                $grossVolume = 0;
                $refundedVolume = 0;
                $pendingCount = 0;
                $disputedCount = 0;

                foreach ($transactions as $t) {
                    $st = $t['transaction_status'] ?? '';
                    if ($st === 'successful') {
                        $successfulCount++;
                        $grossVolume += (int)($t['amount'] ?? 0);
                    } elseif ($st === 'refunded') {
                        $refundedVolume += (int)($t['refunded_amount'] ?? $t['amount'] ?? 0);
                    } elseif ($st === 'pending') {
                        $pendingCount++;
                    } elseif ($st === 'disputed' || $st === 'failed') {
                        $disputedCount++;
                    }
                }

                $netVolume = $grossVolume - $refundedVolume;
                $successRate = $totalTxns > 0 ? round(($successfulCount / $totalTxns) * 100, 1) : 100.0;

                $summaryMetrics = [
                    [
                        'key' => 'total_transactions',
                        'label' => 'Total Transactions',
                        'value' => number_format($totalTxns),
                        'subtext' => 'Payment events recorded',
                        'badge' => 'bg-blue-50 text-blue-700',
                    ],
                    [
                        'key' => 'gross_volume',
                        'label' => 'Gross Volume',
                        'value' => 'Rp ' . number_format($grossVolume, 0, ',', '.'),
                        'subtext' => 'Captured payment volume',
                        'badge' => 'bg-emerald-50 text-emerald-700',
                    ],
                    [
                        'key' => 'refunded_volume',
                        'label' => 'Refunds Processed',
                        'value' => 'Rp ' . number_format($refundedVolume, 0, ',', '.'),
                        'subtext' => 'Policy & manual reversals',
                        'badge' => 'bg-purple-50 text-purple-700',
                    ],
                    [
                        'key' => 'net_volume',
                        'label' => 'Net Receipts',
                        'value' => 'Rp ' . number_format($netVolume, 0, ',', '.'),
                        'subtext' => 'Gross minus refunds',
                        'badge' => 'bg-emerald-100 text-emerald-800',
                    ],
                    [
                        'key' => 'success_rate',
                        'label' => 'Success Rate',
                        'value' => "{$successRate}%",
                        'subtext' => "{$pendingCount} pending, {$disputedCount} disputed",
                        'badge' => 'bg-sky-50 text-sky-700',
                    ],
                ];

                $columns = [
                    ['key' => 'transaction_reference', 'label' => 'Transaction Ref', 'align' => 'left'],
                    ['key' => 'provider_reference', 'label' => 'Gateway Ref', 'align' => 'left'],
                    ['key' => 'created_at', 'label' => 'Date & Time', 'align' => 'left'],
                    ['key' => 'facility_name', 'label' => 'Facility', 'align' => 'left'],
                    ['key' => 'payment_method_label', 'label' => 'Payment Method', 'align' => 'left'],
                    ['key' => 'formatted_amount', 'label' => 'Amount', 'align' => 'right'],
                    ['key' => 'transaction_status_label', 'label' => 'Payment Status', 'align' => 'center'],
                    ['key' => 'settlement_status_label', 'label' => 'Settlement', 'align' => 'center'],
                ];
                break;

            case 'revenue':
                $reportTitle = 'Revenue & Financial Collection Summary';
                $reportDescription = 'Authoritative accounting overview of gross revenue, refunds, net receipts, and facility contribution.';
                
                $analytics = $this->getRevenueAnalytics($facilityId, $period, true);
                $records = $analytics['facility_breakdown'];

                $summaryMetrics = [
                    [
                        'key' => 'net_revenue',
                        'label' => 'Net Recorded Receipts',
                        'value' => $analytics['summary']['formatted_net_revenue'],
                        'subtext' => 'Authoritative net volume',
                        'badge' => 'bg-emerald-50 text-emerald-700',
                    ],
                    [
                        'key' => 'gross_revenue',
                        'label' => 'Gross Receipts',
                        'value' => $analytics['summary']['formatted_gross_revenue'],
                        'subtext' => 'Captured before refunds',
                        'badge' => 'bg-blue-50 text-blue-700',
                    ],
                    [
                        'key' => 'refunds_amount',
                        'label' => 'Confirmed Refunds',
                        'value' => $analytics['summary']['formatted_refunds_amount'],
                        'subtext' => "{$analytics['summary']['refund_count']} refund event(s)",
                        'badge' => 'bg-purple-50 text-purple-700',
                    ],
                    [
                        'key' => 'avg_ticket',
                        'label' => 'Average Ticket (ARPU)',
                        'value' => $analytics['summary']['formatted_avg_ticket'],
                        'subtext' => 'Per completed session',
                        'badge' => 'bg-sky-50 text-sky-700',
                    ],
                    [
                        'key' => 'successful_txns',
                        'label' => 'Successful Payments',
                        'value' => number_format($analytics['summary']['successful_transactions']),
                        'subtext' => 'Reconciled cashless txns',
                        'badge' => 'bg-slate-100 text-slate-700',
                    ],
                ];

                $columns = [
                    ['key' => 'code', 'label' => 'Facility Code', 'align' => 'left'],
                    ['key' => 'name', 'label' => 'Facility Name', 'align' => 'left'],
                    ['key' => 'city', 'label' => 'Location / City', 'align' => 'left'],
                    ['key' => 'formatted_gross', 'label' => 'Gross Volume', 'align' => 'right'],
                    ['key' => 'formatted_refunds', 'label' => 'Refunds', 'align' => 'right'],
                    ['key' => 'formatted_net', 'label' => 'Net Receipts', 'align' => 'right'],
                    ['key' => 'portfolio_share', 'label' => 'Portfolio Share (%)', 'align' => 'center'],
                    ['key' => 'transactions_count', 'label' => 'Transactions', 'align' => 'right'],
                    ['key' => 'formatted_avg_ticket', 'label' => 'Average Ticket', 'align' => 'right'],
                ];
                break;

            case 'facility_performance':
                $reportTitle = 'Facility Operational Performance Report';
                $reportDescription = 'Capacity allocation, real-time occupancy, gate traffic throughput, and hardware operational status.';
                
                $locations = $this->getManagedLocations($filters);
                if ($facilityId !== 'all') {
                    $locations = array_filter($locations, fn($l) => $l['id'] === $facilityId);
                }
                $records = array_values($locations);

                $locMetrics = $this->getLocationSummaryMetrics();

                $summaryMetrics = [
                    [
                        'key' => 'total_facilities',
                        'label' => 'Managed Facilities',
                        'value' => number_format(count($records)),
                        'subtext' => 'Authorized operator scope',
                        'badge' => 'bg-blue-50 text-blue-700',
                    ],
                    [
                        'key' => 'total_capacity',
                        'label' => 'Total Bay Capacity',
                        'value' => number_format($locMetrics['total_capacity']),
                        'subtext' => 'Marked parking spaces',
                        'badge' => 'bg-slate-100 text-slate-700',
                    ],
                    [
                        'key' => 'total_occupied',
                        'label' => 'Occupied Slots',
                        'value' => number_format($locMetrics['total_occupied']),
                        'subtext' => "{$locMetrics['avg_occupancy_rate']}% occupancy rate",
                        'badge' => 'bg-amber-50 text-amber-700',
                    ],
                    [
                        'key' => 'available_slots',
                        'label' => 'Available Spaces',
                        'value' => number_format($locMetrics['total_available']),
                        'subtext' => 'Ready for ingress',
                        'badge' => 'bg-emerald-50 text-emerald-700',
                    ],
                    [
                        'key' => 'operational_rate',
                        'label' => 'Fleet Health',
                        'value' => '99.5%',
                        'subtext' => 'Barrier & sensor telemetry',
                        'badge' => 'bg-sky-50 text-sky-700',
                    ],
                ];

                $columns = [
                    ['key' => 'code', 'label' => 'Code', 'align' => 'left'],
                    ['key' => 'name', 'label' => 'Facility Name', 'align' => 'left'],
                    ['key' => 'city', 'label' => 'City', 'align' => 'left'],
                    ['key' => 'total_capacity', 'label' => 'Capacity', 'align' => 'right'],
                    ['key' => 'occupied', 'label' => 'Occupied', 'align' => 'right'],
                    ['key' => 'occupancy_rate', 'label' => 'Occupancy %', 'align' => 'center'],
                    ['key' => 'today_entries', 'label' => 'Entries (In)', 'align' => 'right'],
                    ['key' => 'today_exits', 'label' => 'Exits (Out)', 'align' => 'right'],
                    ['key' => 'formatted_revenue', 'label' => 'Today Revenue', 'align' => 'right'],
                    ['key' => 'status', 'label' => 'Facility Status', 'align' => 'center'],
                ];
                break;

            case 'gates_operational':
                $reportTitle = 'Barrier Gates & Hardware Telemetry Report';
                $reportDescription = 'Hardware connectivity status, barrier direction, cycles telemetry, and maintenance diagnostic alerts.';
                
                $gates = $this->getGates($facilityId, $filters);
                $records = $gates;

                $totalGates = count($gates);
                $onlineCount = 0;
                $inCount = 0;
                $outCount = 0;
                $totalCycles = 0;

                foreach ($gates as $g) {
                    if (strtolower($g['connectivity_status'] ?? '') === 'online' || strtolower($g['status'] ?? '') === 'active') {
                        $onlineCount++;
                    }
                    if (strtolower($g['direction'] ?? '') === 'inbound' || strtolower($g['direction'] ?? '') === 'in') {
                        $inCount++;
                    } else {
                        $outCount++;
                    }
                    $totalCycles += (int)($g['usage_counter'] ?? $g['total_cycles'] ?? 1250);
                }

                $healthRate = $totalGates > 0 ? round(($onlineCount / $totalGates) * 100, 1) : 100.0;

                $summaryMetrics = [
                    [
                        'key' => 'total_gates',
                        'label' => 'Total Barrier Gates',
                        'value' => number_format($totalGates),
                        'subtext' => 'Hardware terminals configured',
                        'badge' => 'bg-blue-50 text-blue-700',
                    ],
                    [
                        'key' => 'online_gates',
                        'label' => 'Online & Responsive',
                        'value' => number_format($onlineCount),
                        'subtext' => "{$healthRate}% network availability",
                        'badge' => 'bg-emerald-50 text-emerald-700',
                    ],
                    [
                        'key' => 'direction_split',
                        'label' => 'Gate Configuration',
                        'value' => "{$inCount} In / {$outCount} Out",
                        'subtext' => 'Inbound & outbound lanes',
                        'badge' => 'bg-slate-100 text-slate-700',
                    ],
                    [
                        'key' => 'total_cycles',
                        'label' => 'Total Barrier Cycles',
                        'value' => number_format($totalCycles),
                        'subtext' => 'Actuator boom lifts recorded',
                        'badge' => 'bg-purple-50 text-purple-700',
                    ],
                    [
                        'key' => 'uptime_sla',
                        'label' => 'Hardware SLA Uptime',
                        'value' => '99.9%',
                        'subtext' => 'Power & PLC link active',
                        'badge' => 'bg-sky-50 text-sky-700',
                    ],
                ];

                $columns = [
                    ['key' => 'code', 'label' => 'Gate Code', 'align' => 'left'],
                    ['key' => 'name', 'label' => 'Gate Name', 'align' => 'left'],
                    ['key' => 'facility_name', 'label' => 'Facility', 'align' => 'left'],
                    ['key' => 'direction_label', 'label' => 'Direction / Lane', 'align' => 'left'],
                    ['key' => 'barrier_type', 'label' => 'Barrier Model', 'align' => 'left'],
                    ['key' => 'connectivity_status', 'label' => 'Link Status', 'align' => 'center'],
                    ['key' => 'operational_status', 'label' => 'Operational State', 'align' => 'center'],
                    ['key' => 'last_heartbeat', 'label' => 'Last Heartbeat', 'align' => 'right'],
                ];
                break;
        }

        // Apply search query filter on records if provided
        $query = trim(strtolower($filters['q'] ?? ''));
        if ($query !== '' && !empty($records)) {
            $records = array_filter($records, function($item) use ($query) {
                foreach ($item as $val) {
                    if (is_scalar($val) && str_contains(strtolower((string)$val), $query)) {
                        return true;
                    }
                }
                return false;
            });
            $records = array_values($records);
        }

        return [
            'report_id' => 'RPT-' . strtoupper(substr($reportType, 0, 3)) . '-' . date('Ymd-Hi'),
            'report_type' => $reportType,
            'report_title' => $reportTitle,
            'report_description' => $reportDescription,
            'facility_id' => $facilityId,
            'facility_name' => $facilityName,
            'period' => $period,
            'period_label' => $periodLabel,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'filters' => $filters,
            'generated_at' => date('d M Y, H:i') . ' WIB',
            'summary_metrics' => $summaryMetrics,
            'records' => $records,
            'total_count' => count($records),
            'columns' => $columns,
        ];
    }

    /**
     * Default list of authorized staff members for PT Parkir Cipta Nusantara (vdr-jkt-01).
     */
    protected function getDefaultStaff(): array
    {
        return [
            [
                'id' => 'stf-001',
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@parkircipta.co.id',
                'phone' => '+62 811-9876-5432',
                'role' => 'owner',
                'role_label' => 'Vendor Owner & Director',
                'facility_scope' => 'all',
                'assigned_facilities' => ['fac-mall-xyz', 'fac-gi-west', 'fac-cp-jkt'],
                'status' => 'active',
                'is_owner' => true,
                'invitation_status' => 'accepted',
                'invited_at' => '10 Jan 2025, 09:00 WIB',
                'last_active_at' => '11 Oct 2026, 14:15 WIB',
                'notes' => 'Primary account owner & executive signatory.',
                'created_at' => '2025-01-10 09:00:00',
            ],
            [
                'id' => 'stf-002',
                'name' => 'Hendra Wijaya',
                'email' => 'hendra.wijaya@parkircipta.co.id',
                'phone' => '+62 813-2200-9891',
                'role' => 'administrator',
                'role_label' => 'Operations Administrator',
                'facility_scope' => 'all',
                'assigned_facilities' => ['fac-mall-xyz', 'fac-gi-west', 'fac-cp-jkt'],
                'status' => 'active',
                'is_owner' => false,
                'invitation_status' => 'accepted',
                'invited_at' => '01 Feb 2025, 10:30 WIB',
                'last_active_at' => '11 Oct 2026, 13:42 WIB',
                'notes' => 'Central operations lead & escalation admin.',
                'created_at' => '2025-02-01 10:30:00',
            ],
            [
                'id' => 'stf-003',
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@parkircipta.co.id',
                'phone' => '+62 812-9844-1102',
                'role' => 'supervisor',
                'role_label' => 'Facility Supervisor',
                'facility_scope' => 'custom',
                'assigned_facilities' => ['fac-mall-xyz'],
                'status' => 'active',
                'is_owner' => false,
                'invitation_status' => 'accepted',
                'invited_at' => '15 Mar 2025, 11:15 WIB',
                'last_active_at' => '11 Oct 2026, 12:45 WIB',
                'notes' => 'On-duty shift supervisor at Mall XYZ Jakarta.',
                'created_at' => '2025-03-15 11:15:00',
            ],
            [
                'id' => 'stf-004',
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@parkircipta.co.id',
                'phone' => '+62 817-5544-2311',
                'role' => 'supervisor',
                'role_label' => 'Facility Supervisor',
                'facility_scope' => 'custom',
                'assigned_facilities' => ['fac-cp-jkt'],
                'status' => 'active',
                'is_owner' => false,
                'invitation_status' => 'accepted',
                'invited_at' => '12 May 2025, 14:00 WIB',
                'last_active_at' => '11 Oct 2026, 11:20 WIB',
                'notes' => 'On-duty shift supervisor at Central Park Jakarta.',
                'created_at' => '2025-05-12 14:00:00',
            ],
            [
                'id' => 'stf-005',
                'name' => 'Rizky Pratama',
                'email' => 'rizky.pratama@parkircipta.co.id',
                'phone' => '+62 818-4433-2211',
                'role' => 'operator',
                'role_label' => 'Lane & Barrier Operator',
                'facility_scope' => 'custom',
                'assigned_facilities' => ['fac-gi-west'],
                'status' => 'active',
                'is_owner' => false,
                'invitation_status' => 'accepted',
                'invited_at' => '01 Aug 2025, 08:30 WIB',
                'last_active_at' => '11 Oct 2026, 14:02 WIB',
                'notes' => 'Console operator for Grand Indonesia West Mall.',
                'created_at' => '2025-08-01 08:30:00',
            ],
            [
                'id' => 'stf-006',
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@parkircipta.co.id',
                'phone' => '+62 819-3322-1100',
                'role' => 'operator',
                'role_label' => 'Lane & Barrier Operator',
                'facility_scope' => 'custom',
                'assigned_facilities' => ['fac-mall-xyz', 'fac-cp-jkt'],
                'status' => 'pending',
                'is_owner' => false,
                'invitation_status' => 'pending',
                'invited_at' => '09 Oct 2026, 16:30 WIB',
                'last_active_at' => 'Pending Activation',
                'notes' => 'Invitation sent via email; awaiting credential confirmation.',
                'created_at' => '2026-10-09 16:30:00',
            ],
            [
                'id' => 'stf-007',
                'name' => 'Bambang Irawan',
                'email' => 'bambang.irawan@parkircipta.co.id',
                'phone' => '+62 812-7766-5544',
                'role' => 'operator',
                'role_label' => 'Lane & Barrier Operator',
                'facility_scope' => 'custom',
                'assigned_facilities' => ['fac-mall-xyz'],
                'status' => 'suspended',
                'is_owner' => false,
                'invitation_status' => 'accepted',
                'invited_at' => '10 Feb 2025, 10:00 WIB',
                'last_active_at' => '04 Oct 2026, 18:22 WIB',
                'notes' => 'Access temporarily suspended pending seasonal shift reassignment.',
                'created_at' => '2025-02-10 10:00:00',
            ],
        ];
    }

    /**
     * Load stored staff members from cache.
     */
    protected function loadStoredStaff(): array
    {
        $staff = Cache::get(self::STAFF_CACHE_KEY);
        if ($staff === null) {
            $staff = $this->getDefaultStaff();
            $this->saveStaff($staff);
        }
        return $staff;
    }

    /**
     * Persist staff members into cache.
     */
    protected function saveStaff(array $staff): void
    {
        Cache::put(self::STAFF_CACHE_KEY, $staff, now()->addDays(30));
    }

    /**
     * Get staff role metadata dictionary.
     */
    public function getStaffRoles(): array
    {
        return [
            'owner' => [
                'role' => 'owner',
                'label' => 'Vendor Owner & Director',
                'short' => 'Owner',
                'badge' => 'bg-amber-50 text-amber-800 border border-amber-300',
                'description' => 'Full administrative authority over business entity, facilities, staff access, and billing.',
                'assignable' => false,
            ],
            'administrator' => [
                'role' => 'administrator',
                'label' => 'Operations Administrator',
                'short' => 'Admin',
                'badge' => 'bg-blue-50 text-blue-700 border border-blue-200',
                'description' => 'Full operations management across parking lots, gates, ANPR, IoT telemetry, and financial reports.',
                'assignable' => true,
            ],
            'supervisor' => [
                'role' => 'supervisor',
                'label' => 'Facility Supervisor',
                'short' => 'Supervisor',
                'badge' => 'bg-purple-50 text-purple-700 border border-purple-200',
                'description' => 'Supervises on-site bays, reconciles barriers, reviews ANPR alerts, and resolves flagged sessions.',
                'assignable' => true,
            ],
            'operator' => [
                'role' => 'operator',
                'label' => 'Lane & Barrier Operator',
                'short' => 'Operator',
                'badge' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                'description' => 'Assists lane traffic, executes manual barrier override commands, and assists driver sessions.',
                'assignable' => true,
            ],
        ];
    }

    /**
     * Retrieve staff members with enrichment and filtering.
     */
    public function getStaff(array $filters = []): array
    {
        $rawStaff = $this->loadStoredStaff();
        $facilities = $this->getFacilities();
        $facMap = [];
        foreach ($facilities as $fac) {
            $facMap[$fac['id']] = $fac;
        }

        $rolesMeta = $this->getStaffRoles();

        $enriched = array_map(function ($s) use ($facMap, $facilities, $rolesMeta) {
            // Role info
            $roleKey = $s['role'] ?? 'operator';
            $s['role_meta'] = $rolesMeta[$roleKey] ?? [
                'role' => $roleKey,
                'label' => ucfirst($roleKey),
                'short' => ucfirst($roleKey),
                'badge' => 'bg-slate-100 text-slate-700 border border-slate-200',
                'description' => 'Authorized team member.',
            ];

            // Facilities list
            $assignedFacs = $s['assigned_facilities'] ?? [];
            $s['is_all_facilities'] = ($s['facility_scope'] ?? 'custom') === 'all';
            
            if ($s['is_all_facilities']) {
                $s['facility_names'] = ['All Authorized Facilities (' . count($facilities) . ')'];
                $s['facility_badges'] = array_map(fn($f) => $f['name'], $facilities);
            } else {
                $names = [];
                foreach ($assignedFacs as $fid) {
                    if (isset($facMap[$fid])) {
                        $names[] = $facMap[$fid]['name'];
                    }
                }
                $s['facility_names'] = !empty($names) ? $names : ['Unassigned'];
                $s['facility_badges'] = $names;
            }

            // Initials
            $parts = explode(' ', trim($s['name']));
            $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
            $s['initials'] = $initials ?: 'ST';

            return $s;
        }, $rawStaff);

        // Apply filters
        $q = trim(strtolower($filters['q'] ?? ''));
        if ($q !== '') {
            $enriched = array_filter($enriched, function ($item) use ($q) {
                return str_contains(strtolower($item['name'] ?? ''), $q)
                    || str_contains(strtolower($item['email'] ?? ''), $q)
                    || str_contains(strtolower($item['phone'] ?? ''), $q)
                    || str_contains(strtolower($item['id'] ?? ''), $q);
            });
        }

        $roleFilter = $filters['role'] ?? 'all';
        if ($roleFilter !== 'all') {
            $enriched = array_filter($enriched, fn($item) => ($item['role'] ?? '') === $roleFilter);
        }

        $statusFilter = $filters['status'] ?? 'all';
        if ($statusFilter !== 'all') {
            $enriched = array_filter($enriched, fn($item) => ($item['status'] ?? '') === $statusFilter);
        }

        $facFilter = $filters['facility'] ?? 'all';
        if ($facFilter !== 'all') {
            $enriched = array_filter($enriched, function ($item) use ($facFilter) {
                if (($item['facility_scope'] ?? 'custom') === 'all') {
                    return true;
                }
                return in_array($facFilter, $item['assigned_facilities'] ?? []);
            });
        }

        // Sorting
        $sort = $filters['sort'] ?? 'date_desc';
        usort($enriched, function ($a, $b) use ($sort) {
            if ($sort === 'name_asc') {
                return strcmp($a['name'], $b['name']);
            }
            if ($sort === 'name_desc') {
                return strcmp($b['name'], $a['name']);
            }
            if ($sort === 'role_asc') {
                $order = ['owner' => 1, 'administrator' => 2, 'supervisor' => 3, 'operator' => 4];
                return ($order[$a['role'] ?? ''] ?? 9) <=> ($order[$b['role'] ?? ''] ?? 9);
            }
            // date_desc (default)
            return strcmp($b['created_at'] ?? '', $a['created_at'] ?? '');
        });

        return array_values($enriched);
    }

    /**
     * Compute compact staff summary metrics for the vendor tenant.
     */
    public function getStaffSummaryMetrics(): array
    {
        $allStaff = $this->loadStoredStaff();
        $total = count($allStaff);
        $active = 0;
        $pending = 0;
        $suspended = 0;
        $adminCount = 0;
        $operatorCount = 0;

        foreach ($allStaff as $s) {
            $st = $s['status'] ?? 'active';
            if ($st === 'active') {
                $active++;
            } elseif ($st === 'pending') {
                $pending++;
            } elseif ($st === 'suspended') {
                $suspended++;
            }

            $r = $s['role'] ?? 'operator';
            if ($r === 'owner' || $r === 'administrator') {
                $adminCount++;
            } else {
                $operatorCount++;
            }
        }

        return [
            'total_staff' => $total,
            'active_count' => $active,
            'pending_count' => $pending,
            'suspended_count' => $suspended,
            'admin_count' => $adminCount,
            'operator_count' => $operatorCount,
            'facility_coverage' => '100% (3/3 facilities covered)',
        ];
    }

    /**
     * Find single staff member by ID.
     */
    public function getStaffMember(string $id): ?array
    {
        $all = $this->getStaff();
        foreach ($all as $s) {
            if ($s['id'] === $id) {
                return $s;
            }
        }
        return null;
    }

    /**
     * Create a new staff member or send invitation.
     */
    public function createStaffMember(array $data): array
    {
        $allStaff = $this->loadStoredStaff();

        // Check duplicate email
        $cleanEmail = strtolower(trim($data['email']));
        foreach ($allStaff as $s) {
            if (strtolower(trim($s['email'])) === $cleanEmail) {
                throw new \InvalidArgumentException("A staff member with email '{$cleanEmail}' is already registered.");
            }
        }

        $rolesMeta = $this->getStaffRoles();
        $role = $data['role'] ?? 'operator';
        if (!isset($rolesMeta[$role]) || $role === 'owner') {
            $role = 'operator';
        }

        $facilityScope = $data['facility_scope'] ?? 'custom';
        $assignedFacilities = [];
        if ($facilityScope === 'all') {
            $assignedFacilities = ['fac-mall-xyz', 'fac-gi-west', 'fac-cp-jkt'];
        } else {
            $assignedFacilities = $data['facilities'] ?? [];
        }

        $sendInvite = !empty($data['send_invite']);
        $status = $sendInvite ? 'pending' : 'active';
        $invitationStatus = $sendInvite ? 'pending' : 'accepted';

        $id = 'stf-' . str_pad((string)(count($allStaff) + 1), 3, '0', STR_PAD_LEFT);
        while (in_array($id, array_column($allStaff, 'id'))) {
            $id = 'stf-' . substr(md5(uniqid()), 0, 4);
        }

        $newMember = [
            'id' => $id,
            'name' => trim($data['name']),
            'email' => $cleanEmail,
            'phone' => trim($data['phone'] ?? '+62 812-' . rand(1000, 9999) . '-' . rand(1000, 9999)),
            'role' => $role,
            'role_label' => $rolesMeta[$role]['label'] ?? ucfirst($role),
            'facility_scope' => $facilityScope,
            'assigned_facilities' => $assignedFacilities,
            'status' => $status,
            'is_owner' => false,
            'invitation_status' => $invitationStatus,
            'invited_at' => date('d M Y, H:i') . ' WIB',
            'last_active_at' => $sendInvite ? 'Pending Activation' : 'Recently added',
            'notes' => trim($data['notes'] ?? 'Added via Operator Staff Management console.'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $allStaff[] = $newMember;
        $this->saveStaff($allStaff);

        return $newMember;
    }

    /**
     * Update an existing staff member.
     */
    public function updateStaffMember(string $id, array $data): ?array
    {
        $allStaff = $this->loadStoredStaff();
        $updated = null;

        $rolesMeta = $this->getStaffRoles();

        foreach ($allStaff as $index => $s) {
            if ($s['id'] === $id) {
                // If target is owner, prevent demoting or suspending
                $isOwner = !empty($s['is_owner']);

                if (isset($data['name'])) {
                    $allStaff[$index]['name'] = trim($data['name']);
                }
                if (isset($data['phone'])) {
                    $allStaff[$index]['phone'] = trim($data['phone']);
                }
                if (isset($data['notes'])) {
                    $allStaff[$index]['notes'] = trim($data['notes']);
                }

                if (!$isOwner && isset($data['role'])) {
                    $role = $data['role'];
                    if (isset($rolesMeta[$role]) && $role !== 'owner') {
                        $allStaff[$index]['role'] = $role;
                        $allStaff[$index]['role_label'] = $rolesMeta[$role]['label'];
                    }
                }

                if (isset($data['facility_scope'])) {
                    $fScope = $data['facility_scope'];
                    $allStaff[$index]['facility_scope'] = $fScope;
                    if ($fScope === 'all') {
                        $allStaff[$index]['assigned_facilities'] = ['fac-mall-xyz', 'fac-gi-west', 'fac-cp-jkt'];
                    } elseif (isset($data['facilities'])) {
                        $allStaff[$index]['assigned_facilities'] = (array)$data['facilities'];
                    }
                }

                if (!$isOwner && isset($data['status'])) {
                    $validStatuses = ['active', 'pending', 'suspended'];
                    if (in_array($data['status'], $validStatuses)) {
                        $allStaff[$index]['status'] = $data['status'];
                    }
                }

                $updated = $allStaff[$index];
                break;
            }
        }

        if ($updated !== null) {
            $this->saveStaff($allStaff);
        }

        return $updated;
    }

    /**
     * Toggle or update a staff member's operational status.
     */
    public function toggleStaffStatus(string $id, string $newStatus): ?array
    {
        $allStaff = $this->loadStoredStaff();
        $updated = null;

        foreach ($allStaff as $index => $s) {
            if ($s['id'] === $id) {
                // Safety guard: cannot suspend or deactivate owner
                if (!empty($s['is_owner'])) {
                    return null;
                }

                if (in_array($newStatus, ['active', 'suspended'])) {
                    $allStaff[$index]['status'] = $newStatus;
                    $updated = $allStaff[$index];
                }
                break;
            }
        }

        if ($updated !== null) {
            $this->saveStaff($allStaff);
        }

        return $updated;
    }

    /**
     * Resend an activation invitation to a pending staff member.
     */
    public function resendStaffInvitation(string $id): ?array
    {
        $allStaff = $this->loadStoredStaff();
        $updated = null;

        foreach ($allStaff as $index => $s) {
            if ($s['id'] === $id) {
                $allStaff[$index]['invited_at'] = date('d M Y, H:i') . ' WIB';
                $allStaff[$index]['invitation_status'] = 'pending';
                $allStaff[$index]['status'] = 'pending';
                $updated = $allStaff[$index];
                break;
            }
        }

        if ($updated !== null) {
            $this->saveStaff($allStaff);
        }

        return $updated;
    }

    /**
     * Remove / revoke a staff member's access to the vendor tenant.
     */
    public function deleteStaffMember(string $id): bool
    {
        $allStaff = $this->loadStoredStaff();
        $targetIndex = null;

        foreach ($allStaff as $index => $s) {
            if ($s['id'] === $id) {
                // Safeguard: cannot delete owner
                if (!empty($s['is_owner'])) {
                    return false;
                }
                $targetIndex = $index;
                break;
            }
        }

        if ($targetIndex !== null) {
            array_splice($allStaff, $targetIndex, 1);
            $this->saveStaff($allStaff);
            return true;
        }

        return false;
    }

    /**
     * Get default subscription details for vendor tenant PT Parkir Cipta Nusantara.
     */
    public function getSubscriptionDetails(): array
    {
        return [
            'plan_id' => 'plan-enterprise',
            'plan_name' => 'NusaPark Enterprise Tier',
            'plan_badge' => 'Enterprise Multi-Facility License',
            'billing_interval' => 'Monthly',
            'current_period_start' => '01 Oct 2026',
            'current_period_end' => '31 Oct 2026',
            'next_billing_date' => '01 Nov 2026',
            'renewal_status' => 'Auto-Debit Active',
            'payment_method_summary' => 'Bank BCA Corporate Auto-Debit (•••• 5432)',
            'base_fee' => 10000000,
            'formatted_base_fee' => 'Rp 10.000.000',
            'facility_fee' => 3000000,
            'formatted_facility_fee' => 'Rp 3.000.000',
            'hardware_fee' => 1800000,
            'formatted_hardware_fee' => 'Rp 1.800.000',
            'support_fee' => 200000,
            'formatted_support_fee' => 'Rp 200.000',
            'subtotal' => 15000000,
            'tax_rate' => 11,
            'tax_amount' => 1650000,
            'total_monthly' => 16650000,
            'formatted_total_monthly' => 'Rp 16.650.000',
            'status' => 'active',
            'status_label' => 'Active Subscription',
        ];
    }

    /**
     * Default list of canonical subscription invoices for vdr-jkt-01.
     */
    protected function getDefaultInvoices(): array
    {
        $issuer = [
            'company' => 'PT NusaPark Digital Indonesia',
            'brand' => 'NusaPark Enterprise Cloud Platform',
            'address' => 'Cyber 2 Tower, Lantai 18, Jl. H.R. Rasuna Said Blok X-5 No. 13',
            'city' => 'Jakarta Selatan, DKI Jakarta 12950',
            'tax_id' => 'NPWP: 02.456.789.1-015.000',
            'contact_email' => 'billing@nusapark.id',
            'contact_phone' => '+62 21 555-8900',
        ];

        $recipient = [
            'company' => 'PT Parkir Cipta Nusantara',
            'tax_id' => 'NPWP: 01.234.567.8-012.000',
            'attention' => 'Budi Santoso (Operations Manager)',
            'address' => 'Jl. Metro Pondok Indah Blok 3B, Kebayoran Lama',
            'city' => 'Jakarta Selatan, DKI Jakarta 12310',
            'email' => 'budi.santoso@parkircipta.co.id',
            'phone' => '+62 811-9876-5432',
        ];

        return [
            [
                'id' => 'inv-2026-10',
                'invoice_number' => 'INV-2026-10-0042',
                'billing_period' => '01 Oct 2026 - 31 Oct 2026',
                'issue_date' => '2026-10-01',
                'due_date' => '2026-10-15',
                'status' => 'unpaid',
                'paid_at' => null,
                'subtotal' => 15000000,
                'tax_amount' => 1650000,
                'discount_amount' => 0,
                'total_amount' => 16650000,
                'formatted_total' => 'Rp 16.650.000',
                'payment_reference' => null,
                'payment_method' => 'BCA Corporate Virtual Account',
                'issuer' => $issuer,
                'recipient' => $recipient,
                'line_items' => [
                    [
                        'name' => 'NusaPark Enterprise Platform Core',
                        'description' => 'Multi-facility parking cloud management license, real-time ANPR sync & operator dashboard.',
                        'unit_price' => 10000000,
                        'formatted_unit_price' => 'Rp 10.000.000',
                        'quantity' => 1,
                        'total' => 10000000,
                        'formatted_total' => 'Rp 10.000.000',
                    ],
                    [
                        'name' => 'Managed Facilities Expansion Pack',
                        'description' => 'Active location nodes: Mall XYZ Jakarta, Grand Indonesia West Mall, Central Park Mall Jakarta.',
                        'unit_price' => 1000000,
                        'formatted_unit_price' => 'Rp 1.000.000',
                        'quantity' => 3,
                        'total' => 3000000,
                        'formatted_total' => 'Rp 3.000.000',
                    ],
                    [
                        'name' => 'IoT & Barrier Cloud Gateway Streams',
                        'description' => 'Continuous telemetry bridge for 18 barrier gates, ultrasonic sensors & ANPR cameras.',
                        'unit_price' => 100000,
                        'formatted_unit_price' => 'Rp 100.000',
                        'quantity' => 18,
                        'total' => 1800000,
                        'formatted_total' => 'Rp 1.800.000',
                    ],
                    [
                        'name' => 'Premium Field SLA & 24/7 Priority Support',
                        'description' => 'Dedicated engineering incident response under 15 minutes and regular preventive checks.',
                        'unit_price' => 200000,
                        'formatted_unit_price' => 'Rp 200.000',
                        'quantity' => 1,
                        'total' => 200000,
                        'formatted_total' => 'Rp 200.000',
                    ],
                ],
                'created_at' => '2026-10-01 00:00:00',
            ],
            [
                'id' => 'inv-2026-09',
                'invoice_number' => 'INV-2026-09-0038',
                'billing_period' => '01 Sep 2026 - 30 Sep 2026',
                'issue_date' => '2026-09-01',
                'due_date' => '2026-09-15',
                'status' => 'paid',
                'paid_at' => '2026-09-10 11:24:15',
                'subtotal' => 15000000,
                'tax_amount' => 1650000,
                'discount_amount' => 0,
                'total_amount' => 16650000,
                'formatted_total' => 'Rp 16.650.000',
                'payment_reference' => 'BILL-PAY-20260910-881',
                'payment_method' => 'Bank Mandiri Corporate Virtual Account',
                'issuer' => $issuer,
                'recipient' => $recipient,
                'line_items' => [
                    [
                        'name' => 'NusaPark Enterprise Platform Core',
                        'description' => 'Multi-facility parking cloud management license, real-time ANPR sync & operator dashboard.',
                        'unit_price' => 10000000,
                        'formatted_unit_price' => 'Rp 10.000.000',
                        'quantity' => 1,
                        'total' => 10000000,
                        'formatted_total' => 'Rp 10.000.000',
                    ],
                    [
                        'name' => 'Managed Facilities Expansion Pack',
                        'description' => 'Active location nodes: Mall XYZ Jakarta, Grand Indonesia West Mall, Central Park Mall Jakarta.',
                        'unit_price' => 1000000,
                        'formatted_unit_price' => 'Rp 1.000.000',
                        'quantity' => 3,
                        'total' => 3000000,
                        'formatted_total' => 'Rp 3.000.000',
                    ],
                    [
                        'name' => 'IoT & Barrier Cloud Gateway Streams',
                        'description' => 'Continuous telemetry bridge for 18 barrier gates, ultrasonic sensors & ANPR cameras.',
                        'unit_price' => 100000,
                        'formatted_unit_price' => 'Rp 100.000',
                        'quantity' => 18,
                        'total' => 1800000,
                        'formatted_total' => 'Rp 1.800.000',
                    ],
                    [
                        'name' => 'Premium Field SLA & 24/7 Priority Support',
                        'description' => 'Dedicated engineering incident response under 15 minutes and regular preventive checks.',
                        'unit_price' => 200000,
                        'formatted_unit_price' => 'Rp 200.000',
                        'quantity' => 1,
                        'total' => 200000,
                        'formatted_total' => 'Rp 200.000',
                    ],
                ],
                'created_at' => '2026-09-01 00:00:00',
            ],
            [
                'id' => 'inv-2026-08',
                'invoice_number' => 'INV-2026-08-0031',
                'billing_period' => '01 Aug 2026 - 31 Aug 2026',
                'issue_date' => '2026-08-01',
                'due_date' => '2026-08-15',
                'status' => 'paid',
                'paid_at' => '2026-08-12 14:05:30',
                'subtotal' => 15000000,
                'tax_amount' => 1650000,
                'discount_amount' => 0,
                'total_amount' => 16650000,
                'formatted_total' => 'Rp 16.650.000',
                'payment_reference' => 'BILL-PAY-20260812-402',
                'payment_method' => 'Bank BCA Corporate Auto-Debit',
                'issuer' => $issuer,
                'recipient' => $recipient,
                'line_items' => [
                    [
                        'name' => 'NusaPark Enterprise Platform Core',
                        'description' => 'Multi-facility parking cloud management license, real-time ANPR sync & operator dashboard.',
                        'unit_price' => 10000000,
                        'formatted_unit_price' => 'Rp 10.000.000',
                        'quantity' => 1,
                        'total' => 10000000,
                        'formatted_total' => 'Rp 10.000.000',
                    ],
                    [
                        'name' => 'Managed Facilities Expansion Pack',
                        'description' => 'Active location nodes: Mall XYZ Jakarta, Grand Indonesia West Mall, Central Park Mall Jakarta.',
                        'unit_price' => 1000000,
                        'formatted_unit_price' => 'Rp 1.000.000',
                        'quantity' => 3,
                        'total' => 3000000,
                        'formatted_total' => 'Rp 3.000.000',
                    ],
                    [
                        'name' => 'IoT & Barrier Cloud Gateway Streams',
                        'description' => 'Continuous telemetry bridge for 18 barrier gates, ultrasonic sensors & ANPR cameras.',
                        'unit_price' => 100000,
                        'formatted_unit_price' => 'Rp 100.000',
                        'quantity' => 18,
                        'total' => 1800000,
                        'formatted_total' => 'Rp 1.800.000',
                    ],
                    [
                        'name' => 'Premium Field SLA & 24/7 Priority Support',
                        'description' => 'Dedicated engineering incident response under 15 minutes and regular preventive checks.',
                        'unit_price' => 200000,
                        'formatted_unit_price' => 'Rp 200.000',
                        'quantity' => 1,
                        'total' => 200000,
                        'formatted_total' => 'Rp 200.000',
                    ],
                ],
                'created_at' => '2026-08-01 00:00:00',
            ],
            [
                'id' => 'inv-2026-07',
                'invoice_number' => 'INV-2026-07-0025',
                'billing_period' => '01 Jul 2026 - 31 Jul 2026',
                'issue_date' => '2026-07-01',
                'due_date' => '2026-07-15',
                'status' => 'paid',
                'paid_at' => '2026-07-14 09:18:44',
                'subtotal' => 13000000,
                'tax_amount' => 1430000,
                'discount_amount' => 0,
                'total_amount' => 14430000,
                'formatted_total' => 'Rp 14.430.000',
                'payment_reference' => 'BILL-PAY-20260714-190',
                'payment_method' => 'Bank BCA Corporate Auto-Debit',
                'issuer' => $issuer,
                'recipient' => $recipient,
                'line_items' => [
                    [
                        'name' => 'NusaPark Enterprise Platform Core',
                        'description' => 'Multi-facility parking cloud management license, real-time ANPR sync & operator dashboard.',
                        'unit_price' => 10000000,
                        'formatted_unit_price' => 'Rp 10.000.000',
                        'quantity' => 1,
                        'total' => 10000000,
                        'formatted_total' => 'Rp 10.000.000',
                    ],
                    [
                        'name' => 'Managed Facilities Expansion Pack (2 Sites)',
                        'description' => 'Active location nodes: Mall XYZ Jakarta, Grand Indonesia West Mall.',
                        'unit_price' => 1000000,
                        'formatted_unit_price' => 'Rp 1.000.000',
                        'quantity' => 2,
                        'total' => 2000000,
                        'formatted_total' => 'Rp 2.000.000',
                    ],
                    [
                        'name' => 'IoT & Barrier Cloud Gateway Streams (10 Devices)',
                        'description' => 'Continuous telemetry bridge for 10 barrier gates & ANPR cameras.',
                        'unit_price' => 100000,
                        'formatted_unit_price' => 'Rp 100.000',
                        'quantity' => 10,
                        'total' => 1000000,
                        'formatted_total' => 'Rp 1.000.000',
                    ],
                ],
                'created_at' => '2026-07-01 00:00:00',
            ],
            [
                'id' => 'inv-2026-06',
                'invoice_number' => 'INV-2026-06-0019',
                'billing_period' => '01 Jun 2026 - 30 Jun 2026',
                'issue_date' => '2026-06-01',
                'due_date' => '2026-06-15',
                'status' => 'paid',
                'paid_at' => '2026-06-11 16:35:10',
                'subtotal' => 13000000,
                'tax_amount' => 1430000,
                'discount_amount' => 1000000,
                'total_amount' => 13430000,
                'formatted_total' => 'Rp 13.430.000',
                'payment_reference' => 'BILL-PAY-20260611-067',
                'payment_method' => 'Bank BCA Corporate Auto-Debit',
                'issuer' => $issuer,
                'recipient' => $recipient,
                'line_items' => [
                    [
                        'name' => 'NusaPark Enterprise Platform Core',
                        'description' => 'Multi-facility parking cloud management license, real-time ANPR sync & operator dashboard.',
                        'unit_price' => 10000000,
                        'formatted_unit_price' => 'Rp 10.000.000',
                        'quantity' => 1,
                        'total' => 10000000,
                        'formatted_total' => 'Rp 10.000.000',
                    ],
                    [
                        'name' => 'Managed Facilities Expansion Pack (2 Sites)',
                        'description' => 'Active location nodes: Mall XYZ Jakarta, Grand Indonesia West Mall.',
                        'unit_price' => 1000000,
                        'formatted_unit_price' => 'Rp 1.000.000',
                        'quantity' => 2,
                        'total' => 2000000,
                        'formatted_total' => 'Rp 2.000.000',
                    ],
                    [
                        'name' => 'IoT & Barrier Cloud Gateway Streams (10 Devices)',
                        'description' => 'Continuous telemetry bridge for 10 barrier gates & ANPR cameras.',
                        'unit_price' => 100000,
                        'formatted_unit_price' => 'Rp 100.000',
                        'quantity' => 10,
                        'total' => 1000000,
                        'formatted_total' => 'Rp 1.000.000',
                    ],
                ],
                'created_at' => '2026-06-01 00:00:00',
            ],
        ];
    }

    /**
     * Default list of billing payments history for subscription invoices.
     */
    protected function getDefaultBillingPayments(): array
    {
        return [
            [
                'id' => 'pay-001',
                'payment_reference' => 'BILL-PAY-20260910-881',
                'invoice_id' => 'inv-2026-09',
                'invoice_number' => 'INV-2026-09-0038',
                'amount' => 16650000,
                'formatted_amount' => 'Rp 16.650.000',
                'payment_method' => 'Bank Mandiri Corporate Virtual Account',
                'provider_reference' => 'MID-VA-20260910-990234',
                'status' => 'settled',
                'status_label' => 'Settled',
                'payment_date' => '10 Sep 2026, 11:24 WIB',
                'created_at' => '2026-09-10 11:24:15',
            ],
            [
                'id' => 'pay-002',
                'payment_reference' => 'BILL-PAY-20260812-402',
                'invoice_id' => 'inv-2026-08',
                'invoice_number' => 'INV-2026-08-0031',
                'amount' => 16650000,
                'formatted_amount' => 'Rp 16.650.000',
                'payment_method' => 'Bank BCA Corporate Auto-Debit',
                'provider_reference' => 'BCA-AD-20260812-771890',
                'status' => 'settled',
                'status_label' => 'Settled',
                'payment_date' => '12 Aug 2026, 14:05 WIB',
                'created_at' => '2026-08-12 14:05:30',
            ],
            [
                'id' => 'pay-003',
                'payment_reference' => 'BILL-PAY-20260714-190',
                'invoice_id' => 'inv-2026-07',
                'invoice_number' => 'INV-2026-07-0025',
                'amount' => 14430000,
                'formatted_amount' => 'Rp 14.430.000',
                'payment_method' => 'Bank BCA Corporate Auto-Debit',
                'provider_reference' => 'BCA-AD-20260714-654312',
                'status' => 'settled',
                'status_label' => 'Settled',
                'payment_date' => '14 Jul 2026, 09:18 WIB',
                'created_at' => '2026-07-14 09:18:44',
            ],
            [
                'id' => 'pay-004',
                'payment_reference' => 'BILL-PAY-20260611-067',
                'invoice_id' => 'inv-2026-06',
                'invoice_number' => 'INV-2026-06-0019',
                'amount' => 13430000,
                'formatted_amount' => 'Rp 13.430.000',
                'payment_method' => 'Bank BCA Corporate Auto-Debit',
                'provider_reference' => 'BCA-AD-20260611-551029',
                'status' => 'settled',
                'status_label' => 'Settled',
                'payment_date' => '11 Jun 2026, 16:35 WIB',
                'created_at' => '2026-06-11 16:35:10',
            ],
        ];
    }

    /**
     * Load stored subscription invoices from cache.
     */
    protected function loadStoredInvoices(): array
    {
        $invoices = Cache::get(self::INVOICES_CACHE_KEY);
        if ($invoices === null) {
            $invoices = $this->getDefaultInvoices();
            $this->saveInvoices($invoices);
        }
        return $invoices;
    }

    /**
     * Persist subscription invoices to cache.
     */
    protected function saveInvoices(array $invoices): void
    {
        Cache::put(self::INVOICES_CACHE_KEY, $invoices, now()->addDays(30));
    }

    /**
     * Load stored billing payments history from cache.
     */
    protected function loadStoredBillingPayments(): array
    {
        $payments = Cache::get(self::BILLING_PAYMENTS_CACHE_KEY);
        if ($payments === null) {
            $payments = $this->getDefaultBillingPayments();
            $this->saveBillingPayments($payments);
        }
        return $payments;
    }

    /**
     * Persist billing payments to cache.
     */
    protected function saveBillingPayments(array $payments): void
    {
        Cache::put(self::BILLING_PAYMENTS_CACHE_KEY, $payments, now()->addDays(30));
    }

    /**
     * Retrieve invoices with filtering, status enrichment, and sorting.
     */
    public function getInvoices(array $filters = []): array
    {
        $allInvoices = $this->loadStoredInvoices();

        $enriched = array_map(function ($inv) {
            $st = $inv['status'] ?? 'unpaid';
            $dueDate = strtotime($inv['due_date']);
            $today = strtotime('2026-10-11'); // Authoritative context date

            $isOverdue = ($st === 'unpaid' && $today > $dueDate);
            if ($isOverdue) {
                $st = 'overdue';
                $inv['status'] = 'overdue';
            }

            if ($st === 'paid') {
                $inv['status_meta'] = [
                    'status' => 'paid',
                    'label' => 'Paid',
                    'badge' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                    'dot' => 'bg-emerald-500',
                ];
            } elseif ($st === 'overdue') {
                $inv['status_meta'] = [
                    'status' => 'overdue',
                    'label' => 'Overdue',
                    'badge' => 'bg-rose-50 text-rose-700 border border-rose-200',
                    'dot' => 'bg-rose-500',
                ];
            } else {
                $inv['status_meta'] = [
                    'status' => 'unpaid',
                    'label' => 'Unpaid (Due Soon)',
                    'badge' => 'bg-amber-50 text-amber-800 border border-amber-300',
                    'dot' => 'bg-amber-500',
                ];
            }

            $inv['formatted_total'] = 'Rp ' . number_format($inv['total_amount'], 0, ',', '.');
            $inv['formatted_subtotal'] = 'Rp ' . number_format($inv['subtotal'], 0, ',', '.');
            $inv['formatted_tax'] = 'Rp ' . number_format($inv['tax_amount'], 0, ',', '.');
            $inv['formatted_discount'] = 'Rp ' . number_format($inv['discount_amount'], 0, ',', '.');
            $inv['formatted_issue_date'] = date('d M Y', strtotime($inv['issue_date']));
            $inv['formatted_due_date'] = date('d M Y', strtotime($inv['due_date']));

            return $inv;
        }, $allInvoices);

        // Apply filters
        $q = trim(strtolower($filters['q'] ?? ''));
        if ($q !== '') {
            $enriched = array_filter($enriched, function ($item) use ($q) {
                return str_contains(strtolower($item['invoice_number'] ?? ''), $q)
                    || str_contains(strtolower($item['billing_period'] ?? ''), $q)
                    || str_contains(strtolower($item['payment_reference'] ?? ''), $q);
            });
        }

        $statusFilter = $filters['status'] ?? 'all';
        if ($statusFilter !== 'all') {
            $enriched = array_filter($enriched, fn($item) => ($item['status'] ?? '') === $statusFilter);
        }

        $yearFilter = $filters['year'] ?? 'all';
        if ($yearFilter !== 'all') {
            $enriched = array_filter($enriched, function ($item) use ($yearFilter) {
                return str_starts_with($item['issue_date'] ?? '', $yearFilter);
            });
        }

        // Sorting
        $sort = $filters['sort'] ?? 'date_desc';
        usort($enriched, function ($a, $b) use ($sort) {
            if ($sort === 'date_asc') {
                return strcmp($a['issue_date'], $b['issue_date']);
            }
            if ($sort === 'amount_desc') {
                return $b['total_amount'] <=> $a['total_amount'];
            }
            if ($sort === 'amount_asc') {
                return $a['total_amount'] <=> $b['total_amount'];
            }
            // date_desc (default)
            return strcmp($b['issue_date'], $a['issue_date']);
        });

        return array_values($enriched);
    }

    /**
     * Retrieve single invoice by ID with line items.
     */
    public function getInvoice(string $id): ?array
    {
        $all = $this->getInvoices();
        foreach ($all as $inv) {
            if ($inv['id'] === $id || $inv['invoice_number'] === $id) {
                return $inv;
            }
        }
        return null;
    }

    /**
     * Compute authoritative billing summary metrics.
     */
    public function getBillingSummary(): array
    {
        $invoices = $this->getInvoices();
        $outstanding = 0;
        $unpaidCount = 0;
        $latestInvoice = $invoices[0] ?? null;

        foreach ($invoices as $inv) {
            if (($inv['status'] ?? '') === 'unpaid' || ($inv['status'] ?? '') === 'overdue') {
                $outstanding += (int)$inv['total_amount'];
                $unpaidCount++;
            }
        }

        $payments = $this->loadStoredBillingPayments();
        $lastPayment = $payments[0] ?? null;

        return [
            'outstanding_balance' => $outstanding,
            'formatted_outstanding_balance' => 'Rp ' . number_format($outstanding, 0, ',', '.'),
            'unpaid_count' => $unpaidCount,
            'latest_invoice' => $latestInvoice,
            'last_payment' => $lastPayment,
            'subscription' => $this->getSubscriptionDetails(),
        ];
    }

    /**
     * Retrieve billing payments history audit log.
     */
    public function getBillingPayments(): array
    {
        return $this->loadStoredBillingPayments();
    }

    /**
     * Process payment for an outstanding subscription invoice.
     */
    public function payInvoice(string $id, array $paymentData = []): ?array
    {
        $allInvoices = $this->loadStoredInvoices();
        $targetIndex = null;

        foreach ($allInvoices as $index => $inv) {
            if ($inv['id'] === $id || $inv['invoice_number'] === $id) {
                $targetIndex = $index;
                break;
            }
        }

        if ($targetIndex === null) {
            return null;
        }

        $target = $allInvoices[$targetIndex];
        if ($target['status'] === 'paid') {
            return $target;
        }

        $paymentRef = 'BILL-PAY-' . date('Ymd') . '-' . rand(100, 999);
        $method = $paymentData['method'] ?? 'Bank BCA Corporate Virtual Account';

        // Update invoice
        $allInvoices[$targetIndex]['status'] = 'paid';
        $allInvoices[$targetIndex]['paid_at'] = date('Y-m-d H:i:s');
        $allInvoices[$targetIndex]['payment_reference'] = $paymentRef;
        $allInvoices[$targetIndex]['payment_method'] = $method;

        $this->saveInvoices($allInvoices);

        // Add payment audit record
        $allPayments = $this->loadStoredBillingPayments();
        array_unshift($allPayments, [
            'id' => 'pay-' . substr(md5(uniqid()), 0, 6),
            'payment_reference' => $paymentRef,
            'invoice_id' => $target['id'],
            'invoice_number' => $target['invoice_number'],
            'amount' => $target['total_amount'],
            'formatted_amount' => 'Rp ' . number_format($target['total_amount'], 0, ',', '.'),
            'payment_method' => $method,
            'provider_reference' => 'MID-VA-' . date('Ymd') . '-' . rand(100000, 999999),
            'status' => 'settled',
            'status_label' => 'Settled',
            'payment_date' => date('d M Y, H:i') . ' WIB',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->saveBillingPayments($allPayments);

        return $allInvoices[$targetIndex];
    }

    // =========================================================================
    // PHASE 2, PAGE 35: VENDOR NOTIFICATIONS & OPERATIONAL ALERTS
    // =========================================================================

    /**
     * Default canonical notification records for vendor operations.
     */
    protected function getDefaultNotifications(): array
    {
        $now = time();

        return [
            [
                'id' => 'VNOTIF-202610-001',
                'title' => 'ANPR Low-Confidence Capture: Operator Review Required',
                'message' => 'Plate capture at Gate In-02 recorded 64% confidence score (partially obscured rear plate on Toyota Fortuner). Visual verification recommended.',
                'category' => 'anpr',
                'category_label' => 'ANPR Recognition',
                'severity' => 'warning',
                'severity_label' => 'Warning',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'device_id' => 'CAM-GI-02B',
                'device_name' => 'ANPR Camera 2B (Gate In-02)',
                'event_reference' => 'EVT-ANPR-9842',
                'action_url' => '/vendor/anpr?q=EVT-ANPR-9842',
                'action_label' => 'Review ANPR Event',
                'is_read' => false,
                'read_at' => null,
                'timestamp' => $now - 900, // 15 mins ago
                'created_at' => date('Y-m-d H:i:s', $now - 900),
            ],
            [
                'id' => 'VNOTIF-202610-002',
                'title' => 'Zone B Capacity Alert: Occupancy Exceeded 90%',
                'message' => 'Zone B (Basement 1) at Grand Indonesia West Mall reached 92% occupancy (486/528 slots occupied). Dynamic external guidance displays updated to divert incoming vehicles.',
                'category' => 'capacity',
                'category_label' => 'Zone Capacity',
                'severity' => 'warning',
                'severity_label' => 'Warning',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'device_id' => 'SIGN-GI-B1',
                'device_name' => 'Dynamic Guidance Sign B1',
                'event_reference' => 'ZONE-B1-OCCUPANCY',
                'action_url' => '/vendor/parking-areas',
                'action_label' => 'View Zone Occupancy',
                'is_read' => false,
                'read_at' => null,
                'timestamp' => $now - 2520, // 42 mins ago
                'created_at' => date('Y-m-d H:i:s', $now - 2520),
            ],
            [
                'id' => 'VNOTIF-202610-003',
                'title' => 'IoT Telemetry Alert: Gateway Heartbeat Delayed',
                'message' => 'Sensor Gateway GW-CP-01 in Central Park Mall outer lane missed 3 consecutive heartbeat cycles. Mesh failover routed telemetry via secondary node.',
                'category' => 'iot',
                'category_label' => 'IoT Telemetry',
                'severity' => 'warning',
                'severity_label' => 'Warning',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'device_id' => 'GW-CP-01',
                'device_name' => 'IoT LoRa Mesh Gateway 01',
                'event_reference' => 'DIAG-CP-9011',
                'action_url' => '/vendor/iot-devices?q=GW-CP-01',
                'action_label' => 'Inspect IoT Diagnostics',
                'is_read' => false,
                'read_at' => null,
                'timestamp' => $now - 4800, // 1h 20m ago
                'created_at' => date('Y-m-d H:i:s', $now - 4800),
            ],
            [
                'id' => 'VNOTIF-202610-004',
                'title' => 'Critical Session Exception: Overstay Limit Exceeded (>24h)',
                'message' => 'Vehicle B 1092 PQR has parked for 26h 15m in Mall XYZ Jakarta Basement 2 without long-stay authorization. Security patrol alert dispatched.',
                'category' => 'session',
                'category_label' => 'Parking Sessions',
                'severity' => 'critical',
                'severity_label' => 'Critical',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'device_id' => 'GATE-IN-01',
                'device_name' => 'North Entry Barrier Gate 01',
                'event_reference' => 'SESS-202610-088',
                'action_url' => '/vendor/parking-sessions?q=B+1092+PQR',
                'action_label' => 'Inspect Parking Session',
                'is_read' => false,
                'read_at' => null,
                'timestamp' => $now - 7200, // 2h ago
                'created_at' => date('Y-m-d H:i:s', $now - 7200),
            ],
            [
                'id' => 'VNOTIF-202610-005',
                'title' => 'Subscription Tax Invoice Issued: October 2026',
                'message' => 'Official SaaS Tax Invoice INV-202610-NP01 for Rp 6.993.000 (including 11% PPN) has been generated. Payment is due by 31 Oct 2026.',
                'category' => 'billing',
                'category_label' => 'Subscription & Billing',
                'severity' => 'info',
                'severity_label' => 'Informational',
                'facility_id' => null,
                'facility_name' => 'Platform Enterprise',
                'device_id' => null,
                'device_name' => null,
                'event_reference' => 'INV-202610-NP01',
                'action_url' => '/vendor/billing',
                'action_label' => 'View Tax Invoice',
                'is_read' => true,
                'read_at' => date('Y-m-d H:i:s', $now - 10000),
                'timestamp' => $now - 14400, // 4h ago
                'created_at' => date('Y-m-d H:i:s', $now - 14400),
            ],
            [
                'id' => 'VNOTIF-202610-006',
                'title' => 'Barrier Gate Safety Obstruction Sensor Cleared',
                'message' => 'Infrared anti-tailgating loop on Gate Out-01 at Central Park Mall detected an obstacle. Arm held open safely and resumed automatic cycles normally.',
                'category' => 'gate',
                'category_label' => 'Barrier Gates',
                'severity' => 'resolved',
                'severity_label' => 'Resolved',
                'facility_id' => 'fac-cp-jkt',
                'facility_name' => 'Central Park Mall',
                'device_id' => 'GATE-OUT-01',
                'device_name' => 'Automatic Barrier Gate Out-01',
                'event_reference' => 'GATE-LOG-7721',
                'action_url' => '/vendor/gates',
                'action_label' => 'View Barrier Gate Status',
                'is_read' => true,
                'read_at' => date('Y-m-d H:i:s', $now - 18000),
                'timestamp' => $now - 21600, // 6h ago
                'created_at' => date('Y-m-d H:i:s', $now - 21600),
            ],
            [
                'id' => 'VNOTIF-202610-007',
                'title' => 'Scheduled Platform Maintenance Window',
                'message' => 'NusaPark cloud engine will deploy edge firmware updates on Sunday, 26 Oct 2026 from 02:00 to 03:00 WIB. Smart barrier offline caching will handle traffic without interruption.',
                'category' => 'system',
                'category_label' => 'System & Account',
                'severity' => 'info',
                'severity_label' => 'Informational',
                'facility_id' => null,
                'facility_name' => 'Platform Enterprise',
                'device_id' => null,
                'device_name' => null,
                'event_reference' => 'MAINT-202610-26',
                'action_url' => '/vendor/dashboard',
                'action_label' => 'View System Status',
                'is_read' => true,
                'read_at' => date('Y-m-d H:i:s', $now - 70000),
                'timestamp' => $now - 86400, // 1 day ago
                'created_at' => date('Y-m-d H:i:s', $now - 86400),
            ],
            [
                'id' => 'VNOTIF-202610-008',
                'title' => 'Operator Staff Member Onboarded',
                'message' => 'Supervisor Rian Pratama has accepted the team invitation, activated account credentials, and bound two-factor mobile authentication.',
                'category' => 'system',
                'category_label' => 'System & Account',
                'severity' => 'info',
                'severity_label' => 'Informational',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'device_id' => null,
                'device_name' => null,
                'event_reference' => 'STAFF-INV-4412',
                'action_url' => '/vendor/staff',
                'action_label' => 'Manage Operator Staff',
                'is_read' => true,
                'read_at' => date('Y-m-d H:i:s', $now - 150000),
                'timestamp' => $now - 172800, // 2 days ago
                'created_at' => date('Y-m-d H:i:s', $now - 172800),
            ],
            [
                'id' => 'VNOTIF-202610-009',
                'title' => 'EV Charging Hub High Utilization Warning',
                'message' => 'All 6 ultra-fast EV charging bays at Mall XYZ Jakarta are currently active. Automatic queuing and notification dispatched to waiting drivers.',
                'category' => 'capacity',
                'category_label' => 'Zone Capacity',
                'severity' => 'warning',
                'severity_label' => 'Warning',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'device_id' => 'HUB-EV-01',
                'device_name' => 'EV Charging Bay Cluster 01',
                'event_reference' => 'EV-OCCUPANCY-FULL',
                'action_url' => '/vendor/parking-areas',
                'action_label' => 'View EV Hub Slots',
                'is_read' => true,
                'read_at' => date('Y-m-d H:i:s', $now - 220000),
                'timestamp' => $now - 259200, // 3 days ago
                'created_at' => date('Y-m-d H:i:s', $now - 259200),
            ],
            [
                'id' => 'VNOTIF-202610-010',
                'title' => 'ANPR Camera Calibration Restored',
                'message' => 'Field technician completed lens cleaning and optic focal recalibration on Camera 1A at Mall XYZ. Recognition accuracy benchmark returned to 99.4%.',
                'category' => 'anpr',
                'category_label' => 'ANPR Recognition',
                'severity' => 'resolved',
                'severity_label' => 'Resolved',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'device_id' => 'CAM-XYZ-01A',
                'device_name' => 'ANPR Camera 1A (Main In)',
                'event_reference' => 'CAM-MAINT-8812',
                'action_url' => '/vendor/anpr',
                'action_label' => 'Inspect Camera Status',
                'is_read' => true,
                'read_at' => date('Y-m-d H:i:s', $now - 300000),
                'timestamp' => $now - 345600, // 4 days ago
                'created_at' => date('Y-m-d H:i:s', $now - 345600),
            ],
            [
                'id' => 'VNOTIF-202610-011',
                'title' => 'Daily Revenue Escrow Settlement Reconciled',
                'message' => 'Daily merchant revenue payout of Rp 24.320.000 for Grand Indonesia West Mall successfully settled into vendor BCA Escrow account.',
                'category' => 'billing',
                'category_label' => 'Subscription & Billing',
                'severity' => 'resolved',
                'severity_label' => 'Resolved',
                'facility_id' => 'fac-gi-west',
                'facility_name' => 'Grand Indonesia West Mall',
                'device_id' => null,
                'device_name' => null,
                'event_reference' => 'STL-202610-8910',
                'action_url' => '/vendor/revenue',
                'action_label' => 'View Settlement Ledger',
                'is_read' => true,
                'read_at' => date('Y-m-d H:i:s', $now - 390000),
                'timestamp' => $now - 432000, // 5 days ago
                'created_at' => date('Y-m-d H:i:s', $now - 432000),
            ],
            [
                'id' => 'VNOTIF-202610-012',
                'title' => 'Barrier Gate Emergency Manual Key Override Recorded',
                'message' => 'Physical override key was engaged on Gate In-03 at Mall XYZ by supervisor for emergency medical ambulance passage. Logged in audit registry.',
                'category' => 'gate',
                'category_label' => 'Barrier Gates',
                'severity' => 'resolved',
                'severity_label' => 'Resolved',
                'facility_id' => 'fac-mall-xyz',
                'facility_name' => 'Mall XYZ Jakarta',
                'device_id' => 'GATE-IN-03',
                'device_name' => 'North Gate Entry 03',
                'event_reference' => 'OVERRIDE-LOG-551',
                'action_url' => '/vendor/gates',
                'action_label' => 'Review Gate Audit Log',
                'is_read' => true,
                'read_at' => date('Y-m-d H:i:s', $now - 480000),
                'timestamp' => $now - 518400, // 6 days ago
                'created_at' => date('Y-m-d H:i:s', $now - 518400),
            ],
        ];
    }

    /**
     * Load stored notifications from persistent cache.
     */
    protected function loadStoredNotifications(): array
    {
        return Cache::get(self::NOTIFICATIONS_CACHE_KEY, function () {
            $defaults = $this->getDefaultNotifications();
            Cache::forever(self::NOTIFICATIONS_CACHE_KEY, $defaults);
            return $defaults;
        });
    }

    /**
     * Save notifications array to persistent cache.
     */
    protected function saveNotifications(array $notifications): void
    {
        Cache::forever(self::NOTIFICATIONS_CACHE_KEY, $notifications);
    }

    /**
     * Format a timestamp into human-readable relative time string.
     */
    public function formatRelativeNotificationTime(int $timestamp): string
    {
        $diff = time() - $timestamp;

        if ($diff < 60) {
            return 'Just now';
        }
        if ($diff < 3600) {
            $mins = max(1, (int)floor($diff / 60));
            return $mins . ' min' . ($mins > 1 ? 's' : '') . ' ago';
        }
        if ($diff < 86400) {
            $hours = (int)floor($diff / 3600);
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        }
        if ($diff < 172800) {
            return 'Yesterday, ' . date('H:i', $timestamp) . ' WIB';
        }
        $days = (int)floor($diff / 86400);
        if ($days < 7) {
            return $days . ' days ago';
        }
        return date('d M Y, H:i', $timestamp) . ' WIB';
    }

    /**
     * Retrieve filtered, searched, and sorted notifications list.
     */
    public function getNotifications(array $filters = []): array
    {
        $notifications = $this->loadStoredNotifications();

        // 1. Search Query
        $q = trim(strtolower($filters['q'] ?? ''));
        if ($q !== '') {
            $notifications = array_filter($notifications, function ($item) use ($q) {
                return str_contains(strtolower($item['title']), $q)
                    || str_contains(strtolower($item['message']), $q)
                    || str_contains(strtolower($item['facility_name'] ?? ''), $q)
                    || str_contains(strtolower($item['device_name'] ?? ''), $q)
                    || str_contains(strtolower($item['event_reference'] ?? ''), $q)
                    || str_contains(strtolower($item['id']), $q);
            });
        }

        // 2. Category Filter
        $category = $filters['category'] ?? 'all';
        if ($category !== 'all' && array_key_exists($category, self::NOTIFICATION_CATEGORIES)) {
            $notifications = array_filter($notifications, fn($item) => $item['category'] === $category);
        }

        // 3. Status Filter (read / unread)
        $status = $filters['status'] ?? 'all';
        if ($status === 'unread') {
            $notifications = array_filter($notifications, fn($item) => !$item['is_read']);
        } elseif ($status === 'read') {
            $notifications = array_filter($notifications, fn($item) => $item['is_read']);
        }

        // 4. Severity Filter
        $severity = $filters['severity'] ?? 'all';
        if ($severity !== 'all' && array_key_exists($severity, self::NOTIFICATION_SEVERITIES)) {
            $notifications = array_filter($notifications, fn($item) => $item['severity'] === $severity);
        }

        // 5. Facility Filter
        $facility = $filters['facility'] ?? 'all';
        if ($facility !== 'all') {
            $notifications = array_filter($notifications, fn($item) => ($item['facility_id'] ?? '') === $facility);
        }

        // Sort: newest first
        usort($notifications, fn($a, $b) => $b['timestamp'] <=> $a['timestamp']);

        // Attach dynamic relative time
        return array_map(function ($item) {
            $item['formatted_time'] = $this->formatRelativeNotificationTime($item['timestamp']);
            return $item;
        }, array_values($notifications));
    }

    /**
     * Retrieve a single notification by ID.
     */
    public function getNotification(string $id): ?array
    {
        $all = $this->getNotifications();
        foreach ($all as $item) {
            if ($item['id'] === $id) {
                return $item;
            }
        }
        return null;
    }

    /**
     * Calculate aggregate metrics for notifications.
     */
    public function getNotificationMetrics(): array
    {
        $all = $this->loadStoredNotifications();

        $unread = 0;
        $critical = 0;
        $warning = 0;
        $info = 0;
        $resolved = 0;

        $byCategory = [
            'gate' => 0,
            'anpr' => 0,
            'iot' => 0,
            'capacity' => 0,
            'session' => 0,
            'billing' => 0,
            'system' => 0,
        ];

        foreach ($all as $item) {
            if (!$item['is_read']) {
                $unread++;
            }
            if ($item['severity'] === 'critical') {
                $critical++;
            } elseif ($item['severity'] === 'warning') {
                $warning++;
            } elseif ($item['severity'] === 'info') {
                $info++;
            } elseif ($item['severity'] === 'resolved') {
                $resolved++;
            }

            if (isset($byCategory[$item['category']])) {
                $byCategory[$item['category']]++;
            }
        }

        return [
            'total' => count($all),
            'unread' => $unread,
            'read' => count($all) - $unread,
            'critical' => $critical,
            'warning' => $warning,
            'info' => $info,
            'resolved' => $resolved,
            'by_category' => $byCategory,
        ];
    }

    /**
     * Retrieve authoritative unread count for fast badge synchronization.
     */
    public function getNotificationUnreadCount(): int
    {
        $all = $this->loadStoredNotifications();
        $count = 0;
        foreach ($all as $item) {
            if (!$item['is_read']) {
                $count++;
            }
        }
        return $count;
    }

    /**
     * Mark a single notification as read.
     */
    public function markNotificationAsRead(string $id): bool
    {
        $all = $this->loadStoredNotifications();
        $found = false;

        foreach ($all as $index => $item) {
            if ($item['id'] === $id) {
                if (!$item['is_read']) {
                    $all[$index]['is_read'] = true;
                    $all[$index]['read_at'] = date('Y-m-d H:i:s');
                    $found = true;
                }
                break;
            }
        }

        if ($found) {
            $this->saveNotifications($all);
        }

        return $found;
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllNotificationsAsRead(): int
    {
        $all = $this->loadStoredNotifications();
        $count = 0;
        $now = date('Y-m-d H:i:s');

        foreach ($all as $index => $item) {
            if (!$item['is_read']) {
                $all[$index]['is_read'] = true;
                $all[$index]['read_at'] = $now;
                $count++;
            }
        }

        if ($count > 0) {
            $this->saveNotifications($all);
        }

        return $count;
    }

    /**
     * Mark multiple selected notifications as read in bulk.
     */
    public function bulkMarkNotificationsAsRead(array $ids): int
    {
        if (empty($ids)) {
            return 0;
        }

        $all = $this->loadStoredNotifications();
        $count = 0;
        $now = date('Y-m-d H:i:s');
        $idMap = array_flip($ids);

        foreach ($all as $index => $item) {
            if (isset($idMap[$item['id']]) && !$item['is_read']) {
                $all[$index]['is_read'] = true;
                $all[$index]['read_at'] = $now;
                $count++;
            }
        }

        if ($count > 0) {
            $this->saveNotifications($all);
        }

        return $count;
    }

    /**
     * Remove or dismiss a notification from the inbox.
     */
    public function removeNotification(string $id): bool
    {
        $all = $this->loadStoredNotifications();
        $initialCount = count($all);

        $filtered = array_filter($all, fn($item) => $item['id'] !== $id);

        if (count($filtered) !== $initialCount) {
            $this->saveNotifications(array_values($filtered));
            return true;
        }

        return false;
    }

    // =========================================================================
    // PHASE 2, PAGE 36: VENDOR SETTINGS & OPERATIONAL PREFERENCES
    // =========================================================================

    /**
     * Default canonical settings and preferences configuration.
     */
    protected function getDefaultSettings(): array
    {
        return [
            'profile' => [
                'id' => 'vdr-jkt-01',
                'company_name' => 'PT Parkir Cipta Nusantara',
                'brand_name' => 'Cipta Parking Solutions',
                'nib' => '9120008471291',
                'npwp' => '02.987.654.3-034.000',
                'category' => 'Commercial Parking Operator & IoT Gate Integrator',
                'description' => 'National smart parking management partner operating high-throughput commercial and retail parking facilities across Jabodetabek and Bandung.',
                'partner_tier' => 'Enterprise Partner',
                'contract_status' => 'Active',
                'contract_number' => 'NUSA-VDR-2025-0042',
                'contract_expiry' => '31 Dec 2027',
                'logo_initials' => 'CPS',
            ],
            'contact' => [
                'address' => 'Cyber 2 Tower, Lantai 18, Jl. H.R. Rasuna Said Blok X-5',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'postal_code' => '12950',
                'email' => 'corporate@parkircipta.co.id',
                'billing_email' => 'invoicing@parkircipta.co.id',
                'phone' => '+62 21 555-8900',
                'emergency_hotline' => '+62 811-987-6543',
                'website' => 'https://parkircipta.co.id',
            ],
            'operational' => [
                'default_facility_id' => 'fac-gi-west',
                'anpr_confidence_threshold' => 80, // %
                'barrier_auto_close_delay' => 6, // seconds
                'overstay_alert_hours' => 24, // hours
                'capacity_warning_threshold' => 90, // %
                'allow_manual_gate_override' => true,
                'require_anpr_two_stage' => false,
                'telemetry_heartbeat_interval' => 30, // seconds
            ],
            'localization' => [
                'timezone' => 'Asia/Jakarta',
                'timezone_label' => 'Asia/Jakarta (WIB, UTC+7)',
                'locale' => 'id_ID',
                'locale_label' => 'Bahasa Indonesia (ID)',
                'currency' => 'IDR',
                'currency_symbol' => 'Rp',
                'date_format' => 'DD/MM/YYYY',
                'operating_hours' => '24/7 Continuous Operations',
            ],
            'notifications' => [
                'email_critical_alerts' => true,
                'email_daily_digest' => true,
                'email_billing_invoices' => true,
                'inapp_alerts' => true,
                'sms_emergency_dispatch' => true,
                'push_mobile_alerts' => true,
            ],
            'security' => [
                'operator_name' => 'Budi Santoso',
                'operator_role' => 'Operations Manager',
                'operator_email' => 'budi.santoso@parkircipta.co.id',
                'two_factor_enabled' => true,
                'session_timeout_hours' => 8,
                'api_key_masked' => 'np_live_sec_89f0••••••••••••••••9f2a',
                'api_status' => 'Active (Edge Controllers Connected)',
                'last_password_change' => '15 Sep 2026',
                'last_security_audit' => '01 Oct 2026',
                'allowed_ip_range' => 'All Authorized Gateways (0.0.0.0/0)',
            ],
        ];
    }

    /**
     * Retrieve persistent vendor settings configuration.
     */
    public function getVendorSettings(): array
    {
        return Cache::get(self::SETTINGS_CACHE_KEY, function () {
            $defaults = $this->getDefaultSettings();
            Cache::forever(self::SETTINGS_CACHE_KEY, $defaults);
            return $defaults;
        });
    }

    /**
     * Save settings to persistent cache.
     */
    public function saveVendorSettings(array $settings): void
    {
        Cache::forever(self::SETTINGS_CACHE_KEY, $settings);
    }

    /**
     * Update a specific section of vendor settings.
     */
    public function updateSettingsSection(string $section, array $data): array
    {
        $settings = $this->getVendorSettings();

        switch ($section) {
            case 'profile':
                if (isset($data['company_name'])) {
                    $settings['profile']['company_name'] = trim($data['company_name']);
                }
                if (isset($data['brand_name'])) {
                    $settings['profile']['brand_name'] = trim($data['brand_name']);
                    $words = preg_split('/\s+/', trim($data['brand_name']));
                    $initials = '';
                    foreach ($words as $w) {
                        if (!empty($w)) {
                            $initials .= strtoupper($w[0]);
                        }
                    }
                    $settings['profile']['logo_initials'] = substr($initials, 0, 3) ?: 'CPS';
                }
                if (isset($data['description'])) {
                    $settings['profile']['description'] = trim($data['description']);
                }
                if (isset($data['logo_url'])) {
                    $settings['profile']['logo_url'] = $data['logo_url'];
                }
                break;

            case 'contact':
                if (isset($data['address'])) {
                    $settings['contact']['address'] = trim($data['address']);
                }
                if (isset($data['city'])) {
                    $settings['contact']['city'] = trim($data['city']);
                }
                if (isset($data['postal_code'])) {
                    $settings['contact']['postal_code'] = trim($data['postal_code']);
                }
                if (isset($data['email'])) {
                    $settings['contact']['email'] = trim($data['email']);
                }
                if (isset($data['billing_email'])) {
                    $settings['contact']['billing_email'] = trim($data['billing_email']);
                }
                if (isset($data['phone'])) {
                    $settings['contact']['phone'] = trim($data['phone']);
                }
                if (isset($data['emergency_hotline'])) {
                    $settings['contact']['emergency_hotline'] = trim($data['emergency_hotline']);
                }
                if (isset($data['website'])) {
                    $settings['contact']['website'] = trim($data['website']);
                }
                break;

            case 'operational':
                if (isset($data['default_facility_id'])) {
                    $settings['operational']['default_facility_id'] = $data['default_facility_id'];
                }
                if (isset($data['anpr_confidence_threshold'])) {
                    $settings['operational']['anpr_confidence_threshold'] = max(50, min(99, (int)$data['anpr_confidence_threshold']));
                }
                if (isset($data['barrier_auto_close_delay'])) {
                    $settings['operational']['barrier_auto_close_delay'] = max(3, min(30, (int)$data['barrier_auto_close_delay']));
                }
                if (isset($data['overstay_alert_hours'])) {
                    $settings['operational']['overstay_alert_hours'] = max(6, min(168, (int)$data['overstay_alert_hours']));
                }
                if (isset($data['capacity_warning_threshold'])) {
                    $settings['operational']['capacity_warning_threshold'] = max(50, min(98, (int)$data['capacity_warning_threshold']));
                }
                $settings['operational']['allow_manual_gate_override'] = !empty($data['allow_manual_gate_override']);
                $settings['operational']['require_anpr_two_stage'] = !empty($data['require_anpr_two_stage']);
                break;

            case 'localization':
                if (isset($data['timezone'])) {
                    $settings['localization']['timezone'] = $data['timezone'];
                    $settings['localization']['timezone_label'] = match($data['timezone']) {
                        'Asia/Makassar' => 'Asia/Makassar (WITA, UTC+8)',
                        'Asia/Jayapura' => 'Asia/Jayapura (WIT, UTC+9)',
                        default => 'Asia/Jakarta (WIB, UTC+7)',
                    };
                }
                if (isset($data['locale'])) {
                    $settings['localization']['locale'] = $data['locale'];
                    $settings['localization']['locale_label'] = match($data['locale']) {
                        'en_US' => 'English (US/UK)',
                        default => 'Bahasa Indonesia (ID)',
                    };
                }
                if (isset($data['date_format'])) {
                    $settings['localization']['date_format'] = $data['date_format'];
                }
                break;

            case 'notifications':
                $settings['notifications']['email_critical_alerts'] = !empty($data['email_critical_alerts']);
                $settings['notifications']['email_daily_digest'] = !empty($data['email_daily_digest']);
                $settings['notifications']['email_billing_invoices'] = !empty($data['email_billing_invoices']);
                $settings['notifications']['inapp_alerts'] = !empty($data['inapp_alerts']);
                $settings['notifications']['sms_emergency_dispatch'] = !empty($data['sms_emergency_dispatch']);
                $settings['notifications']['push_mobile_alerts'] = !empty($data['push_mobile_alerts']);
                break;

            case 'security':
                if (isset($data['session_timeout_hours'])) {
                    $settings['security']['session_timeout_hours'] = max(1, min(72, (int)$data['session_timeout_hours']));
                }
                $settings['security']['two_factor_enabled'] = !empty($data['two_factor_enabled']);
                break;
        }

        $this->saveVendorSettings($settings);

        return $settings;
    }

    /**
     * Reset all vendor settings and operational preferences to factory defaults.
     */
    public function resetSettingsDefaults(): array
    {
        $defaults = $this->getDefaultSettings();
        $this->saveVendorSettings($defaults);
        return $defaults;
    }
}




