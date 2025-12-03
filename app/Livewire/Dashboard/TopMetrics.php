<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class TopMetrics extends Component
{
    public $stats;
    public $weeklyData;

    public function mount($stats, $weeklyData)
    {
        $this->stats = $stats;
        $this->weeklyData = $weeklyData;
    }

    public function render()
    {
        return view('livewire.dashboard.top-metrics');
    }
}