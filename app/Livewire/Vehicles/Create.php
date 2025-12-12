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
        'vehicle_number' => 'required|string|unique:vehicles,vehicle_number|max:50',
        'type' => 'required|string|max:100',
        'make' => 'required|string|max:100',
        'model' => 'required|string|max:100',
        'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        'license_plate' => 'required|string|unique:vehicles,license_plate|max:20',
        'capacity' => 'required|numeric|min:0',
        'status' => 'required|in:available,in_use,maintenance,out_of_service',
        'last_maintenance' => 'nullable|date',
        'next_maintenance' => 'nullable|date|after:last_maintenance',
        'notes' => 'nullable|string',
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
