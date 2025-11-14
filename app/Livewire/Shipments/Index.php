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
    
    public function render()
    {
        return view('livewire.shipments.index');
    }
}
