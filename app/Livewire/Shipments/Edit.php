<?php

namespace App\Livewire\Shipments;

use App\Models\Shipment;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

#[Layout('layouts.app')]
#[Title('Edit Shipment - Ron Logistics')]
class Edit extends Component
{
    public Shipment $shipment;
    
    // FORM PROPERTIES
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

    // VALIDATION RULES
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
        'status' => 'required|in:pending,in_transit,delivered,cancelled',
        'pickup_date' => 'required|date',
        'estimated_delivery_date' => 'required|date|after:pickup_date',
    ];

    // CUSTOM VALIDATION MESSAGES
    protected $messages = [
        'sender_name.required' => 'Sender name is required',
        'estimated_delivery_date.after' => 'Delivery date must be after pickup date',
    ];

    // LIFECYCLE HOOKS
    public function mount(Shipment $shipment)
    {
        // Check if user owns this shipment or is authorized to edit
        if ($shipment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $this->shipment = $shipment;
        
        // Populate form with existing shipment data
        $this->tracking_number = $shipment->tracking_number;
        $this->sender_name = $shipment->sender_name;
        $this->sender_phone = $shipment->sender_phone;
        $this->receiver_name = $shipment->receiver_name;
        $this->receiver_phone = $shipment->receiver_phone;
        $this->origin_city = $shipment->origin_city;
        $this->destination_city = $shipment->destination_city;
        $this->description = $shipment->description;
        $this->weight = $shipment->weight;
        $this->quantity = $shipment->quantity;
        $this->value = $shipment->value;
        $this->status = $shipment->status;
        $this->priority = $shipment->priority;
        // Ensure dates are formatted whether they're DateTime instances or strings
        $this->pickup_date = $shipment->pickup_date instanceof \DateTimeInterface
            ? $shipment->pickup_date->format('Y-m-d')
            : Carbon::parse($shipment->pickup_date)->format('Y-m-d');
        $this->estimated_delivery_date = $shipment->estimated_delivery_date instanceof \DateTimeInterface
            ? $shipment->estimated_delivery_date->format('Y-m-d')
            : Carbon::parse($shipment->estimated_delivery_date)->format('Y-m-d');
    }

    // RESET FORM METHOD - Reset to original values
    public function resetForm()
    {
        $this->mount($this->shipment); // Reload original data
        session()->flash('info', 'Form reset to original values!');
    }

    public function update()
    {
        // Validate all fields
        $validated = $this->validate();

        try {
            // Update the shipment
            $this->shipment->update($validated);

            // Flash success message
            session()->flash('success', "Shipment {$this->tracking_number} updated successfully!");

            // Redirect to shipments index
            return $this->redirect(route('shipments.index'), navigate: true);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update shipment: ' . $e->getMessage());
        }
    }

    // Cancel and redirect to shipments index
    public function cancel()
    {
        return $this->redirect(route('shipments.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.shipments.edit');
    }
}