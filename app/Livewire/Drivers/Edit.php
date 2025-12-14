<?php

namespace App\Livewire\Drivers;

use App\Models\Driver;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Add New Driver - Ron Logistics')]

class Edit extends Component
{
    // Basic Information
    public $driver_number = '';
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $phone = '';
    public $phone_alt = '';

    // License Details
    public $license_number = '';
    public $license_type = 'Code 10';
    public $license_expiry = '';

    // Employment Details
    public $hire_date = '';
    public $employment_type = 'full_time';
    public $status = 'active';

    // Address Information
    public $address = '';
    public $city = '';
    public $state = '';
    public $postal_code = '';

    // Emergency Contact
    public $emergency_contact_name = '';
    public $emergency_contact_phone = '';
    public $emergency_contact_relationship = '';

    // Additional Notes
    public $notes = '';
    public $last_medical_checkup = '';
    public $next_medical_checkup = '';

    // License Types
    public function getLicenseTypesProperty()
    {
        return [
            'Code 08' =>  'Code 08',
            'Code 10' =>  'Code 10',
            'Code 14' =>  'Code 14',
            'Forklift' =>  'Forklift',
        ];
    }

    // Mount - Load driver data
    public function mount(Driver $driver)
    {
        // Populate form fields
        $this->driver_number = $driver->driver_number;
        $this->first_name = $driver->first_name;
        $this->last_name = $driver->last_name;
        $this->email = $driver->email;
        $this->phone = $driver->phone;
        $this->phone_alt = $driver->phone_alt;
        $this->license_number = $driver->license_number;
        $this->license_type = $driver->license_type;
        $this->license_expiry = $driver->license_expiry?->format('Y-m-d');
        $this->hire_date = $driver->hire_date?->format('Y-m-d');
        $this->employment_type = $driver->employment_type;
        $this->status = $driver->status;
        $this->address = $driver->address;
        $this->city = $driver->city;
        $this->state = $driver->state;
        $this->postal_code = $driver->postal_code;
        $this->emergency_contact_name = $driver->emergency_contact_name;
        $this->emergency_contact_phone = $driver->emergency_contact_phone;
        $this->emergency_contact_relationship = $driver->emergency_contact_relationship;
        $this->notes = $driver->notes;
        $this->last_medical_checkup = $driver->last_medical_checkup?->format('Y-m-d');
        $this->next_medical_checkup = $driver->next_medical_checkup?->format('Y-m-d');
    }

    // Validation Rules
    protected function rules()
    {
        return [
            'driver_number' => 'required|string|max:255|unique:drivers,driver_number',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:drivers,email',
            'phone' => 'required|string|max:255',
            'phone_alt' => 'nullable|string|max:255',
            'license_number' => 'required|string|max:255|unique:drivers,license_number',
            'license_type' => 'required|in:Class A,Class B,Class C,Commercial',
            'license_expiry' => 'required|date|after:today',
            'hire_date' => 'nullable|date',
            'employment_type' => 'required|in:full_time,part_time,contract',
            'status' => 'required|in:active,inactive,on_leave,suspended',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'last_medical_checkup' => 'nullable|date',
            'next_medical_checkup' => 'nullable|date|after_or_equal:last_medical_checkup',
        ];
    }

    // Update Driver
    public function update()
    {
        $validated = $this->validates();

        try {
            $this->driver->update($validated);

            session()->flash('success', "Driver {$this->driver->full_name} updated successfully");

            return $this->redirect(route('driver.index'), true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update driver. Please try again.');
        }
    }

    // Cancel
    public function cancel()
    {
        return $this->redirect(route('drivers.index'), true);
    }

    public function render()
    {
        return view('livewire.drivers.edit', [
            'licenseTypes' => $this->licenseTypes,
        ]);
    }
}
