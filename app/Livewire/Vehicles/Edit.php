<?php

namespace App\Livewire\Vehicles;

use App\Models\Vehicle;
use Livewire\Component;

class Edit extends Component
{
    public Vehicle $vehicle;

    // Form fields
    public $vehicle_number = '';
    public $type = '';
    public $make = '';
    public $model = '';
    public $year = '';
    public $license_plate = '';
    public $capacity = '';
    public $status = '';
    public $notes = '';
    public $last_maintenance = '';
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

    // Mount -  load vehicle data 
    public function mount(Vehicle $vehicle)
    {
         $this->vehicle = $vehicle;
        
        // Populate form fields
        $this->vehicle_number = $vehicle->vehicle_number;
        $this->type = $vehicle->type;
        $this->make = $vehicle->make;
        $this->model = $vehicle->model;
        $this->year = $vehicle->year;
        $this->license_plate = $vehicle->license_plate;
        $this->capacity = $vehicle->capacity;
        $this->status = $vehicle->status;
        $this->notes = $vehicle->notes;
        $this->last_maintenance = $vehicle->last_maintenance?->format('Y-m-d');
        $this->next_maintenance = $vehicle->next_maintenance?->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.vehicles.edit');
    }
}
