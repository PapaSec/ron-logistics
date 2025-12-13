<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-truck text-[#138898] mr-2"></i> Vehicle Details
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Complete information for vehicle: {{ $vehicle->vehicle_number }}</p>
        </div>

        <div class="flex items-center space-x-3">
            <x-button style="back" href="{{ route('vehicles.index') }}" icon="fas fa-arrow-left">
                Back to List
            </x-button>
            <x-button href="{{ route('vehicles.edit', $vehicle->id) }}" style="edit" icon="fas fa-edit">
                Edit Vehicle
            </x-button>
        </div>
    </div>

    <!-- Vehicle Number Banner -->
    <div class="bg-[#138898] rounded-xl p-6 text-white">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <p class="text-sm font-medium text-blue-100">Vehicle Number</p>
                <h1 class="text-3xl font-bold mt-1 font-mono">{{ $vehicle->vehicle_number }}</h1>
                <p class="text-blue-100 mt-2 flex items-center">
                    <i class="fas fa-truck mr-2"></i>
                    {{ $vehicle->make }} {{ $vehicle->model }} 
                    @if($vehicle->year)
                        • {{ $vehicle->year }}
                    @endif
                </p>
            </div>
            <div class="mt-4 md:mt-0 text-right">
                <div class="text-sm text-blue-100">Current Status</div>
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium !text-white !border-white !bg-white/20 mt-1">
                    <i class="fas {{ $statusConfig['icon'] }} mr-2"></i>
                    {{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Maintenance Alert (if needed) -->
    @if($vehicle->needsMaintenance())
        <div class="bg-orange-50 dark:bg-orange-900/20 border-l-4 border-orange-500 p-4 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-orange-500 mr-3 text-xl"></i>
                <div>
                    <p class="text-orange-800 dark:text-orange-300 font-medium">Maintenance Required</p>
                    <p class="text-sm text-orange-700 dark:text-orange-400 mt-1">
                        This vehicle is due for maintenance 
                        @if($vehicle->next_maintenance)
                            on {{ $vehicle->next_maintenance->format('M d, Y') }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Information Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Basic Information -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                Basic Information
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Vehicle Number</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">{{ $vehicle->vehicle_number }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Vehicle Type</label>
                    <p class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">
                            <i class="fas fa-truck mr-1.5"></i>
                            {{ $vehicle->type }}
                        </span>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">License Plate</label>
                    <p class="mt-1">
                        <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-mono font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-700">
                            {{ $vehicle->license_plate }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Vehicle Details -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-car text-green-500 mr-3"></i>
                Vehicle Details
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Make</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">{{ $vehicle->make ?: 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Model</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">{{ $vehicle->model ?: 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Year</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $vehicle->year ?: 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Capacity & Performance Stats -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
            <i class="fas fa-chart-bar text-yellow-500 mr-3"></i>
            Capacity & Performance
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <i class="fas fa-weight-hanging text-blue-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Capacity</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                    {{ $vehicle->capacity ? number_format($vehicle->capacity) . ' kg' : 'N/A' }}
                </p>
            </div>
            
            <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                <i class="fas fa-check-circle text-green-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                    {{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}
                </p>
            </div>
            
            <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                <i class="fas fa-shipping-fast text-purple-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Shipments</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                    @php
                        try {
                            echo $vehicle->shipments()->whereIn('status', ['pending', 'in_transit'])->count();
                        } catch (\Exception $e) {
                            echo 0;
                        }
                    @endphp
                </p>
            </div>
            
            <div class="text-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                <i class="fas fa-box text-orange-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Shipments</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                    @php
                        try {
                            echo $vehicle->shipments()->count();
                        } catch (\Exception $e) {
                            echo 0;
                        }
                    @endphp
                </p>
            </div>
        </div>
    </div>

    <!-- Additional Information Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Maintenance Schedule -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-wrench text-blue-500 mr-3"></i>
                Maintenance Schedule
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Last Maintenance</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">
                        @if($vehicle->last_maintenance)
                            {{ $vehicle->last_maintenance->format('F d, Y') }}
                            <span class="block text-xs text-gray-500 mt-1">
                                ({{ $vehicle->last_maintenance->diffForHumans() }})
                            </span>
                        @else
                            <span class="text-gray-400">Not recorded</span>
                        @endif
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Next Maintenance</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">
                        @if($vehicle->next_maintenance)
                            {{ $vehicle->next_maintenance->format('F d, Y') }}
                            <span class="block text-xs text-gray-500 mt-1">
                                ({{ $vehicle->next_maintenance->diffForHumans() }})
                            </span>
                        @else
                            <span class="text-gray-400">Not scheduled</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Vehicle Metadata -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-info-circle text-gray-500 mr-3"></i>
                Vehicle Info
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Vehicle ID</span>
                    <span class="text-sm text-gray-900 dark:text-white font-medium">#{{ $vehicle->id }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Created Date</span>
                    <span class="text-sm text-gray-900 dark:text-white">{{ $vehicle->created_at->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Last Updated</span>
                    <span class="text-sm text-gray-900 dark:text-white">{{ $vehicle->updated_at->format('M d, Y') }}</span>
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
                <x-button href="{{ route('vehicles.edit', $vehicle->id) }}" style="edit" class="w-full justify-center" icon="fas fa-edit">
                    Edit Vehicle
                </x-button>
                <button 
                    wire:click="confirmDelete"
                    class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition flex items-center justify-center"
                >
                    <i class="fas fa-trash mr-2"></i>
                    Delete Vehicle
                </button>
                <x-button style="back" href="{{ route('vehicles.index') }}" class="w-full justify-center" icon="fas fa-arrow-left">
                    Back to List
                </x-button>
            </div>
        </div>
    </div>

    <!-- Notes Section (if exists) -->
    @if($vehicle->notes)
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-sticky-note text-yellow-500 mr-3"></i>
                Notes
            </h3>
            <div class="bg-white dark:bg-white/5 p-4 rounded-lg border border-gray-200 dark:border-white/10">
                <p class="text-sm text-gray-900 dark:text-white whitespace-pre-wrap">{{ $vehicle->notes }}</p>
            </div>
        </div>
    @endif

    <!-- Delete Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"></div>
            
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full p-6 z-10">
                    
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30">
                        <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl"></i>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Delete Vehicle?</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Are you sure you want to delete <strong>{{ $vehicle->vehicle_number }}</strong>? This action cannot be undone.
                        </p>
                    </div>
                    
                    <div class="mt-6 flex gap-3">
                        <button 
                            wire:click="cancelDelete"
                            class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                        >
                            Cancel
                        </button>
                        <button 
                            wire:click="delete"
                            class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                        >
                            Delete
                        </button>
                    </div>
                    
                </div>
            </div>
        </div>
    @endif
</div>