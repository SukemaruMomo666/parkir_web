<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Explicit development-only seeder for local testing across all 3 NusaPark portals.
 * Not invoked automatically by DatabaseSeeder.
 *
 * Execution command:
 *   php artisan db:seed --class=DevDemoUserSeeder
 */
class DevDemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Super Admin Account -> Lands on /admin/dashboard
        User::updateOrCreate(
            ['email' => 'raditya.pratama@nusapark.id'],
            [
                'name' => 'Raditya Pratama',
                'phone' => '+62 811-2345-6789',
                'password' => Hash::make('password123'),
                'account_type' => 'Super Admin',
                'role' => 'Super Administrator',
                'vendor_id' => 'platform',
                'status' => 'Active',
                'email_verified_at' => now(),
            ]
        );

        // 2. Vendor Operator Account -> Lands on /vendor/dashboard
        User::updateOrCreate(
            ['email' => 'budi.santoso@nusapark.id'],
            [
                'name' => 'Budi Santoso',
                'phone' => '+62 812-3456-7890',
                'password' => Hash::make('password123'),
                'account_type' => 'Vendor Staff',
                'role' => 'Tenant Administrator',
                'vendor_id' => 'vnd-01',
                'status' => 'Active',
                'email_verified_at' => now(),
            ]
        );

        // 3. Driver Motorist Account -> Lands on /dashboard
        User::updateOrCreate(
            ['email' => 'alex.driver@nusapark.id'],
            [
                'name' => 'Alex Driver',
                'phone' => '+62 813-4567-8901',
                'password' => Hash::make('password123'),
                'account_type' => 'Driver',
                'role' => 'Registered Driver',
                'vendor_id' => null,
                'status' => 'Active',
                'email_verified_at' => now(),
            ]
        );

        // 4. Academic Postman Test Account (Agung Hidayat) -> Driver role
        User::updateOrCreate(
            ['email' => 'agung@example.com'],
            [
                'name' => 'Agung Hidayat',
                'phone' => '+62 814-5678-9012',
                'password' => Hash::make('12345678'),
                'account_type' => 'Driver',
                'role' => 'Registered Driver',
                'vendor_id' => null,
                'status' => 'Active',
                'email_verified_at' => now(),
            ]
        );
    }
}
