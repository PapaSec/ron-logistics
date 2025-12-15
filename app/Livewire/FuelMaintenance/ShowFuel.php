<?php

namespace App\Livewire\FuelMaintenance;

use App\Models\FuelRecord;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Fuel Record Details - Ron Logistics')]
class ShowFuel extends Component
{
    public FuelRecord $fuelRecord;

    public function mount(FuelRecord $fuelRecord)
    {
        $this->fuelRecord = $fuelRecord->load(['vehicle', 'driver']);
    }

    public function render()
    {
        return view('livewire.fuel-maintenance.show-fuel');
    }
}