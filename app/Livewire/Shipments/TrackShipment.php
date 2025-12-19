<?php

namespace App\Livewire\Shipments;

use App\Models\Shipment;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Track Shipment - Ron Logistics')]
class TrackShipment extends Component
{
    public $trackingNumber = '';
    public $shipment = null;
    public $notFound = false;

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
            'trackingNumber' => 'required|string',
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
    public function getProgressPercentage()
    {
        if (!$this->shipment) return 0;

        return match($this->shipment->status) {
            'pending' => 25,
            'in_transit' => 65,
            'delivered' => 100,
            'cancelled' => 0,
            default => 0
        };
    }

    // Get status color
    public function getStatusColor()
    {
        if (!$this->shipment) return 'gray';

        return match($this->shipment->status) {
            'pending' => 'blue',
            'in_transit' => 'yellow',
            'delivered' => 'green',
            'cancelled' => 'red',
            default => 'gray'
        };
    }

    public function render()
    {
        return view('livewire.shipments.track-shipment', [
            'progress' => $this->getProgressPercentage(),
            'statusColor' => $this->getStatusColor(),
        ]);
    }
}