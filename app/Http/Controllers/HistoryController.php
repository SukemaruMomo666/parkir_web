<?php

namespace App\Http\Controllers;

use App\Services\HistoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class HistoryController extends Controller
{
    protected HistoryService $historyService;

    public function __construct(HistoryService $historyService)
    {
        $this->historyService = $historyService;
    }

    /**
     * Display authenticated driver parking and payment history (Page 16).
     */
    public function index(Request $request): View
    {
        // Simulated auth protection (consistent with existing routes)
        $isAuthenticated = true;
        if (!$isAuthenticated) {
            return redirect('/login');
        }

        $filters = [
            'search' => $request->query('search', ''),
            'type' => $request->query('type', 'all'),
            'status' => $request->query('status', 'all'),
            'date_from' => $request->query('date_from', ''),
            'date_to' => $request->query('date_to', ''),
            'sort' => $request->query('sort', 'newest'),
            'page' => (int) $request->query('page', 1),
            'per_page' => 5,
            'empty' => $request->query('empty', '0'),
        ];

        $hasActiveFilters = !empty($filters['search']) || 
                            ($filters['type'] !== 'all') || 
                            ($filters['status'] !== 'all') || 
                            !empty($filters['date_from']) || 
                            !empty($filters['date_to']) ||
                            ($filters['sort'] !== 'newest');

        $result = $this->historyService->getRecords($filters);

        return view('history', [
            'records' => $result['records'],
            'pagination' => [
                'current_page' => $result['current_page'],
                'last_page' => $result['last_page'],
                'total' => $result['total'],
                'per_page' => $result['per_page'],
            ],
            'metrics' => $result['metrics'],
            'filters' => $filters,
            'hasActiveFilters' => $hasActiveFilters,
        ]);
    }

    /**
     * Fetch receipt detail for modal view or download.
     */
    public function receipt(string $id): JsonResponse
    {
        $record = $this->historyService->getRecord($id);

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Receipt not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'receipt' => $record,
        ]);
    }
}
