<?php

namespace App\Livewire\Shipments;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Edit Shipment - Ron Logistics')]

class Edit extends Component
{
    public function render()
    {
        return view('livewire.shipments.edit');
    }
}
