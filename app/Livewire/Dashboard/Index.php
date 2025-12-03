<?php

namespace App\Livewire\Dashboard;

use App\Models\Shipment;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Dashboard - Ron Logistics')]
class Index extends Component
{

    public function getStatsProperty()
    {
        return [
            'total_shipments' => Shipment::count(),
            'pending_shipments' => Shipment::where('status', 'pending')->count(),
        ]
    }
    public function render()
    {
        return view('livewire.dashboard.index');
    }
}