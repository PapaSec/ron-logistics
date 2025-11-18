<?php

namespace App\Livewire\Shipments;

use App\Models\Shipment;
use Livewire\{Component, WithPagination, WithoutUrlPagination};
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Dashboard - Ron Logistics')]
class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    // Public Properties
    public $search = '';
    public $statusFilter = 'all';
    public $priorityFilter = 'all';
    public $perPage = 10;

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
    

    // Delete Shipment method
    public function delete($id)
    {
        //
    }

    public function render()
    {
        return view('livewire.shipments.index');
    }
}
