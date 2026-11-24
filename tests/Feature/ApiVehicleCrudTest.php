<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiVehicleCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper to authenticate user and issue a valid Bearer token.
     */
    protected function authenticateUser(User $user): string
    {
        $plainToken = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $plainToken);

        Cache::put("api_token:{$tokenHash}", [
            'user_id' => $user->id,
            'role' => $user->role,
            'abilities' => ['api:access'],
            'created_at' => now()->toIso8601String(),
        ], now()->addDays(30));

        return $plainToken;
    }

    /**
     * Helper to create a driver user.
     */
    protected function createDriver(string $email = 'driver@example.com'): User
    {
        return User::create([
            'name' => 'Driver Tester',
            'email' => $email,
            'phone' => '+62 812-' . rand(1000, 9999) . '-' . rand(1000, 9999),
            'password' => Hash::make('password123'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
            'email_verified_at' => now(),
        ]);
    }

    /**
     * 1. GET /api/v1/vehicles returns paginated list of vehicles for authenticated user.
     */
    public function test_01_get_vehicles_list_returns_paginated_data_for_authenticated_user(): void
    {
        $userA = $this->createDriver('usera@example.com');
        $tokenA = $this->authenticateUser($userA);

        $userB = $this->createDriver('userb@example.com');

        // Create 2 vehicles for User A
        Vehicle::create([
            'user_id' => $userA->id,
            'plate_number' => 'B 1111 AAA',
            'type' => 'car',
            'make' => 'Toyota',
            'model' => 'Avanza',
            'is_default' => true,
        ]);
        Vehicle::create([
            'user_id' => $userA->id,
            'plate_number' => 'B 2222 BBB',
            'type' => 'motorcycle',
            'make' => 'Honda',
            'model' => 'Vario',
            'is_default' => false,
        ]);

        // Create 1 vehicle for User B (must NOT be visible to User A)
        Vehicle::create([
            'user_id' => $userB->id,
            'plate_number' => 'B 3333 CCC',
            'type' => 'car',
            'make' => 'Suzuki',
            'model' => 'Ertiga',
            'is_default' => true,
        ]);

        $response = $this->withToken($tokenA)->getJson('/api/v1/vehicles?per_page=10');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Daftar kendaraan berhasil diambil',
                'meta' => [
                    'current_page' => 1,
                    'per_page' => 10,
                    'total' => 2,
                ],
            ]);

        $data = $response->json('data');
        $this->assertCount(2, $data);
        $this->assertEquals('B 1111 AAA', $data[0]['plate_number']);
        $this->assertEquals('B 2222 BBB', $data[1]['plate_number']);
    }

    /**
     * 2. POST /api/v1/vehicles creates new vehicle and auto-sets first vehicle as default.
     */
    public function test_02_post_vehicle_creates_new_vehicle_and_auto_sets_first_vehicle_as_default(): void
    {
        $user = $this->createDriver('newuser@example.com');
        $token = $this->authenticateUser($user);

        $response = $this->withToken($token)->postJson('/api/v1/vehicles', [
            'plate_number' => 'b 1234 xyz',
            'type' => 'car',
            'make' => 'Toyota',
            'model' => 'Innova Zenix',
            'color' => 'White Pearl',
            'is_default' => false, // Sent false, but should auto-promote to true as it is the first vehicle
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'Kendaraan berhasil ditambahkan',
                'data' => [
                    'user_id' => $user->id,
                    'plate_number' => 'B 1234 XYZ', // Normalized uppercase
                    'type' => 'car',
                    'type_label' => 'Car',
                    'make' => 'Toyota',
                    'model' => 'Innova Zenix',
                    'display_name' => 'Toyota Innova Zenix',
                    'color' => 'White Pearl',
                    'is_default' => true,
                ],
            ]);

        $this->assertDatabaseHas('vehicles', [
            'user_id' => $user->id,
            'plate_number' => 'B 1234 XYZ',
            'is_default' => true,
        ]);
    }

    /**
     * 3. GET /api/v1/vehicles/{id} returns vehicle details for owner.
     */
    public function test_03_get_vehicle_detail_succeeds_for_owner(): void
    {
        $user = $this->createDriver('owner@example.com');
        $token = $this->authenticateUser($user);

        $vehicle = Vehicle::create([
            'user_id' => $user->id,
            'plate_number' => 'D 9999 EV',
            'type' => 'ev',
            'make' => 'Hyundai',
            'model' => 'Ioniq 5',
            'color' => 'Gravity Gold',
            'is_default' => true,
        ]);

        $response = $this->withToken($token)->getJson("/api/v1/vehicles/{$vehicle->id}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Detail kendaraan berhasil diambil',
                'data' => [
                    'id' => $vehicle->id,
                    'user_id' => $user->id,
                    'plate_number' => 'D 9999 EV',
                    'type' => 'ev',
                    'type_label' => 'Electric Vehicle',
                    'is_default' => true,
                ],
            ]);
    }

    /**
     * 4. PUT /api/v1/vehicles/{id} updates vehicle details for owner.
     */
    public function test_04_put_update_vehicle_succeeds_for_owner(): void
    {
        $user = $this->createDriver('updater@example.com');
        $token = $this->authenticateUser($user);

        $vehicle = Vehicle::create([
            'user_id' => $user->id,
            'plate_number' => 'B 8888 OLD',
            'type' => 'car',
            'make' => 'Honda',
            'model' => 'Jazz',
            'color' => 'Red',
            'is_default' => true,
        ]);

        $response = $this->withToken($token)->putJson("/api/v1/vehicles/{$vehicle->id}", [
            'plate_number' => 'B 8888 NEW',
            'type' => 'car',
            'make' => 'Honda',
            'model' => 'HR-V',
            'color' => 'Meteoroid Gray',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Data kendaraan berhasil diperbarui',
                'data' => [
                    'plate_number' => 'B 8888 NEW',
                    'model' => 'HR-V',
                    'color' => 'Meteoroid Gray',
                ],
            ]);

        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id,
            'plate_number' => 'B 8888 NEW',
            'model' => 'HR-V',
        ]);
    }

    /**
     * 5. DELETE /api/v1/vehicles/{id} removes vehicle from database.
     */
    public function test_05_delete_vehicle_removes_from_database(): void
    {
        $user = $this->createDriver('deleter@example.com');
        $token = $this->authenticateUser($user);

        $vehicle = Vehicle::create([
            'user_id' => $user->id,
            'plate_number' => 'B 7777 DEL',
            'type' => 'car',
            'is_default' => true,
        ]);

        $response = $this->withToken($token)->deleteJson("/api/v1/vehicles/{$vehicle->id}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Kendaraan berhasil dihapus.',
            ]);

        $this->assertDatabaseMissing('vehicles', [
            'id' => $vehicle->id,
        ]);
    }

    /**
     * 6. PATCH /api/v1/vehicles/{id}/default sets primary vehicle and unsets previous default.
     */
    public function test_06_patch_default_vehicle_sets_primary_and_unsets_previous_default(): void
    {
        $user = $this->createDriver('defaultswitch@example.com');
        $token = $this->authenticateUser($user);

        $vehicle1 = Vehicle::create([
            'user_id' => $user->id,
            'plate_number' => 'B 1010 ONE',
            'type' => 'car',
            'is_default' => true,
        ]);

        $vehicle2 = Vehicle::create([
            'user_id' => $user->id,
            'plate_number' => 'B 2020 TWO',
            'type' => 'motorcycle',
            'is_default' => false,
        ]);

        $response = $this->withToken($token)->patchJson("/api/v1/vehicles/{$vehicle2->id}/default");

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Kendaraan berhasil ditetapkan sebagai kendaraan utama',
                'data' => [
                    'id' => $vehicle2->id,
                    'is_default' => true,
                ],
            ]);

        $this->assertFalse((bool) $vehicle1->fresh()->is_default);
        $this->assertTrue((bool) $vehicle2->fresh()->is_default);
    }

    /**
     * 7. Anti-IDOR: User cannot view another user's vehicle.
     */
    public function test_07_user_cannot_view_another_users_vehicle_anti_idor(): void
    {
        $userA = $this->createDriver('victim@example.com');
        $userB = $this->createDriver('attacker@example.com');
        $tokenB = $this->authenticateUser($userB);

        $vehicleA = Vehicle::create([
            'user_id' => $userA->id,
            'plate_number' => 'B 5555 VIC',
            'type' => 'car',
            'is_default' => true,
        ]);

        $response = $this->withToken($tokenB)->getJson("/api/v1/vehicles/{$vehicleA->id}");

        $response->assertStatus(404)
            ->assertJson([
                'status' => 'error',
                'message' => 'Kendaraan tidak ditemukan atau Anda tidak memiliki hak akses.',
            ]);
    }

    /**
     * 8. Anti-IDOR: User cannot update another user's vehicle.
     */
    public function test_08_user_cannot_update_another_users_vehicle_anti_idor(): void
    {
        $userA = $this->createDriver('victim2@example.com');
        $userB = $this->createDriver('attacker2@example.com');
        $tokenB = $this->authenticateUser($userB);

        $vehicleA = Vehicle::create([
            'user_id' => $userA->id,
            'plate_number' => 'B 6666 VIC',
            'type' => 'car',
            'make' => 'Toyota',
            'is_default' => true,
        ]);

        $response = $this->withToken($tokenB)->putJson("/api/v1/vehicles/{$vehicleA->id}", [
            'plate_number' => 'B 6666 HACKED',
            'make' => 'Hacked',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'status' => 'error',
                'message' => 'Kendaraan tidak ditemukan atau Anda tidak memiliki hak akses.',
            ]);

        $this->assertEquals('B 6666 VIC', $vehicleA->fresh()->plate_number);
    }

    /**
     * 9. Anti-IDOR: User cannot delete another user's vehicle.
     */
    public function test_09_user_cannot_delete_another_users_vehicle_anti_idor(): void
    {
        $userA = $this->createDriver('victim3@example.com');
        $userB = $this->createDriver('attacker3@example.com');
        $tokenB = $this->authenticateUser($userB);

        $vehicleA = Vehicle::create([
            'user_id' => $userA->id,
            'plate_number' => 'B 7777 VIC',
            'type' => 'car',
            'is_default' => true,
        ]);

        $response = $this->withToken($tokenB)->deleteJson("/api/v1/vehicles/{$vehicleA->id}");

        $response->assertStatus(404)
            ->assertJson([
                'status' => 'error',
                'message' => 'Kendaraan tidak ditemukan atau Anda tidak memiliki hak akses.',
            ]);

        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicleA->id,
        ]);
    }

    /**
     * 10. Unauthenticated request without token is rejected with 401.
     */
    public function test_10_unauthenticated_request_without_token_is_rejected_401(): void
    {
        $response = $this->getJson('/api/v1/vehicles');

        $response->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Unauthenticated: Token bearer diperlukan.',
            ]);
    }

    /**
     * 11. Invalid input validation returns 422 with Indonesian messages.
     */
    public function test_11_invalid_input_validation_returns_422_with_indonesian_messages(): void
    {
        $user = $this->createDriver('validator@example.com');
        $token = $this->authenticateUser($user);

        $response = $this->withToken($token)->postJson('/api/v1/vehicles', [
            'plate_number' => '', // Empty
            'type' => 'aeroplane', // Invalid type
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Data kendaraan tidak valid',
                'errors' => [
                    'plate_number' => ['Nomor pelat kendaraan wajib diisi.'],
                    'type' => ['Jenis kendaraan tidak valid. Pilihan yang tersedia: car, motorcycle, ev.'],
                ],
            ]);
    }

    /**
     * 12. Anti-Mass-Assignment: user_id in payload cannot be manipulated.
     */
    public function test_12_user_id_cannot_be_manipulated_via_request_payload_anti_mass_assignment(): void
    {
        $user = $this->createDriver('massassign@example.com');
        $token = $this->authenticateUser($user);

        $response = $this->withToken($token)->postJson('/api/v1/vehicles', [
            'user_id' => 999999, // Attempt to tamper ownership
            'plate_number' => 'B 4321 SEC',
            'type' => 'car',
        ]);

        $response->assertStatus(201);
        $createdId = $response->json('data.id');

        $vehicle = Vehicle::find($createdId);
        $this->assertEquals($user->id, $vehicle->user_id);
        $this->assertNotEquals(999999, $vehicle->user_id);
    }

    /**
     * 13. Duplicate plate number is rejected with 422.
     */
    public function test_13_duplicate_plate_number_is_rejected_with_422(): void
    {
        $userA = $this->createDriver('plate1@example.com');
        $userB = $this->createDriver('plate2@example.com');
        $tokenB = $this->authenticateUser($userB);

        Vehicle::create([
            'user_id' => $userA->id,
            'plate_number' => 'B 9999 DUP',
            'type' => 'car',
            'is_default' => true,
        ]);

        $response = $this->withToken($tokenB)->postJson('/api/v1/vehicles', [
            'plate_number' => 'B 9999 DUP',
            'type' => 'car',
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Data kendaraan tidak valid',
                'errors' => [
                    'plate_number' => ['Nomor pelat kendaraan ini sudah terdaftar di sistem.'],
                ],
            ]);
    }

    /**
     * 14. Deleting default vehicle automatically promotes next vehicle to default.
     */
    public function test_14_deleting_default_vehicle_promotes_next_available_vehicle_to_default(): void
    {
        $user = $this->createDriver('promoter@example.com');
        $token = $this->authenticateUser($user);

        $v1 = Vehicle::create([
            'user_id' => $user->id,
            'plate_number' => 'B 1111 PRM',
            'type' => 'car',
            'is_default' => true,
        ]);

        $v2 = Vehicle::create([
            'user_id' => $user->id,
            'plate_number' => 'B 2222 PRM',
            'type' => 'motorcycle',
            'is_default' => false,
        ]);

        $response = $this->withToken($token)->deleteJson("/api/v1/vehicles/{$v1->id}");

        $response->assertStatus(200);
        $this->assertTrue((bool) $v2->fresh()->is_default);
    }
}

