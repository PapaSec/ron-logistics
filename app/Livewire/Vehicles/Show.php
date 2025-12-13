<?php

namespace App\Livewire\Vehicles;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Vehicle Details - Ron Logistics')]
class Show extends Component
{
    public Vehicle $vehicle;

    // For delete confirmation
    public $showDeleteModal = false;

    // Mount - Load vehicle
    public function mount(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    // Confirm delete
    public function confirmDelete()
    {
        $this->showDeleteModal = true;
    }

    // Cancel delete
    public function cancelDelete()
    {
        $this->showDeleteModal = false;
    }

    // Delete vehicle
    public function delete()
    {
        try {
            // Check if vehicle has active shipments
            if ($this->vehicle->shipments()->whereIn('status', ['pending', 'in_transit'])->exists()) {
                session()->flash('error', 'Cannot delete vehicle with active shipments!');
                $this->showDeleteModal = false;
                return;
            }

            $vehicleNumber = $this->vehicle->vehicle_number;
            $this->vehicle->delete();

            session()->flash('success', "Vehicle {$vehicleNumber} deleted successfully!");

            return $this->redirect(route('vehicles.index'), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete vehicle. Please try again.');
            $this->showDeleteModal = false;
        }
    }

    // Get status badge configuration
    public function getStatusConfigProperty()
    {
        $configs = [
            'available' => [
                'class' => 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300',
                'icon' => 'fa-check-circle'
            ],
            'in_use' => [
                'class' => 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300',
                'icon' => 'fa-truck-moving'
            ],
            'maintenance' => [
                'class' => 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300',
                'icon' => 'fa-wrench'
            ],
            'out_of_service' => [
                'class' => 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300',
                'icon' => 'fa-times-circle'
            ],
        ];

        return $configs[$this->vehicle->status] ?? $configs['available'];
    }

    public function render()
    {
        return view('livewire.vehicles.show', [
            'statusConfig' => $this->statusConfig,
        ]);
    }
}