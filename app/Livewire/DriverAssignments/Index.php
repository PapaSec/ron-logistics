<?php

namespace App\Livewire\DriverAssignments;

use App\Models\{Driver, Vehicle};
use Livewire\{Component, WithPagination};
use Livewire\Attributes\{Layout, Title, Url};

#[Layout('layouts.app')]
#[Title('Driver Assignments - Ron Logistics')]
class Index extends Component
{
    use WithPagination;

    // Filters
    #[Url(as: 's')]
    public $search = '';

    #[Url(as: 'status')]
    public $statusFilter = 'all';

    public $perPage = 10;

    // Assignment modal
    public $showAssignModal = false;
    public $selectedVehicleId = null;
    public $selectedDriverId = null;

    // Unassign confirmation
    public $showUnassignModal = false;
    public $unassignVehicleId = null;

    // Reset pagination when search changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    // Clear filters
    public function clearFilters()
    {
        $this->reset(['search', 'statusFilter']);
        $this->resetPage();
        session()->flash('success', 'Filters cleared successfully!');
    }

    // Open assign modal
    public function openAssignModal($vehicleId)
    {
        $this->selectedVehicleId = $vehicleId;
        $this->selectedDriverId = null;
        
        $vehicle = Vehicle::find($vehicleId);
        if ($vehicle && $vehicle->driver_id) {
            $this->selectedDriverId = $vehicle->driver_id;
        }
        
        $this->showAssignModal = true;
    }

    // Close assign modal
    public function closeAssignModal()
    {
        $this->showAssignModal = false;
        $this->selectedVehicleId = null;
        $this->selectedDriverId = null;
    }

    // Assign driver to vehicle
    public function assignDriver()
    {
        $this->validate([
            'selectedDriverId' => 'required|exists:drivers,id',
        ]);

        try {
            $vehicle = Vehicle::findOrFail($this->selectedVehicleId);
            $driver = Driver::findOrFail($this->selectedDriverId);

            // Check if driver is active
            if ($driver->status !== 'active') {
                session()->flash('error', 'Cannot assign inactive driver!');
                return;
            }

            $vehicle->update(['driver_id' => $this->selectedDriverId]);

            session()->flash('success', "Driver {$driver->full_name} assigned to vehicle {$vehicle->vehicle_number} successfully!");
            
            $this->closeAssignModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to assign driver. Please try again.');
        }
    }

    // Open unassign modal
    public function openUnassignModal($vehicleId)
    {
        $this->unassignVehicleId = $vehicleId;
        $this->showUnassignModal = true;
    }

    // Close unassign modal
    public function closeUnassignModal()
    {
        $this->showUnassignModal = false;
        $this->unassignVehicleId = null;
    }

    // Unassign driver from vehicle
    public function unassignDriver()
    {
        try {
            $vehicle = Vehicle::findOrFail($this->unassignVehicleId);
            
            if (!$vehicle->driver_id) {
                session()->flash('error', 'No driver assigned to this vehicle!');
                return;
            }

            $driverName = $vehicle->driver->full_name ?? 'Driver';
            $vehicle->update(['driver_id' => null]);

            session()->flash('success', "{$driverName} unassigned from vehicle {$vehicle->vehicle_number} successfully!");
            
            $this->closeUnassignModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to unassign driver. Please try again.');
        }
    }

    // Get vehicles with filters
    public function getVehiclesProperty()
    {
        return Vehicle::query()
            ->with('driver')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('vehicle_number', 'LIKE', "%{$this->search}%")
                        ->orWhere('license_plate', 'LIKE', "%{$this->search}%")
                        ->orWhere('make', 'LIKE', "%{$this->search}%")
                        ->orWhere('model', 'LIKE', "%{$this->search}%")
                        ->orWhereHas('driver', function ($q) {
                            $q->where('first_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('last_name', 'LIKE', "%{$this->search}%")
                                ->orWhere('driver_number', 'LIKE', "%{$this->search}%");
                        });
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                if ($this->statusFilter === 'assigned') {
                    $query->whereNotNull('driver_id');
                } else if ($this->statusFilter === 'unassigned') {
                    $query->whereNull('driver_id');
                }
            })
            ->latest()
            ->paginate($this->perPage);
    }

    // Get available drivers for assignment
    public function getAvailableDriversProperty()
    {
        return Driver::where('status', 'active')
            ->orderBy('first_name')
            ->get();
    }

    // Get statistics
    public function getStatsProperty()
    {
        return [
            'total_vehicles' => Vehicle::count(),
            'assigned' => Vehicle::whereNotNull('driver_id')->count(),
            'unassigned' => Vehicle::whereNull('driver_id')->count(),
            'active_drivers' => Driver::where('status', 'active')->count(),
        ];
    }

    public function render()
    {
        return view('livewire.driver-assignments.index', [
            'vehicles' => $this->vehicles,
            'availableDrivers' => $this->availableDrivers,
            'stats' => $this->stats,
        ]);
    }
}