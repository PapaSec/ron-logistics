<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-plus text-[#138898] mr-2"></i> Add Fuel Record
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Record a new fuel transaction</p>
        </div>

        <x-button style="back" href="{{ route('fuel-maintenance.index') }}" icon="fas fa-arrow-left">
            Back to List
        </x-button>
    </div>

    <!-- Receipt Number Display -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-500/20 p-4 rounded-lg mb-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Receipt Number</p>
                <p class="text-2xl font-bold text-[#138898] mt-1">{{ $receipt_number }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    Auto-generated receipt number
                    <span class="inline-block w-2 h-2 bg-[#138898] rounded-full animate-pulse ml-2"></span>
                </p>
            </div>
            <div class="flex items-center gap-3">
                <button 
                    type="button"
                    wire:click="generateReceiptNumber"
                    class="text-sm text-[#138898] hover:text-[#023543] dark:text-[#138898] dark:hover:text-[#1fa8bd] transition font-medium"
                >
                    <i class="fas fa-sync-alt mr-1"></i> Regenerate
                </button>
                <div class="text-[#138898]">
                    <i class="fas fa-receipt text-4xl"></i>
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

    <!-- Fuel Record Form -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-lg shadow-sm p-6">
        <form wire:submit.prevent="save" class="space-y-6">
            @csrf

            <!-- Vehicle & Driver Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-truck text-[#138898] mr-3"></i>Vehicle & Driver
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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

                    <x-inputs.select 
                        label="Driver (Optional)" 
                        name="driver_id" 
                        model="driver_id" 
                        icon="fas fa-user"
                        :options="['' => 'Select driver'] + $drivers->mapWithKeys(function($driver) {
                            return [$driver->id => $driver->full_name . ' (' . $driver->driver_number . ')'];
                        })->toArray()"
                    />
                    @error('driver_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Fuel Details -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-gas-pump text-[#138898] mr-3"></i>Fuel Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-inputs.date 
                        label="Date" 
                        name="date" 
                        model="date" 
                        icon="fas fa-calendar"
                        required 
                    />
                    @error('date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.select 
                        label="Fuel Type" 
                        name="fuel_type" 
                        model="fuel_type" 
                        icon="fas fa-tint"
                        :options="$fuelTypes"
                        required 
                    />
                    @error('fuel_type')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.number 
                        label="Quantity (Liters)" 
                        name="quantity" 
                        model="quantity" 
                        icon="fas fa-tint"
                        placeholder="0.00" 
                        step="0.01"
                        min="0"
                        required 
                    />
                    @error('quantity')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.number 
                        label="Price per Liter (R)" 
                        name="price_per_liter" 
                        model="price_per_liter" 
                        icon="fas fa-dollar-sign"
                        placeholder="0.00" 
                        step="0.01"
                        min="0"
                        required 
                    />
                    @error('price_per_liter')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.number 
                        label="Total Cost (R)" 
                        name="total_cost" 
                        model="total_cost" 
                        icon="fas fa-calculator"
                        placeholder="0.00" 
                        step="0.01"
                        min="0"
                        required
                        readonly
                    />
                    @error('total_cost')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Odometer Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-tachometer-alt text-[#138898] mr-3"></i>Odometer Reading
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-inputs.number 
                        label="Current Odometer (km)" 
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
                        label="Distance Traveled (km)" 
                        name="distance_traveled" 
                        model="distance_traveled" 
                        icon="fas fa-road"
                        placeholder="0" 
                        step="0.01"
                        min="0"
                    />
                    @error('distance_traveled')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Location & Payment -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-map-marker-alt text-[#138898] mr-3"></i>Location & Payment
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <x-inputs.text 
                        label="Location" 
                        name="location" 
                        model="location" 
                        icon="fas fa-map-marker-alt"
                        placeholder="City/Area" 
                    />
                    @error('location')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="Fuel Station" 
                        name="station_name" 
                        model="station_name" 
                        icon="fas fa-gas-pump"
                        placeholder="Station name" 
                    />
                    @error('station_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="Receipt Number" 
                        name="receipt_number" 
                        model="receipt_number" 
                        icon="fas fa-receipt"
                        placeholder="Receipt #" 
                    />
                    @error('receipt_number')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.select 
                        label="Payment Method" 
                        name="payment_method" 
                        model="payment_method" 
                        icon="fas fa-credit-card"
                        :options="$paymentMethods"
                        required 
                    />
                    @error('payment_method')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Notes -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-sticky-note text-[#138898] mr-3"></i>Additional Notes
                </h3>
                <div>
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
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end pt-4 space-x-4">
                <x-button type="button" style="clear" wire:click="cancel" icon="fas fa-times">
                    Cancel
                </x-button>

                <x-button type="submit" style="submit" icon="fas fa-save" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">Save Fuel Record</span>
                    <span wire:loading wire:target="save">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Saving...
                    </span>
                </x-button>
            </div>
        </form>
    </div>
</div>