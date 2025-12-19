<div class="min-h-screen bg-[#E4EBE7] dark:bg-[#1f2431] rounded-lg shadow-sm p-6">
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <div class="p-2 bg-[#138898] rounded-lg">
                            <i class="fas fa-route text-white text-xl"></i>
                        </div>
                        Track Shipment
                    </h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Enter your tracking number to view real-time shipment status
                    </p>
                </div>
                
                @if($shipment)
                <button 
                    wire:click="resetSearch"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                >
                    <i class="fas fa-search mr-2"></i>
                    New Search
                </button>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Search Form & Tracking Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Search Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        <i class="fas fa-search mr-2 text-[#138898]"></i>
                        Track Your Package
                    </h2>
                    
                    <form wire:submit.prevent="track" class="space-y-4">
                        <div>
                            <label for="trackingNumber" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tracking Number
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-barcode text-gray-400"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="trackingNumber" 
                                    wire:model="trackingNumber"
                                    placeholder="Enter tracking number (e.g., TRK-2024-001)"
                                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-[#138898] focus:border-transparent transition-colors"
                                >
                            </div>
                            @error('trackingNumber')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <button 
                            type="submit"
                            class="w-full flex justify-center items-center px-4 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#138898] hover:bg-[#0f6b78] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#138898] transition-colors"
                            wire:loading.attr="disabled"
                        >
                            <span wire:loading.remove wire:target="track">
                                <i class="fas fa-search mr-2"></i>
                                Track Shipment
                            </span>
                            <span wire:loading wire:target="track">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Tracking...
                            </span>
                        </button>
                    </form>
                </div>

                <!-- Not Found Message -->
                @if($notFound)
                <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800 dark:text-red-300">
                                Shipment Not Found
                            </h3>
                            <div class="mt-2 text-sm text-red-700 dark:text-red-400">
                                <p>No shipment found with tracking number <strong>"{{ $trackingNumber }}"</strong>.</p>
                                <p class="mt-1">Please verify the tracking number and try again.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Tracking Results -->
                @if($shipment)
                <div class="space-y-6">
                    <!-- Status Overview -->
                    <div class="bg-gradient-to-r from-[#138898] to-[#0f6b78] rounded-xl shadow-sm p-6 text-white">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <p class="text-sm opacity-90 mb-1">Tracking Number</p>
                                <h3 class="text-2xl font-bold font-mono">{{ $shipment->tracking_number }}</h3>
                            </div>
                            <div class="text-center md:text-right">
                                <p class="text-sm opacity-90 mb-1">Current Status</p>
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white/20 backdrop-blur-sm">
                                    <i class="fas fa-circle text-{{ $statusColor }}-400 mr-2 text-xs"></i>
                                    {{ ucfirst(str_replace('_', ' ', $shipment->status)) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-white/20">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm opacity-90 mb-1">Route</p>
                                    <p class="text-lg font-medium">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        {{ $shipment->origin_city }} → {{ $shipment->destination_city }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm opacity-90 mb-1">Expected Delivery</p>
                                    <p class="text-lg font-medium">
                                        <i class="far fa-calendar-alt mr-2"></i>
                                        {{ $shipment->estimated_delivery_date->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Tracker -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                            <i class="fas fa-route mr-2 text-[#138898]"></i>
                            Delivery Progress
                        </h3>
                        
                        <!-- Progress Bar -->
                        <div class="mb-8">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $progress }}% Complete
                                </span>
                                <span class="text-sm font-semibold text-[#138898]">
                                    {{ ucfirst(str_replace('_', ' ', $shipment->status)) }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-[#138898] h-2.5 rounded-full transition-all duration-500"
                                     style="width: {{ $progress }}%"></div>
                            </div>
                        </div>

                        <!-- Progress Steps -->
                        <div class="relative">
                            <div class="absolute left-0 right-0 top-5 h-0.5 bg-gray-200 dark:bg-gray-700"></div>
                            <div class="absolute left-0 top-5 h-0.5 bg-[#138898] transition-all duration-500"
                                 style="width: {{ $progress }}%"></div>
                            
                            <div class="grid grid-cols-4 relative z-10">
                                @php
                                    $steps = [
                                        ['status' => 'pending', 'label' => 'Pending', 'icon' => 'fa-clock', 'desc' => 'Order received'],
                                        ['status' => 'in_transit', 'label' => 'In Transit', 'icon' => 'fa-truck-moving', 'desc' => 'On the way'],
                                        ['status' => 'out_for_delivery', 'label' => 'Out for Delivery', 'icon' => 'fa-shipping-fast', 'desc' => 'Nearby'],
                                        ['status' => 'delivered', 'label' => 'Delivered', 'icon' => 'fa-check-circle', 'desc' => 'Arrived'],
                                    ];
                                    $currentIndex = array_search($shipment->status, ['pending', 'in_transit', 'out_for_delivery', 'delivered']);
                                @endphp

                                @foreach($steps as $index => $step)
                                    @php
                                        $isActive = $index <= $currentIndex;
                                        $isCurrent = $shipment->status === $step['status'];
                                    @endphp
                                    <div class="text-center">
                                        <div class="mx-auto w-10 h-10 rounded-full flex items-center justify-center mb-2
                                            {{ $isActive ? 'bg-[#138898] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-400' }}
                                            {{ $isCurrent ? 'ring-4 ring-[#138898]/30' : '' }}">
                                            <i class="fas {{ $step['icon'] }} text-sm"></i>
                                        </div>
                                        <p class="text-xs font-semibold {{ $isActive ? 'text-[#138898]' : 'text-gray-500' }}">
                                            {{ $step['label'] }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $step['desc'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Shipment Details -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                            <i class="fas fa-boxes mr-2 text-[#138898]"></i>
                            Shipment Details
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Package Info -->
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                            <i class="fas fa-box text-blue-600 dark:text-blue-400"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Package Description</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $shipment->description }}</p>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Weight</p>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $shipment->weight }} kg</p>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Quantity</p>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $shipment->quantity }} items</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Info -->
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                            <i class="fas fa-calendar-alt text-green-600 dark:text-green-400"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Schedule</p>
                                        <div class="mt-2 space-y-2">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-gray-500 dark:text-gray-400">Pickup Date</span>
                                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $shipment->pickup_date->format('M d, Y') }}</span>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-gray-500 dark:text-gray-400">Priority</span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    {{ $shipment->priority === 'express' ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300' : '' }}
                                                    {{ $shipment->priority === 'standard' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300' : '' }}
                                                    {{ $shipment->priority === 'economy' ? 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300' : '' }}">
                                                    {{ ucfirst($shipment->priority) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Contact & Parties Info -->
            <div class="space-y-6">
                @if($shipment)
                <!-- Contact Parties -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                        <i class="fas fa-users mr-2 text-[#138898]"></i>
                        Contact Parties
                    </h3>
                    
                    <div class="space-y-6">
                        <!-- Sender -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3 flex items-center">
                                <i class="fas fa-paper-plane mr-2 text-blue-500"></i>
                                Sender
                            </h4>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Name</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $shipment->sender_name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Phone</p>
                                    <p class="text-sm font-mono text-gray-900 dark:text-white">{{ $this->maskPhone($shipment->sender_phone) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Location</p>
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $shipment->origin_city }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Receiver -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3 flex items-center">
                                <i class="fas fa-user-check mr-2 text-green-500"></i>
                                Receiver
                            </h4>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Name</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $shipment->receiver_name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Phone</p>
                                    <p class="text-sm font-mono text-gray-900 dark:text-white">{{ $this->maskPhone($shipment->receiver_phone) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Location</p>
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $shipment->destination_city }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support Card -->
                <div class="bg-gradient-to-br from-[#138898]/10 to-[#0f6b78]/10 dark:from-[#138898]/20 dark:to-[#0f6b78]/20 rounded-xl shadow-sm border border-[#138898]/20 p-6">
                    <div class="text-center mb-4">
                        <div class="w-12 h-12 bg-[#138898] rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-headset text-white text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Need Help?</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            Our support team is here to help
                        </p>
                    </div>
                    
                    <div class="space-y-3">
                        <a href="tel:+27123456789" 
                           class="flex items-center justify-center px-4 py-2 bg-[#138898] hover:bg-[#0f6b78] text-white rounded-lg transition-colors text-sm font-medium">
                            <i class="fas fa-phone mr-2"></i>
                            Call Support
                        </a>
                        <a href="mailto:support@ronlogistics.com" 
                           class="flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg transition-colors text-sm font-medium">
                            <i class="fas fa-envelope mr-2"></i>
                            Email Support
                        </a>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
                            Available 24/7 for shipment inquiries
                        </p>
                    </div>
                </div>
                @else
                <!-- Empty State -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-truck text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Track Shipment</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Enter a tracking number to view shipment details, delivery progress, and contact information.
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>