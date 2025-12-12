<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-plus text-[#138898] mr-2"></i> Add New Vehicle
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Register a new vehicle to your fleet</p>
        </div>

        <x-button style="back" href="{{ route('vehicles.index') }}" icon="fas fa-arrow-left">
            Back to List
        </x-button>
    </div>

    <!-- Vehicle Number Display -->
    <div
        class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-500/20 p-4 rounded-lg mb-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Vehicle Number</p>
                <p class="text-2xl font-bold text-[#138898] mt-1">{{ $vehicle_number }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    This vehicle number will be auto-assigned
                    <span class="inline-block w-2 h-2 bg-[#138898] rounded-full animate-pulse ml-2"></span>
                </p>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" wire:click="generateVehicleNumber"
                    class="text-sm text-[#138898] hover:text-[#023543] dark:text-[#138898] dark:hover:text-[#1fa8bd] transition font-medium">
                    <i class="fas fa-sync-alt mr-1"></i> Regenerate
                </button>
                <div class="text-[#138898]">
                    <i class="fas fa-truck text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 p-4 rounded-lg mb-4">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                <p class="text-green-800 dark:text-green-300 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 p-4 rounded-lg mb-4">
            <div class="flex items-center">
                <i class="fas fa-times-circle text-red-500 mr-3 text-xl"></i>
                <p class="text-red-800 dark:text-red-300 font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Vehicle Creation Form -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-lg shadow-sm p-6">
        <form wire:submit.prevent="save" class="space-y-6">
            @csrf

            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-info-circle text-[#138898] mr-3"></i>Basic Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-inputs.text label="Vehicle Number" name="vehicle_number" model="vehicle_number"
                        icon="fas fa-hashtag" placeholder="VEH-001" required />
                    @error('vehicle_number')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.select label="Vehicle Type" name="type" model="type" icon="fas fa-truck"
                        :options="$vehicleTypes" required />
                    @error('type')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text label="License Plate" name="license_plate" model="license_plate"
                        icon="fas fa-id-card" placeholder="ABC-1234" required />
                    @error('license_plate')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Vehicle Details -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-car text-[#138898] mr-3"></i>Vehicle Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-inputs.text label="Make" name="make" model="make" icon="fas fa-industry"
                        placeholder="e.g., Toyota, Ford" />
                    @error('make')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text label="Model" name="model" model="model" icon="fas fa-car"
                        placeholder="e.g., Hilux, F-150" />
                    @error('model')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.number label="Year" name="year" model="year" icon="fas fa-calendar"
                        placeholder="{{ date('Y') }}" min="1900" max="2100" />
                    @error('year')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Capacity & Status -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-cogs text-[#138898] mr-3"></i>Capacity & Status
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-inputs.number label="Capacity (kg)" name="capacity" model="capacity" icon="fas fa-weight-hanging"
                        placeholder="5000" step="0.01" min="0" />
                    @error('capacity')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.select label="Status" name="status" model="status" icon="fas fa-traffic-light" :options="[
        'available' => 'Available',
        'in_use' => 'In Use',
        'maintenance' => 'Maintenance',
        'out_of_service' => 'Out of Service'
    ]" required />
                    @error('status')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Maintenance Schedule -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-wrench text-[#138898] mr-3"></i>Maintenance Schedule
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-inputs.date label="Last Maintenance" name="last_maintenance" model="last_maintenance"
                        icon="fas fa-calendar-check" />
                    @error('last_maintenance')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.date label="Next Maintenance" name="next_maintenance" model="next_maintenance"
                        icon="fas fa-calendar-plus" />
                    @error('next_maintenance')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Additional Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-sticky-note text-[#138898] mr-3"></i>Additional Information
                </h3>
                <div>
                    <x-inputs.textarea label="Notes" name="notes" model="notes" icon="fas fa-sticky-note" rows="4"
                        placeholder="Add any additional notes..." required />
                    @error('notes')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end pt-4 space-x-4">
                <x-button type="button" style="clear" wire:click="cancel" icon="fas fa-times">
                    Cancel
                </x-button>

                <x-button type="submit" style="submit" icon="fas fa-save" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">Create Vehicle</span>
                    <span wire:loading wire:target="save">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Creating...
                    </span>
                </x-button>
            </div>
        </form>
    </div>
</div>