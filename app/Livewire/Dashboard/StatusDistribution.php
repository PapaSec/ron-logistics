<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class StatusDistribution extends Component
{
    public $stats;

    public function mount($stats)
    {
        $this->stats = $stats;
    }

    public function render()
    {
        return view('livewire.dashboard.status-distribution');
    }
}