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
            'total' => Shipment::count(),
            'pending' => Shipment::where('status', 'pending')->count(),
            'in_transit' => Shipment::where('status', 'in_transit')->count(),
            'delivered' => Shipment::where('status', 'delivered')->count(),
            'cancelled' => Shipment::where('status', 'cancelled')->count(),
            
            // Priority counts
            'express' => Shipment::where('priority', 'express')->count(),
            'standard' => Shipment::where('priority', 'standard')->count(),
            'economy' => Shipment::where('priority', 'economy')->count(),
            
            'on_time_rate' => 95.2,
            'active_vehicles' => 12,
            'monthly_revenue' => 45280.50,
        ];
    }
    
    // Weekly data for mini charts
    public function getWeeklyDataProperty()
    {
        return [20, 40, 35, 50, 49, 60, 70, 81];
    }
    
    // Monthly data for main chart
    public function getMonthlyDataProperty()
    {
        // Get shipments per month for the last 6 months
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = Shipment::whereYear('created_at', $date->year)
                            ->whereMonth('created_at', $date->month)
                            ->count();
            
            $months[] = [
                'month' => $date->format('M'),
                'count' => $count
            ];
        }
        
        return $months;
    }
    
    public function render()
    {
        return view('livewire.dashboard.index', [
            'stats' => $this->stats,
            'weeklyData' => $this->weeklyData,
            'monthlyData' => $this->monthlyData,
        ]);
    }
}