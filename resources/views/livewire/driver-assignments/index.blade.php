<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <x-stats-card 
            title="Total Vehicles" 
            :value="$stats['total_vehicles']" 
            icon="fas fa-truck" 
            color="blue"
            iconBg="bg-blue-400 dark:bg-blue-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Fleet size" 
        />

        <x-stats-card 
            title="Assigned" 
            :value="$stats['assigned']" 
            icon="fas fa-user-check" 
            color="green"
            iconBg="bg-green-400 dark:bg-green-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="With drivers" 
        />

        <x-stats-card 
            title="Unassigned" 
            :value="$stats['unassigned']" 
            icon="fas fa-user-times" 
            color="orange"
            iconBg="bg-orange-400 dark:bg-orange-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Need drivers" 
        />

        <x-stats-card 
            title="Active Drivers" 
            :value="$stats['active_drivers']" 
            icon="fas fa-users" 
            color="purple"
            iconBg="bg-purple-400 dark:bg-purple-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Available" 
        />
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-user-cog text-[#138898] mr-2"></i> Driver Assignments
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Assign and manage drivers for your fleet vehicles</p>
        </div>
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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
            <!-- Search input -->
            <x-inputs.text 
                name="search" 
                placeholder="Search vehicles or drivers..." 
                icon="fas fa-search" 
                model="live"
            />

            <!-- Status filter -->
            <x-inputs.select 
                name="statusFilter" 
                model="statusFilter" 
                icon="fas fa-filter" 
                :options="[
                    'all' => 'All Vehicles',
                    'assigned' => 'Assigned',
                    'unassigned' => 'Unassigned'
                ]" 
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
            <span class="text-gray-600 dark:text-gray-400">Loading assignments...</span>
        </div>

        <!-- Assignments Table with Scrollbar -->
        <div class="table-scrollbar overflow-x-auto">
            <x-table.wrapper>
                <x-table.header>
                    <x-table.th>Vehicle</x-table.th>
                    <x-table.th>Type</x-table.th>
                    <x-table.th>License Plate</x-table.th>
                    <x-table.th>Status</x-table.th>
                    <x-table.th>Assigned Driver</x-table.th>
                    <x-table.th>Driver Status</x-table.th>
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
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $vehicle->make }} {{ $vehicle->model }}
                                </div>
                            </x-table.cell>

                            <!-- Type -->
                            <x-table.cell>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">
                                    <i class="fas fa-truck mr-1.5"></i>
                                    {{ $vehicle->type }}
                                </span>
                            </x-table.cell>

                            <!-- License Plate -->
                            <x-table.cell>
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-mono font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-700">
                                    {{ $vehicle->license_plate }}
                                </span>
                            </x-table.cell>

                            <!-- Vehicle Status -->
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
                            </x-table.cell>

                            <!-- Assigned Driver -->
                            <x-table.cell>
                                @if($vehicle->driver)
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 flex-shrink-0">
                                            <div class="h-8 w-8 rounded-full bg-[#138898] flex items-center justify-center text-white text-xs font-semibold">
                                                {{ substr($vehicle->driver->first_name, 0, 1) }}{{ substr($vehicle->driver->last_name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm text-gray-900 dark:text-white font-medium">
                                                {{ $vehicle->driver->full_name }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $vehicle->driver->driver_number }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-user-slash mr-1.5"></i>
                                        Unassigned
                                    </span>
                                @endif
                            </x-table.cell>

                            <!-- Driver Status -->
                            <x-table.cell>
                                @if($vehicle->driver)
                                    @php
                                        $driverStatusConfig = [
                                            'active' => [
                                                'class' => 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300',
                                                'icon' => 'fa-check-circle'
                                            ],
                                            'inactive' => [
                                                'class' => 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300',
                                                'icon' => 'fa-times-circle'
                                            ],
                                            'on_leave' => [
                                                'class' => 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300',
                                                'icon' => 'fa-calendar-times'
                                            ],
                                            'suspended' => [
                                                'class' => 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300',
                                                'icon' => 'fa-ban'
                                            ],
                                        ];
                                        $driverConfig = $driverStatusConfig[$vehicle->driver->status] ?? $driverStatusConfig['active'];
                                    @endphp
                                    
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $driverConfig['class'] }}">
                                        <i class="fas {{ $driverConfig['icon'] }} mr-1.5"></i>
                                        {{ ucfirst(str_replace('_', ' ', $vehicle->driver->status)) }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </x-table.cell>

                            <!-- Actions -->
                            <x-table.cell align="right">
                                <div class="flex items-center justify-end gap-2">
                                    @if($vehicle->driver)
                                        <button 
                                            wire:click="openAssignModal({{ $vehicle->id }})"
                                            class="px-3 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 rounded-lg transition"
                                            title="Reassign Driver"
                                        >
                                            <i class="fas fa-sync-alt mr-1"></i>
                                            Reassign
                                        </button>
                                        <button 
                                            wire:click="openUnassignModal({{ $vehicle->id }})"
                                            class="px-3 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-lg transition"
                                            title="Unassign Driver"
                                        >
                                            <i class="fas fa-user-times mr-1"></i>
                                            Unassign
                                        </button>
                                    @else
                                        <button 
                                            wire:click="openAssignModal({{ $vehicle->id }})"
                                            class="px-3 py-1.5 text-xs font-medium text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 rounded-lg transition"
                                            title="Assign Driver"
                                        >
                                            <i class="fas fa-user-plus mr-1"></i>
                                            Assign
                                        </button>
                                    @endif
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.empty 
                            colspan="7" 
                            icon="fa-truck" 
                            title="No vehicles found" 
                            message="Try adjusting your search or filters" 
                        />
                    @endforelse
                </x-table.body>
            </x-table.wrapper>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $vehicles->links() }}
        </div>
    </div>

    <!-- Assign/Reassign Driver Modal -->
    @if ($showAssignModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"></div>
            
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full p-6 z-10">
                    
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            <i class="fas fa-user-cog text-[#138898] mr-2"></i>
                            Assign Driver
                        </h3>
                        <button 
                            wire:click="closeAssignModal"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Select a driver to assign to vehicle 
                            <strong class="text-gray-900 dark:text-white">
                                {{ $vehicles->where('id', $selectedVehicleId)->first()->vehicle_number ?? '' }}
                            </strong>
                        </p>
                    </div>

                    <div class="mb-6">
                        <x-inputs.select 
                            name="selectedDriverId" 
                            label="Driver" 
                            model="selectedDriverId" 
                            icon="fas fa-user"
                            :options="['' => 'Select a driver'] + $availableDrivers->mapWithKeys(function($driver) {
                                return [$driver->id => $driver->full_name . ' (' . $driver->driver_number . ')'];
                            })->toArray()"
                            required
                        />
                        @error('selectedDriverId')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="flex gap-3">
                        <button 
                            wire:click="closeAssignModal"
                            class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                        >
                            Cancel
                        </button>
                        <button 
                            wire:click="assignDriver"
                            class="flex-1 px-4 py-2 bg-[#138898] text-white rounded-lg hover:bg-[#0f6b78] transition"
                            wire:loading.attr="disabled"
                        >
                            <span wire:loading.remove wire:target="assignDriver">Assign Driver</span>
                            <span wire:loading wire:target="assignDriver">
                                <i class="fas fa-spinner fa-spin mr-2"></i>Assigning...
                            </span>
                        </button>
                    </div>
                    
                </div>
            </div>
        </div>
    @endif

    <!-- Unassign Driver Modal -->
    @if ($showUnassignModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"></div>
            
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full p-6 z-10">
                    
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 dark:bg-orange-900/30">
                        <i class="fas fa-user-times text-orange-600 dark:text-orange-400 text-xl"></i>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Unassign Driver?</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Are you sure you want to unassign the driver from 
                            <strong>{{ $vehicles->where('id', $unassignVehicleId)->first()->vehicle_number ?? '' }}</strong>?
                        </p>
                    </div>
                    
                    <div class="mt-6 flex gap-3">
                        <button 
                            wire:click="closeUnassignModal"
                            class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                        >
                            Cancel
                        </button>
                        <button 
                            wire:click="unassignDriver"
                            class="flex-1 px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition"
                        >
                            Unassign
                        </button>
                    </div>
                    
                </div>
            </div>
        </div>
    @endif

    <!-- Scrollbar Styles -->
    <style>
        /* Horizontal scrollbar for table */
        .table-scrollbar {
            overflow-x: auto;
            position: relative;
            scrollbar-width: thin;
            scrollbar-color: #138898 transparent;
        }

        /* Webkit scrollbar styles */
        .table-scrollbar::-webkit-scrollbar {
            height: 8px;
        }

        .table-scrollbar::-webkit-scrollbar-track {
            background: transparent;
            border-radius: 10px;
            margin: 0 10px;
        }

        .table-scrollbar::-webkit-scrollbar-thumb {
            background: #138898;
            border-radius: 10px;
            border: 2px solid #E4EBE7;
        }

        .table-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #0f6b78;
        }

        /* Dark mode styles */
        .dark .table-scrollbar {
            scrollbar-color: #138898 transparent;
        }

        .dark .table-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .dark .table-scrollbar::-webkit-scrollbar-thumb {
            background: #138898;
            border: 2px solid #1f2431;
        }

        .dark .table-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #0f6b78;
        }

        /* Firefox scrollbar styles */
        .table-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #138898 transparent;
        }

        /* Smooth scroll behavior */
        .table-scrollbar {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        /* Hide scrollbar when not needed */
        .table-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .table-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Show scrollbar on hover */
        .table-scrollbar:hover::-webkit-scrollbar {
            display: block;
        }

        .table-scrollbar:hover {
            -ms-overflow-style: auto;
            scrollbar-width: thin;
        }
    </style>
</div>