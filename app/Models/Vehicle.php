<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vehicles';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'plate_number',
        'type',
        'make',
        'model',
        'color',
        'is_default',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_default' => 'boolean',
        ];
    }

    /**
     * Get the user that owns the vehicle.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper accessor for vehicle type label.
     */
    public function getTypeLabelAttribute(): string
    {
        return match (strtolower($this->type)) {
            'car' => 'Car',
            'motorcycle' => 'Motorcycle',
            'ev' => 'Electric Vehicle',
            default => ucfirst($this->type),
        };
    }

    /**
     * Helper accessor for display name.
     */
    public function getDisplayNameAttribute(): string
    {
        $name = trim(($this->make ?? '') . ' ' . ($this->model ?? ''));
        return $name !== '' ? $name : $this->plate_number;
    }
}

