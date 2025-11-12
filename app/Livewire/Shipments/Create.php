<?php

namespace App\Livewire\Shipments;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Create Shipment - Ron Logistics')]

class Create extends Component
{
    public function render()
    {
        return view('livewire.shipments.create');
    }
}
