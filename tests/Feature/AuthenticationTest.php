<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test login screen can be rendered.
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Welcome back');
    }

    /**
     * Test users can authenticate using the login screen.
     */
    public function test_driver_can_authenticate_and_redirects_to_driver_dashboard(): void
    {
        $user = User::create([
            'name' => 'Alex Driver',
            'email' => 'driver@example.com',
            'phone' => '+628111111111',
            'password' => Hash::make('secret1234'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $response = $this->post('/login', [
            'login' => 'driver@example.com',
            'password' => 'secret1234',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/dashboard');
    }

    /**
     * Test vendor user redirects to vendor dashboard.
     */
    public function test_vendor_can_authenticate_and_redirects_to_vendor_dashboard(): void
    {
        $user = User::create([
            'name' => 'Vendor Op',
            'email' => 'vendor@example.com',
            'phone' => '+628222222222',
            'password' => Hash::make('secret1234'),
            'account_type' => 'Vendor Staff',
            'role' => 'Tenant Administrator',
            'vendor_id' => 'vnd-01',
            'status' => 'Active',
        ]);

        $response = $this->post('/login', [
            'login' => 'vendor@example.com',
            'password' => 'secret1234',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/vendor/dashboard');
    }

    /**
     * Test super admin user redirects to admin dashboard.
     */
    public function test_super_admin_can_authenticate_and_redirects_to_admin_dashboard(): void
    {
        $user = User::create([
            'name' => 'Root Admin',
            'email' => 'admin@example.com',
            'phone' => '+628333333333',
            'password' => Hash::make('secret1234'),
            'account_type' => 'Super Admin',
            'role' => 'Super Administrator',
            'status' => 'Active',
        ]);

        $response = $this->post('/login', [
            'login' => 'admin@example.com',
            'password' => 'secret1234',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/admin/dashboard');
    }

    /**
     * Test users can authenticate using phone number.
     */
    public function test_user_can_authenticate_using_phone_number(): void
    {
        $user = User::create([
            'name' => 'Driver Phone',
            'email' => 'phone@example.com',
            'phone' => '+628999999999',
            'password' => Hash::make('secret1234'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $response = $this->post('/login', [
            'login' => '+628999999999',
            'password' => 'secret1234',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/dashboard');
    }

    /**
     * Test users cannot authenticate with invalid password.
     */
    public function test_users_cannot_authenticate_with_invalid_password(): void
    {
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('secret1234'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $this->post('/login', [
            'login' => 'user@example.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    /**
     * Test suspended users are rejected.
     */
    public function test_suspended_users_are_rejected(): void
    {
        User::create([
            'name' => 'Suspended User',
            'email' => 'suspended@example.com',
            'password' => Hash::make('secret1234'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Suspended',
        ]);

        $response = $this->post('/login', [
            'login' => 'suspended@example.com',
            'password' => 'secret1234',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('login');
    }

    /**
     * Test users can log out.
     */
    public function test_users_can_logout(): void
    {
        $user = User::create([
            'name' => 'Logged User',
            'email' => 'logged@example.com',
            'password' => Hash::make('secret1234'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/login');
    }

    /**
     * Test a user can register via web form.
     */
    public function test_user_can_register_via_web_form(): void
    {
        $response = $this->post('/register', [
            'name' => 'Budi Baru',
            'email' => 'budibaru@example.com',
            'password' => 'password123',
            'terms' => '1',
        ]);

        $this->assertAuthenticated();
        $user = User::where('email', 'budibaru@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Budi Baru', $user->name);
        $this->assertEquals('Driver', $user->account_type);
        $this->assertEquals('Registered Driver', $user->role);
        $this->assertEquals('Active', $user->status);
        $response->assertRedirect('/dashboard');
    }

    /**
     * Test registration fails if duplicate email.
     */
    public function test_registration_fails_if_duplicate_email(): void
    {
        User::create([
            'name' => 'Existing Driver',
            'email' => 'existing@example.com',
            'password' => Hash::make('secret1234'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $response = $this->post('/register', [
            'name' => 'Another User',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'terms' => '1',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test registration fails if required fields are missing.
     */
    public function test_registration_requires_mandatory_fields(): void
    {
        $response = $this->post('/register', []);

        $response->assertSessionHasErrors(['name', 'email', 'password', 'terms']);
        $this->assertGuest();
    }

    /**
     * Test newly registered user can log in with their created credentials.
     */
    public function test_registered_user_can_subsequently_login(): void
    {
        $this->post('/register', [
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'password' => 'secretP@ss123',
            'terms' => '1',
        ]);

        $this->post('/logout');
        $this->assertGuest();

        $loginResponse = $this->post('/login', [
            'login' => 'siti@example.com',
            'password' => 'secretP@ss123',
        ]);

        $this->assertAuthenticated();
        $loginResponse->assertRedirect('/dashboard');
    }
}
