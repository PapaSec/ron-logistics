<?php

namespace App\Livewire\Shipments;

use App\Models\Shipment;
use Livewire\{Component, WithPagination};
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Shipments - Ron Logistics')]
class Index extends Component
{
    // TRAITS
    use WithPagination;

    // PUBLIC PROPERTIES
    public $search = '';
    public $statusFilter = 'all';
    public $perPage = 10;
    public $showDeleteModal = false;
    public $shipmentToDelete = null;

    // PROTECTED PROPERTIES (optional)
    protected $queryString = ['search', 'statusFilter'];

    // LIFECYCLE HOOKS
    public function mount()
    {
        // Runs once when page loads
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    // CUSTOM METHODS
    public function confirmDelete($id)
    {
        $this->shipmentToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->shipmentToDelete) {
            Shipment::findOrFail($this->shipmentToDelete)->delete();
            $this->showDeleteModal = false;
            $this->shipmentToDelete = null;
            session()->flash('success', 'Shipment deleted!');
        }
    }

    public function clearFilters()
    {
        $this->reset(['search', 'statusFilter']);
        $this->resetPage();
    }

    // RENDER METHOD 
    public function render()
    {
        $shipments = Shipment::query()
            ->when($this->search, fn($q) => 
                $q->where('tracking_number', 'LIKE', "%{$this->search}%")
            )
            ->when($this->statusFilter !== 'all', fn($q) => 
                $q->where('status', $this->statusFilter)
            )
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.shipments.index', compact('shipments'));
    }
}