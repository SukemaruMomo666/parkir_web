<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'google_id',
    'phone',
    'password',
    'account_type',
    'role',
    'vendor_id',
    'status',
    'email_verified_at',
    'last_login_at',
    'last_login_ip',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'google_id',
        'phone',
        'password',
        'account_type',
        'role',
        'vendor_id',
        'status',
        'email_verified_at',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if the user is a platform Super Admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->account_type === 'Super Admin' 
            || $this->role === 'Super Administrator'
            || str_contains(strtolower($this->role ?? ''), 'super admin');
    }

    /**
     * Check if the user is a Vendor / Tenant operator.
     */
    public function isVendor(): bool
    {
        if ($this->account_type === 'Vendor Staff' || $this->account_type === 'Vendor') {
            return true;
        }

        $vendorRoles = [
            'Tenant Administrator',
            'Operations Manager',
            'Finance Manager',
            'Field Attendant',
        ];

        return in_array($this->role, $vendorRoles, true);
    }

    /**
     * Check if the user is a Driver motorist.
     */
    public function isDriver(): bool
    {
        return $this->account_type === 'Driver' 
            || in_array($this->role, ['Registered Driver', 'Corporate Fleet Driver'], true);
    }

    /**
     * Check if the account is active.
     */
    public function isActive(): bool
    {
        return strtolower($this->status ?? 'active') === 'active';
    }

    /**
     * Check if the account is suspended.
     */
    public function isSuspended(): bool
    {
        return strtolower($this->status ?? '') === 'suspended';
    }

    /**
     * Resolve the canonical dashboard route URL for this user's role.
     */
    public function dashboardRoute(): string
    {
        if ($this->isSuperAdmin()) {
            return '/admin/dashboard';
        }

        if ($this->isVendor()) {
            return '/vendor/dashboard';
        }

        return '/dashboard';
    }

    /**
     * Get the vehicles registered to this user.
     */
    public function vehicles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
