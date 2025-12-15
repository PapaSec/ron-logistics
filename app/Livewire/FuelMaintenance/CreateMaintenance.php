<?php

namespace App\Livewire\FuelMaintenance;

use App\Models\{MaintenanceRecord, Vehicle};
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Add Maintenance Record - Ron Logistics')]
class CreateMaintenance extends Component
{
    public $vehicle_id = '';
    public $maintenance_number = '';
    public $date = '';
    public $type = 'routine';
    public $service_provider = '';
    public $description = '';
    public $odometer_reading = '';
    public $parts_cost = '';
    public $labor_cost = '';
    public $total_cost = '';
    public $status = 'completed';
    public $next_service_date = '';
    public $next_service_odometer = '';
    public $invoice_number = '';
    public $notes = '';

    public function getMaintenanceTypesProperty()
    {
        return [
            'routine' => 'Routine',
            'repair' => 'Repair',
            'inspection' => 'Inspection',
            'tire_change' => 'Tire Change',
            'oil_change' => 'Oil Change',
            'brake_service' => 'Brake Service',
            'other' => 'Other',
        ];
    }

    public function getStatusOptionsProperty()
    {
        return [
            'scheduled' => 'Scheduled',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];
    }

    public function getVehiclesProperty()
    {
        return Vehicle::orderBy('vehicle_number')->get();
    }

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
        $this->generateMaintenanceNumber();
    }

    public function generateMaintenanceNumber()
    {
        $lastRecord = MaintenanceRecord::latest('id')->first();
        $nextId = $lastRecord ? $lastRecord->id + 1 : 1;
        $this->maintenance_number = 'MNT-' . now()->format('Ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['parts_cost', 'labor_cost'])) {
            $parts = floatval($this->parts_cost ?: 0);
            $labor = floatval($this->labor_cost ?: 0);
            $this->total_cost = round($parts + $labor, 2);
        }
    }

    protected function rules()
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,id',
            'maintenance_number' => 'required|string|max:255|unique:maintenance_records,maintenance_number',
            'date' => 'required|date',
            'type' => 'required|in:routine,repair,inspection,tire_change,oil_change,brake_service,other',
            'service_provider' => 'nullable|string|max:255',
            'description' => 'required|string',
            'odometer_reading' => 'required|numeric|min:0',
            'parts_cost' => 'required|numeric|min:0',
            'labor_cost' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled',
            'next_service_date' => 'nullable|date',
            'next_service_odometer' => 'nullable|numeric|min:0',
            'invoice_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        $validated['created_by'] = auth()->id();

        try {
            $maintenanceRecord = MaintenanceRecord::create($validated);
            session()->flash('success', 'Maintenance record created successfully!');
            return $this->redirect(route('fuel-maintenance.show-maintenance', $maintenanceRecord->id), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create maintenance record. Please try again.');
        }
    }

    public function cancel()
    {
        return $this->redirect(route('fuel-maintenance.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.fuel-maintenance.create-maintenance', [
            'vehicles' => $this->vehicles,
            'maintenanceTypes' => $this->maintenanceTypes,
            'statusOptions' => $this->statusOptions,
        ]);
    }
}