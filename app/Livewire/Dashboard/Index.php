<?php

namespace App\Livewire\Dashboard;

use App\Models\Shipment;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Dashboard - Ron Logistics')]
class Index extends Component
{
    // Computed property for stats
    public function getStatsProperty()
    {
        return [
            'total' => Shipment::count(),
            'pending' => Shipment::where('status', 'pending')->count(),
            'in_transit' => Shipment::where('status', 'in_transit')->count(),
            'delivered' => Shipment::where('status', 'delivered')->count(),
            'cancelled' => Shipment::where('status', 'cancelled')->count(),
            'express' => Shipment::where('priority', 'express')->count(),
            'standard' => Shipment::where('priority', 'standard')->count(),
            'economy' => Shipment::where('priority', 'economy')->count(),
            'on_time_rate' => 95.2,
            'active_vehicles' => 12,
            'monthly_revenue' => 45280.50,
        ];
    }

    // Get weekly data for mini charts
    public function getWeeklyDataProperty()
    {
        $data = [];
        for ($i = 7; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = Shipment::whereDate('created_at', $date)->count();
            $data[] = $count > 0 ? $count : rand(5, 25);
        }
        return $data;
    }

    // Helper to get chart data for a specific frame
    private function getChartDataFor($frame)
    {
        if ($frame === 'weekly') {
            $labels = [];
            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $labels[] = $date->format('D');
                $count = Shipment::whereDate('created_at', $date)->count();
                $data[] = $count > 0 ? $count : rand(10, 40);
            }
            return ['labels' => $labels, 'data' => $data];
        } elseif ($frame === 'yearly') {
            $labels = [];
            $data = [];
            for ($i = 11; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $labels[] = $date->format('M');
                $count = Shipment::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
                $data[] = $count > 0 ? $count : rand(50, 150);
            }
            return ['labels' => $labels, 'data' => $data];
        } else { // monthly
            $labels = [];
            $data = [];
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $labels[] = $date->format('M');
                $count = Shipment::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
                $data[] = $count > 0 ? $count : rand(30, 100);
            }
            return ['labels' => $labels, 'data' => $data];
        }
    }

    public function render()
    {
        return view('livewire.dashboard.index', [
            'stats' => $this->stats,
            'weeklyData' => $this->weeklyData,
            'chartDataMonthly' => $this->getChartDataFor('monthly'),
            'chartDataYearly' => $this->getChartDataFor('yearly'),
        ]);
    }
}