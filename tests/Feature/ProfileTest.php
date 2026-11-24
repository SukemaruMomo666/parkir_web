<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Unauthenticated users cannot view the profile page.
     */
    public function test_unauthenticated_user_cannot_access_profile(): void
    {
        $response = $this->get('/profile');

        $response->assertRedirect('/login');
    }

    /**
     * Authenticated driver sees their real name, email, phone, and initials on profile.
     */
    public function test_authenticated_driver_sees_their_own_details_on_profile(): void
    {
        $user = User::create([
            'name' => 'Batu Bata Kotak',
            'email' => 'batubata@example.com',
            'phone' => '081299998888',
            'password' => Hash::make('password123'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
        $response->assertSee('Batu Bata Kotak');
        $response->assertSee('batubata@example.com');
        $response->assertSee('081299998888');
        $response->assertSee('BB'); // Avatar initials
        $response->assertDontSee('Alex Chandra');
    }

    /**
     * Authenticated driver sees their first name on the dashboard and navbar.
     */
    public function test_authenticated_driver_sees_their_first_name_on_dashboard_and_navbar(): void
    {
        $user = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti.aminah@example.com',
            'phone' => '081377776666',
            'password' => Hash::make('password123'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Good morning, Siti.');
        $response->assertDontSee('Good morning, Alex.');
        $response->assertSee('SA'); // Initials in navbar
    }

    /**
     * Driver can update personal information and changes persist to database.
     */
    public function test_driver_can_update_profile_and_persists_to_database(): void
    {
        $user = User::create([
            'name' => 'Original Name',
            'email' => 'original@example.com',
            'phone' => '08111222333',
            'password' => Hash::make('password123'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $response = $this->actingAs($user)->put('/profile', [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '08999888777',
            'id_card' => '3171000011112222',
        ]);

        $response->assertRedirect('/profile#personal-info');
        $response->assertSessionHas('profile_success');

        $user->refresh();
        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals('updated@example.com', $user->email);
        $this->assertEquals('08999888777', $user->phone);
    }

    /**
     * Driver cannot update email to another user's email.
     */
    public function test_driver_cannot_update_email_to_another_users_email(): void
    {
        User::create([
            'name' => 'Existing User',
            'email' => 'existing@example.com',
            'phone' => '08111111111',
            'password' => Hash::make('password123'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $user = User::create([
            'name' => 'My User',
            'email' => 'myuser@example.com',
            'phone' => '08222222222',
            'password' => Hash::make('password123'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $response = $this->actingAs($user)->put('/profile', [
            'name' => 'My User',
            'email' => 'existing@example.com',
            'phone' => '08222222222',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertEquals('myuser@example.com', $user->fresh()->email);
    }

    /**
     * Driver can update password with valid current password.
     */
    public function test_driver_can_update_password_with_valid_current_password(): void
    {
        $user = User::create([
            'name' => 'Password Tester',
            'email' => 'pwdtest@example.com',
            'phone' => '08555666777',
            'password' => Hash::make('old_password123'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $response = $this->actingAs($user)->put('/profile/password', [
            'current_password' => 'old_password123',
            'new_password' => 'new_password123',
            'new_password_confirmation' => 'new_password123',
        ]);

        $response->assertRedirect('/profile#security');
        $response->assertSessionHas('password_success');

        $this->assertTrue(Hash::check('new_password123', $user->fresh()->password));
    }

    /**
     * Driver cannot update password with invalid current password.
     */
    public function test_driver_cannot_update_password_with_invalid_current_password(): void
    {
        $user = User::create([
            'name' => 'Password Tester',
            'email' => 'pwdtest2@example.com',
            'phone' => '08555666778',
            'password' => Hash::make('correct_password123'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $response = $this->actingAs($user)->put('/profile/password', [
            'current_password' => 'wrong_password',
            'new_password' => 'new_password123',
            'new_password_confirmation' => 'new_password123',
        ]);

        $response->assertSessionHasErrors(['current_password']);
        $this->assertTrue(Hash::check('correct_password123', $user->fresh()->password));
    }

    /**
     * Google linked driver shows google connected badge on profile.
     */
    public function test_google_linked_driver_displays_google_badge(): void
    {
        $user = User::create([
            'name' => 'Google User',
            'email' => 'google.user@example.com',
            'google_id' => 'google-test-id-9988',
            'phone' => '08777888999',
            'password' => Hash::make('password123'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
        $response->assertSee('Google Connected');
        $response->assertSee('Google User');
    }
}

