<?php

namespace App\Livewire\FuelMaintenance;

use App\Models\{MaintenanceRecord, Vehicle};
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Edit Maintenance Record - Ron Logistics')]
class EditMaintenance extends Component
{
    public MaintenanceRecord $maintenanceRecord;
    
    // Same properties as CreateMaintenance...
    public $vehicle_id, $maintenance_number, $date, $type, $service_provider;
    public $description, $odometer_reading, $parts_cost, $labor_cost, $total_cost;
    public $status, $next_service_date, $next_service_odometer, $invoice_number, $notes;

    public function mount(MaintenanceRecord $maintenanceRecord)
    {
        $this->maintenanceRecord = $maintenanceRecord;
        $this->vehicle_id = $maintenanceRecord->vehicle_id;
        $this->maintenance_number = $maintenanceRecord->maintenance_number;
        $this->date = Carbon::parse($maintenanceRecord->date)->format('Y-m-d');
        $this->type = $maintenanceRecord->type;
        $this->service_provider = $maintenanceRecord->service_provider;
        $this->description = $maintenanceRecord->description;
        $this->odometer_reading = $maintenanceRecord->odometer_reading;
        $this->parts_cost = $maintenanceRecord->parts_cost;
        $this->labor_cost = $maintenanceRecord->labor_cost;
        $this->total_cost = $maintenanceRecord->total_cost;
        $this->status = $maintenanceRecord->status;
        $this->next_service_date = $maintenanceRecord->next_service_date instanceof Carbon ? $maintenanceRecord->next_service_date->format('Y-m-d') : null;
        $this->next_service_odometer = $maintenanceRecord->next_service_odometer;
        $this->invoice_number = $maintenanceRecord->invoice_number;
        $this->notes = $maintenanceRecord->notes;
    }

    // Copy same getters from CreateMaintenance...
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
            'maintenance_number' => 'required|string|max:255|unique:maintenance_records,maintenance_number,' . $this->maintenanceRecord->id,
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

    public function update()
    {
        $validated = $this->validate();

        try {
            $this->maintenanceRecord->update($validated);
            session()->flash('success', 'Maintenance record updated successfully!');
            return $this->redirect(route('fuel-maintenance.show-maintenance', $this->maintenanceRecord->id), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update maintenance record. Please try again.');
        }
    }

    public function cancel()
    {
        return $this->redirect(route('fuel-maintenance.show-maintenance', $this->maintenanceRecord->id), navigate: true);
    }

    public function render()
    {
        return view('livewire.fuel-maintenance.edit-maintenance', [
            'vehicles' => Vehicle::orderBy('vehicle_number')->get(),
            'maintenanceTypes' => $this->getMaintenanceTypesProperty(),
            'statusOptions' => $this->getStatusOptionsProperty(),
        ]);
    }
}