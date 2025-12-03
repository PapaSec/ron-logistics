<?php

namespace App\Livewire\Dashboard;

use App\Models\Shipment;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Dashboard - Ron Logistics')]
class Index extends Component
{
    // Method 1: Using a computed property
    public function getStatsProperty()
    {
        return [
            'total' => Shipment::count(),
            'pending' => Shipment::where('status', 'pending')->count(),
            'in_transit' => Shipment::where('status', 'in_transit')->count(),
            'delivered' => Shipment::where('status', 'delivered')->count(),
            'cancelled' => Shipment::where('status', 'cancelled')->count(),
            
            // Dummy data for now (we'll make these real later)
            'on_time_rate' => 95.2,
            'active_vehicles' => 12,
            'monthly_revenue' => 45280.50,
        ];
    }
    
    // Method 2: Or use a regular method
    public function getStatusBreakdown()
    {
        return [
            'pending' => Shipment::where('status', 'pending')->count(),
            'in_transit' => Shipment::where('status', 'in_transit')->count(),
            'delivered' => Shipment::where('status', 'delivered')->count(),
            'cancelled' => Shipment::where('status', 'cancelled')->count(),
        ];
    }
    
    public function getPriorityDistribution()
    {
        return [
            'express' => Shipment::where('priority', 'express')->count(),
            'standard' => Shipment::where('priority', 'standard')->count(),
            'economy' => Shipment::where('priority', 'economy')->count(),
        ];
    }
    
    public function render()
    {
        return view('livewire.dashboard.index', [
            'stats' => $this->stats, // Use the computed property
            'status_breakdown' => $this->getStatusBreakdown(),
            'priority_distribution' => $this->getPriorityDistribution(),
        ]);
    }
}