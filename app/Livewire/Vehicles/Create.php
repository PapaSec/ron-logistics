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

    // CUSTOM VALIDATION MESSAGES
    protected $messages = [
        'vehicle_number.required' => 'Vehicle number is required',
        'vehicle_number.unique' => 'This vehicle number is already taken',
        'license_plate.required' => 'License plate is required',
        'license_plate.unique' => 'This license plate is already taken',
        'next_maintenance.after' => 'Next maintenance date must be after last maintenance date',
    ];

    

    public function render()
    {
        return view('livewire.vehicles.create');
    }
}
