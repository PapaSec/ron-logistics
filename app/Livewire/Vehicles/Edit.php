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

    

    public function render()
    {
        return view('livewire.vehicles.edit');
    }
}
