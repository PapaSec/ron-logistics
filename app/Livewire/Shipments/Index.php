<?php

namespace App\Livewire\Shipments;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Dashboard - Ron Logistics')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.shipments.index');
    }
}
