<?php

namespace App\Livewire\FuelMaintenance;

use App\Models\{Driver, FuelRecord, Vehicle};
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Add Fuel Record - Ron Logistics')]
class CreateFuel extends Component
{
    // Form fields
    public $vehicle_id = '';
    public $driver_id = '';
    public $date = '';
    public $quantity = '';
    public $price_per_liter = '';
    public $total_cost = '';
    public $fuel_type = 'Diesel';
    public $odometer_reading = '';
    public $distance_traveled = '';
    public $location = '';
    public $station_name = '';
    public $receipt_number = '';
    public $payment_method = 'cash';
    public $notes = '';

    // Fuel types
    public function getFuelTypesProperty()
    {
        return [
            'Diesel' => 'Diesel',
            'Petrol' => 'Petrol',
            'Unleaded' => 'Unleaded',
        ];
    }

    // Payment methods
    public function getPaymentMethodsProperty()
    {
        return [
            'cash' => 'Cash',
            'card' => 'Card',
            'fuel_card' => 'Fuel Card',
            'account' => 'Account',
        ];
    }

    // Get vehicles
    public function getVehiclesProperty()
    {
        return Vehicle::orderBy('vehicle_number')->get();
    }

    // Get drivers
    public function getDriversProperty()
    {
        return Driver::where('status', 'active')->orderBy('first_name')->get();
    }

    // Mount
    public function mount()
    {
        $this->date = now()->format('Y-m-d');
        $this->generateReceiptNumber();
    }

    // Generate receipt number
    public function generateReceiptNumber()
    {
        $lastRecord = FuelRecord::latest('id')->first();
        $nextId = $lastRecord ? $lastRecord->id + 1 : 1;
        $this->receipt_number = 'FR-' . now()->format('Ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }

    // Calculate total cost when quantity or price changes
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['quantity', 'price_per_liter'])) {
            if ($this->quantity && $this->price_per_liter) {
                $this->total_cost = round($this->quantity * $this->price_per_liter, 2);
            }
        }
    }

    // Validation rules
    protected function rules()
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'date' => 'required|date',
            'quantity' => 'required|numeric|min:0.01',
            'price_per_liter' => 'required|numeric|min:0.01',
            'total_cost' => 'required|numeric|min:0.01',
            'fuel_type' => 'required|string',
            'odometer_reading' => 'required|numeric|min:0',
            'distance_traveled' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'station_name' => 'nullable|string|max:255',
            'receipt_number' => 'nullable|string|max:255',
            'payment_method' => 'required|in:cash,card,fuel_card,account',
            'notes' => 'nullable|string',
        ];
    }

    // Save fuel record
    public function save()
    {
        $validated = $this->validate();
        $validated['created_by'] = auth()->id();

        try {
            $fuelRecord = FuelRecord::create($validated);

            session()->flash('success', 'Fuel record created successfully!');

            return $this->redirect(route('fuel-maintenance.show-fuel', $fuelRecord->id), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create fuel record. Please try again.');
        }
    }

    // Cancel
    public function cancel()
    {
        return $this->redirect(route('fuel-maintenance.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.fuel-maintenance.create-fuel', [
            'vehicles' => $this->vehicles,
            'drivers' => $this->drivers,
            'fuelTypes' => $this->fuelTypes,
            'paymentMethods' => $this->paymentMethods,
        ]);
    }
}