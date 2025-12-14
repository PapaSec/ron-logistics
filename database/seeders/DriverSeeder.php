<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    public function run(): void
    {
        $drivers = [
            // Special drivers for testing
            [
                'driver_number' => 'DRV-0001',
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@ronlogistics.co.za',
                'phone' => '+27 11 123 4567',
                'phone_alt' => '+27 82 123 4567',
                'license_number' => 'DL001234',
                'license_type' => 'Code 10',
                'license_expiry' => now()->addDays(15),
                'hire_date' => now()->subYears(2),
                'employment_type' => 'full_time',
                'status' => 'active',
                'address' => '123 Main Street',
                'city' => 'Johannesburg',
                'state' => 'Gauteng',
                'postal_code' => '2000',
                'emergency_contact_name' => 'Mary Smith',
                'emergency_contact_phone' => '+27 11 987 6543',
                'emergency_contact_relationship' => 'Spouse',
                'notes' => 'Excellent driver, reliable for long hauls',
                'last_medical_checkup' => now()->subMonths(6),
                'next_medical_checkup' => now()->addMonths(6),
            ],
            [
                'driver_number' => 'DRV-0002',
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@ronlogistics.co.za',
                'phone' => '+27 21 234 5678',
                'license_number' => 'DL002345',
                'license_type' => 'Code 14',
                'license_expiry' => now()->addYear(),
                'hire_date' => now()->subYear(),
                'employment_type' => 'full_time',
                'status' => 'on_leave',
                'address' => '456 Beach Road',
                'city' => 'Cape Town',
                'state' => 'Western Cape',
                'postal_code' => '8001',
                'emergency_contact_name' => 'Robert Johnson',
                'emergency_contact_phone' => '+27 21 876 5432',
                'emergency_contact_relationship' => 'Husband',
                'notes' => 'On maternity leave until next month',
            ],
            [
                'driver_number' => 'DRV-0003',
                'first_name' => 'Mike',
                'last_name' => 'Williams',
                'email' => 'mike.williams@ronlogistics.co.za',
                'phone' => '+27 31 345 6789',
                'license_number' => 'DL003456',
                'license_type' => 'Code 10',
                'license_expiry' => now()->addMonths(6),
                'hire_date' => now()->subMonths(18),
                'employment_type' => 'contract',
                'status' => 'active',
                'address' => '789 Ocean Drive',
                'city' => 'Durban',
                'state' => 'KwaZulu-Natal',
                'postal_code' => '4001',
                'emergency_contact_name' => 'Susan Williams',
                'emergency_contact_phone' => '+27 31 765 4321',
                'emergency_contact_relationship' => 'Wife',
                'notes' => 'Contract ends in 3 months',
            ],
            [
                'driver_number' => 'DRV-0004',
                'first_name' => 'David',
                'last_name' => 'Brown',
                'email' => 'david.brown@ronlogistics.co.za',
                'phone' => '+27 12 456 7890',
                'license_number' => 'DL004567',
                'license_type' => 'Forklift',
                'license_expiry' => now()->subDays(7),
                'hire_date' => now()->subYears(3),
                'employment_type' => 'full_time',
                'status' => 'inactive',
                'address' => '321 Union Street',
                'city' => 'Pretoria',
                'state' => 'Gauteng',
                'postal_code' => '0002',
                'emergency_contact_name' => 'Lisa Brown',
                'emergency_contact_phone' => '+27 12 654 3210',
                'emergency_contact_relationship' => 'Sister',
                'notes' => 'License expired - awaiting renewal',
            ],
        ];

        foreach ($drivers as $driver) {
            Driver::create($driver);
        }

        // Generate more random drivers
        $firstNames = ['James', 'Mary', 'Robert', 'Patricia', 'Michael', 'Jennifer', 'William', 'Linda', 'Richard', 'Elizabeth', 'Charles', 'Susan', 'Thomas', 'Jessica', 'Christopher', 'Sarah'];
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Gonzalez', 'Wilson', 'Anderson', 'Taylor'];
        $cities = ['Johannesburg', 'Cape Town', 'Durban', 'Pretoria', 'Port Elizabeth', 'Bloemfontein', 'East London', 'Pietermaritzburg'];
        $states = ['Gauteng', 'Western Cape', 'KwaZulu-Natal', 'Eastern Cape', 'Free State', 'Mpumalanga', 'North West', 'Limpopo'];
        $licenseTypes = ['Code 8', 'Code 10', 'Code 14', 'Forklift'];
        $employmentTypes = ['full_time', 'part_time', 'contract'];
        $statuses = ['active', 'inactive', 'on_leave', 'suspended'];
        $relationships = ['Spouse', 'Parent', 'Sibling', 'Child', 'Friend'];

        for ($i = 5; $i <= 50; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $hireDate = now()->subMonths(rand(1, 60));
            
            Driver::create([
                'driver_number' => 'DRV-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => strtolower($firstName . '.' . $lastName) . '@ronlogistics.co.za',
                'phone' => '+27 ' . fake()->numerify('## ### ####'),
                'phone_alt' => rand(0, 1) ? '+27 ' . fake()->numerify('## ### ####') : null,
                'license_number' => 'DL' . fake()->numerify('######'),
                'license_type' => $licenseTypes[array_rand($licenseTypes)],
                'license_expiry' => now()->addMonths(rand(-6, 24)),
                'hire_date' => $hireDate,
                'employment_type' => $employmentTypes[array_rand($employmentTypes)],
                'status' => $statuses[array_rand($statuses)],
                'address' => fake()->streetAddress(),
                'city' => $cities[array_rand($cities)],
                'state' => $states[array_rand($states)],
                'postal_code' => fake()->numerify('####'),
                'emergency_contact_name' => fake()->name(),
                'emergency_contact_phone' => '+27 ' . fake()->numerify('## ### ####'),
                'emergency_contact_relationship' => $relationships[array_rand($relationships)],
                'notes' => rand(0, 1) ? fake()->sentence() : null,
                'last_medical_checkup' => $hireDate->copy()->addMonths(rand(1, 12)),
                'next_medical_checkup' => $hireDate->copy()->addMonths(rand(13, 24)),
            ]);
        }
    }
}