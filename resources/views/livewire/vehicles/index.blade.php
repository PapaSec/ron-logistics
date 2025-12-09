<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <x-stats-card 
            title="Total Vehicles" 
            :value="$stats['total']" 
            icon="fas fa-truck" 
            color="blue"
            iconBg="bg-blue-400 dark:bg-blue-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Fleet size" 
        />

        <x-stats-card 
            title="Available" 
            :value="$stats['available']" 
            icon="fas fa-check-circle" 
            color="green"
            iconBg="bg-green-400 dark:bg-green-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Ready for dispatch" 
        />

        <x-stats-card 
            title="In Use" 
            :value="$stats['in_use']" 
            icon="fas fa-shipping-fast" 
            color="blue"
            iconBg="bg-blue-400 dark:bg-blue-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="On active routes" 
        />

        <x-stats-card 
            title="Maintenance" 
            :value="$stats['maintenance']" 
            icon="fas fa-wrench" 
            color="yellow"
            iconBg="bg-yellow-400 dark:bg-yellow-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Under service" 
        />
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-truck-moving text-[#138898] mr-2"></i> Fleet Management
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Manage and track all vehicles in your fleet</p>
        </div>
        <x-button href="{{ route('vehicles.create') }}" icon="fas fa-plus-circle">
            Add Vehicle
        </x-button>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

    @if (session()->has('error'))
        <x-alert type="error">{{ session('error') }}</x-alert>
    @endif

    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-lg shadow-sm p-6">
        <!-- Filters -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
            <!-- Search input -->
            <x-inputs.text 
                name="search" 
                placeholder="Search vehicles..." 
                icon="fas fa-search" 
                model="live"
            />

            <!-- Status filter -->
            <x-inputs.select 
                name="statusFilter" 
                model="statusFilter" 
                icon="fas fa-filter" 
                :options="[
                    'all' => 'All Status',
                    'available' => 'Available',
                    'in_use' => 'In Use',
                    'maintenance' => 'Maintenance',
                    'out_of_service' => 'Out of Service'
                ]" 
            />

            <!-- Type filter -->
            <x-inputs.select 
                name="typeFilter" 
                model="typeFilter" 
                icon="fas fa-truck" 
                :options="array_merge(
                    ['all' => 'All Types'],
                    collect($vehicleTypes)->mapWithKeys(fn($type) => [$type => $type])->toArray()
                )"
            />

            <!-- Per page selector -->
            <x-inputs.select 
                name="perPage" 
                model="perPage" 
                icon="fas fa-list-ol" 
                :options="[
                    '10' => '10 per page',
                    '25' => '25 per page',
                    '50' => '50 per page',
                    '100' => '100 per page'
                ]"
            />

            <!-- Clear Filters button -->
            <div>
                <x-button style="clear" wire:click="clearFilters" icon="fas fa-times-circle">
                    Clear Filters
                </x-button>
            </div>
        </div>

        <!-- Loading -->
        <div wire:loading class="flex items-center justify-center py-4">
            <i class="fas fa-spinner fa-spin text-blue-500 text-2xl mr-3"></i>
            <span class="text-gray-600 dark:text-gray-400">Loading vehicles...</span>
        </div>

        <!-- Vehicles Table -->
        <x-table.wrapper>
            <x-table.header>
                <x-table.th>Vehicle #</x-table.th>
                <x-table.th>Type</x-table.th>
                <x-table.th>Make & Model</x-table.th>
                <x-table.th>Year</x-table.th>
                <x-table.th>License Plate</x-table.th>
                <x-table.th>Capacity</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Last Maintenance</x-table.th>
                <x-table.th align="right">Actions</x-table.th>
            </x-table.header>

            <x-table.body>
                @forelse ($vehicles as $vehicle)
                    <x-table.row>
                        <!-- Vehicle Number -->
                        <x-table.cell>
                            <div class="font-medium text-gray-900 dark:text-white">
                                {{ $vehicle->vehicle_number }}
                            </div>
                        </x-table.cell>

                        <!-- Type -->
                        <x-table.cell>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">
                                <i class="fas fa-truck mr-1.5"></i>
                                {{ $vehicle->type }}
                            </span>
                        </x-table.cell>

                        <!-- Make & Model -->
                        <x-table.cell>
                            <div class="text-gray-900 dark:text-gray-300">
                                {{ $vehicle->make }} {{ $vehicle->model }}
                            </div>
                        </x-table.cell>

                        <!-- Year -->
                        <x-table.cell>
                            {{ $vehicle->year ?? 'N/A' }}
                        </x-table.cell>

                        <!-- License Plate -->
                        <x-table.cell>
                            <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-mono font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-700">
                                {{ $vehicle->license_plate }}
                            </span>
                        </x-table.cell>

                        <!-- Capacity -->
                        <x-table.cell>
                            <div class="flex items-center text-gray-700 dark:text-gray-300">
                                <i class="fas fa-weight-hanging mr-2 text-gray-400"></i>
                                {{ number_format($vehicle->capacity) }} kg
                            </div>
                        </x-table.cell>

                        <!-- Status -->
                        <x-table.cell>
                            @php
                                $statusConfig = [
                                    'available' => [
                                        'class' => 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300',
                                        'icon' => 'fa-check-circle'
                                    ],
                                    'in_use' => [
                                        'class' => 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300',
                                        'icon' => 'fa-truck-moving'
                                    ],
                                    'maintenance' => [
                                        'class' => 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300',
                                        'icon' => 'fa-wrench'
                                    ],
                                    'out_of_service' => [
                                        'class' => 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300',
                                        'icon' => 'fa-times-circle'
                                    ],
                                ];
                                $config = $statusConfig[$vehicle->status] ?? $statusConfig['available'];
                            @endphp
                            
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $config['class'] }}">
                                <i class="fas {{ $config['icon'] }} mr-1.5"></i>
                                {{ ucfirst(str_replace('_', ' ', $vehicle->status)) }}
                            </span>

                            <!-- Maintenance Alert -->
                            @if($vehicle->needsMaintenance())
                                <div class="mt-1">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 dark:bg-orange-900/50 text-orange-800 dark:text-orange-300">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Due soon
                                    </span>
                                </div>
                            @endif
                        </x-table.cell>

                        <!-- Last Maintenance -->
                        <x-table.cell>
                            @if($vehicle->last_maintenance)
                                <div class="text-gray-700 dark:text-gray-300">
                                    {{ $vehicle->last_maintenance->diffForHumans() }}
                                </div>
                                @if($vehicle->next_maintenance)
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        Next: {{ $vehicle->next_maintenance->format('M d, Y') }}
                                    </div>
                                @endif
                            @else
                                <span class="text-gray-400">Not recorded</span>
                            @endif
                        </x-table.cell>

                        <!-- Actions -->
                        <x-table.cell align="right">
                            <x-table.actions 
                                :viewRoute="route('vehicles.show', $vehicle->id)" 
                                :editRoute="route('vehicles.edit', $vehicle->id)" 
                                :deleteId="$vehicle->id" 
                            />
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.empty 
                        colspan="9" 
                        icon="fa-truck" 
                        title="No vehicles found" 
                        message="Try adjusting your search or filters, or add a new vehicle" 
                    />
                @endforelse
            </x-table.body>
        </x-table.wrapper>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $vehicles->links() }}
        </div>
    </div>

    <!-- Delete Modal -->
    @if ($deleteId)
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
                            Are you sure you want to delete this vehicle? This action cannot be undone.
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

    <!-- Scrollbar Styles -->
    <style>
        .table-scrollbar::-webkit-scrollbar { height: 6px; }
        .table-scrollbar::-webkit-scrollbar-track { background: transparent; border-radius: 10px; margin: 0 10px; }
        .table-scrollbar::-webkit-scrollbar-thumb { background: #023543; border-radius: 10px; }
        .table-scrollbar::-webkit-scrollbar-thumb:hover { background: #138898; }
        .dark .table-scrollbar::-webkit-scrollbar-thumb { background: #138898; }
        .table-scrollbar { scrollbar-width: thin; scrollbar-color: #138898 transparent; }
    </style>
</div>