<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-edit text-blue-500 mr-2"></i> Edit Shipment
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Editing shipment: {{ $tracking_number }}</p>
        </div>

        <x-button style="back" href="{{ route('shipments.index') }}" icon="fas fa-arrow-left">
            Back to List
        </x-button>
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

    <!-- Edit Form -->
    <div class="bg-[#E4EBE7] dark:bg-[#272d3e] rounded-lg shadow-sm p-6">
        <form wire:submit="update" class="space-y-6">
            <!-- Tracking Number Display (Read-only) -->
            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Tracking Number
                </label>
                <div class="text-lg font-mono font-bold text-gray-900 dark:text-white">
                    {{ $tracking_number }}
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Tracking number cannot be changed
                </p>
            </div>

            <!-- Rest of your form fields (same as create form) -->
            <!-- Sender Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-user text-blue-600 mr-3"></i>Sender Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-inputs.text label="Full Names" name="sender_name" model="sender_name" icon="fas fa-user"
                        placeholder="Enter full names" required />
                    @error('sender_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text label="Sender Phone" name="sender_phone" model="sender_phone" icon="fas fa-phone"
                        type="tel" placeholder="Enter phone number" required />
                    @error('sender_phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text label="Origin City" name="origin_city" model="origin_city" icon="fas fa-city"
                        placeholder="Enter origin city" required />
                    @error('origin_city')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Receiver Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-user-tag text-blue-600 mr-3"></i>Receiver Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-inputs.text label="Full Names" name="receiver_name" model="receiver_name" icon="fas fa-user"
                        placeholder="Enter full names" required />
                    @error('receiver_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text label="Receiver Phone" name="receiver_phone" model="receiver_phone"
                        icon="fas fa-phone" type="tel" placeholder="Enter phone number" required />
                    @error('receiver_phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text label="Destination City" name="destination_city" model="destination_city"
                        icon="fas fa-map-marker-alt" placeholder="Enter destination city" required />
                    @error('destination_city')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Package Details -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-box text-blue-600 mr-3"></i>Package Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-inputs.text label="Description" name="description" model="description" icon="fas fa-file-alt"
                        placeholder="Enter description" required />
                    @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.number label="Weight (kg)" name="weight" model="weight" icon="fas fa-weight"
                        placeholder="Enter weight" step="0.01" min="0" required />
                    @error('weight')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.number label="Items" name="quantity" model="quantity" icon="fas fa-cube"
                        placeholder="Enter quantity" min="1" required />
                    @error('quantity')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Additional Package Details -->
            <div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <x-inputs.number label="Value ($)" name="value" model="value" icon="fas fa-dollar-sign"
                        placeholder="Enter value" step="0.01" min="0" />
                    @error('value')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.select label="Status" name="status" model="status" icon="fas fa-info-circle" :options="[
        'pending' => 'Pending',
        'in_transit' => 'In Transit',
        'delivered' => 'Delivered',
        'cancelled' => 'Cancelled'
    ]" required />
                    @error('status')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.select label="Priority" name="priority" model="priority" icon="fas fa-flag" :options="[
        'standard' => 'Standard',
        'express' => 'Express',
        'economy' => 'Economy'
    ]" required />
                    @error('priority')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.date label="Pickup Date" name="pickup_date" model="pickup_date" icon="fas fa-calendar-alt"
                        required />
                    @error('pickup_date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.date label="Estimated Delivery Date" name="estimated_delivery_date"
                        model="estimated_delivery_date" icon="fas fa-shipping-fast" required />
                    @error('estimated_delivery_date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Add other form sections (Receiver, Package Details, etc.) same as create form -->

            <div class="flex justify-end pt-4 space-x-4">
                <x-button type="button" style="clear" wire:click="resetForm" icon="fas fa-undo">
                    Reset Changes
                </x-button>

                <x-button type="button" style="secondary" wire:click="cancel" icon="fas fa-times">
                    Cancel
                </x-button>

                <x-button type="submit" style="submit" icon="fas fa-save" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="update">Update Shipment</span>
                    <span wire:loading wire:target="update">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Updating...
                    </span>
                </x-button>
            </div>
        </form>
    </div>
</div>