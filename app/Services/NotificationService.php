<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class NotificationService
{
    /**
     * Cache key for driver Alex's notification store.
     */
    protected const CACHE_KEY = 'user_notifications_alex';

    /**
     * Supported notification categories.
     */
    public const CATEGORIES = [
        'all' => 'All Updates',
        'session' => 'Parking Sessions',
        'reservation' => 'Reservations',
        'payment' => 'Payments & Receipts',
    ];

    /**
     * Get filtered and searched notifications.
     */
    public function getNotifications(array $filters = []): array
    {
        $notifications = $this->loadStoredNotifications();

        // 1. Search filter
        $query = trim(strtolower($filters['q'] ?? ''));
        if ($query !== '') {
            $notifications = array_filter($notifications, function ($item) use ($query) {
                return str_contains(strtolower($item['title']), $query)
                    || str_contains(strtolower($item['message']), $query)
                    || str_contains(strtolower($item['facility'] ?? ''), $query)
                    || str_contains(strtolower($item['reference'] ?? ''), $query)
                    || str_contains(strtolower($item['vehicle_plate'] ?? ''), $query);
            });
        }

        // 2. Status / Category filter
        $status = $filters['status'] ?? 'all';
        if ($status === 'unread') {
            $notifications = array_filter($notifications, fn($item) => !$item['is_read']);
        } elseif ($status === 'read') {
            $notifications = array_filter($notifications, fn($item) => $item['is_read']);
        }

        $category = $filters['category'] ?? 'all';
        if ($category !== 'all' && array_key_exists($category, self::CATEGORIES)) {
            $notifications = array_filter($notifications, fn($item) => $item['category'] === $category);
        }

        // 3. Sort: newest first
        usort($notifications, fn($a, $b) => $b['timestamp'] <=> $a['timestamp']);

        return array_values($notifications);
    }

    /**
     * Get aggregate statistics.
     */
    public function getMetrics(): array
    {
        $all = $this->loadStoredNotifications();

        $unreadCount = 0;
        $sessionCount = 0;
        $bookingReceiptCount = 0;
        $byCategory = [
            'session' => 0,
            'reservation' => 0,
            'payment' => 0,
        ];

        foreach ($all as $item) {
            if (!$item['is_read']) {
                $unreadCount++;
            }
            if ($item['category'] === 'session') {
                $sessionCount++;
            }
            if ($item['category'] === 'reservation' || $item['category'] === 'payment') {
                $bookingReceiptCount++;
            }
            if (isset($byCategory[$item['category']])) {
                $byCategory[$item['category']]++;
            }
        }

        return [
            'total' => count($all),
            'unread' => $unreadCount,
            'read' => count($all) - $unreadCount,
            'sessions' => $sessionCount,
            'bookings_receipts' => $bookingReceiptCount,
            'by_category' => $byCategory,
        ];
    }

    /**
     * Get unread count.
     */
    public function getUnreadCount(): int
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
    public function markAsRead(string $id): bool
    {
        $notifications = $this->loadStoredNotifications();
        $updated = false;

        foreach ($notifications as &$item) {
            if ($item['id'] === $id) {
                if (!$item['is_read']) {
                    $item['is_read'] = true;
                    $item['read_at'] = date('Y-m-d H:i:s');
                    $updated = true;
                }
                break;
            }
        }
        unset($item);

        if ($updated) {
            $this->persistNotifications($notifications);
        }

        return $updated;
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(): int
    {
        $notifications = $this->loadStoredNotifications();
        $updatedCount = 0;

        foreach ($notifications as &$item) {
            if (!$item['is_read']) {
                $item['is_read'] = true;
                $item['read_at'] = date('Y-m-d H:i:s');
                $updatedCount++;
            }
        }
        unset($item);

        if ($updatedCount > 0) {
            $this->persistNotifications($notifications);
        }

        return $updatedCount;
    }

    /**
     * Delete a single notification.
     */
    public function removeNotification(string $id): bool
    {
        $notifications = $this->loadStoredNotifications();
        $initialCount = count($notifications);
        $notifications = array_values(array_filter($notifications, fn($n) => $n['id'] !== $id));

        if (count($notifications) !== $initialCount) {
            $this->persistNotifications($notifications);
            return true;
        }

        return false;
    }

    /**
     * Load notifications from cache or seed.
     */
    protected function loadStoredNotifications(): array
    {
        return Cache::get(self::CACHE_KEY, function () {
            $seed = $this->seedNotifications();
            Cache::put(self::CACHE_KEY, $seed, now()->addHours(24));
            return $seed;
        });
    }

    /**
     * Persist notifications to cache.
     */
    protected function persistNotifications(array $notifications): void
    {
        Cache::put(self::CACHE_KEY, array_values($notifications), now()->addHours(24));
    }

    /**
     * Seed authoritative notification data corresponding to existing driver activities.
     */
    protected function seedNotifications(): array
    {
        return [
            [
                'id' => 'notif-001',
                'category' => 'session',
                'category_label' => 'Parking Session',
                'title' => 'Active Parking In Progress',
                'message' => 'Vehicle B 1234 XYZ entered Mall XYZ Jakarta at 10:32 WIB. Smart gate opened automatically via ANPR license plate recognition.',
                'reference' => 'SES-20261011-0984',
                'facility' => 'Mall XYZ Jakarta · Zone A',
                'vehicle_plate' => 'B 1234 XYZ',
                'timestamp' => strtotime('2026-10-11 10:32:00'),
                'created_at_formatted' => '11 Oct 2026, 10:32 WIB',
                'relative_time' => '1h ago',
                'is_read' => false,
                'read_at' => null,
                'action_url' => '/active-parking',
                'action_label' => 'View Session',
            ],
            [
                'id' => 'notif-002',
                'category' => 'reservation',
                'category_label' => 'Reservation',
                'title' => 'Upcoming Slot Reservation Confirmed',
                'message' => 'Advance slot reservation confirmed at Grand Indonesia West Mall for Hyundai Ioniq 5 (B 9012 EV) on 12 Oct 2026.',
                'reference' => 'NP-20261012-0819',
                'facility' => 'Grand Indonesia West Mall',
                'vehicle_plate' => 'B 9012 EV',
                'timestamp' => strtotime('2026-10-11 09:15:00'),
                'created_at_formatted' => '11 Oct 2026, 09:15 WIB',
                'relative_time' => '2h ago',
                'is_read' => false,
                'read_at' => null,
                'action_url' => '/reservations',
                'action_label' => 'View Booking',
            ],
            [
                'id' => 'notif-003',
                'category' => 'payment',
                'category_label' => 'Payment',
                'title' => 'Payment Verified & Receipt Issued',
                'message' => 'Payment of Rp 15.000 for reservation NP-20261010-00421 was settled successfully via QRIS Instant Pay.',
                'reference' => 'RCP-20261010-0842',
                'facility' => 'Mall XYZ Jakarta',
                'vehicle_plate' => 'B 1234 XYZ',
                'timestamp' => strtotime('2026-10-10 13:45:00'),
                'created_at_formatted' => '10 Oct 2026, 13:45 WIB',
                'relative_time' => 'Yesterday',
                'is_read' => true,
                'read_at' => '2026-10-10 14:00:00',
                'action_url' => '/history',
                'action_label' => 'View Receipt',
            ],
            [
                'id' => 'notif-004',
                'category' => 'session',
                'category_label' => 'Parking Session',
                'title' => 'Parking Session Completed',
                'message' => 'Session completed at Grand Indonesia West Mall. Duration 3h 30m. Payment Rp 18.000 confirmed via Prepaid Card (Flazz).',
                'reference' => 'SES-20261008-0451',
                'facility' => 'Grand Indonesia West Mall',
                'vehicle_plate' => 'B 1234 XYZ',
                'timestamp' => strtotime('2026-10-08 14:45:00'),
                'created_at_formatted' => '08 Oct 2026, 14:45 WIB',
                'relative_time' => '3 days ago',
                'is_read' => true,
                'read_at' => '2026-10-08 15:00:00',
                'action_url' => '/history',
                'action_label' => 'View in History',
            ],
            [
                'id' => 'notif-005',
                'category' => 'payment',
                'category_label' => 'Refund',
                'title' => 'Refund Processed: Rp 20.000',
                'message' => 'Reservation NP-20261002-00109 at Senayan City was cancelled. Full refund of Rp 20.000 returned to your QRIS account.',
                'reference' => 'RCP-20261002-0819',
                'facility' => 'Senayan City',
                'vehicle_plate' => 'B 1234 XYZ',
                'timestamp' => strtotime('2026-10-02 09:12:00'),
                'created_at_formatted' => '02 Oct 2026, 09:12 WIB',
                'relative_time' => '9 days ago',
                'is_read' => true,
                'read_at' => '2026-10-02 10:00:00',
                'action_url' => '/history',
                'action_label' => 'View Receipt',
            ],
        ];
    }
}
