<?php

namespace App\Livewire\Shipments;

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
    public function render()
    {
        return view('livewire.shipments.create');
    }
}
