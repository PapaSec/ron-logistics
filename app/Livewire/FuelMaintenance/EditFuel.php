<?php

namespace App\Livewire\FuelMaintenance;

use App\Models\{Driver, FuelRecord, Vehicle};
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Edit Fuel Record - Ron Logistics')]
class EditFuel extends Component
{
    public FuelRecord $fuelRecord;

    // Form fields
    public $vehicle_id = '';
    public $driver_id = '';
    public $date = '';
    public $quantity = '';
    public $price_per_liter = '';
    public $total_cost = '';
    public $fuel_type = '';
    public $odometer_reading = '';
    public $distance_traveled = '';
    public $location = '';
    public $station_name = '';
    public $receipt_number = '';
    public $payment_method = '';
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
    public function mount(FuelRecord $fuelRecord)
    {
        $this->fuelRecord = $fuelRecord;
        
        // Populate form
        $this->vehicle_id = $fuelRecord->vehicle_id;
        $this->driver_id = $fuelRecord->driver_id;
        $this->date = $fuelRecord->date->format('Y-m-d');
        $this->quantity = $fuelRecord->quantity;
        $this->price_per_liter = $fuelRecord->price_per_liter;
        $this->total_cost = $fuelRecord->total_cost;
        $this->fuel_type = $fuelRecord->fuel_type;
        $this->odometer_reading = $fuelRecord->odometer_reading;
        $this->distance_traveled = $fuelRecord->distance_traveled;
        $this->location = $fuelRecord->location;
        $this->station_name = $fuelRecord->station_name;
        $this->receipt_number = $fuelRecord->receipt_number;
        $this->payment_method = $fuelRecord->payment_method;
        $this->notes = $fuelRecord->notes;
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

    // Update fuel record
    public function update()
    {
        $validated = $this->validate();

        try {
            $this->fuelRecord->update($validated);

            session()->flash('success', 'Fuel record updated successfully!');

            return $this->redirect(route('fuel-maintenance.show-fuel', $this->fuelRecord->id), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update fuel record. Please try again.');
        }
    }

    // Cancel
    public function cancel()
    {
        return $this->redirect(route('fuel-maintenance.show-fuel', $this->fuelRecord->id), navigate: true);
    }

    public function render()
    {
        return view('livewire.fuel-maintenance.edit-fuel', [
            'vehicles' => $this->vehicles,
            'drivers' => $this->drivers,
            'fuelTypes' => $this->fuelTypes,
            'paymentMethods' => $this->paymentMethods,
        ]);
    }
}