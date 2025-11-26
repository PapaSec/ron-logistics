<?php

namespace App\Livewire\Shipments;

use App\Models\Shipment;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Shipment Details - Ron Logistics')]

class Show extends Component
{
    // Shipment Model Instance
    public Shipment $shipment;
    
    public function mount(Shipment $shipment)
    {
        $this->shipment = $shipment;
    }
    
    public function render()
    {
        return view('livewire.shipments.show', [
            'shipment' => $this->shipment
        ]);
    }
}