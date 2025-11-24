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

    <!-- Shipment Creation Form -->
    <div class="bg-[#E4EBE7] dark:bg-[#272d3e] rounded-lg shadow-sm border-gray-200 dark:border-gray-700 p-6">
        <form wire:submit.prevent="createShipment" class="space-y-6">
            <!-- Tracking Number (Readonly Display) -->
            <div></div>
            <!-- Sender Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-user-circle text-blue-600 mr-4 text-3xl"></i>Sender Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Sender Full Names Field -->
                    <div>
                        <label for="receiver_name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Full Names <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fas fa-user text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
                            </div>
                            <input type="text" id="sender_name" wire:model="sender_name"
                                class="pl-12 pr-4 py-3 text-gray-700 dark:text-white form-input block w-full rounded-lg shadow-sm border border-gray-500 focus:border-blue-500/50 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                                required placeholder="Enter full names">
                        </div>
                        @error('sender_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sender Phone -->
                    <div>
                        <label for="sender_phone"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Sender Phone <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fa-solid fa-address-book text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
                            </div>
                            <input type="text" id="sender_phone" wire:model="sender_phone"
                                class="pl-12 pr-4 py-3 text-gray-700 dark:text-white form-input block w-full rounded-lg shadow-sm border border-gray-500 focus:border-blue-500/50 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                                required placeholder="Enter Phone Number">
                        </div>
                        @error('sender_phone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Origin City -->
                    <div>
                        <label for="origin_city"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Origin City <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fa-regular fa-address-book text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
                            </div>
                            <input type="text" id="origin_city" wire:model="origin_city"
                                class="pl-12 pr-4 py-3 text-gray-700 dark:text-white form-input block w-full rounded-lg shadow-sm border border-gray-500 focus:border-blue-500/50 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                                required placeholder="Enter Origin City">
                        </div>
                        @error('origin_city')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Receiver Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-user-circle text-blue-600 mr-4 text-3xl"></i>Receiver Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Receiver Full Names Field -->
                    <div>
                        <label for="receiver_name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Full Names <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fas fa-user text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
                            </div>
                            <input type="text" id="receiver_name" wire:model="receiver_name"
                                class="pl-12 pr-4 py-3 text-gray-700 dark:text-white form-input block w-full rounded-lg shadow-sm border border-gray-500 focus:border-blue-500/50 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                                required placeholder="Enter full names">
                        </div>
                        @error('receiver_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sender Phone -->
                    <div>
                        <label for="receiver_phone"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Receiver Phone <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fa-solid fa-address-book text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
                            </div>
                            <input type="text" id="receiver_phone" wire:model="receiver_phone"
                                class="pl-12 pr-4 py-3 text-gray-700 dark:text-white form-input block w-full rounded-lg shadow-sm border border-gray-500 focus:border-blue-500/50 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                                required placeholder="Enter Phone Number">
                        </div>
                        @error('receiver_phone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Destination City -->
                    <div>
                        <label for="destination_city"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Destination City <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fa-regular fa-address-book text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
                            </div>
                            <input type="text" id="destination_city" wire:model="destination_city"
                                class="pl-12 pr-4 py-3 text-gray-700 dark:text-white form-input block w-full rounded-lg shadow-sm border border-gray-500 focus:border-blue-500/50 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                                required placeholder="Enter Origin City">
                        </div>
                        @error('destination_city')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Package Details -->
            <div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Description Field -->
                    <div>
                        <label for="description"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fas fa-user text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
                            </div>
                            <input type="text" id="description" wire:model="description"
                                class="pl-12 pr-4 py-3 text-gray-700 dark:text-white form-input block w-full rounded-lg shadow-sm border border-gray-500 focus:border-blue-500/50 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                                required placeholder="Enter Description">
                        </div>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Package weight -->
                    <div>
                        <label for="weight"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Weight <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fa-solid fa-address-book text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
                            </div>
                            <input type="text" id="weight" wire:model="weight"
                                class="pl-12 pr-4 py-3 text-gray-700 dark:text-white form-input block w-full rounded-lg shadow-sm border border-gray-500 focus:border-blue-500/50 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                                required placeholder="Enter Phone Number">
                        </div>
                        @error('weight')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Items -->
                    <div>
                        <label for="quantity"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Items <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fa-regular fa-address-book text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
                            </div>
                            <input type="text" id="quantity" wire:model="quantity"
                                class="pl-12 pr-4 py-3 text-gray-700 dark:text-white form-input block w-full rounded-lg shadow-sm border border-gray-500 focus:border-blue-500/50 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                                required placeholder="Enter Origin City">
                        </div>
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Additional form fields for Recipient Information, Package Details, etc. would go here -->

            <div class="flex justify-end">
                <x-button type="submit" style="submit" icon="fas fa-paper-plane">
                    Create Shipment
                </x-button>
            </div>
        </form>
    </div>
</div>