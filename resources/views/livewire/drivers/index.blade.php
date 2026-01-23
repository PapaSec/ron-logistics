<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <x-stats-card 
            title="Total Drivers" 
            :value="$stats['total']" 
            icon="fas fa-users" 
            color="blue"
            iconBg="bg-blue-400 dark:bg-blue-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Fleet drivers" 
        />

        <x-stats-card 
            title="Active" 
            :value="$stats['active']" 
            icon="fas fa-user-check" 
            color="green"
            iconBg="bg-green-400 dark:bg-green-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="On duty" 
        />

        <x-stats-card 
            title="On Leave" 
            :value="$stats['on_leave']" 
            icon="fas fa-calendar-times" 
            color="yellow"
            iconBg="bg-yellow-400 dark:bg-yellow-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Currently away" 
        />

        <x-stats-card 
            title="License Expiring" 
            :value="$stats['license_expiring']" 
            icon="fas fa-exclamation-triangle" 
            color="red"
            iconBg="bg-red-400 dark:bg-red-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Within 30 days" 
        />
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-id-card text-[#138898] mr-2"></i> Driver Management
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Manage and track all drivers in your fleet</p>
        </div>
        <x-button href="{{ route('drivers.create') }}" icon="fas fa-plus-circle">
            Add Driver
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
                placeholder="Search drivers..." 
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
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    'on_leave' => 'On Leave',
                    'suspended' => 'Suspended'
                ]" 
            />

            <!-- Employment filter -->
            <x-inputs.select 
                name="employmentFilter" 
                model="employmentFilter" 
                icon="fas fa-briefcase" 
                :options="[
                    'all' => 'All Types',
                    'full_time' => 'Full Time',
                    'part_time' => 'Part Time',
                    'contract' => 'Contract'
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
            <span class="text-gray-600 dark:text-gray-400">Loading drivers...</span>
        </div>

        <!-- Drivers Table -->
        <div class="table-scrollbar overflow-x-auto">
            <x-table.wrapper>
                <x-table.header>
                    <x-table.th>Driver #</x-table.th>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Contact</x-table.th>
                    <x-table.th>License</x-table.th>
                    <x-table.th>Employment</x-table.th>
                    <x-table.th>Status</x-table.th>
                    <x-table.th>Assigned Vehicle</x-table.th>
                    <x-table.th align="right">Actions</x-table.th>
                </x-table.header>

                <x-table.body>
                    @forelse ($drivers as $driver)
                        <x-table.row>
                            <!-- Driver Number -->
                            <x-table.cell>
                                <div class="font-medium text-gray-900 dark:text-white">
                                    {{ $driver->driver_number }}
                                </div>
                            </x-table.cell>

                            <!-- Name -->
                            <x-table.cell>
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-[#138898] flex items-center justify-center text-white font-semibold">
                                            {{ substr($driver->first_name, 0, 1) }}{{ substr($driver->last_name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-gray-900 dark:text-white font-medium">
                                            {{ $driver->full_name }}
                                        </div>
                                        @if($driver->email)
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $driver->email }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </x-table.cell>

                            <!-- Contact -->
                            <x-table.cell>
                                <div class="text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-phone text-gray-400 mr-1"></i>
                                    {{ $driver->phone }}
                                </div>
                            </x-table.cell>

                            <!-- License -->
                            <x-table.cell>
                                <div class="text-gray-900 dark:text-gray-300">
                                    {{ $driver->license_number }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $driver->license_type }}
                                </div>
                                @if($driver->licenseExpiringSoon())
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 dark:bg-orange-900/50 text-orange-800 dark:text-orange-300 mt-1">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Expiring soon
                                    </span>
                                @endif
                            </x-table.cell>

                            <!-- Employment -->
                            <x-table.cell>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $driver->employment_type === 'full_time' ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300' : '' }}
                                    {{ $driver->employment_type === 'part_time' ? 'bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300' : '' }}
                                    {{ $driver->employment_type === 'contract' ? 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300' : '' }}">
                                    {{ ucfirst(str_replace('_', ' ', $driver->employment_type)) }}
                                </span>
                            </x-table.cell>

                            <!-- Status -->
                            <x-table.cell>
                                @php
                                    $statusConfig = [
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
                                    $config = $statusConfig[$driver->status] ?? $statusConfig['active'];
                                @endphp
                                
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $config['class'] }}">
                                    <i class="fas {{ $config['icon'] }} mr-1.5"></i>
                                    {{ ucfirst(str_replace('_', ' ', $driver->status)) }}
                                </span>
                            </x-table.cell>

                            <!-- Assigned Vehicle -->
                            <x-table.cell>
                                @php
                                    $assignedVehicle = $driver->vehicles()->first();
                                @endphp
                                @if($assignedVehicle)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">
                                        <i class="fas fa-truck mr-1.5"></i>
                                        {{ $assignedVehicle->vehicle_number }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm">Unassigned</span>
                                @endif
                            </x-table.cell>

                            <!-- Actions -->
                            <x-table.cell align="right">
                                <x-table.actions 
                                    :viewRoute="route('drivers.show', $driver->id)" 
                                    :editRoute="route('drivers.edit', $driver->id)" 
                                    :deleteId="$driver->id" 
                                />
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.empty 
                            colspan="8" 
                            icon="fa-users" 
                            title="No drivers found" 
                            message="Try adjusting your search or filters, or add a new driver" 
                        />
                    @endforelse
                </x-table.body>
            </x-table.wrapper>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $drivers->links() }}
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
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Delete Driver?</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Are you sure you want to delete this driver? This action cannot be undone.
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