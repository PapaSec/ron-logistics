<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-boxes text-[#138898] mr-2"></i> Shipment Details
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Complete information for tracking number: {{ $shipment->tracking_number }}</p>
        </div>

        <div class="flex items-center space-x-3">
            <x-button style="back" href="{{ route('shipments.index') }}" icon="fas fa-arrow-left">
                Back to List
            </x-button>
            <x-button href="{{ route('shipments.edit', $shipment->id) }}" style="edit" icon="fas fa-edit">
                Edit Shipment
            </x-button>
        </div>
    </div>

    <!-- Tracking Number Banner -->
    <div class="bg-[#138898] rounded-xl p-6 text-white">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <p class="text-sm font-medium text-blue-100">Tracking Number</p>
                <h1 class="text-3xl font-bold mt-1 font-mono">{{ $shipment->tracking_number }}</h1>
                <p class="text-blue-100 mt-2 flex items-center">
                    <i class="fas fa-route mr-2"></i>
                    {{ $shipment->origin_city }} → {{ $shipment->destination_city }}
                </p>
            </div>
            <div class="mt-4 md:mt-0 text-right">
                <div class="text-sm text-blue-100">Current Status</div>
                <x-status-badge :status="$shipment->status" class="!text-white !border-white !bg-white/20 mt-1" />
            </div>
        </div>
    </div>

    <!-- Progress Tracking -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
            <i class="fas fa-shipping-fast text-[#138898] mr-3"></i>
            Delivery Progress
        </h3>
        
        <div class="space-y-4">
            <!-- Progress Bar -->
            <div class="relative pt-1">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Shipment Progress</span>
                    </div>
                    <div class="text-right">
                        <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">
                            @php
                                $progress = match($shipment->status) {
                                    'pending' => 25,
                                    'in_transit' => 65,
                                    'delivered' => 100,
                                    'cancelled' => 0,
                                    default => 0
                                };
                            @endphp
                            {{ $progress }}%
                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-3 mb-4 text-xs flex rounded-full bg-gray-300 dark:bg-gray-700">
                    <div style="width: {{ $progress }}%" 
                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-[#138898] transition-all duration-500"></div>
                </div>
            </div>

            <!-- Progress Steps -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @php
                    $steps = [
                        ['status' => 'pending', 'label' => 'Pending', 'icon' => 'fas fa-clock', 'description' => 'Shipment registered'],
                        ['status' => 'in_transit', 'label' => 'In Transit', 'icon' => 'fas fa-truck-moving', 'description' => 'On the way to destination'],
                        ['status' => 'out_for_delivery', 'label' => 'Out for Delivery', 'icon' => 'fas fa-truck', 'description' => 'Being delivered today'],
                        ['status' => 'delivered', 'label' => 'Delivered', 'icon' => 'fas fa-check-circle', 'description' => 'Successfully delivered'],
                    ];
                @endphp

                @foreach($steps as $step)
                    @php
                        $isActive = array_search($shipment->status, array_column($steps, 'status')) >= array_search($step['status'], array_column($steps, 'status'));
                        $isCurrent = $shipment->status === $step['status'];
                    @endphp
                    <div class="text-center">
                        <div class="relative">
                            <div class="mx-auto w-12 h-12 rounded-full flex items-center justify-center 
                                {{ $isActive ? 'bg-[#138898] text-white' : 'bg-gray-300 dark:bg-gray-700 text-gray-400' }}
                                {{ $isCurrent ? 'ring-4 ring-blue-200 dark:ring-blue-800' : '' }}">
                                <i class="{{ $step['icon'] }}"></i>
                            </div>
                            @if(!$loop->last)
                                <div class="hidden md:block absolute top-6 left-1/2 w-full h-0.5 
                                    {{ $isActive ? 'bg-[#138898]' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
                            @endif
                        </div>
                        <div class="mt-3">
                            <p class="text-sm font-medium {{ $isActive ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500' }}">
                                {{ $step['label'] }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">{{ $step['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Main Information Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Sender Information -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-user text-blue-500 mr-3"></i>
                Sender Information
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">{{ $shipment->sender_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $shipment->sender_phone }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Origin City</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $shipment->origin_city }}</p>
                </div>
            </div>
        </div>

        <!-- Receiver Information -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-user-tag text-green-500 mr-3"></i>
                Receiver Information
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">{{ $shipment->receiver_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $shipment->receiver_phone }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Destination City</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $shipment->destination_city }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Package Details -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
            <i class="fas fa-box text-yellow-500 mr-3"></i>
            Package Details
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <i class="fas fa-file-alt text-blue-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $shipment->description }}</p>
            </div>
            
            <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                <i class="fas fa-weight-hanging text-green-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Weight</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $shipment->weight }} kg</p>
            </div>
            
            <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                <i class="fas fa-cube text-purple-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Quantity</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $shipment->quantity }} items</p>
            </div>
            
            <div class="text-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                <i class="fas fa-dollar-sign text-orange-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Value</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">${{ number_format($shipment->value ?? 0, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Shipment Metadata -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-info-circle text-gray-500 mr-3"></i>
                Shipment Info
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Priority</span>
                    <span class="px-3 py-1 text-xs font-medium rounded-full 
                        {{ $shipment->priority === 'express' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300' : '' }}
                        {{ $shipment->priority === 'standard' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : '' }}
                        {{ $shipment->priority === 'economy' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}">
                        {{ ucfirst($shipment->priority) }}
                    </span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Created By</span>
                    <span class="text-sm text-gray-900 dark:text-white">{{ $shipment->user->name ?? 'System' }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Created Date</span>
                    <span class="text-sm text-gray-900 dark:text-white">{{ $shipment->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Schedule Information -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-calendar-alt text-blue-500 mr-3"></i>
                Schedule
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Pickup Date</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">
                        {{ $shipment->pickup_date->format('F d, Y') }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Estimated Delivery</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">
                        {{ $shipment->estimated_delivery_date->format('F d, Y') }}
                    </p>
                </div>
                <div class="pt-2">
                    <div class="text-xs text-gray-500 dark:text-gray-400 bg-gray-300 dark:bg-gray-800 p-2 rounded">
                        <i class="fas fa-clock mr-1"></i>
                        Estimated transit time: 
                        @php
                            $days = $shipment->pickup_date->diffInDays($shipment->estimated_delivery_date);
                        @endphp
                        {{ $days }} {{ Str::plural('day', $days) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                Quick Actions
            </h3>
            <div class="space-y-3">
                <x-button href="{{ route('shipments.edit', $shipment->id) }}" style="edit" class="w-full justify-center" icon="fas fa-edit">
                    Edit Shipment
                </x-button>
                <x-button style="print" class="w-full justify-center" icon="fas fa-print">
                    Print Details
                </x-button>
                <x-button style="back" href="{{ route('shipments.index') }}" class="w-full justify-center" icon="fas fa-arrow-left">
                    Back to List
                </x-button>
            </div>
        </div>
    </div>
</div>