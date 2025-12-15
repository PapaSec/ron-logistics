<?php

namespace App\Livewire\FuelMaintenance;

use App\Models\MaintenanceRecord;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Maintenance Record Details - Ron Logistics')]
class ShowMaintenance extends Component
{
    public MaintenanceRecord $maintenanceRecord;

    public function mount(MaintenanceRecord $maintenanceRecord)
    {
        $this->maintenanceRecord = $maintenanceRecord->load('vehicle');
    }

    public function render()
    {
        return view('livewire.fuel-maintenance.show-maintenance');
    }
}