<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class ShipmentTrends extends Component
{
    public $chartDataMonthly;
    public $chartDataYearly;

    public function mount($chartDataMonthly, $chartDataYearly)
    {
        $this->chartDataMonthly = $chartDataMonthly;
        $this->chartDataYearly = $chartDataYearly;
    }

    public function render()
    {
        return view('livewire.dashboard.shipment-trends');
    }
}