<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-plus text-[#138898] mr-2"></i> Add Maintenance Record
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Record a new maintenance service</p>
        </div>

        <x-button style="back" href="{{ route('fuel-maintenance.index') }}" icon="fas fa-arrow-left">
            Back to List
        </x-button>
    </div>

    <!-- Maintenance Number Display -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-500/20 p-4 rounded-lg mb-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Maintenance Number</p>
                <p class="text-2xl font-bold text-[#138898] mt-1">{{ $maintenance_number }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    Auto-generated maintenance number
                    <span class="inline-block w-2 h-2 bg-[#138898] rounded-full animate-pulse ml-2"></span>
                </p>
            </div>
            <div class="flex items-center gap-3">
                <button 
                    type="button"
                    wire:click="generateMaintenanceNumber"
                    class="text-sm text-[#138898] hover:text-[#023543] dark:text-[#138898] dark:hover:text-[#1fa8bd] transition font-medium"
                >
                    <i class="fas fa-sync-alt mr-1"></i> Regenerate
                </button>
                <div class="text-[#138898]">
                    <i class="fas fa-tools text-4xl"></i>
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

    <!-- Maintenance Form -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-lg shadow-sm p-6">
        <form wire:submit.prevent="save" class="space-y-6">
            @csrf

            <!-- Vehicle & Basic Info -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-truck text-[#138898] mr-3"></i>Vehicle & Basic Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-inputs.select 
                        label="Vehicle" 
                        name="vehicle_id" 
                        model="vehicle_id" 
                        icon="fas fa-truck"
                        :options="['' => 'Select vehicle'] + $vehicles->mapWithKeys(function($vehicle) {
                            return [$vehicle->id => $vehicle->vehicle_number . ' - ' . $vehicle->make . ' ' . $vehicle->model];
                        })->toArray()"
                        required 
                    />
                    @error('vehicle_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.date 
                        label="Service Date" 
                        name="date" 
                        model="date" 
                        icon="fas fa-calendar"
                        required 
                    />
                    @error('date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="Maintenance Number" 
                        name="maintenance_number" 
                        model="maintenance_number" 
                        icon="fas fa-hashtag"
                        placeholder="MNT-001" 
                        required 
                    />
                    @error('maintenance_number')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Service Details -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-wrench text-[#138898] mr-3"></i>Service Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-inputs.select 
                        label="Maintenance Type" 
                        name="type" 
                        model="type" 
                        icon="fas fa-cogs"
                        :options="$maintenanceTypes"
                        required 
                    />
                    @error('type')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.select 
                        label="Status" 
                        name="status" 
                        model="status" 
                        icon="fas fa-info-circle"
                        :options="$statusOptions"
                        required 
                    />
                    @error('status')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="Service Provider" 
                        name="service_provider" 
                        model="service_provider" 
                        icon="fas fa-building"
                        placeholder="Workshop/Mechanic name" 
                    />
                    @error('service_provider')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="mt-6">
                    <x-inputs.textarea 
                        label="Description" 
                        name="description" 
                        model="description" 
                        icon="fas fa-file-alt"
                        rows="3"
                        placeholder="Describe the maintenance work performed..."
                        required
                    />
                    @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Odometer & Costs -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-calculator text-[#138898] mr-3"></i>Odometer & Costs
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <x-inputs.number 
                        label="Odometer Reading (km)" 
                        name="odometer_reading" 
                        model="odometer_reading" 
                        icon="fas fa-tachometer-alt"
                        placeholder="0" 
                        step="0.01"
                        min="0"
                        required 
                    />
                    @error('odometer_reading')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.number 
                        label="Parts Cost (R)" 
                        name="parts_cost" 
                        model="parts_cost" 
                        icon="fas fa-cogs"
                        placeholder="0.00" 
                        step="0.01"
                        min="0"
                        required 
                    />
                    @error('parts_cost')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.number 
                        label="Labor Cost (R)" 
                        name="labor_cost" 
                        model="labor_cost" 
                        icon="fas fa-user-cog"
                        placeholder="0.00" 
                        step="0.01"
                        min="0"
                        required 
                    />
                    @error('labor_cost')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.number 
                        label="Total Cost (R)" 
                        name="total_cost" 
                        model="total_cost" 
                        icon="fas fa-dollar-sign"
                        placeholder="0.00" 
                        step="0.01"
                        min="0"
                        required
                        readonly
                    />
                    @error('total_cost')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Next Service Schedule -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-calendar-plus text-[#138898] mr-3"></i>Next Service Schedule
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-inputs.date 
                        label="Next Service Date" 
                        name="next_service_date" 
                        model="next_service_date" 
                        icon="fas fa-calendar"
                    />
                    @error('next_service_date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.number 
                        label="Next Service Odometer (km)" 
                        name="next_service_odometer" 
                        model="next_service_odometer" 
                        icon="fas fa-tachometer-alt"
                        placeholder="0" 
                        step="0.01"
                        min="0"
                    />
                    @error('next_service_odometer')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Additional Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-sticky-note text-[#138898] mr-3"></i>Additional Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <x-inputs.text 
                        label="Invoice Number" 
                        name="invoice_number" 
                        model="invoice_number" 
                        icon="fas fa-file-invoice"
                        placeholder="INV-001" 
                    />
                    @error('invoice_number')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <x-inputs.textarea 
                    label="Notes" 
                    name="notes" 
                    model="notes" 
                    icon="fas fa-sticky-note"
                    rows="3"
                    placeholder="Add any additional notes..."
                />
                @error('notes')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end pt-4 space-x-4">
                <x-button type="button" style="clear" wire:click="cancel" icon="fas fa-times">
                    Cancel
                </x-button>

                <x-button type="submit" style="submit" icon="fas fa-save" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">Save Maintenance Record</span>
                    <span wire:loading wire:target="save">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Saving...
                    </span>
                </x-button>
            </div>
        </form>
    </div>
</div>