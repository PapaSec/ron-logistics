<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class TopMetrics extends Component
{
    public $stats;
    public $weeklyData;
    public $weeklyFuelData; 

    public function mount($stats, $weeklyData, $weeklyFuelData = [])
    {
        $this->stats = $stats;
        $this->weeklyData = $weeklyData;
        $this->weeklyFuelData = $weeklyFuelData;
    }

    public function render()
    {
        return view('livewire.dashboard.top-metrics');
    }
}