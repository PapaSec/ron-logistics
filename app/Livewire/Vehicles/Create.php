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

    
    public function render()
    {
        return view('livewire.vehicles.create');
    }
}
