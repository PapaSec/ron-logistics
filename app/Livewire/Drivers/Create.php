<?php

namespace App\Livewire\Drivers;

use App\Models\Driver;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Add New Driver - Ron Logistics')]

class Create extends Component
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
            'Forklift'=>  'Forklift',
        ];
    }

    // Generate next Driver Number
    public function generateDriverNumber()
    {
        $lastDriver = Driver::latest('id')->first();

        if (!$lastDriver) {
            $this->driver_number = 'DRV-001';
        }else {
            preg_match('/(\d+)$/', $lastDriver->driver_number, $matches);
            $lastNumber = isset($matches[1]) ? intval($matches[1]) : 0;
            $newNumber = $lastNumber + 1;
            $this->driver_number = 'DRV-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        }
    }

    // Mount
    public function mount()
    {
        $this->generateDriverNumber();
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

    // Save Driver
    public function save()
    {
        $validated = $this->validate();

        try {
            $driver = Driver::create($validated);

            session()->flash('success', "Driver {$driver->full_name} created successfully!");

            return $this->redirect(route('drivers.show', $driver->id), true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create driver. Please try again.');
        }
    }

    // Cancel and go back
    public function cancel()
    {
        return $this->redirect(route('drivers.index'), true);
    }

    public function render()
    {
        return view('livewire.drivers.create', [
            'licenseTypes' => $this->licenseTypes,
        ]);
    }
}
