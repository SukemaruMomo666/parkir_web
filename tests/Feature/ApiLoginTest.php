<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiLoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TC-01: Successful login with registered email and correct password.
     */
    public function test_tc_01_successful_login_returns_200_and_token(): void
    {
        $user = User::create([
            'name' => 'Agung Hidayat',
            'email' => 'agung@example.com',
            'phone' => '+62 814-5678-9012',
            'password' => Hash::make('12345678'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
            'email_verified_at' => now(),
        ]);

        $response = $this->postJson('/api/login', [
            'login' => 'agung@example.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Login berhasil',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => 'Agung Hidayat',
                        'email' => 'agung@example.com',
                        'role' => 'Registered Driver',
                    ],
                ],
            ]);

        $this->assertNotEmpty($response->json('data.token'));
    }

    /**
     * TC-02: Incorrect password with existing registered email.
     */
    public function test_tc_02_incorrect_password_returns_401(): void
    {
        User::create([
            'name' => 'Agung Hidayat',
            'email' => 'agung@example.com',
            'password' => Hash::make('12345678'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $response = $this->postJson('/api/login', [
            'login' => 'agung@example.com',
            'password' => 'wrongpassword123',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Email atau password tidak sesuai',
            ]);
    }

    /**
     * TC-03: Unregistered email address.
     */
    public function test_tc_03_unregistered_email_returns_401(): void
    {
        $response = $this->postJson('/api/login', [
            'login' => 'notfound@example.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Email atau password tidak sesuai',
            ]);
    }

    /**
     * TC-04: Missing or incomplete login data.
     */
    public function test_tc_04_missing_or_incomplete_fields_returns_422(): void
    {
        // 1. Missing password
        $response1 = $this->postJson('/api/login', [
            'login' => 'agung@example.com',
        ]);

        $response1->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Data login tidak lengkap',
            ])
            ->assertJsonValidationErrors(['password']);

        // 2. Missing login identifier
        $response2 = $this->postJson('/api/login', [
            'password' => '12345678',
        ]);

        $response2->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Data login tidak lengkap',
            ])
            ->assertJsonValidationErrors(['login']);
    }

    /**
     * Verify login using phone number identifier.
     */
    public function test_api_login_supports_phone_number_identifier(): void
    {
        $user = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@nusapark.id',
            'phone' => '+62 812-3456-7890',
            'password' => Hash::make('password123'),
            'account_type' => 'Vendor Staff',
            'role' => 'Tenant Administrator',
            'status' => 'Active',
        ]);

        $response = $this->postJson('/api/login', [
            'login' => '+62 812-3456-7890',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Login berhasil',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => 'Budi Santoso',
                        'email' => 'budi.santoso@nusapark.id',
                        'role' => 'Tenant Administrator',
                    ],
                ],
            ]);

        $this->assertNotEmpty($response->json('data.token'));
    }

    /**
     * Verify suspended accounts are rejected with 403.
     */
    public function test_suspended_account_rejected_with_403(): void
    {
        User::create([
            'name' => 'Suspended Motorist',
            'email' => 'suspended@example.com',
            'password' => Hash::make('12345678'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Suspended',
        ]);

        $response = $this->postJson('/api/login', [
            'login' => 'suspended@example.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(403)
            ->assertJson([
                'status' => 'error',
                'message' => 'Akun Anda sedang dinonaktifkan. Silakan hubungi administrator.',
            ]);
    }

    /**
     * Verify credentials sent in query parameters are rejected.
     */
    public function test_query_parameter_credentials_rejected_with_400(): void
    {
        $response = $this->postJson('/api/login?password=secret', [
            'login' => 'agung@example.com',
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'status' => 'error',
                'message' => 'Kredensial tidak boleh dikirim melalui URL query parameters.',
            ]);
    }

    /**
     * Verify protected /api/user endpoint with valid Bearer token.
     */
    public function test_protected_user_endpoint_with_bearer_token(): void
    {
        $user = User::create([
            'name' => 'Agung Hidayat',
            'email' => 'agung@example.com',
            'password' => Hash::make('12345678'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        // Login first to obtain bearer token
        $loginResponse = $this->postJson('/api/login', [
            'login' => 'agung@example.com',
            'password' => '12345678',
        ]);

        $token = $loginResponse->json('data.token');

        // Access protected route
        $userResponse = $this->withToken($token)->getJson('/api/user');

        $userResponse->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Data pengguna berhasil diambil',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => 'Agung Hidayat',
                        'email' => 'agung@example.com',
                        'role' => 'Registered Driver',
                    ],
                ],
            ]);
    }

    /**
     * Verify protected /api/user endpoint without Bearer token returns 401.
     */
    public function test_protected_user_endpoint_without_bearer_token_returns_401(): void
    {
        $response = $this->getJson('/api/user');

        $response->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Unauthenticated: Token bearer diperlukan.',
            ]);
    }

    /**
     * Verify /api/logout endpoint revokes token.
     */
    public function test_api_logout_revokes_token(): void
    {
        User::create([
            'name' => 'Agung Hidayat',
            'email' => 'agung@example.com',
            'password' => Hash::make('12345678'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        // Login
        $loginResponse = $this->postJson('/api/login', [
            'login' => 'agung@example.com',
            'password' => '12345678',
        ]);

        $token = $loginResponse->json('data.token');

        // Logout
        $logoutResponse = $this->withToken($token)->postJson('/api/logout');

        $logoutResponse->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Logout berhasil. Token telah dicabut.',
            ]);

        // Subsequent call with the same token must fail with 401
        $userResponse = $this->withToken($token)->getJson('/api/user');
        $userResponse->assertStatus(401);
    }
}
