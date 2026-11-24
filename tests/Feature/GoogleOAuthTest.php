<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery;
use Tests\TestCase;

class GoogleOAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Helper to mock Socialite Google driver response.
     */
    protected function mockGoogleUser(
        string $id = 'google-id-12345',
        string $email = 'driver@example.com',
        string $name = 'Google Driver',
        bool $verifiedEmail = true
    ): void {
        $socialiteUser = Mockery::mock(SocialiteUser::class);
        $socialiteUser->shouldReceive('getId')->andReturn($id);
        $socialiteUser->shouldReceive('getEmail')->andReturn($email);
        $socialiteUser->shouldReceive('getName')->andReturn($name);
        $socialiteUser->shouldReceive('getAvatar')->andReturn('https://lh3.googleusercontent.com/avatar.jpg');
        $socialiteUser->user = [
            'sub' => $id,
            'email' => $email,
            'name' => $name,
            'verified_email' => $verifiedEmail,
            'email_verified' => $verifiedEmail,
        ];

        $provider = Mockery::mock(GoogleProvider::class);
        $provider->shouldReceive('user')->andReturn($socialiteUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);
    }

    /**
     * 1. Test login page renders the "Masuk dengan Google" button.
     */
    public function test_login_page_renders_google_sign_in_button(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Masuk dengan Google');
        $response->assertSee(route('auth.google.redirect', ['intent' => 'login']));
    }

    /**
     * 2. Test register page renders the "Daftar dengan Google" button.
     */
    public function test_register_page_renders_google_sign_up_button(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Daftar dengan Google');
        $response->assertSee(route('auth.google.redirect', ['intent' => 'register']));
    }

    /**
     * 3. Test redirect route initiates OAuth with correct scopes and stores intent.
     */
    public function test_google_redirect_initiates_oauth_flow_with_scopes(): void
    {
        $response = $this->get('/auth/google/redirect?intent=register');

        $response->assertStatus(302);
        $this->assertEquals('register', session('google_oauth_intent'));

        $targetUrl = $response->headers->get('Location');
        $this->assertStringContainsString('accounts.google.com', $targetUrl);
        $this->assertStringContainsString('client_id=', $targetUrl);
        $this->assertStringContainsString('scope=openid', $targetUrl);
    }

    /**
     * 4. Test user cancellation redirects to login/register with flash error.
     */
    public function test_user_cancellation_redirects_to_login_with_flash_error(): void
    {
        $response = $this->withSession(['google_oauth_intent' => 'login'])
            ->get('/auth/google/callback?error=access_denied');

        $response->assertRedirect('/login');
        $response->assertSessionHas('error', 'Login dengan Google dibatalkan.');
        $this->assertGuest();
    }

    /**
     * 5. Test invalid state exception is handled gracefully.
     */
    public function test_invalid_state_exception_redirects_to_login_with_error(): void
    {
        $provider = Mockery::mock(GoogleProvider::class);
        $provider->shouldReceive('user')->andThrow(new InvalidStateException('State mismatch'));
        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $response = $this->withSession(['google_oauth_intent' => 'login'])
            ->get('/auth/google/callback');

        $response->assertRedirect('/login');
        $response->assertSessionHas('error');
        $this->assertGuest();
    }

    /**
     * 6. Test unverified email from Google is rejected.
     */
    public function test_unverified_email_from_google_is_rejected(): void
    {
        $this->mockGoogleUser(
            id: 'google-unverified-1',
            email: 'unverified@example.com',
            name: 'Unverified User',
            verifiedEmail: false
        );

        $response = $this->withSession(['google_oauth_intent' => 'login'])
            ->get('/auth/google/callback');

        $response->assertRedirect('/login');
        $response->assertSessionHas('error', 'Email akun Google Anda belum diverifikasi oleh Google. Autentikasi ditolak demi keamanan.');
        $this->assertGuest();
    }

    /**
     * [SKENARIO 1] Login Google dengan email yang sudah terdaftar: PASS.
     */
    public function test_google_login_with_registered_email_succeeds(): void
    {
        $user = User::create([
            'name' => 'Registered Driver',
            'email' => 'driver.reg@example.com',
            'password' => Hash::make('secret1234'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
            'email_verified_at' => now(),
        ]);

        $this->mockGoogleUser(
            id: 'google-reg-driver-1',
            email: 'driver.reg@example.com',
            name: 'Registered Driver'
        );

        $response = $this->withSession(['google_oauth_intent' => 'login'])
            ->get('/auth/google/callback');

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/dashboard');
        $this->assertEquals('google-reg-driver-1', $user->fresh()->google_id);
    }

    /**
     * [SKENARIO 2] Login Google dengan email baru: harus ditolak, tidak boleh membuat akun baru,
     * dan menampilkan pesan "Akun belum terdaftar. Silakan daftar terlebih dahulu.".
     */
    public function test_google_login_with_unregistered_email_is_rejected(): void
    {
        $this->mockGoogleUser(
            id: 'google-unknown-user-99',
            email: 'unknown.driver@example.com',
            name: 'Unknown Driver'
        );

        $response = $this->withSession(['google_oauth_intent' => 'login'])
            ->get('/auth/google/callback');

        // Harus tetap guest (tidak boleh login)
        $this->assertGuest();

        // Tidak boleh ada akun baru yang dibuat di database
        $this->assertNull(User::where('email', 'unknown.driver@example.com')->first());
        $this->assertNull(User::where('google_id', 'google-unknown-user-99')->first());

        // Diarahkan ke registrasi dengan pesan error yang spesifik
        $response->assertRedirect('/register');
        $response->assertSessionHas('error', 'Akun belum terdaftar. Silakan daftar terlebih dahulu.');
    }

    /**
     * [SKENARIO 3] Registrasi Google dengan email baru: akun berhasil dibuat (Driver role),
     * pengguna langsung masuk ke dashboard Driver.
     */
    public function test_google_registration_with_new_email_creates_driver_account_and_logs_in(): void
    {
        $this->mockGoogleUser(
            id: 'google-newbie-100',
            email: 'brandnew.driver@example.com',
            name: 'Brand New Driver'
        );

        $response = $this->withSession(['google_oauth_intent' => 'register'])
            ->get('/auth/google/callback');

        $this->assertAuthenticated();
        $user = Auth::user();

        $this->assertEquals('brandnew.driver@example.com', $user->email);
        $this->assertEquals('google-newbie-100', $user->google_id);
        $this->assertEquals('Driver', $user->account_type);
        $this->assertEquals('Registered Driver', $user->role);
        $this->assertEquals('Active', $user->status);
        $this->assertNotNull($user->email_verified_at);
        $this->assertNotEmpty($user->password);

        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('success', 'Pendaftaran berhasil! Selamat datang di NusaPark.');
    }

    /**
     * [SKENARIO 4] Registrasi Google dengan email yang sudah terdaftar: ditolak dan tidak membuat duplikat,
     * diarahkan ke login dengan pesan bahwa akun sudah terdaftar.
     */
    public function test_google_registration_with_already_registered_email_is_rejected_without_duplicates(): void
    {
        $existing = User::create([
            'name' => 'Existing Driver',
            'email' => 'existing.driver@example.com',
            'password' => Hash::make('secret1234'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
            'email_verified_at' => now(),
        ]);

        $initialUserCount = User::count();

        $this->mockGoogleUser(
            id: 'google-duplicate-attempt',
            email: 'existing.driver@example.com',
            name: 'Existing Driver'
        );

        $response = $this->withSession(['google_oauth_intent' => 'register'])
            ->get('/auth/google/callback');

        // Tidak boleh login otomatis saat registrasi duplikat
        $this->assertGuest();

        // Tidak ada baris duplikat yang tercipta
        $this->assertEquals($initialUserCount, User::count());

        // Diarahkan ke login dengan flash error
        $response->assertRedirect('/login');
        $response->assertSessionHas('error', 'Akun dengan email ini sudah terdaftar. Silakan masuk menggunakan akun Anda.');
    }

    /**
     * [SKENARIO 5] Login Google setelah registrasi berhasil: PASS.
     */
    public function test_google_login_succeeds_after_successful_registration(): void
    {
        // 1. Lakukan pendaftaran terlebih dahulu
        $this->mockGoogleUser(
            id: 'google-flow-driver-200',
            email: 'flow.driver@example.com',
            name: 'Flow Driver'
        );

        $regResponse = $this->withSession(['google_oauth_intent' => 'register'])
            ->get('/auth/google/callback');

        $this->assertAuthenticated();
        $registeredUser = Auth::user();
        $this->assertEquals('flow.driver@example.com', $registeredUser->email);

        // Logout
        Auth::logout();
        $this->assertGuest();

        // 2. Sekarang coba login menggunakan akun Google yang baru saja terdaftar
        $this->mockGoogleUser(
            id: 'google-flow-driver-200',
            email: 'flow.driver@example.com',
            name: 'Flow Driver'
        );

        $loginResponse = $this->withSession(['google_oauth_intent' => 'login'])
            ->get('/auth/google/callback');

        $this->assertAuthenticatedAs($registeredUser);
        $loginResponse->assertRedirect('/dashboard');
        $loginResponse->assertSessionHas('success', 'Berhasil masuk dengan akun Google.');
    }

    /**
     * User already linked with google_id can login directly.
     */
    public function test_user_already_linked_with_google_id_can_login_directly(): void
    {
        $user = User::create([
            'name' => 'Linked Driver',
            'email' => 'linked.driver@example.com',
            'google_id' => 'google-matched-12345',
            'password' => Hash::make('secret1234'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
            'email_verified_at' => now(),
        ]);

        $this->mockGoogleUser(
            id: 'google-matched-12345',
            email: 'linked.driver@example.com',
            name: 'Linked Driver'
        );

        $response = $this->withSession(['google_oauth_intent' => 'login'])
            ->get('/auth/google/callback');

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/dashboard');
    }

    /**
     * Existing local privileged user (Vendor Staff/Super Admin) preserves their role 100%.
     */
    public function test_existing_privileged_user_auto_links_and_preserves_role(): void
    {
        $vendorUser = User::create([
            'name' => 'Budi Vendor',
            'email' => 'budi.vendor@example.com',
            'google_id' => null,
            'password' => Hash::make('vendorpass123'),
            'account_type' => 'Vendor Staff',
            'role' => 'Tenant Administrator',
            'status' => 'Active',
            'email_verified_at' => now(),
        ]);

        $this->mockGoogleUser(
            id: 'google-budi-id-999',
            email: 'budi.vendor@example.com',
            name: 'Budi Santoso'
        );

        $response = $this->withSession(['google_oauth_intent' => 'login'])
            ->get('/auth/google/callback');

        $this->assertAuthenticatedAs($vendorUser);
        $response->assertRedirect('/vendor/dashboard');

        $fresh = $vendorUser->fresh();
        $this->assertEquals('google-budi-id-999', $fresh->google_id);
        $this->assertEquals('Vendor Staff', $fresh->account_type);
        $this->assertEquals('Tenant Administrator', $fresh->role);
    }

    /**
     * Conflicting Google ID (already assigned to another account) is rejected.
     */
    public function test_conflicting_google_id_on_different_user_is_rejected(): void
    {
        User::create([
            'name' => 'Original Owner',
            'email' => 'owner@example.com',
            'google_id' => 'google-shared-id',
            'password' => Hash::make('secret123'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        User::create([
            'name' => 'Second User',
            'email' => 'second@example.com',
            'google_id' => null,
            'password' => Hash::make('secret123'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $this->mockGoogleUser(
            id: 'google-shared-id',
            email: 'second@example.com',
            name: 'Second User'
        );

        $response = $this->withSession(['google_oauth_intent' => 'login'])
            ->get('/auth/google/callback');

        $this->assertGuest();
        $response->assertRedirect('/login');
        $response->assertSessionHas('error');
    }

    /**
     * Existing user who already has a different Google ID is not overwritten.
     */
    public function test_existing_user_with_different_google_id_is_not_overwritten(): void
    {
        $user = User::create([
            'name' => 'Driver One',
            'email' => 'driver.one@example.com',
            'google_id' => 'google-old-id',
            'password' => Hash::make('secret123'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Active',
        ]);

        $this->mockGoogleUser(
            id: 'google-new-id',
            email: 'driver.one@example.com',
            name: 'Driver One'
        );

        $response = $this->withSession(['google_oauth_intent' => 'login'])
            ->get('/auth/google/callback');

        $this->assertGuest();
        $response->assertRedirect('/login');
        $response->assertSessionHas('error');
        $this->assertEquals('google-old-id', $user->fresh()->google_id);
    }

    /**
     * Suspended account is rejected on Google OAuth.
     */
    public function test_suspended_account_is_rejected_on_google_login(): void
    {
        User::create([
            'name' => 'Suspended Guy',
            'email' => 'suspended.guy@example.com',
            'google_id' => 'google-suspended-888',
            'password' => Hash::make('secret1234'),
            'account_type' => 'Driver',
            'role' => 'Registered Driver',
            'status' => 'Suspended',
            'email_verified_at' => now(),
        ]);

        $this->mockGoogleUser(
            id: 'google-suspended-888',
            email: 'suspended.guy@example.com',
            name: 'Suspended Guy'
        );

        $response = $this->withSession(['google_oauth_intent' => 'login'])
            ->get('/auth/google/callback');

        $this->assertGuest();
        $response->assertRedirect('/login');
        $response->assertSessionHas('error');
    }
}
