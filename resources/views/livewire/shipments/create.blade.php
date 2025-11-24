<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-plus text-blue-500 mr-2"></i> Create New Shipments
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Add new shipments in our system</p>
        </div>

        <x-button style="back" href="{{ route('shipments.index') }}" icon="fas fa-arrow-left">
            Back to List
        </x-button>
    </div>

    <!-- Tracking Number Display -->
    <div
        class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border-blue-500 p-4 rounded-lg mb-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Tracking Number</p>
                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-1">
                    {{ $tracking_number }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    This tracking number will be auto-assigned to your shipment
                    <span class="inline-block w-2 h-2 bg-blue-500 rounded-full animate-pulse ml-2"></span>
                </p>
            </div>
            <div class="text-blue-500 dark:text-blue-400">
                <i class="fas fa-barcode text-4xl"></i>
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

    <!-- Shipment Creation Form -->
    <div class="bg-[#E4EBE7] dark:bg-[#272d3e] rounded-lg shadow-sm border-gray-200 dark:border-gray-700 p-6">
        <form wire:submit="save" class="space-y-6">
            <!-- Sender Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-user text-blue-600 mr-3"></i>Sender Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Sender Full Names Field -->
                    <div>
                        <label for="sender_name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Full Names <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" id="sender_name" wire:model="sender_name"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-input block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required placeholder="Enter full names">
                        </div>
                        @error('sender_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sender Phone -->
                    <div>
                        <label for="sender_phone"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Sender Phone <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input type="tel" id="sender_phone" wire:model="sender_phone"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-input block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required placeholder="Enter phone number">
                        </div>
                        @error('sender_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Origin City -->
                    <div>
                        <label for="origin_city"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Origin City <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-city text-gray-400"></i>
                            </div>
                            <input type="text" id="origin_city" wire:model="origin_city"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-input block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required placeholder="Enter origin city">
                        </div>
                        @error('origin_city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Receiver Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-user-tag text-blue-600 mr-3"></i>Receiver Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Receiver Full Names Field -->
                    <div>
                        <label for="receiver_name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Full Names <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" id="receiver_name" wire:model="receiver_name"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-input block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required placeholder="Enter full names">
                        </div>
                        @error('receiver_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Receiver Phone -->
                    <div>
                        <label for="receiver_phone"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Receiver Phone <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input type="tel" id="receiver_phone" wire:model="receiver_phone"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-input block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required placeholder="Enter phone number">
                        </div>
                        @error('receiver_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Destination City -->
                    <div>
                        <label for="destination_city"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Destination City <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <input type="text" id="destination_city" wire:model="destination_city"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-input block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required placeholder="Enter destination city">
                        </div>
                        @error('destination_city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Package Details -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-box text-blue-600 mr-3"></i>Package Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Description Field -->
                    <div>
                        <label for="description"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-file-alt text-gray-400"></i>
                            </div>
                            <input type="text" id="description" wire:model="description"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-input block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required placeholder="Enter description">
                        </div>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Package Weight -->
                    <div>
                        <label for="weight" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Weight (kg) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-weight text-gray-400"></i>
                            </div>
                            <input type="number" id="weight" wire:model="weight" step="0.01" min="0"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-input block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required placeholder="Enter weight">
                        </div>
                        @error('weight')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Items -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Items <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-cube text-gray-400"></i>
                            </div>
                            <input type="number" id="quantity" wire:model="quantity" min="1"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-input block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required placeholder="Enter quantity">
                        </div>
                        @error('quantity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Additional Package Details -->
            <div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Value Field -->
                    <div>
                        <label for="value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Value ($) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-dollar-sign text-gray-400"></i>
                            </div>
                            <input type="number" id="value" wire:model="value" step="0.01" min="0"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-input block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required placeholder="Enter value">
                        </div>
                        @error('value')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Priority <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-flag text-gray-400"></i>
                            </div>
                            <select id="priority" wire:model="priority"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-select block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required>
                                <option value="">Select priority</option>
                                <option value="standard">Standard</option>
                                <option value="express">Express</option>
                                <option value="economy">Economy</option>
                            </select>
                        </div>
                        @error('priority')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pickup Date -->
                    <div>
                        <label for="pickup_date"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Pickup Date <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-400"></i>
                            </div>
                            <input type="date" id="pickup_date" wire:model="pickup_date"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-input block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required>
                        </div>
                        @error('pickup_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Estimated Delivery Date -->
                    <div>
                        <label for="estimated_delivery_date"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Estimated Delivery Date <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-shipping-fast text-gray-400"></i>
                            </div>
                            <input type="date" id="estimated_delivery_date" wire:model="estimated_delivery_date"
                                class="pl-10 pr-4 py-2.5 text-gray-700 dark:text-white form-input block w-full rounded-lg border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 bg-white dark:bg-gray-800"
                                required>
                        </div>
                        @error('estimated_delivery_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 space-x-4">

                <!-- Clear Buutton -->
                <x-button type="button" style="clear" wire:click="resetForm" icon="fas fa-broom">
                    Clear
                </x-button>

                <!-- Submit Button -->
                <x-button type="submit" style="submit" icon="fas fa-paper-plane">
                    Create Shipment
                </x-button>
            </div>
        </form>
    </div>
</div>