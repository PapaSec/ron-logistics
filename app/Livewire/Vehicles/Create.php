<?php

namespace App\Livewire\Vehicles;

use Livewire\Component;

class Create extends Component
{
    // FORM PROPERTIES
    public $vehicle_number = '';
    public $type = '';
    public $make = '';
    public $model = '';
    public $year = '';
    public $license_plate = '';
    public $capacity = '';
    public $status = 'available';
    public $last_maintenance;
    public $next_maintenance;
    public $notes = '';

    // VALIDATION RULES
    protected $rules = [
        
    ];
    
    // Handle form submission
    public function submit()
    {
        $this->validate();
        \App\Models\Vehicle::create([
            'vehicle_number' => $this->vehicle_number,
            'type' => $this->type,
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'license_plate' => $this->license_plate,
            'capacity' => $this->capacity,
            'status' => $this->status,
            'last_maintenance' => $this->last_maintenance,
            'next_maintenance' => $this->next_maintenance,
            'notes' => $this->notes,
        ]);
        session()->flash('success', 'Vehicle created successfully.');
        return redirect()->route('vehicles.index');
    }

    // Render method
    public function render()
    {
        return view('livewire.vehicles.create');
    }
}
