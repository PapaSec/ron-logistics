<?php

namespace App\Livewire\Vehicles;

use App\Models\Vehicle;
use Livewire\{Component, WithPagination};
use Livewire\Attributes\{Layout, Title, Url};

use function Symfony\Component\String\s;

#[Layout('layouts.app')]
#[Title('Vehicles - Ron Logistics')]
class Index extends Component
{
    use WithPagination;

    // Public Properties
    #[Url(as: 's')]
    public $search = '';

    #[Url(as: 'status')]
    public $statusFilter = 'all';

    #[Url(as: 'type')]
    public $typeFilter = 'all';

    public $perPage = 10;

    // For delete confirmation
    public $deleteId = null;

    // Reset pagination when search changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Reset pagination when status filter changes
    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    // Reset pagination when type filter changes
    public function updatingTypeFilter()
    {
        $this->resetPage();
    }

    // Clear all filters and reset to defaults
    public function clearFilters()
    {
        $this->reset(['search', 'statusFilter', 'typeFilter']);
        $this->resetPage();

        session()->flash('success', 'Filters cleared successfully!');
    }

    // Confirm delete - stores the ID
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    // Cancel delete - clears the stored ID
    public function cancelDelete()
    {
        $this->deleteId = null;
    }

    // Delete vehicle
    public function delete()
    {
        try {
            $vehicle = Vehicle::findOrFail($this->deleteId);
            $vehicleNumber = $vehicle->vehicle_number;

            // Check if vehicle has active shipments
            if ($vehicle->shipments()->whereIn('status', ['pending', 'in_transit'])->exists()) {
                session()->flash('error', 'Cannot delete vehicle with active shipments!');
                $this->deleteId = null;
                return;
            }

            $vehicle->delete();

            $this->deleteId = null;

            session()->flash('success', "Vehicle {$vehicleNumber} deleted successfully!");
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete vehicle. Please try again.');
        }
    }

    // Get vehicles with filters applied
    public function getVehiclesProperty()
    {
        return Vehicle::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('vehicle_number', 'LIKE', "%{$this->search}%")
                        ->orWhere('license_plate', 'LIKE', "%{$this->search}%")
                        ->orWhere('make', 'LIKE', "%{$this->search}%")
                        ->orWhere('model', 'LIKE', "%{$this->search}%");
                });

            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->typeFilter !== 'all', function ($query) {
                $query->where('type', $this->typeFilter);
            })
            ->latest()
            ->paginate($this->perPage);
    }

    // Get statistics for dashboard cards
    public function getStatsProperty()
    {
        $query = Vehicle::query();

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('vehicle_number', 'LIKE', "%{$this->search}%")
                    ->orWhere('license_plate', 'LIKE', "%{$this->search}%")
                    ->orWhere('make', 'LIKE', "%{$this->search}%")
                    ->orWhere('model', 'LIKE', "%{$this->search}%");
            });
        }

        return [
            'total' => $query->count(),
            'available' => (clone $query)->where('status', 'available')->count(),
            'in_use' => (clone $query)->where('status', 'in_use')->count(),
            'maintenance' => (clone $query)->where('status', 'maintenance')->count(),
            'out_of_service' => (clone $query)->where('status', 'out_of_service')->count(),
            'total_capacity' => $query->sum('capacity'), // Total kg capacity
            'needs_maintenance' => Vehicle::whereNotNull('next_maintenance')
                ->whereDate('next_maintenance', '<=', now()->addDays(30))
                ->count(), // Vehicles needing maintenance in next 30 days
        ];
    }

    // Get vehicle types for filter dropdown
    public function getVehicleTypesProperty()
    {
        return Vehicle::distinct()->pluck('type')->sort()->values();
    }

    // Render the component
    public function render()
    {
        return view('livewire.vehicles.index', [
            'vehicles' => $this->vehicles,
            'stats' => $this->stats,
            'vehicleTypes' => $this->vehicleTypes,

        ]);
    }
}
