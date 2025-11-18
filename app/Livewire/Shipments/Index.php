<?php

namespace App\Livewire\Shipments;

use App\Models\Shipment;
use Livewire\{Component, WithPagination};
use Livewire\Attributes\{Layout, Title, Url};

#[Layout('layouts.app')]
#[Title('Shipments - Ron Logistics')]
class Index extends Component
{
    use WithPagination;

    // Public Properties
    #[Url(as: 's')]
    public $search = '';

    #[Url(as: 'status')]
    public $statusFilter = 'all';

    #[Url(as: 'priority')]
    public $priorityFilter = 'all';

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

    // Reset pagination when priority filter changes
    public function updatingPriorityFilter()
    {
        $this->resetPage();
    }

    // Clear all filters and reset to defaults
    public function clearFilters()
    {
        $this->reset(['search', 'statusFilter', 'priorityFilter']);
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

    // Delete shipment

    public function delete()
    {
        try {
            $shipment = Shipment::findOrFail($this->deleteId);
            $trackingNumber = $shipment->tracking_number;

            $shipment->delete();

            $this->deleteId = null;

            session()->flash('success', "Shipment {$trackingNumber} deleted successfully!");
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete shipment. Please try again.');
        }
    }

    // Get shipments with filters applied
    public function getShipmentsProperty()
    {
        return Shipment::query()
            ->with('user:id,name') // Eager load user relationship
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('tracking_number', 'LIKE', "%{$this->search}%")
                        ->orWhere('sender_name', 'LIKE', "%{$this->search}%")
                        ->orWhere('receiver_name', 'LIKE', "%{$this->search}%")
                        ->orWhere('origin_city', 'LIKE', "%{$this->search}%")
                        ->orWhere('destination_city', 'LIKE', "%{$this->search}%");
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->priorityFilter !== 'all', function ($query) {
                $query->where('priority', $this->priorityFilter);
            })
            ->latest()
            ->paginate($this->perPage);
    }

    // Get statistics for dashboard cards
    public function getStatsProperty()
    {
        $query = Shipment::query();

        // Apply same search filter to stats
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('tracking_number', 'LIKE', "%{$this->search}%")
                    ->orWhere('sender_name', 'LIKE', "%{$this->search}%")
                    ->orWhere('receiver_name', 'LIKE', "%{$this->search}%");
            });
        }

        return [
            'total' => $query->count(),
            'pending' => (clone $query)->where('status', 'pending')->count(),
            'in_transit' => (clone $query)->where('status', 'in_transit')->count(),
            'delivered' => (clone $query)->where('status', 'delivered')->count(),
        ];
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.shipments.index', [
            'shipments' => $this->shipments,
            'stats' => $this->stats,
        ]);
    }
}
