<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div class="w-12 h-12 bg-[#138898] rounded-lg flex items-center justify-center">
                    <i class="fas fa-truck text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Ron Logistics</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400">Track your shipment in real-time</p>
        </div>

        <!-- Search Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
            <form wire:submit.prevent="track" class="space-y-4">
                <div>
                    <label for="trackingNumber" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-search mr-2"></i>
                        Enter Tracking Number
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="trackingNumber" 
                            wire:model="trackingNumber"
                            placeholder="e.g., SHIP-20231215-001"
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 rounded-lg border border-gray-300 dark:border-gray-600 focus:border-[#138898] focus:ring-2 focus:ring-[#138898]/20 transition-all"
                        >
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-barcode text-gray-400"></i>
                        </div>
                    </div>
                    @error('trackingNumber')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <button 
                    type="submit"
                    class="w-full px-6 py-3 bg-[#138898] hover:bg-[#0f6b78] text-white font-medium rounded-lg transition flex items-center justify-center gap-2"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove wire:target="track">
                        <i class="fas fa-search mr-2"></i>
                        Track Shipment
                    </span>
                    <span wire:loading wire:target="track">
                        <i class="fas fa-spinner fa-spin mr-2"></i>
                        Searching...
                    </span>
                </button>
            </form>
        </div>

        <!-- Not Found Message -->
        @if($notFound)
            <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 rounded-lg mb-6">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3 mt-0.5"></i>
                    <div>
                        <h3 class="text-red-800 dark:text-red-300 font-medium">Shipment Not Found</h3>
                        <p class="text-sm text-red-700 dark:text-red-400 mt-1">
                            No shipment found with tracking number "<strong>{{ $trackingNumber }}</strong>". 
                            Please check the number and try again.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Tracking Results -->
        @if($shipment)
            <div class="space-y-6">
                
                <!-- Status Header -->
                <div class="bg-[#138898] rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-sm text-blue-100">Tracking Number</p>
                            <h2 class="text-2xl font-bold font-mono mt-1">{{ $shipment->tracking_number }}</h2>
                        </div>
                        <button 
                            wire:click="resetSearch"
                            class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg transition text-sm"
                        >
                            <i class="fas fa-search mr-2"></i>
                            New Search
                        </button>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm">Current Status</p>
                            <p class="text-xl font-semibold mt-1">
                                {{ ucfirst(str_replace('_', ' ', $shipment->status)) }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-blue-100 text-sm">Route</p>
                            <p class="text-lg font-medium mt-1">
                                {{ $shipment->origin_city }} → {{ $shipment->destination_city }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        <i class="fas fa-route text-[#138898] mr-2"></i>
                        Delivery Progress
                    </h3>
                    
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Progress</span>
                            <span class="text-sm font-semibold text-[#138898]">{{ $progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                            <div 
                                class="bg-[#138898] h-3 rounded-full transition-all duration-500"
                                style="width: {{ $progress }}%"
                            ></div>
                        </div>
                    </div>

                    <!-- Progress Steps -->
                    <div class="grid grid-cols-4 gap-2">
                        @php
                            $steps = [
                                ['status' => 'pending', 'label' => 'Pending', 'icon' => 'fa-clock'],
                                ['status' => 'in_transit', 'label' => 'In Transit', 'icon' => 'fa-truck-moving'],
                                ['status' => 'out_for_delivery', 'label' => 'Out for Delivery', 'icon' => 'fa-shipping-fast'],
                                ['status' => 'delivered', 'label' => 'Delivered', 'icon' => 'fa-check-circle'],
                            ];
                            $currentIndex = array_search($shipment->status, ['pending', 'in_transit', 'out_for_delivery', 'delivered']);
                        @endphp

                        @foreach($steps as $index => $step)
                            @php
                                $isActive = $index <= $currentIndex;
                                $isCurrent = $shipment->status === $step['status'];
                            @endphp
                            <div class="text-center">
                                <div class="mx-auto w-12 h-12 rounded-full flex items-center justify-center mb-2
                                    {{ $isActive ? 'bg-[#138898] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-400' }}
                                    {{ $isCurrent ? 'ring-4 ring-blue-200 dark:ring-blue-800' : '' }}">
                                    <i class="fas {{ $step['icon'] }}"></i>
                                </div>
                                <p class="text-xs font-medium {{ $isActive ? 'text-[#138898]' : 'text-gray-500' }}">
                                    {{ $step['label'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shipment Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Sender Information -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-user text-blue-500 mr-2"></i>
                            Sender
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Name</p>
                                <p class="text-gray-900 dark:text-white font-medium">{{ $shipment->sender_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Phone</p>
                                <p class="text-gray-900 dark:text-white">{{ $this->maskPhone($shipment->sender_phone) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Location</p>
                                <p class="text-gray-900 dark:text-white">{{ $shipment->origin_city }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Receiver Information -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-user-tag text-green-500 mr-2"></i>
                            Receiver
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Name</p>
                                <p class="text-gray-900 dark:text-white font-medium">{{ $shipment->receiver_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Phone</p>
                                <p class="text-gray-900 dark:text-white">{{ $this->maskPhone($shipment->receiver_phone) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Location</p>
                                <p class="text-gray-900 dark:text-white">{{ $shipment->destination_city }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package Details -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-box text-yellow-500 mr-2"></i>
                        Package Details
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <i class="fas fa-file-alt text-blue-500 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Description</p>
                            <p class="text-gray-900 dark:text-white font-medium mt-1">{{ $shipment->description }}</p>
                        </div>
                        
                        <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <i class="fas fa-weight-hanging text-green-500 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Weight</p>
                            <p class="text-gray-900 dark:text-white font-medium mt-1">{{ $shipment->weight }} kg</p>
                        </div>
                        
                        <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                            <i class="fas fa-cube text-purple-500 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Quantity</p>
                            <p class="text-gray-900 dark:text-white font-medium mt-1">{{ $shipment->quantity }} items</p>
                        </div>
                    </div>
                </div>

                <!-- Delivery Schedule -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-calendar-alt text-orange-500 mr-2"></i>
                        Delivery Schedule
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Pickup Date</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $shipment->pickup_date->format('F d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Estimated Delivery</p>
                            <p class="text-gray-900 dark:text-white font-medium">{{ $shipment->estimated_delivery_date->format('F d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Priority</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                {{ $shipment->priority === 'express' ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300' : '' }}
                                {{ $shipment->priority === 'standard' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300' : '' }}
                                {{ $shipment->priority === 'economy' ? 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300' : '' }}">
                                {{ ucfirst($shipment->priority) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg p-6 text-center">
                    <i class="fas fa-headset text-[#138898] text-3xl mb-3"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Need Help?</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Contact our support team for assistance with your shipment
                    </p>
                    <div class="flex items-center justify-center gap-4">
                        <a href="tel:+27123456789" class="inline-flex items-center px-4 py-2 bg-[#138898] hover:bg-[#0f6b78] text-white rounded-lg transition">
                            <i class="fas fa-phone mr-2"></i>
                            Call Support
                        </a>
                        <a href="mailto:support@ronlogistics.com" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition">
                            <i class="fas fa-envelope mr-2"></i>
                            Email Us
                        </a>
                    </div>
                </div>

            </div>
        @endif

    </div>
</div>