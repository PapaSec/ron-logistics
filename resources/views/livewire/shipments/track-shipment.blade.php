<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                <div class="p-2 bg-[#138898] rounded-lg">
                    <i class="fas fa-route text-white text-xl"></i>
                </div>
                Track Shipment
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Enter tracking number to view shipment status and details</p>
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

    <!-- Flash Messages -->
    @if (session()->has('tracking_message'))
        <x-alert type="success">{{ session('tracking_message') }}</x-alert>
    @endif

    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-lg shadow-sm p-6">
        <!-- Search Form -->
        <div class="mb-6">
            <div class="max-w-2xl mx-auto">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-search mr-2 text-[#138898]"></i>
                        Enter Tracking Number
                    </h3>
                    
                    <form wire:submit.prevent="track" class="space-y-4">
                        <div>
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

                        <div class="flex gap-3">
                            <button 
                                type="submit"
                                class="flex-1 flex justify-center items-center px-4 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#138898] hover:bg-[#0f6b78] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#138898] transition-colors"
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
                            
                            @if($shipment)
                            <button 
                                type="button"
                                wire:click="resetSearch"
                                class="px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                            >
                                <i class="fas fa-times mr-2"></i>
                                Clear
                            </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Not Found Message -->
        @if($notFound)
        <div class="mb-6 max-w-2xl mx-auto">
            <x-alert type="error">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-circle text-red-500 mt-0.5 mr-3"></i>
                    <div>
                        <p class="font-medium">Shipment Not Found</p>
                        <p class="text-sm mt-1">No shipment found with tracking number "<strong>{{ $trackingNumber }}</strong>". Please verify and try again.</p>
                    </div>
                </div>
            </x-alert>
        </div>
        @endif

        <!-- Loading State -->
        <div wire:loading class="flex items-center justify-center py-12">
            <i class="fas fa-spinner fa-spin text-[#138898] text-2xl mr-3"></i>
            <span class="text-gray-600 dark:text-gray-400">Searching for shipment...</span>
        </div>

        <!-- Tracking Results -->
        @if($shipment)
        <div class="space-y-6">
            <!-- Shipment Header Card -->
            <div class="bg-gradient-to-r from-[#138898] to-[#0f6b78] rounded-lg p-6 text-white">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
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
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-6 border-t border-white/20">
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
                    <div>
                        <p class="text-sm opacity-90 mb-1">Progress</p>
                        <div class="flex items-center">
                            <div class="flex-1 bg-white/20 rounded-full h-2 mr-3">
                                <div class="bg-white h-2 rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                            <span class="text-lg font-medium">{{ $progress }}%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Tracker -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                    <i class="fas fa-route mr-2 text-[#138898]"></i>
                    Delivery Progress
                </h3>
                
                <div class="relative mb-6">
                    <div class="absolute left-0 right-0 top-5 h-0.5 bg-gray-200 dark:bg-gray-700"></div>
                    <div class="absolute left-0 top-5 h-0.5 bg-[#138898] transition-all duration-500"
                         style="width: {{ $progress }}%"></div>
                    
                    <div class="grid grid-cols-4 relative z-10">
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
                                <div class="mx-auto w-10 h-10 rounded-full flex items-center justify-center mb-2
                                    {{ $isActive ? 'bg-[#138898] text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-400' }}
                                    {{ $isCurrent ? 'ring-4 ring-[#138898]/30' : '' }}">
                                    <i class="fas {{ $step['icon'] }} text-sm"></i>
                                </div>
                                <p class="text-xs font-semibold {{ $isActive ? 'text-[#138898]' : 'text-gray-500' }}">
                                    {{ $step['label'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Contact Parties -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">Contact Parties</h4>
                        <div class="space-y-4">
                            <!-- Sender -->
                            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                                <div class="flex items-center mb-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-blue-600 dark:text-blue-400 text-sm"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Sender</span>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Name</p>
                                        <p class="text-sm text-gray-900 dark:text-white">{{ $shipment->sender_name }}</p>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Phone</p>
                                            <p class="text-sm text-gray-900 dark:text-white">{{ $this->maskPhone($shipment->sender_phone) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Location</p>
                                            <p class="text-sm text-gray-900 dark:text-white">{{ $shipment->origin_city }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Receiver -->
                            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                                <div class="flex items-center mb-3">
                                    <div class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center mr-3">
                                        <i class="fas fa-user-check text-green-600 dark:text-green-400 text-sm"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Receiver</span>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Name</p>
                                        <p class="text-sm text-gray-900 dark:text-white">{{ $shipment->receiver_name }}</p>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Phone</p>
                                            <p class="text-sm text-gray-900 dark:text-white">{{ $this->maskPhone($shipment->receiver_phone) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Location</p>
                                            <p class="text-sm text-gray-900 dark:text-white">{{ $shipment->destination_city }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Package Details -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">Package Details</h4>
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 h-full">
                            <div class="space-y-4">
                                <div>
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center mr-3">
                                            <i class="fas fa-box text-purple-600 dark:text-purple-400 text-sm"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">Description</span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $shipment->description }}</p>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-white dark:bg-gray-800 rounded p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Weight</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $shipment->weight }} kg</p>
                                    </div>
                                    <div class="bg-white dark:bg-gray-800 rounded p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Quantity</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $shipment->quantity }} items</p>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-white dark:bg-gray-800 rounded p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Pickup Date</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $shipment->pickup_date->format('M d, Y') }}</p>
                                    </div>
                                    <div class="bg-white dark:bg-gray-800 rounded p-3">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Priority</p>
                                        <span class="inline-flex items-center text-xs font-medium
                                            {{ $shipment->priority === 'express' ? 'text-purple-600 dark:text-purple-400' : '' }}
                                            {{ $shipment->priority === 'standard' ? 'text-blue-600 dark:text-blue-400' : '' }}
                                            {{ $shipment->priority === 'economy' ? 'text-gray-600 dark:text-gray-400' : '' }}">
                                            {{ ucfirst($shipment->priority) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support Card -->
            <div class="bg-gradient-to-r from-[#138898]/10 to-[#0f6b78]/10 dark:from-[#138898]/20 dark:to-[#0f6b78]/20 rounded-lg border border-[#138898]/20 p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-[#138898] rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-headset text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Need Help?</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Contact our support team for assistance</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-3">
                        <a href="tel:+27123456789" 
                           class="inline-flex items-center px-4 py-2 bg-[#138898] hover:bg-[#0f6b78] text-white rounded-lg transition-colors text-sm font-medium">
                            <i class="fas fa-phone mr-2"></i>
                            Call Support
                        </a>
                        <a href="mailto:support@ronlogistics.com" 
                           class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg transition-colors text-sm font-medium">
                            <i class="fas fa-envelope mr-2"></i>
                            Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>