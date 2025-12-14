<?php

namespace App\Livewire\Drivers;

use App\Models\Driver;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Driver Details - Ron Logistics')]

class Show extends Component
{
    public function render()
    {
        return view('livewire.drivers.show');
    }
}
