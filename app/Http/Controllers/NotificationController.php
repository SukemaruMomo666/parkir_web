<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Display Driver Notifications inbox (Page 18).
     */
    public function index(Request $request): View
    {
        $filters = [
            'q' => $request->query('q', ''),
            'category' => $request->query('category', 'all'),
            'status' => $request->query('status', 'all'),
        ];

        $notifications = $this->notificationService->getNotifications($filters);
        $metrics = $this->notificationService->getMetrics();
        $categories = NotificationService::CATEGORIES;

        return view('notifications', [
            'notifications' => $notifications,
            'metrics' => $metrics,
            'filters' => $filters,
            'categories' => $categories,
            'hasActiveFilters' => !empty($filters['q']) || $filters['category'] !== 'all' || $filters['status'] !== 'all',
        ]);
    }

    /**
     * Mark a single notification as read.
     */
    public function markAsRead(Request $request, string $id): RedirectResponse|JsonResponse
    {
        $updated = $this->notificationService->markAsRead($id);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => $updated,
                'unread' => $this->notificationService->getUnreadCount(),
            ]);
        }

        return redirect()->back()->with('notification_success', 'Notification marked as read.');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(Request $request): RedirectResponse|JsonResponse
    {
        $count = $this->notificationService->markAllAsRead();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'updated_count' => $count,
                'unread' => 0,
            ]);
        }

        return redirect()->back()->with('notification_success', 'All notifications marked as read.');
    }

    /**
     * Delete a notification.
     */
    public function destroy(Request $request, string $id): RedirectResponse|JsonResponse
    {
        $removed = $this->notificationService->removeNotification($id);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => $removed,
                'unread' => $this->notificationService->getUnreadCount(),
            ]);
        }

        return redirect()->back()->with('notification_success', 'Notification removed.');
    }

    /**
     * Return authoritative unread count (for navbar badge sync).
     */
    public function unreadCount(): JsonResponse
    {
        return response()->json([
            'unread' => $this->notificationService->getUnreadCount(),
        ]);
    }
}
