<?php

namespace App\Livewire\Shipments;

use App\Models\Shipment;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.guest')]
#[Title('Track Shipment - Ron Logistics')]
class TrackShipment extends Component
{
    // Public Properties
    public $trackingNumber = '';
    public $shipment = null;
    public $notFound = false;

    // Mount
    public function mount($tracking = null)
    {
        if ($tracking) {
            $this->trackingNumber = $tracking;
            $this->track();
        }
    }

    public function track() 
    {
        $this->notFound = false;
        $this->shipment = null;

        $this->validate([
            'tracking_number', $this->trackingNumber,
        ]);

        $shipment = Shipment::with(['vehicle', 'user'])
        ->where('tracking_number', $this->trackingNumber)
        ->first();

        if ($shipment) {
            $this->shipment = $shipment;

            // Update URL without page reload
            $this->dispatch('track-found', tracking: $this->trackingNumber);
        } else {
            $this->notFound = true;
        }
    }

    // Reset Search 
    public function resetSearch()
    {
        $this->reset(['trackingNumber', 'shipment', 'notFound']);
        $this->dispatch('reset-tracking');
    }

    // Helper to mask phone numbers for privacy
    public function maskPhone($phone)
    {
        if (strlen($phone) < 4) return $phone;
        return substr($phone, 0, 3) . ' *** *** ' . substr($phone, -3);
    }

    // Get progress percentage based on status
    public function getStatusColor()
    {
        if (!$this->shipment) return 'gray';

        return match($this->shipment->status) {
            'pending' => 'blue',
            'in_transit' => 'yellow',
        };
    }
    public function render()
    {
        return view('livewire.shipments.track-shipment');
    }
}
