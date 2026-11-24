<?php

namespace App\Http\Controllers;

use App\Services\VehicleService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    protected VehicleService $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * Display the My Vehicles page (Page 17).
     */
    public function index(Request $request): View
    {
        $vehicles = $this->vehicleService->getUserVehicles();
        $vehicleTypes = VehicleService::VEHICLE_TYPES;

        // Flash message from session
        $success = session('vehicle_success');
        $error = session('vehicle_error');

        $defaultVehicle = null;
        $activeVehiclesCount = 0;
        $reservedVehiclesCount = 0;

        foreach ($vehicles as $v) {
            if ($v['is_default']) {
                $defaultVehicle = $v;
            }
            if (!empty($v['has_active_session'])) {
                $activeVehiclesCount++;
            }
            if (!empty($v['has_future_reservation'])) {
                $reservedVehiclesCount++;
            }
        }

        return view('vehicles', [
            'vehicles' => $vehicles,
            'vehicleTypes' => $vehicleTypes,
            'vehicleCount' => count($vehicles),
            'defaultVehicle' => $defaultVehicle,
            'activeVehiclesCount' => $activeVehiclesCount,
            'reservedVehiclesCount' => $reservedVehiclesCount,
            'success' => $success,
            'error' => $error,
        ]);
    }

    /**
     * Store a new vehicle.
     */
    public function store(Request $request): RedirectResponse
    {
        $validation = $this->vehicleService->validate($request->all());

        if (!$validation['valid']) {
            return redirect('/vehicles')
                ->withErrors($validation['errors'])
                ->withInput()
                ->with('show_modal', 'add');
        }

        $result = $this->vehicleService->addVehicle($validation['sanitized']);

        if ($result['success']) {
            return redirect('/vehicles')->with('vehicle_success', 'Vehicle "' . $result['vehicle']['plate'] . '" has been added successfully.');
        }

        return redirect('/vehicles')->with('vehicle_error', 'Failed to add the vehicle. Please try again.');
    }

    /**
     * Update an existing vehicle.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validation = $this->vehicleService->validate($request->all(), $id);

        if (!$validation['valid']) {
            return redirect('/vehicles')
                ->withErrors($validation['errors'])
                ->withInput()
                ->with('show_modal', 'edit')
                ->with('edit_vehicle_id', $id);
        }

        $result = $this->vehicleService->updateVehicle($id, $validation['sanitized']);

        if ($result['success']) {
            return redirect('/vehicles')->with('vehicle_success', 'Vehicle "' . $result['vehicle']['plate'] . '" has been updated.');
        }

        return redirect('/vehicles')->with('vehicle_error', $result['error'] ?? 'Failed to update the vehicle.');
    }

    /**
     * Set a vehicle as default.
     */
    public function setDefault(string $id): RedirectResponse
    {
        $result = $this->vehicleService->setDefault($id);

        if ($result['success']) {
            return redirect('/vehicles')->with('vehicle_success', 'Default vehicle updated.');
        }

        return redirect('/vehicles')->with('vehicle_error', $result['error'] ?? 'Failed to update default vehicle.');
    }

    /**
     * Remove a vehicle.
     */
    public function destroy(string $id): RedirectResponse
    {
        $result = $this->vehicleService->removeVehicle($id);

        if ($result['success']) {
            return redirect('/vehicles')->with('vehicle_success', 'Vehicle "' . $result['plate'] . '" has been removed.');
        }

        return redirect('/vehicles')->with('vehicle_error', $result['error'] ?? 'Failed to remove the vehicle.');
    }

    /**
     * Get vehicle data as JSON (for edit modal AJAX).
     */
    public function show(string $id): JsonResponse
    {
        $vehicle = $this->vehicleService->getVehicle($id);

        if (!$vehicle) {
            return response()->json(['success' => false, 'error' => 'Vehicle not found.'], 404);
        }

        return response()->json(['success' => true, 'vehicle' => $vehicle]);
    }
}
