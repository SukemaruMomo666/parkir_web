<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Safely adds authentication, role, tenant, and status columns to users table.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->unique()->after('email');
            }
            if (!Schema::hasColumn('users', 'account_type')) {
                $table->string('account_type')->default('Driver')->after('phone');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('Registered Driver')->after('account_type');
            }
            if (!Schema::hasColumn('users', 'vendor_id')) {
                $table->string('vendor_id')->nullable()->after('role');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status')->default('Active')->after('vendor_id');
            }
            if (!Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable()->after('status');
            }
            if (!Schema::hasColumn('users', 'last_login_ip')) {
                $table->string('last_login_ip', 45)->nullable()->after('last_login_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columnsToDrop = [];
            foreach (['phone', 'account_type', 'role', 'vendor_id', 'status', 'last_login_at', 'last_login_ip'] as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $columnsToDrop[] = $col;
                }
            }
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
