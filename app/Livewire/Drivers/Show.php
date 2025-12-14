<?php

namespace App\Livewire\Drivers;

use App\Models\Driver;
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Driver Details - Ron Logistics')]
class Show extends Component
{
    public Driver $driver;

    // For delete confirmation
    public $showDeleteModal = false;

    // Mount
    public function mount(Driver $driver)
    {
        $this->driver = $driver;
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

    // Delete driver
    public function delete()
    {
        try {
            // Check if driver has assigned vehicles
            if ($this->driver->vehicles()->exists()) {
                session()->flash('error', 'Cannot delete driver with assigned vehicles!');
                $this->showDeleteModal = false;
                return;
            }

            $driverName = $this->driver->full_name;
            $this->driver->delete();

            session()->flash('success', "Driver {$driverName} deleted successfully!");

            return $this->redirect(route('drivers.index'), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete driver. Please try again.');
            $this->showDeleteModal = false;
        }
    }

    // Get status badge configuration
    public function getStatusConfigProperty()
    {
        $configs = [
            'active' => [
                'class' => 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300',
                'icon' => 'fa-check-circle'
            ],
            'inactive' => [
                'class' => 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300',
                'icon' => 'fa-times-circle'
            ],
            'on_leave' => [
                'class' => 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300',
                'icon' => 'fa-calendar-times'
            ],
            'suspended' => [
                'class' => 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300',
                'icon' => 'fa-ban'
            ],
        ];

        return $configs[$this->driver->status] ?? $configs['active'];
    }

    public function render()
    {
        return view('livewire.drivers.show', [
            'statusConfig' => $this->statusConfig,
        ]);
    }
}