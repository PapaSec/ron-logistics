<?php

namespace App\Livewire\Vehicles;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title, Validate};

#[Layout('layouts.app')]
#[Title('Add New Vehicle - Ron Logistics')]
class Create extends Component
{
    // Form fields
    #[Validate('required|string|max:255|unique:vehicles,vehicle_number')]
    public $vehicle_number = '';

    #[Validate('required|string|max:255')]
    public $type = '';

    #[Validate('nullable|string|max:255')]
    public $make = '';

    #[Validate('nullable|string|max:255')]
    public $model = '';

    #[Validate('nullable|integer|min:1900|max:2100')]
    public $year = '';

    #[Validate('required|string|max:255|unique:vehicles,license_plate')]
    public $license_plate = '';

    #[Validate('nullable|numeric|min:0')]
    public $capacity = '';

    #[Validate('required|in:available,in_use,maintenance,out_of_service')]
    public $status = 'available';

    #[Validate('nullable|string')]
    public $notes = '';

    #[Validate('nullable|date')]
    public $last_maintenance = '';

    #[Validate('nullable|date|after_or_equal:last_maintenance')]
    public $next_maintenance = '';

    // Common vehicle types for dropdown
    public function getVehicleTypesProperty()
    {
        return [
            'Truck' => 'Truck',
            'Van' => 'Van',
            'Pickup' => 'Pickup',
            'Semi-Trailer' => 'Semi-Trailer',
            'Box Truck' => 'Box Truck',
            'Flatbed' => 'Flatbed',
            'Refrigerated' => 'Refrigerated',
            'Other' => 'Other',
        ];
    }

    // Generate next vehicle number
    public function generateVehicleNumber()
    {
        $lastVehicle = Vehicle::latest('id')->first();
        
        if (!$lastVehicle) {
            $this->vehicle_number = 'VEH-001';
        } else {
            // Extract number from last vehicle (e.g., VEH-001 -> 001)
            preg_match('/(\d+)$/', $lastVehicle->vehicle_number, $matches);
            $lastNumber = isset($matches[1]) ? intval($matches[1]) : 0;
            $newNumber = $lastNumber + 1;
            $this->vehicle_number = 'VEH-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        }
    }

    // Mount - Initialize component
    public function mount()
    {
        $this->generateVehicleNumber();
    }

    // Save vehicle
    public function save()
    {
        $validated = $this->validate();

        try {
            // Create vehicle
            $vehicle = Vehicle::create($validated);

            session()->flash('success', "Vehicle {$vehicle->vehicle_number} created successfully!");

            // Temporarily redirect to index until Show component is created
            return $this->redirect(route('vehicles.index'), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create vehicle. Please try again.');
        }
    }

    // Cancel and go back
    public function cancel()
    {
        return $this->redirect(route('vehicles.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.vehicles.create', [
            'vehicleTypes' => $this->vehicleTypes,
        ]);
    }
}