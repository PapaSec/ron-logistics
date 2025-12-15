<?php

namespace App\Livewire\FuelMaintenance;

use App\Models\{FuelRecord, MaintenanceRecord, Vehicle};
use Livewire\{Component, WithPagination};
use Livewire\Attributes\{Layout, Title, Url};

#[Layout('layouts.app')]
#[Title('Fuel & Maintenance - Ron Logistics')]

class Index extends Component
{
    use WithPagination;

    // Active Tab
    public $activeTab = ''; // Fuel or Maintenance

    // Filters
    #[Url(as: 's')]
    public $search = '';

    #[Url(as: 'vehicle')]
    public $vehicleFilter = 'all';

    public $dateFrom = '';
    public $dateTo = '';

    public $perPage = 10;

    // Reset pagination when filters change
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingVehicleFilter()
    {
        $this->resetPage();
    }

    public function updatingDateFrom()
    {
        $this->resetPage();
    }

    public function updatingDateTo()
    {
        $this->resetPage();
    }

    // Switch tabs
    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    // Clear filters
    public function clearFilters()
    {
        $this->reset(['search', 'vehicleFilter', 'dateFrom', 'dateTo']);
        $this->resetPage();
        session()->flash('success', 'Filters cleared successfully!');
    }

    // Get fuel records
    public function getFuelRecordsProperty()
    {
        return FuelRecord::query()
            ->with(['vehicle', 'driver'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('receipt_number', 'LIKE', "%{$this->search}%")
                        ->orWhere('location', 'LIKE', "%{$this->search}%")
                        ->orWhere('station_name', 'LIKE', "%{$this->search}%")
                        ->orWhereHas('vehicle', function ($q) {
                            $q->where('vehicle_number', 'LIKE', "%{$this->search}%");
                        });
                });
            })
            ->when($this->vehicleFilter !== 'all', function ($query) {
                $query->where('vehicle_id', $this->vehicleFilter);
            })
            ->when($this->dateFrom, function ($query) {
                $query->whereDate('date', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function ($query) {
                $query->whereDate('date', '<=', $this->dateTo);
            })
            ->latest('date')
            ->paginate($this->perPage);
    }

    // Get maintenance records
    public function getMaintenanceRecordsProperty()
    {
        return MaintenanceRecord::query()
            ->with('vehicle')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('maintenance_number', 'LIKE', "%{$this->search}%")
                        ->orWhere('description', 'LIKE', "%{$this->search}%")
                        ->orWhere('service_provider', 'LIKE', "%{$this->search}%")
                        ->orWhereHas('vehicle', function ($q) {
                            $q->where('vehicle_number', 'LIKE', "%{$this->search}%");
                        });
                });
            })
            ->when($this->vehicleFilter !== 'all', function ($query) {
                $query->where('vehicle_id', $this->vehicleFilter);
            })
            ->when($this->dateFrom, function ($query) {
                $query->whereDate('date', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function ($query) {
                $query->whereDate('date', '<=', $this->dateTo);
            })
            ->latest('date')
            ->paginate($this->perPage);
    }

    // Get all vehicles for filter
    public function getVehiclesProperty()
    {
        return Vehicle::orderBy('vehicle_number')->get();
    }

    // Get statistics
    public function getStatsProperty()
    {
        $fuelQuery = FuelRecord::query();
        $maintenanceQuery = MaintenanceRecord::query();

        // Apply vehicle filter to stats
        if ($this->vehicleFilter !== 'all') {
            $fuelQuery->where('vehicle_id', $this->vehicleFilter);
            $maintenanceQuery->where('vehicle_id', $this->vehicleFilter);
        }

        // Apply date filters
        if ($this->dateFrom) {
            $fuelQuery->whereDate('date', '>=', $this->dateFrom);
            $maintenanceQuery->whereDate('date', '>=', $this->dateFrom);
        }
        if ($this->dateTo) {
            $fuelQuery->whereDate('date', '<=', $this->dateTo);
            $maintenanceQuery->whereDate('date', '<=', $this->dateTo);
        }

        return [
            'total_fuel_cost' => $fuelQuery->sum('total_cost'),
            'total_fuel_quantity' => $fuelQuery->sum('quantity'),
            'total_maintenance_cost' => $maintenanceQuery->sum('total_cost'),
            'maintenance_count' => $maintenanceQuery->count(),
            'overdue_maintenance' => MaintenanceRecord::where('next_service_date', '<', now())->count(),
        ];
    }

    public function render()
    {
        return view('livewire.fuel-maintenance.index', [
            'fuelRecords' => $this->activeTab === 'fuel' ? $this->fuelRecords : collect(),
            'maintenanceRecords' => $this->activeTab === 'maintenance' ? $this->maintenanceRecords : collect(),
            'vehicles' => $this->vehicles,
            'stats' => $this->stats,
        ]);
    }
}
