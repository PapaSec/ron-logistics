<?php

namespace App\Livewire\Shipments;

use Livewire\{Component, WithPagination};
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Dashboard - Ron Logistics')]
class Index extends Component
{
    use WithPagination;

    // Public Properties
    public $search = '';
    public $statusFilter = 'all';
    public $priorityFilter = 'all';
    public $perPage = 10;

    // Reset to page 1 when search changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

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
