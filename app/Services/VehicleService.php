<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class VehicleService
{
    /**
     * Supported vehicle types.
     */
    public const VEHICLE_TYPES = [
        'car' => 'Car',
        'motorcycle' => 'Motorcycle',
        'ev' => 'Electric Vehicle',
    ];

    /**
     * Get all vehicles for the authenticated user.
     */
    public function getUserVehicles(): array
    {
        $vehicles = $this->loadStoredVehicles();

        // Sort: default vehicle first, then by created_at descending
        usort($vehicles, function ($a, $b) {
            if ($a['is_default'] && !$b['is_default']) return -1;
            if (!$a['is_default'] && $b['is_default']) return 1;
            return strtotime($b['created_at']) <=> strtotime($a['created_at']);
        });

        return $vehicles;
    }

    /**
     * Get a single vehicle by ID.
     */
    public function getVehicle(string $id): ?array
    {
        $vehicles = $this->loadStoredVehicles();
        foreach ($vehicles as $v) {
            if ($v['id'] === $id) {
                return $v;
            }
        }
        return null;
    }

    /**
     * Get the default vehicle.
     */
    public function getDefaultVehicle(): ?array
    {
        $vehicles = $this->loadStoredVehicles();
        foreach ($vehicles as $v) {
            if ($v['is_default']) {
                return $v;
            }
        }
        return null;
    }

    /**
     * Validate vehicle input data.
     *
     * @return array ['valid' => bool, 'errors' => [...]]
     */
    public function validate(array $data, ?string $excludeId = null): array
    {
        $errors = [];

        // Registration number: required, trimmed
        $plate = isset($data['plate']) ? strtoupper(trim($data['plate'])) : '';
        if (empty($plate)) {
            $errors['plate'] = 'Registration number is required.';
        } elseif (strlen($plate) < 2 || strlen($plate) > 15) {
            $errors['plate'] = 'Registration number must be between 2 and 15 characters.';
        } else {
            // Check uniqueness among this user's vehicles
            $vehicles = $this->loadStoredVehicles();
            foreach ($vehicles as $v) {
                if ($v['id'] !== $excludeId && strtoupper(trim($v['plate'])) === $plate) {
                    $errors['plate'] = 'This registration number is already registered to your account.';
                    break;
                }
            }
        }

        // Vehicle type: required, must be valid
        $type = $data['type'] ?? '';
        if (empty($type) || !array_key_exists($type, self::VEHICLE_TYPES)) {
            $errors['type'] = 'Please select a valid vehicle type.';
        }

        // Make: optional, max 50 chars
        $make = trim($data['make'] ?? '');
        if (strlen($make) > 50) {
            $errors['make'] = 'Make must not exceed 50 characters.';
        }

        // Model: optional, max 50 chars
        $model = trim($data['model'] ?? '');
        if (strlen($model) > 50) {
            $errors['model'] = 'Model must not exceed 50 characters.';
        }

        // Color: optional, max 30 chars
        $color = trim($data['color'] ?? '');
        if (strlen($color) > 30) {
            $errors['color'] = 'Color must not exceed 30 characters.';
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors,
            'sanitized' => [
                'plate' => $plate,
                'type' => $type,
                'make' => $make,
                'model' => $model,
                'color' => $color,
                'is_default' => !empty($data['is_default']),
            ],
        ];
    }

    /**
     * Add a new vehicle (simulated).
     */
    public function addVehicle(array $sanitized): array
    {
        $vehicles = $this->loadStoredVehicles();

        // If new vehicle is default, unset others
        if ($sanitized['is_default']) {
            foreach ($vehicles as &$v) {
                $v['is_default'] = false;
            }
            unset($v);
        }

        // If this is the first vehicle, auto-set as default
        if (empty($vehicles)) {
            $sanitized['is_default'] = true;
        }

        $newId = 'veh-' . str_pad(count($vehicles) + 1, 3, '0', STR_PAD_LEFT);
        $displayName = trim(($sanitized['make'] ?: '') . ' ' . ($sanitized['model'] ?: ''));

        $newVehicle = [
            'id' => $newId,
            'plate' => $sanitized['plate'],
            'type' => $sanitized['type'],
            'type_label' => self::VEHICLE_TYPES[$sanitized['type']] ?? ucfirst($sanitized['type']),
            'make' => $sanitized['make'],
            'model' => $sanitized['model'],
            'display_name' => $displayName ?: null,
            'color' => $sanitized['color'],
            'is_default' => $sanitized['is_default'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'has_active_session' => false,
            'has_future_reservation' => false,
        ];

        $vehicles[] = $newVehicle;
        $this->persistVehicles($vehicles);

        return ['success' => true, 'vehicle' => $newVehicle];
    }

    /**
     * Update an existing vehicle (simulated).
     */
    public function updateVehicle(string $id, array $sanitized): array
    {
        $vehicles = $this->loadStoredVehicles();
        $found = false;

        // If updating to default, unset others first
        if ($sanitized['is_default']) {
            foreach ($vehicles as &$v) {
                $v['is_default'] = false;
            }
            unset($v);
        }

        foreach ($vehicles as &$v) {
            if ($v['id'] === $id) {
                $found = true;
                $v['plate'] = $sanitized['plate'];
                $v['type'] = $sanitized['type'];
                $v['type_label'] = self::VEHICLE_TYPES[$sanitized['type']] ?? ucfirst($sanitized['type']);
                $v['make'] = $sanitized['make'];
                $v['model'] = $sanitized['model'];
                $v['display_name'] = trim(($sanitized['make'] ?: '') . ' ' . ($sanitized['model'] ?: '')) ?: null;
                $v['color'] = $sanitized['color'];
                $v['is_default'] = $sanitized['is_default'];
                $v['updated_at'] = date('Y-m-d H:i:s');
                $updated = $v;
                break;
            }
        }
        unset($v);

        if (!$found) {
            return ['success' => false, 'error' => 'Vehicle not found.'];
        }

        $this->persistVehicles($vehicles);
        return ['success' => true, 'vehicle' => $updated];
    }

    /**
     * Set a vehicle as the default.
     */
    public function setDefault(string $id): array
    {
        $vehicles = $this->loadStoredVehicles();
        $found = false;

        foreach ($vehicles as &$v) {
            if ($v['id'] === $id) {
                $found = true;
                $v['is_default'] = true;
            } else {
                $v['is_default'] = false;
            }
        }
        unset($v);

        if (!$found) {
            return ['success' => false, 'error' => 'Vehicle not found.'];
        }

        $this->persistVehicles($vehicles);
        return ['success' => true];
    }

    /**
     * Remove a vehicle if permitted.
     */
    public function removeVehicle(string $id): array
    {
        $vehicles = $this->loadStoredVehicles();
        $target = null;

        foreach ($vehicles as $v) {
            if ($v['id'] === $id) {
                $target = $v;
                break;
            }
        }

        if (!$target) {
            return ['success' => false, 'error' => 'Vehicle not found or already removed.'];
        }

        if (!empty($target['has_active_session'])) {
            return ['success' => false, 'error' => 'This vehicle has an active parking session. Please end the session before removing it.'];
        }

        if (!empty($target['has_future_reservation'])) {
            return ['success' => false, 'error' => 'This vehicle has a future reservation. Please cancel the reservation before removing it.'];
        }

        $wasDefault = $target['is_default'];
        $vehicles = array_values(array_filter($vehicles, fn($v) => $v['id'] !== $id));

        // If the removed vehicle was the default, promote the first remaining
        if ($wasDefault && !empty($vehicles)) {
            $vehicles[0]['is_default'] = true;
        }

        $this->persistVehicles($vehicles);
        return ['success' => true, 'plate' => $target['plate']];
    }

    /**
     * Load vehicles from cache or seed with mock data.
     */
    protected function loadStoredVehicles(): array
    {
        return Cache::get('user_vehicles_alex', function () {
            $seed = $this->seedVehicles();
            Cache::put('user_vehicles_alex', $seed, now()->addHours(24));
            return $seed;
        });
    }

    /**
     * Persist vehicles to cache.
     */
    protected function persistVehicles(array $vehicles): void
    {
        Cache::put('user_vehicles_alex', array_values($vehicles), now()->addHours(24));
    }

    /**
     * Authoritative seed data matching existing mock records across pages.
     */
    protected function seedVehicles(): array
    {
        return [
            [
                'id' => 'veh-001',
                'plate' => 'B 1234 XYZ',
                'type' => 'car',
                'type_label' => 'Car',
                'make' => 'Toyota',
                'model' => 'Avanza',
                'display_name' => 'Toyota Avanza',
                'color' => 'White',
                'is_default' => true,
                'created_at' => '2026-08-15 09:00:00',
                'updated_at' => '2026-10-01 14:30:00',
                'has_active_session' => true,
                'has_future_reservation' => false,
            ],
            [
                'id' => 'veh-002',
                'plate' => 'B 9012 EV',
                'type' => 'ev',
                'type_label' => 'Electric Vehicle',
                'make' => 'Hyundai',
                'model' => 'Ioniq 5',
                'display_name' => 'Hyundai Ioniq 5',
                'color' => 'Silver',
                'is_default' => false,
                'created_at' => '2026-10-05 16:00:00',
                'updated_at' => '2026-10-05 16:00:00',
                'has_active_session' => false,
                'has_future_reservation' => true,
            ],
            [
                'id' => 'veh-003',
                'plate' => 'B 5678 ABC',
                'type' => 'motorcycle',
                'type_label' => 'Motorcycle',
                'make' => 'Honda',
                'model' => 'Vario 160',
                'display_name' => 'Honda Vario 160',
                'color' => 'Black',
                'is_default' => false,
                'created_at' => '2026-09-20 11:00:00',
                'updated_at' => '2026-09-20 11:00:00',
                'has_active_session' => false,
                'has_future_reservation' => false,
            ],
        ];
    }
}
