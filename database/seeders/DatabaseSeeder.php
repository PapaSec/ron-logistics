<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
           // UsersSeeder::class,        // First create users (for created_by)
            DriverSeeder::class,       // Then drivers
            VehicleSeeder::class,      // Then vehicles (needs drivers)
            FuelMaintenanceSeeder::class, // Then fuel & maintenance (needs vehicles & drivers)
            // ... other seeders
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
