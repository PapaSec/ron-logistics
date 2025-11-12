<?php

namespace App\Livewire\Shipments;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Shipment Details - Ron Logistics')]

class Show extends Component
{
    public function render()
    {
        return view('livewire.shipments.show');
    }
}
