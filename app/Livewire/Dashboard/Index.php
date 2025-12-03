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
        'in_transit' => Shipment::where('status', 'in_transit')->count(),
        'delivered' => Shipment::where('status', 'delivered')->count(),
        'cancelled' => Shipment::where('status', 'cancelled')->count(),
        
        // Calculate on-time delivery rate (dummy logic for now)
        'on_time_rate' => 95.2,
        
        // Active vehicles (dummy - we'll add real data later)
        'active_vehicles' => 12,
        
        // Monthly revenue (dummy - we'll add real billing later)
        'monthly_revenue' => 45280.50,
    ];
}
    public function render()
    {
        return view('livewire.dashboard.index');
    }
}