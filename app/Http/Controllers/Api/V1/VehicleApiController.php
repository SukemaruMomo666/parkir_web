<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreVehicleRequest;
use App\Http\Requests\Api\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleApiController extends Controller
{
    /**
     * Display a paginated listing of the authenticated user's vehicles.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $perPage = max(1, min((int) $request->query('per_page', 10), 100));

        $vehicles = $user->vehicles()
            ->orderByDesc('is_default')
            ->orderByDesc('created_at')
            ->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar kendaraan berhasil diambil',
            'data' => VehicleResource::collection($vehicles->items()),
            'meta' => [
                'current_page' => $vehicles->currentPage(),
                'per_page' => $vehicles->perPage(),
                'total' => $vehicles->total(),
                'last_page' => $vehicles->lastPage(),
            ],
        ], 200);
    }

    /**
     * Store a newly created vehicle for the authenticated user.
     *
     * @param  \App\Http\Requests\Api\StoreVehicleRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreVehicleRequest $request): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        // Anti-IDOR: Discard any user_id provided in the payload and bind to authenticated user
        unset($validated['user_id']);
        $validated['user_id'] = $user->id;

        $isFirstVehicle = $user->vehicles()->count() === 0;
        $isDefault = !empty($validated['is_default']) || $isFirstVehicle;
        $validated['is_default'] = $isDefault;

        $vehicle = DB::transaction(function () use ($user, $validated, $isDefault) {
            if ($isDefault) {
                // Ensure only one default vehicle exists at any time
                $user->vehicles()->where('is_default', true)->update(['is_default' => false]);
            }

            return $user->vehicles()->create($validated);
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Kendaraan berhasil ditambahkan',
            'data' => new VehicleResource($vehicle),
        ], 201);
    }

    /**
     * Display the specified vehicle with strict ownership protection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, int|string $id): JsonResponse
    {
        $user = $request->user();

        // Enforce ownership: query strictly scoped to authenticated user
        $vehicle = $user->vehicles()->find($id);

        if (!$vehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kendaraan tidak ditemukan atau Anda tidak memiliki hak akses.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail kendaraan berhasil diambil',
            'data' => new VehicleResource($vehicle),
        ], 200);
    }

    /**
     * Update the specified vehicle with strict ownership protection.
     *
     * @param  \App\Http\Requests\Api\UpdateVehicleRequest  $request
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateVehicleRequest $request, int|string $id): JsonResponse
    {
        $user = $request->user();

        // Enforce ownership
        $vehicle = $user->vehicles()->find($id);

        if (!$vehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kendaraan tidak ditemukan atau Anda tidak memiliki hak akses.',
            ], 404);
        }

        $validated = $request->validated();
        unset($validated['user_id']); // Protect user_id from mass mutation

        DB::transaction(function () use ($user, $vehicle, $validated) {
            if (isset($validated['is_default']) && $validated['is_default']) {
                $user->vehicles()
                    ->where('id', '!=', $vehicle->id)
                    ->where('is_default', true)
                    ->update(['is_default' => false]);
            }

            $vehicle->update($validated);
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data kendaraan berhasil diperbarui',
            'data' => new VehicleResource($vehicle->fresh()),
        ], 200);
    }

    /**
     * Set a vehicle as the primary/default vehicle for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function setDefault(Request $request, int|string $id): JsonResponse
    {
        $user = $request->user();

        // Enforce ownership
        $vehicle = $user->vehicles()->find($id);

        if (!$vehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kendaraan tidak ditemukan atau Anda tidak memiliki hak akses.',
            ], 404);
        }

        DB::transaction(function () use ($user, $vehicle) {
            // Unset all existing defaults
            $user->vehicles()
                ->where('id', '!=', $vehicle->id)
                ->where('is_default', true)
                ->update(['is_default' => false]);

            $vehicle->update(['is_default' => true]);
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Kendaraan berhasil ditetapkan sebagai kendaraan utama',
            'data' => new VehicleResource($vehicle->fresh()),
        ], 200);
    }

    /**
     * Remove the specified vehicle with strict ownership protection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int|string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, int|string $id): JsonResponse
    {
        $user = $request->user();

        // Enforce ownership
        $vehicle = $user->vehicles()->find($id);

        if (!$vehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kendaraan tidak ditemukan atau Anda tidak memiliki hak akses.',
            ], 404);
        }

        DB::transaction(function () use ($user, $vehicle) {
            $wasDefault = $vehicle->is_default;
            $vehicle->delete();

            // If deleted vehicle was default, promote next available vehicle if any
            if ($wasDefault) {
                $nextVehicle = $user->vehicles()->first();
                if ($nextVehicle) {
                    $nextVehicle->update(['is_default' => true]);
                }
            }
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Kendaraan berhasil dihapus.',
        ], 200);
    }
}

