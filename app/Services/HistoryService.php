<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class HistoryService
{
    /**
     * Get authoritative activity records for authenticated user Alex.
     */
    public function getRecords(array $filters = []): array
    {
        // Support explicit empty state testing e.g. /history?empty=1
        if (!empty($filters['empty']) && $filters['empty'] == '1') {
            return [
                'records' => [],
                'total' => 0,
                'current_page' => 1,
                'last_page' => 1,
                'per_page' => 10,
                'metrics' => [
                    'total_sessions' => 0,
                    'total_reservations' => 0,
                    'total_spent' => 0,
                    'formatted_spent' => 'Rp 0',
                ],
            ];
        }

        $allRecords = $this->loadUserRecords();

        // Check if current session was paid in Page 15 (stored in Cache)
        $cachedSessionIntent = Cache::get('payment_intent_session_SES-20261011-0984_qris');
        if ($cachedSessionIntent && $cachedSessionIntent['status'] === 'successful') {
            // Update active session record in history
            foreach ($allRecords as &$r) {
                if ($r['reference'] === 'SES-20261011-0984') {
                    $r['status'] = 'completed';
                    $r['payment_status'] = 'paid';
                    $r['receipt_ref'] = $cachedSessionIntent['receipt_ref'] ?? 'RCP-20261011-0421';
                    $r['paid_at'] = date('d M Y, H:i', $cachedSessionIntent['paid_at'] ?? time());
                }
            }
            unset($r);
        }

        // Apply Search Filter
        if (!empty($filters['search'])) {
            $s = strtolower(trim($filters['search']));
            $allRecords = array_filter($allRecords, function ($item) use ($s) {
                return str_contains(strtolower($item['facility_name']), $s) ||
                       str_contains(strtolower($item['vehicle_plate']), $s) ||
                       str_contains(strtolower($item['reference']), $s) ||
                       (!empty($item['receipt_ref']) && str_contains(strtolower($item['receipt_ref']), $s));
            });
        }

        // Apply Record Type Filter
        if (!empty($filters['type']) && $filters['type'] !== 'all') {
            $allRecords = array_filter($allRecords, function ($item) use ($filters) {
                return $item['type'] === $filters['type'];
            });
        }

        // Apply Status Filter
        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $statusFilter = strtolower($filters['status']);
            $allRecords = array_filter($allRecords, function ($item) use ($statusFilter) {
                return strtolower($item['status']) === $statusFilter ||
                       strtolower($item['payment_status']) === $statusFilter;
            });
        }

        // Apply Date From Filter
        if (!empty($filters['date_from'])) {
            $from = strtotime($filters['date_from'] . ' 00:00:00');
            $allRecords = array_filter($allRecords, function ($item) use ($from) {
                return $item['timestamp'] >= $from;
            });
        }

        // Apply Date To Filter
        if (!empty($filters['date_to'])) {
            $to = strtotime($filters['date_to'] . ' 23:59:59');
            $allRecords = array_filter($allRecords, function ($item) use ($to) {
                return $item['timestamp'] <= $to;
            });
        }

        // Apply Sorting
        $sort = $filters['sort'] ?? 'newest';
        usort($allRecords, function ($a, $b) use ($sort) {
            return $sort === 'oldest' 
                ? $a['timestamp'] <=> $b['timestamp'] 
                : $b['timestamp'] <=> $a['timestamp'];
        });

        // Calculate Summary Metrics from actual confirmed records
        $totalSessions = 0;
        $totalReservations = 0;
        $totalSpent = 0;

        foreach ($allRecords as $item) {
            if ($item['type'] === 'session') {
                $totalSessions++;
            } elseif ($item['type'] === 'reservation') {
                $totalReservations++;
            }

            // Count only confirmed paid records (exclude refunded, pending, unpaid)
            if ($item['payment_status'] === 'paid') {
                $totalSpent += $item['amount'];
            }
        }

        // Pagination
        $perPage = (int)($filters['per_page'] ?? 6);
        $total = count($allRecords);
        $lastPage = max(1, (int)ceil($total / $perPage));
        $page = max(1, min((int)($filters['page'] ?? 1), $lastPage));
        $offset = ($page - 1) * $perPage;
        $pagedRecords = array_slice($allRecords, $offset, $perPage);

        return [
            'records' => array_values($pagedRecords),
            'total' => $total,
            'current_page' => $page,
            'last_page' => $lastPage,
            'per_page' => $perPage,
            'metrics' => [
                'total_sessions' => $totalSessions,
                'total_reservations' => $totalReservations,
                'total_spent' => $totalSpent,
                'formatted_spent' => 'Rp ' . number_format($totalSpent, 0, ',', '.'),
            ],
        ];
    }

    /**
     * Get single record by reference or ID.
     */
    public function getRecord(string $reference): ?array
    {
        $records = $this->loadUserRecords();
        foreach ($records as $r) {
            if ($r['reference'] === $reference || (!empty($r['receipt_ref']) && $r['receipt_ref'] === $reference)) {
                return $r;
            }
        }
        return null;
    }

    /**
     * Authoritative mock data contract representing authentic past driver activity.
     */
    protected function loadUserRecords(): array
    {
        return [
            [
                'id' => 'rec-001',
                'type' => 'session',
                'reference' => 'SES-20261011-0984',
                'facility_name' => 'Mall XYZ Jakarta',
                'facility_city' => 'Jakarta Selatan',
                'facility_zone' => 'Zone A · Spot B1-A01',
                'vehicle_plate' => 'B 1234 XYZ',
                'vehicle_name' => 'Toyota Avanza',
                'entry_time' => '11 Oct 2026, 10:32',
                'exit_time' => 'In Progress',
                'duration' => '1h 24m (Active)',
                'amount' => 12000,
                'formatted_amount' => 'Rp 12.000',
                'status' => 'active',
                'status_label' => 'In Progress',
                'payment_status' => 'unpaid',
                'payment_status_label' => 'Unpaid',
                'payment_method' => 'Pending Exit',
                'payment_method_code' => 'pending',
                'receipt_ref' => null,
                'timestamp' => strtotime('2026-10-11 10:32:00'),
                'action_url' => '/payment?type=session',
                'action_label' => 'Pay Now',
            ],
            [
                'id' => 'rec-002',
                'type' => 'reservation',
                'reference' => 'NP-20261010-00421',
                'facility_name' => 'Mall XYZ Jakarta',
                'facility_city' => 'Jakarta Selatan',
                'facility_zone' => 'Standard Slot Reservation',
                'vehicle_plate' => 'B 1234 XYZ',
                'vehicle_name' => 'Toyota Avanza',
                'entry_time' => '10 Oct 2026, 14:00',
                'exit_time' => '10 Oct 2026, 16:00',
                'duration' => '2h Allocated',
                'amount' => 15000,
                'formatted_amount' => 'Rp 15.000',
                'status' => 'completed',
                'status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid',
                'payment_method' => 'QRIS Instant Pay',
                'payment_method_code' => 'qris',
                'receipt_ref' => 'RCP-20261010-0042',
                'paid_at' => '10 Oct 2026, 13:45',
                'timestamp' => strtotime('2026-10-10 14:00:00'),
                'action_url' => null,
                'action_label' => 'View Receipt',
            ],
            [
                'id' => 'rec-003',
                'type' => 'session',
                'reference' => 'SES-20261008-0451',
                'facility_name' => 'Grand Indonesia West Mall',
                'facility_city' => 'Jakarta Pusat',
                'facility_zone' => 'Basement 2 · Zone B',
                'vehicle_plate' => 'B 1234 XYZ',
                'vehicle_name' => 'Toyota Avanza',
                'entry_time' => '08 Oct 2026, 11:15',
                'exit_time' => '08 Oct 2026, 14:45',
                'duration' => '3h 30m',
                'amount' => 18000,
                'formatted_amount' => 'Rp 18.000',
                'status' => 'completed',
                'status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid',
                'payment_method' => 'Prepaid Card (Flazz)',
                'payment_method_code' => 'nfc_card',
                'receipt_ref' => 'RCP-20261008-0115',
                'paid_at' => '08 Oct 2026, 14:45',
                'timestamp' => strtotime('2026-10-08 11:15:00'),
                'action_url' => null,
                'action_label' => 'View Receipt',
            ],
            [
                'id' => 'rec-004',
                'type' => 'session',
                'reference' => 'SES-20261005-0199',
                'facility_name' => 'Central Park Mall',
                'facility_city' => 'Jakarta Barat',
                'facility_zone' => 'Level 1 · Outer Lane',
                'vehicle_plate' => 'B 1234 XYZ',
                'vehicle_name' => 'Toyota Avanza',
                'entry_time' => '05 Oct 2026, 18:30',
                'exit_time' => '05 Oct 2026, 21:00',
                'duration' => '2h 30m',
                'amount' => 14000,
                'formatted_amount' => 'Rp 14.000',
                'status' => 'completed',
                'status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid',
                'payment_method' => 'QRIS Instant Pay',
                'payment_method_code' => 'qris',
                'receipt_ref' => 'RCP-20261005-0902',
                'paid_at' => '05 Oct 2026, 20:58',
                'timestamp' => strtotime('2026-10-05 18:30:00'),
                'action_url' => null,
                'action_label' => 'View Receipt',
            ],
            [
                'id' => 'rec-005',
                'type' => 'reservation',
                'reference' => 'NP-20261002-00109',
                'facility_name' => 'Senayan City',
                'facility_city' => 'Jakarta Pusat',
                'facility_zone' => 'VIP Parking Level P1',
                'vehicle_plate' => 'B 1234 XYZ',
                'vehicle_name' => 'Toyota Avanza',
                'entry_time' => '02 Oct 2026, 10:00',
                'exit_time' => 'Cancelled',
                'duration' => '3h Reserved',
                'amount' => 20000,
                'formatted_amount' => 'Rp 20.000',
                'status' => 'cancelled',
                'status_label' => 'Cancelled',
                'payment_status' => 'refunded',
                'payment_status_label' => 'Refunded',
                'payment_method' => 'QRIS Instant Pay',
                'payment_method_code' => 'qris',
                'receipt_ref' => 'RCP-20261002-0019',
                'paid_at' => '02 Oct 2026, 09:12',
                'timestamp' => strtotime('2026-10-02 10:00:00'),
                'action_url' => null,
                'action_label' => 'View Receipt',
            ],
            [
                'id' => 'rec-006',
                'type' => 'session',
                'reference' => 'SES-20260928-0881',
                'facility_name' => 'Pondok Indah Mall 2',
                'facility_city' => 'Jakarta Selatan',
                'facility_zone' => 'North Basement · Zone C',
                'vehicle_plate' => 'B 1234 XYZ',
                'vehicle_name' => 'Toyota Avanza',
                'entry_time' => '28 Sep 2026, 15:00',
                'exit_time' => '28 Sep 2026, 17:15',
                'duration' => '2h 15m',
                'amount' => 12000,
                'formatted_amount' => 'Rp 12.000',
                'status' => 'completed',
                'status_label' => 'Completed',
                'payment_status' => 'paid',
                'payment_status_label' => 'Paid',
                'payment_method' => 'Prepaid Card (e-Money)',
                'payment_method_code' => 'nfc_card',
                'receipt_ref' => 'RCP-20260928-0412',
                'paid_at' => '28 Sep 2026, 17:15',
                'timestamp' => strtotime('2026-09-28 15:00:00'),
                'action_url' => null,
                'action_label' => 'View Receipt',
            ],
        ];
    }
}
