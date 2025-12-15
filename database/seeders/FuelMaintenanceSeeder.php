<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\{Driver, FuelRecord, MaintenanceRecord, User, Vehicle};

class FuelMaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if we have necessary data
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $users = User::all();
        
        if ($vehicles->isEmpty()) {
            $this->command->error('Please seed vehicles first!');
            return;
        }
        
        if ($drivers->isEmpty()) {
            $this->command->warn('No drivers found. Fuel records will be created without driver association.');
        }
        
        if ($users->isEmpty()) {
            $this->command->warn('No users found. Records will be created without created_by.');
        }

        $this->command->info('Clearing existing fuel and maintenance records...');
        FuelRecord::query()->delete();
        MaintenanceRecord::query()->delete();

        $this->command->info('Generating fuel records...');
        $this->seedFuelRecords($vehicles, $drivers, $users);
        
        $this->command->info('Generating maintenance records...');
        $this->seedMaintenanceRecords($vehicles, $users);
        
        $this->command->info('Updating vehicle maintenance dates...');
        $this->updateVehicleMaintenanceDates($vehicles);
        
        $this->command->info('Fuel & Maintenance records created successfully!');
    }

    /**
     * Generate fuel records for each vehicle
     */
    private function seedFuelRecords($vehicles, $drivers, $users): void
    {
        $fuelStations = [
            'Shell', 'BP', 'Engen', 'Caltex', 'Total', 'Sasol',
            'Quickfuel', 'Star', 'Gulf', 'PetroSA'
        ];
        
        $locations = [
            'Johannesburg CBD', 'Pretoria Central', 'Durban Harbor', 'Cape Town City', 
            'Port Elizabeth', 'Bloemfontein', 'Polokwane', 'Nelspruit', 'Kimberley', 
            'Rustenburg', 'East London', 'George', 'Pietermaritzburg', 'Welkom'
        ];
        
        // Exact ENUM values from migration
        $paymentMethods = ['cash', 'card', 'fuel_card', 'account'];
        
        // Fuel types from your model
        $fuelTypes = ['Diesel', 'Petrol', 'Unleaded'];

        foreach ($vehicles as $vehicle) {
            // Each vehicle gets 15-40 fuel records over the last year
            $recordCount = rand(15, 40);
            $currentOdometer = rand(50000, 150000);
            $lastFuelDate = Carbon::now()->subMonths(10); // Start 10 months ago
            
            // Get assigned driver for this vehicle
            $assignedDriver = $vehicle->driver_id ? $drivers->firstWhere('id', $vehicle->driver_id) : null;

            for ($i = 0; $i < $recordCount; $i++) {
                $date = $lastFuelDate->addDays(rand(3, 14)); // Fuel every 3-14 days
                
                // Simulate price fluctuations (South African diesel prices)
                $pricePerLiter = rand(1800, 2300) / 100; // R18.00 - R23.00
                
                // Generate quantity based on vehicle type
                $vehicleType = strtolower($vehicle->type ?? '');
                if (str_contains($vehicleType, 'truck') || str_contains($vehicleType, 'lorry')) {
                    $quantity = rand(800, 1200) / 10; // 80-120 liters for trucks
                    $distanceTraveled = rand(600, 1200); // km traveled
                } elseif (str_contains($vehicleType, 'van') || str_contains($vehicleType, 'minibus')) {
                    $quantity = rand(400, 700) / 10; // 40-70 liters for vans
                    $distanceTraveled = rand(300, 800); // km traveled
                } else {
                    $quantity = rand(500, 900) / 10; // 50-90 liters for others
                    $distanceTraveled = rand(400, 1000); // km traveled
                }
                
                $totalCost = $quantity * $pricePerLiter;
                
                // Odometer increases
                $currentOdometer += $distanceTraveled;
                
                // Random driver or assigned driver
                $driverId = $assignedDriver ? $assignedDriver->id : 
                           (!$drivers->isEmpty() ? $drivers->random()->id : null);
                
                // Random user for created_by
                $createdBy = !$users->isEmpty() ? $users->random()->id : null;
                
                // Generate receipt number
                $receiptNumber = 'FR-' . $date->format('Ymd') . '-' . 
                               str_pad($vehicle->id, 3, '0', STR_PAD_LEFT) . '-' .
                               str_pad($i + 1, 3, '0', STR_PAD_LEFT);
                
                // Use a valid payment method from ENUM
                $paymentMethod = $paymentMethods[array_rand($paymentMethods)];
                
                // Most commercial vehicles use Diesel
                $fuelType = in_array($vehicleType, ['car', 'sedan']) ? 'Petrol' : 'Diesel';
                
                FuelRecord::create([
                    'vehicle_id' => $vehicle->id,
                    'driver_id' => $driverId,
                    'date' => $date,
                    'quantity' => $quantity,
                    'price_per_liter' => $pricePerLiter,
                    'total_cost' => round($totalCost, 2),
                    'fuel_type' => $fuelType,
                    'odometer_reading' => $currentOdometer,
                    'distance_traveled' => $distanceTraveled,
                    'location' => $locations[array_rand($locations)],
                    'station_name' => $fuelStations[array_rand($fuelStations)],
                    'receipt_number' => $receiptNumber,
                    'payment_method' => $paymentMethod,
                    'notes' => $this->getFuelNote(),
                    'created_by' => $createdBy,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
            
            $this->command->info("Created {$recordCount} fuel records for vehicle {$vehicle->vehicle_number}");
        }
    }

    /**
     * Generate maintenance records for each vehicle
     */
    private function seedMaintenanceRecords($vehicles, $users): void
    {
        // Exact ENUM values from migration
        $maintenanceTypes = ['routine', 'repair', 'inspection', 'tire_change', 'oil_change', 'brake_service', 'other'];
        $statuses = ['scheduled', 'in_progress', 'completed', 'cancelled'];
        
        $serviceProviders = [
            'AutoTech Services', 'FleetCare Pro', 'Mechanix Direct', 'Vehicle Doctors',
            'Roadside Assist', 'Premium Auto Care', 'FastFix Garage', 'Expert Mechanics'
        ];

        foreach ($vehicles as $vehicle) {
            // Each vehicle gets 2-8 maintenance records
            $recordCount = rand(2, 8);
            $lastMaintenanceDate = Carbon::now()->subMonths(rand(6, 18));
            $currentOdometer = rand(50000, 200000);
            
            // Random user for created_by
            $createdBy = !$users->isEmpty() ? $users->random()->id : null;
            
            for ($i = 0; $i < $recordCount; $i++) {
                $date = $lastMaintenanceDate->addDays(rand(30, 180)); // Maintenance every 1-6 months
                $status = $statuses[array_rand($statuses)];
                
                // Generate maintenance number
                $maintenanceNumber = 'MNT-' . $date->format('Ymd') . '-' . 
                                   str_pad($vehicle->id, 3, '0', STR_PAD_LEFT) . '-' .
                                   str_pad($i + 1, 3, '0', STR_PAD_LEFT);
                
                // Get maintenance type
                $type = $maintenanceTypes[array_rand($maintenanceTypes)];
                
                // Generate costs based on vehicle type and maintenance type
                $isTruck = str_contains(strtolower($vehicle->type ?? ''), 'truck');
                $costMultiplier = $this->getCostMultiplier($type, $isTruck);
                
                // Base costs for different vehicle types
                $baseCost = $isTruck ? 5000 : 2500;
                
                $partsCost = $baseCost * $costMultiplier * 0.6; // 60% parts
                $laborCost = $baseCost * $costMultiplier * 0.4; // 40% labor
                $totalCost = $partsCost + $laborCost;
                
                // Increase odometer for each maintenance
                $odometerIncrease = rand(5000, 15000);
                $currentOdometer += $odometerIncrease;
                
                // Calculate next service date and odometer
                if ($status === 'completed') {
                    $nextServiceDate = $date->copy()->addDays(rand(90, 365));
                    $nextServiceOdometer = $currentOdometer + rand(5000, 20000);
                } else {
                    $nextServiceDate = null;
                    $nextServiceOdometer = null;
                }
                
                // Generate invoice number if completed or in progress
                $invoiceNumber = in_array($status, ['completed', 'in_progress']) ? 
                    'INV' . $date->format('Ymd') . str_pad($vehicle->id, 3, '0', STR_PAD_LEFT) . str_pad($i + 1, 2, '0', STR_PAD_LEFT) : null;
                
                MaintenanceRecord::create([
                    'vehicle_id' => $vehicle->id,
                    'maintenance_number' => $maintenanceNumber,
                    'date' => $date,
                    'type' => $type,
                    'service_provider' => $serviceProviders[array_rand($serviceProviders)],
                    'description' => $this->getMaintenanceDescription($type),
                    'odometer_reading' => $currentOdometer,
                    'parts_cost' => round($partsCost, 2),
                    'labor_cost' => round($laborCost, 2),
                    'total_cost' => round($totalCost, 2),
                    'status' => $status,
                    'next_service_date' => $nextServiceDate,
                    'next_service_odometer' => $nextServiceOdometer,
                    'invoice_number' => $invoiceNumber,
                    'notes' => $this->getMaintenanceNote($type),
                    'created_by' => $createdBy,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
            
            $this->command->info("Created {$recordCount} maintenance records for vehicle {$vehicle->vehicle_number}");
        }
    }

    /**
     * Update vehicle maintenance dates based on latest maintenance records
     */
    private function updateVehicleMaintenanceDates($vehicles): void
    {
        foreach ($vehicles as $vehicle) {
            // Get the latest completed maintenance record
            $latestMaintenance = MaintenanceRecord::where('vehicle_id', $vehicle->id)
                ->where('status', 'completed')
                ->latest('date')
                ->first();
            
            if ($latestMaintenance) {
                $vehicle->update([
                    'last_maintenance' => $latestMaintenance->date,
                    'next_maintenance' => $latestMaintenance->next_service_date,
                ]);
                
                $this->command->info("Updated maintenance dates for vehicle {$vehicle->vehicle_number}");
            }
        }
    }

    /**
     * Get fuel note
     */
    private function getFuelNote(): string
    {
        $notes = [
            'Full tank refill',
            'Partial refill during delivery route',
            'Topped up before long trip',
            'Emergency refuel',
            'Scheduled refueling',
            'Refuel after maintenance service',
            'Fleet card transaction',
            'Cash payment',
            'Credit card payment',
            'After-hours refuel',
            'Pre-trip refueling',
            'Post-delivery refuel',
            'Refuel at client site',
            'Weekend refueling',
            'Monthly fuel allocation',
            'Fuel for upcoming delivery',
            'Topped up at highway stop',
            'Refuel during night shift'
        ];
        
        return $notes[array_rand($notes)];
    }

    /**
     * Get maintenance description
     */
    private function getMaintenanceDescription(string $type): string
    {
        $descriptions = [
            'routine' => [
                'Routine vehicle inspection and service',
                'Regular maintenance check',
                'Monthly vehicle service',
                'General vehicle maintenance',
                'Standard service package'
            ],
            'repair' => [
                'Engine repair and diagnostics',
                'Transmission repair',
                'Suspension system repair',
                'Exhaust system replacement',
                'Electrical system repair',
                'Cooling system repair'
            ],
            'inspection' => [
                'Annual roadworthy inspection',
                'Road safety certificate check',
                'Comprehensive vehicle inspection',
                'Pre-trip safety inspection',
                'Fleet compliance inspection'
            ],
            'tire_change' => [
                'Tire replacement and balancing',
                'All four tires replaced',
                'Tire rotation and alignment',
                'Emergency tire change',
                'Seasonal tire change'
            ],
            'oil_change' => [
                'Engine oil and filter change',
                'Full synthetic oil change',
                'Oil change with filter replacement',
                'High-mileage oil change'
            ],
            'brake_service' => [
                'Brake pad replacement',
                'Complete brake system service',
                'Brake disc machining',
                'Brake fluid flush and replacement',
                'Emergency brake repair'
            ],
            'other' => [
                'Vehicle detailing and cleaning',
                'Window tinting',
                'Radio and navigation system installation',
                'Accessory installation',
                'Custom modifications'
            ]
        ];
        
        return $descriptions[$type][array_rand($descriptions[$type])];
    }

    /**
     * Get cost multiplier based on maintenance type and vehicle
     */
    private function getCostMultiplier(string $type, bool $isTruck = false): float
    {
        $baseMultiplier = match($type) {
            'repair' => rand(15, 30) / 10, // 1.5x - 3x
            'brake_service' => rand(12, 25) / 10, // 1.2x - 2.5x
            'tire_change' => rand(10, 20) / 10, // 1x - 2x
            'oil_change' => rand(3, 8) / 10, // 0.3x - 0.8x
            'inspection' => rand(5, 15) / 10, // 0.5x - 1.5x
            'other' => rand(8, 25) / 10, // 0.8x - 2.5x
            default => rand(5, 12) / 10, // 0.5x - 1.2x (routine)
        };
        
        // Trucks cost more to maintain
        if ($isTruck) {
            $baseMultiplier *= 1.5;
        }
        
        return $baseMultiplier;
    }

    /**
     * Get maintenance note
     */
    private function getMaintenanceNote(string $type): string
    {
        $notes = [
            'routine' => 'Routine maintenance completed as per schedule. All systems checked and operational.',
            'repair' => 'Repair work completed successfully. Parts replaced as needed. Vehicle back in service.',
            'inspection' => 'Inspection completed. Vehicle passed all safety checks. Certificate provided.',
            'tire_change' => 'Tires changed and balanced. Wheel alignment checked and adjusted.',
            'oil_change' => 'Oil and filter changed. Fluid levels checked and topped up.',
            'brake_service' => 'Brake system serviced. New pads installed. System tested and operational.',
            'other' => 'Service completed as requested. Customer satisfied with work done.'
        ];
        
        return $notes[$type] ?? 'Maintenance service completed successfully.';
    }
}