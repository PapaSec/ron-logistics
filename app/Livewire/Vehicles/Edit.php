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

    // Validation rules
    protected function rules()
    {
        return [
            'vehicle_number' => 'required|string|max:255|unique:vehicles,vehicle_number,' . $this->vehicle->id,
            'type' => 'required|string|max:255',
            'make' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:2100',
            'license_plate' => 'required|string|max:255|unique:vehicles,license_plate,' . $this->vehicle->id,
            'capacity' => 'nullable|numeric|min:0',
            'status' => 'required|in:available,in_use,maintenance,out_of_service',
            'notes' => 'nullable|string',
            'last_maintenance' => 'nullable|date',
            'next_maintenance' => 'nullable|date|after_or_equal:last_maintenance',
        ];
    }

    // Update vehicle
    public function update()
    {
        $validated = $this->validate();

        try {
            // Update vehicle
            $this->vehicle->update($validated);

            session()->flash('success', "Vehicle {$this->vehicle->vehicle_number} updated successfully!");

            return $this->redirect(route('vehicles.index'), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update vehicle. Please try again.');
        }
    }

    // Cancel and go back
    public function cancel()
    {
        return $this->redirect(route('vehicles.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.vehicles.edit', [
            'vehicleTypes' => $this->vehicleTypes,
        ]);
    }
}
