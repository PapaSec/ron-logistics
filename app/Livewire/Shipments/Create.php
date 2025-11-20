<?php

namespace App\Livewire\Shipments;

use App\Models\Shipment;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Create Shipment - Ron Logistics')]

class Create extends Component
{
    // Form Properties
    public $tracking_number;
    public $sender_name = '';
    public $sender_phone = '';
    public $receiver_name = '';
    public $receiver_phone = '';
    public $origin_city = '';
    public $destination_city = '';
    public $description = '';
    public $weight = '';
    public $quantity = 1;
    public $value = '';
    public $status = 'pending';
    public $priority = 'standard';
    public $pickup_date;
    public $estimated_delivery_date;

    // Validation Rules
    protected $rules = [
        'sender_name' => 'required|string|max:255',
        'sender_phone' => 'required|string|max:20',
        'receiver_name' => 'required|string|max:255',
        'receiver_phone' => 'required|string|max:20',
        'origin_city' => 'required|string|max:255',
        'destination_city' => 'required|string|max:255',
        'description' => 'required|string',
        'weight' => 'required|numeric|min:0.01',
        'quantity' => 'required|integer|min:1',
        'value' => 'nullable|numeric|min:0',
        'priority' => 'required|in:standard,express,economy',
        'pickup_date' => 'required|date|after_or_equal:today',
        'estimated_delivery_date' => 'required|date|after:pickup_date',
    ];

    // Custom Validation Messages
    protected $messages = [
        'sender_name.required' => 'Sender name is required',
        'pickup_date.after_or_equal' => 'Pickup date cannot be in the past',
        'estimated_delivery_date.after' => 'Delivery date must be after pickup date'
    ];

    // Lifecycle Hooks
    public function mount()
    {
        // Generate tracking number on page load
        $this->tracking_number = $this->generateTrackingNumber();

        // Set default dates
        $this->pickup_date = now()->format('Y-m-d');
        $this->estimated_delivery_date = now()->addDays(3)->format('Y-m-d');
    }

    // Custom Methods
    private function generateTrackingNumber()
    {
        $year = now()->year;
        $lastShipment = Shipment::latest('id')->first();
        $nextNumber = $lastShipment ? $lastShipment->id + 1 : 1;

        return 'SHIP-' . $year . '-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
    public function render()
    {
        return view('livewire.shipments.create');
    }
}
