<?php

namespace App\Livewire\Dashboard;

use App\Models\Shipment;
use Livewire\Component;

class RecentActivity extends Component
{
    public $recentShipments;

    public function mount()
    {
        $this->recentShipments = Shipment::latest()->take(5)->get();
    }

    public function render()
    {
        return view('livewire.dashboard.recent-activity');
    }
}