<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <x-stats-card 
            title="Total Fuel Cost" 
            :value="'R ' . number_format($stats['total_fuel_cost'], 2)" 
            icon="fas fa-gas-pump" 
            color="blue"
            iconBg="bg-blue-400 dark:bg-blue-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Fuel expenses" 
        />

        <x-stats-card 
            title="Total Fuel (L)" 
            :value="number_format($stats['total_fuel_quantity'], 2)" 
            icon="fas fa-tint" 
            color="green"
            iconBg="bg-green-400 dark:bg-green-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Liters consumed" 
        />

        <x-stats-card 
            title="Maintenance Cost" 
            :value="'R ' . number_format($stats['total_maintenance_cost'], 2)" 
            icon="fas fa-wrench" 
            color="orange"
            iconBg="bg-orange-400 dark:bg-orange-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Service expenses" 
        />

        <x-stats-card 
            title="Overdue Services" 
            :value="$stats['overdue_maintenance']" 
            icon="fas fa-exclamation-triangle" 
            color="red"
            iconBg="bg-red-400 dark:bg-red-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Needs attention" 
        />
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-gas-pump text-[#138898] mr-2"></i> Fuel & Maintenance
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Track fuel consumption and maintenance records for your fleet</p>
        </div>
        <div class="flex gap-3">
            <x-button href="{{ route('fuel-maintenance.create-fuel') }}" icon="fas fa-plus-circle">
                Add Fuel Record
            </x-button>
            <x-button href="{{ route('fuel-maintenance.create-maintenance') }}" icon="fas fa-plus-circle">
                Add Maintenance
            </x-button>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

    @if (session()->has('error'))
        <x-alert type="error">{{ session('error') }}</x-alert>
    @endif

    <!-- Tabs -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-lg shadow-sm">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="flex -mb-px">
                <button 
                    wire:click="switchTab('fuel')"
                    class="flex items-center gap-2 px-6 py-4 text-sm font-medium border-b-2 transition {{ $activeTab === 'fuel' ? 'border-[#138898] text-[#138898]' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 hover:border-gray-300' }}"
                >
                    <i class="fas fa-gas-pump"></i>
                    Fuel Records
                </button>
                <button 
                    wire:click="switchTab('maintenance')"
                    class="flex items-center gap-2 px-6 py-4 text-sm font-medium border-b-2 transition {{ $activeTab === 'maintenance' ? 'border-[#138898] text-[#138898]' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 hover:border-gray-300' }}"
                >
                    <i class="fas fa-wrench"></i>
                    Maintenance Records
                </button>
            </nav>
        </div>

        <div class="p-6">
            <!-- Filters -->
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-4">
                <!-- Search -->
                <x-inputs.text 
                    name="search" 
                    placeholder="Search..." 
                    icon="fas fa-search" 
                    model="live"
                />

                <!-- Vehicle filter -->
                <x-inputs.select 
                    name="vehicleFilter" 
                    model="vehicleFilter" 
                    icon="fas fa-truck" 
                    :options="[
                        'all' => 'All Vehicles'
                    ] + $vehicles->pluck('vehicle_number', 'id')->toArray()" 
                />

                <!-- Date from -->
                <x-inputs.date 
                    name="dateFrom" 
                    placeholder="Date from" 
                    icon="fas fa-calendar" 
                    model="dateFrom"
                />

                <!-- Date to -->
                <x-inputs.date 
                    name="dateTo" 
                    placeholder="Date to" 
                    icon="fas fa-calendar" 
                    model="dateTo"
                />

                <!-- Per page -->
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

                <!-- Clear filters -->
                <x-button style="clear" wire:click="clearFilters" icon="fas fa-times-circle">
                    Clear
                </x-button>
            </div>

            <!-- Loading -->
            <div wire:loading class="flex items-center justify-center py-4">
                <i class="fas fa-spinner fa-spin text-blue-500 text-2xl mr-3"></i>
                <span class="text-gray-600 dark:text-gray-400">Loading records...</span>
            </div>

            <!-- Fuel Records Tab -->
            @if($activeTab === 'fuel')
                <x-table.wrapper>
                    <x-table.header>
                        <x-table.th>Date</x-table.th>
                        <x-table.th>Vehicle</x-table.th>
                        <x-table.th>Driver</x-table.th>
                        <x-table.th>Quantity (L)</x-table.th>
                        <x-table.th>Price/L</x-table.th>
                        <x-table.th>Total Cost</x-table.th>
                        <x-table.th>Odometer</x-table.th>
                        <x-table.th>Efficiency</x-table.th>
                        <x-table.th align="right">Actions</x-table.th>
                    </x-table.header>

                    <x-table.body>
                        @forelse ($fuelRecords as $record)
                            <x-table.row>
                                <!-- Date -->
                                <x-table.cell>
                                    <div class="font-medium text-gray-900 dark:text-white">
                                        {{ $record->date->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $record->date->diffForHumans() }}
                                    </div>
                                </x-table.cell>

                                <!-- Vehicle -->
                                <x-table.cell>
                                    <div class="font-medium text-gray-900 dark:text-white">
                                        {{ $record->vehicle->vehicle_number }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $record->vehicle->make }} {{ $record->vehicle->model }}
                                    </div>
                                </x-table.cell>

                                <!-- Driver -->
                                <x-table.cell>
                                    @if($record->driver)
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ $record->driver->full_name }}
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </x-table.cell>

                                <!-- Quantity -->
                                <x-table.cell>
                                    <span class="font-medium text-gray-900 dark:text-white">
                                        {{ number_format($record->quantity, 2) }} L
                                    </span>
                                </x-table.cell>

                                <!-- Price per Liter -->
                                <x-table.cell>
                                    R {{ number_format($record->price_per_liter, 2) }}
                                </x-table.cell>

                                <!-- Total Cost -->
                                <x-table.cell>
                                    <span class="font-semibold text-gray-900 dark:text-white">
                                        R {{ number_format($record->total_cost, 2) }}
                                    </span>
                                </x-table.cell>

                                <!-- Odometer -->
                                <x-table.cell>
                                    {{ number_format($record->odometer_reading, 0) }} km
                                    @if($record->distance_traveled)
                                        <div class="text-xs text-gray-500">
                                            +{{ number_format($record->distance_traveled, 0) }} km
                                        </div>
                                    @endif
                                </x-table.cell>

                                <!-- Fuel Efficiency -->
                                <x-table.cell>
                                    @if($record->fuel_efficiency)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300">
                                            {{ $record->fuel_efficiency }} km/L
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </x-table.cell>

                                <!-- Actions -->
                                <x-table.cell align="right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('fuel-maintenance.show-fuel', $record->id) }}" 
                                           class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300"
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('fuel-maintenance.edit-fuel', $record->id) }}" 
                                           class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-300"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.empty 
                                colspan="9" 
                                icon="fa-gas-pump" 
                                title="No fuel records found" 
                                message="Try adjusting your filters or add a new fuel record" 
                            />
                        @endforelse
                    </x-table.body>
                </x-table.wrapper>

                <!-- Pagination -->
                @if($fuelRecords->hasPages())
                    <div class="mt-4">
                        {{ $fuelRecords->links() }}
                    </div>
                @endif
            @endif

            <!-- Maintenance Records Tab -->
            @if($activeTab === 'maintenance')
                <x-table.wrapper>
                    <x-table.header>
                        <x-table.th>Date</x-table.th>
                        <x-table.th>Maintenance #</x-table.th>
                        <x-table.th>Vehicle</x-table.th>
                        <x-table.th>Type</x-table.th>
                        <x-table.th>Description</x-table.th>
                        <x-table.th>Cost</x-table.th>
                        <x-table.th>Status</x-table.th>
                        <x-table.th>Next Service</x-table.th>
                        <x-table.th align="right">Actions</x-table.th>
                    </x-table.header>

                    <x-table.body>
                        @forelse ($maintenanceRecords as $record)
                            <x-table.row>
                                <!-- Date -->
                                <x-table.cell>
                                    <div class="font-medium text-gray-900 dark:text-white">
                                        {{ $record->date->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $record->date->diffForHumans() }}
                                    </div>
                                </x-table.cell>

                                <!-- Maintenance Number -->
                                <x-table.cell>
                                    <span class="font-mono font-medium text-gray-900 dark:text-white">
                                        {{ $record->maintenance_number }}
                                    </span>
                                </x-table.cell>

                                <!-- Vehicle -->
                                <x-table.cell>
                                    <div class="font-medium text-gray-900 dark:text-white">
                                        {{ $record->vehicle->vehicle_number }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $record->vehicle->make }} {{ $record->vehicle->model }}
                                    </div>
                                </x-table.cell>

                                <!-- Type -->
                                <x-table.cell>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300">
                                        {{ ucfirst(str_replace('_', ' ', $record->type)) }}
                                    </span>
                                </x-table.cell>

                                <!-- Description -->
                                <x-table.cell>
                                    <div class="max-w-xs truncate text-gray-700 dark:text-gray-300">
                                        {{ $record->description }}
                                    </div>
                                </x-table.cell>

                                <!-- Cost -->
                                <x-table.cell>
                                    <span class="font-semibold text-gray-900 dark:text-white">
                                        R {{ number_format($record->total_cost, 2) }}
                                    </span>
                                </x-table.cell>

                                <!-- Status -->
                                <x-table.cell>
                                    @php
                                        $statusConfig = [
                                            'scheduled' => ['class' => 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300', 'icon' => 'fa-calendar'],
                                            'in_progress' => ['class' => 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300', 'icon' => 'fa-spinner'],
                                            'completed' => ['class' => 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300', 'icon' => 'fa-check-circle'],
                                            'cancelled' => ['class' => 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300', 'icon' => 'fa-times-circle'],
                                        ];
                                        $config = $statusConfig[$record->status] ?? $statusConfig['completed'];
                                    @endphp
                                    
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $config['class'] }}">
                                        <i class="fas {{ $config['icon'] }} mr-1.5"></i>
                                        {{ ucfirst($record->status) }}
                                    </span>
                                </x-table.cell>

                                <!-- Next Service -->
                                <x-table.cell>
                                    @if($record->next_service_date)
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ $record->next_service_date->format('M d, Y') }}
                                        </div>
                                        @if($record->isOverdue())
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300 mt-1">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                                Overdue
                                            </span>
                                        @elseif($record->isDueSoon())
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 dark:bg-orange-900/50 text-orange-800 dark:text-orange-300 mt-1">
                                                <i class="fas fa-clock mr-1"></i>
                                                Due soon
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </x-table.cell>

                                <!-- Actions -->
                                <x-table.cell align="right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('fuel-maintenance.show-maintenance', $record->id) }}" 
                                           class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300"
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('fuel-maintenance.edit-maintenance', $record->id) }}" 
                                           class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-300"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.empty 
                                colspan="9" 
                                icon="fa-wrench" 
                                title="No maintenance records found" 
                                message="Try adjusting your filters or add a new maintenance record" 
                            />
                        @endforelse
                    </x-table.body>
                </x-table.wrapper>

                <!-- Pagination -->
                @if($maintenanceRecords->hasPages())
                    <div class="mt-4">
                        {{ $maintenanceRecords->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
    
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