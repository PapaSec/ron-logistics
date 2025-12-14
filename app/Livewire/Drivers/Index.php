<?php

namespace App\Livewire\Drivers;

use App\Models\Driver;
use Livewire\{Component, WithPagination};
use Livewire\Attributes\{Layout, Title, Url};

#[Layout('layouts.app')]
#[Title('Drivers - Ron Logistics')]
class Index extends Component
{
    use WithPagination;

    // Public Properties
    #[Url(as: 's')]
    public $search = '';

    #[Url(as: 'status')]
    public $statusFilter = 'all';

    #[Url(as: 'type')]
    public $employmentFilter = 'all';

    public $perPage = 10;

    // For delete confirmation
    public $deleteId = null;

    // Reset pagination when search changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingEmploymentFilter()
    {
        $this->resetPage();
    }

    // Clear all filters
    public function clearFilters()
    {
        $this->reset(['search', 'statusFilter', 'employmentFilter']);
        $this->resetPage();
        session()->flash('success', 'Filters cleared successfully!');
    }

    // Confirm delete
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    // Cancel delete
    public function cancelDelete()
    {
        $this->deleteId = null;
    }

    // Delete driver
    public function delete()
    {
        try {
            $driver = Driver::findOrFail($this->deleteId);
            $driverName = $driver->full_name;

            // Check if driver has assigned vehicles
            if ($driver->vehicles()->exists()) {
                session()->flash('error', 'Cannot delete driver with assigned vehicles!');
                $this->deleteId = null;
                return;
            }

            $driver->delete();
            $this->deleteId = null;

            session()->flash('success', "Driver {$driverName} deleted successfully!");
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete driver. Please try again.');
        }
    }

    // Get drivers with filters
    public function getDriversProperty()
    {
        return Driver::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('driver_number', 'LIKE', "%{$this->search}%")
                        ->orWhere('first_name', 'LIKE', "%{$this->search}%")
                        ->orWhere('last_name', 'LIKE', "%{$this->search}%")
                        ->orWhere('email', 'LIKE', "%{$this->search}%")
                        ->orWhere('phone', 'LIKE', "%{$this->search}%")
                        ->orWhere('license_number', 'LIKE', "%{$this->search}%");
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->employmentFilter !== 'all', function ($query) {
                $query->where('employment_type', $this->employmentFilter);
            })
            ->latest()
            ->paginate($this->perPage);
    }

    // Get statistics
    public function getStatsProperty()
    {
        $query = Driver::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('driver_number', 'LIKE', "%{$this->search}%")
                    ->orWhere('first_name', 'LIKE', "%{$this->search}%")
                    ->orWhere('last_name', 'LIKE', "%{$this->search}%")
                    ->orWhere('email', 'LIKE', "%{$this->search}%")
                    ->orWhere('phone', 'LIKE', "%{$this->search}%");
            });
        }

        return [
            'total' => $query->count(),
            'active' => (clone $query)->where('status', 'active')->count(),
            'on_leave' => (clone $query)->where('status', 'on_leave')->count(),
            'inactive' => (clone $query)->where('status', 'inactive')->count(),
            'license_expiring' => Driver::whereDate('license_expiry', '<=', now()->addDays(30))->count(),
        ];
    }

    public function render()
    {
        return view('livewire.drivers.index', [
            'drivers' => $this->drivers,
            'stats' => $this->stats,
        ]);
    }
}