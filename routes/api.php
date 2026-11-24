<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\VehicleApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| NusaPark Web Service API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the application configuration with the "api"
| prefix and "api" middleware group applied.
|
*/

// Public Authentication Endpoint for Postman Testing (Phase 2 & Phase 4)
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

// Protected API Endpoints (Bearer Token Authentication)
Route::middleware('auth.api')->group(function () {
    Route::get('/user', [AuthController::class, 'user'])->name('api.user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    // =========================================================================
    // API V1: Driver Vehicle Management (Phase 6 - Jobsheet Build Project)
    // =========================================================================
    Route::prefix('v1')->group(function () {
        Route::get('/vehicles', [VehicleApiController::class, 'index'])->name('api.v1.vehicles.index');
        Route::post('/vehicles', [VehicleApiController::class, 'store'])->name('api.v1.vehicles.store');
        Route::get('/vehicles/{id}', [VehicleApiController::class, 'show'])->name('api.v1.vehicles.show');
        Route::put('/vehicles/{id}', [VehicleApiController::class, 'update'])->name('api.v1.vehicles.update');
        Route::patch('/vehicles/{id}', [VehicleApiController::class, 'update'])->name('api.v1.vehicles.patch');
        Route::patch('/vehicles/{id}/default', [VehicleApiController::class, 'setDefault'])->name('api.v1.vehicles.default');
        Route::delete('/vehicles/{id}', [VehicleApiController::class, 'destroy'])->name('api.v1.vehicles.destroy');
    });
});
