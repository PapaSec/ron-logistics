<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Shipment, User};

class ShipmentSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // Get your user
        
        $statuses = ['pending', 'in_transit', 'delivered', 'cancelled'];
        $priorities = ['standard', 'express', 'economy'];
        
        for ($i = 1; $i <= 30; $i++) {
            Shipment::create([
                'tracking_number' => 'SHIP-' . now()->year . '-' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'user_id' => $user->id,
                'sender_name' => fake()->name(),
                'sender_phone' => fake()->phoneNumber(),
                'receiver_name' => fake()->name(),
                'receiver_phone' => fake()->phoneNumber(),
                'origin_city' => fake()->city(),
                'destination_city' => fake()->city(),
                'description' => fake()->sentence(4),
                'weight' => rand(1, 50) + (rand(0, 99) / 100),
                'quantity' => rand(1, 5),
                'value' => rand(100, 5000),
                'status' => $statuses[array_rand($statuses)],
                'priority' => $priorities[array_rand($priorities)],
                'pickup_date' => now()->subDays(rand(0, 10)),
                'estimated_delivery_date' => now()->addDays(rand(1, 7)),
            ]);
        }
    }
}