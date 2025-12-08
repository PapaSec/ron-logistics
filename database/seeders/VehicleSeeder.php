<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            // Active fleet
            [
                'vehicle_number' => 'VEH-0001',
                'type' => 'Truck',
                'make' => 'Toyota',
                'model' => 'Hilux',
                'year' => 2023,
                'license_plate' => 'GP-12-AB-123',
                'capacity' => 1500,
                'status' => 'available',
                'last_maintenance' => now()->subMonths(2),
                'next_maintenance' => now()->addMonths(4),
                'notes' => 'Excellent condition, recently serviced',
            ],
            [
                'vehicle_number' => 'VEH-0002',
                'type' => 'Van',
                'make' => 'Mercedes',
                'model' => 'Sprinter',
                'year' => 2022,
                'license_plate' => 'GP-34-CD-456',
                'capacity' => 2000,
                'status' => 'in_use',
                'last_maintenance' => now()->subMonths(3),
                'next_maintenance' => now()->addMonths(3),
                'notes' => 'Currently assigned to long-distance route',
            ],
            [
                'vehicle_number' => 'VEH-0003',
                'type' => 'Pickup',
                'make' => 'Ford',
                'model' => 'F-150',
                'year' => 2021,
                'license_plate' => 'GP-56-EF-789',
                'capacity' => 1200,
                'status' => 'maintenance',
                'last_maintenance' => now()->subDays(5),
                'next_maintenance' => now()->addMonths(6),
                'notes' => 'Undergoing routine maintenance check',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }

        // Generate more random vehicles
        $types = ['Truck', 'Van', 'Pickup', 'Semi-Truck'];
        $makes = ['Toyota', 'Ford', 'Mercedes', 'Isuzu', 'Volvo', 'Scania'];
        $models = ['Hilux', 'F-150', 'Sprinter', 'Giga', 'FH16', 'R450'];
        $statuses = ['available', 'in_use', 'maintenance', 'out_of_service'];

        for ($i = 4; $i <= 30; $i++) {
            Vehicle::create([
                'vehicle_number' => 'VEH-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'type' => $types[array_rand($types)],
                'make' => $makes[array_rand($makes)],
                'model' => $models[array_rand($models)],
                'year' => rand(2015, 2024),
                'license_plate' => strtoupper(fake()->bothify('GP-##-??-###')),
                'capacity' => rand(800, 5000),
                'status' => $statuses[array_rand($statuses)],
                'last_maintenance' => now()->subMonths(rand(1, 6)),
                'next_maintenance' => now()->addMonths(rand(1, 12)),
                'notes' => rand(0, 1) ? fake()->sentence() : null,
            ]);
        }
    }
}