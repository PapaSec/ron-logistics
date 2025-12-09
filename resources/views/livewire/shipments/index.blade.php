<div class="space-y-6">
    <!-- Stats Cards (keep as is) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        
        <x-stats-card 
            title="Total Items" 
            :value="$stats['total']" 
            icon="fas fa-box" 
            color="blue" 
            iconBg="bg-blue-400 
            dark:bg-blue-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Last 30 days" />

        <x-stats-card 
            title="Pending 
            Shipments" 
            :value="$stats['pending']" 
            icon="fas fa-hourglass-half" 
            color="green" 
            iconBg="bg-green-400 dark:bg-green-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Last 30 days" />

        <x-stats-card 
            title="In Transit" 
            :value="$stats['in_transit']" 
            icon="fas fa-shipping-fast" 
            color="purple" 
            iconBg="bg-purple-400 dark:bg-purple-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Last 30 days" />

        <x-stats-card title="Delivered" 
            :value="$stats['delivered']" 
            icon="fas fa-truck" 
            color="yellow" 
            iconBg="bg-yellow-400 dark:bg-yellow-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Last 30 days" />
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-list-ul text-[#138898] mr-2"></i> All Shipments List
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Manage and track all shipments across your logistics network</p>
        </div>
        <x-button href="{{ route('shipments.create') }}" icon="fas fa-plus-circle">
            New Shipments
        </x-button>
    </div>

    <!-- Flash Messages (NEW - much cleaner) -->
    @if (session()->has('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

    @if (session()->has('error'))
        <x-alert type="error">{{ session('error') }}</x-alert>
    @endif

    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-lg shadow-sm p-6">
        <!-- Filters (keep as is) -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
            <x-inputs.text name="search" placeholder="Search Shipments..." icon="fas fa-search" model="live" value="{{ request('search') }}" />
            <x-inputs.select name="statusFilter" model="statusFilter" icon="fas fa-filter" :options="['all' => 'All Status', 'pending' => 'Pending', 'in_transit' => 'In Transit', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled']" selected="{{ $statusFilter ?? 'all' }}" />
            <x-inputs.select name="priorityFilter" model="priorityFilter" icon="fas fa-flag" :options="['all' => 'All Priority', 'standard' => 'Standard', 'express' => 'Express', 'economy' => 'Economy']" selected="{{ $priorityFilter ?? 'all' }}" />
            <x-inputs.select name="perPage" model="perPage" icon="fas fa-list-ol" :options="['10' => '10 per page', '25' => '25 per page', '50' => '50 per page', '100' => '100 per page']" selected="{{ $perPage ?? '10' }}" />
            <div>
                <x-button style="clear" wire:click="clearFilters" icon="fas fa-times-circle">
                    Clear Filters
                </x-button>
            </div>
        </div>

        <!-- Loading -->
        <div wire:loading class="flex items-center justify-center py-4">
            <i class="fas fa-spinner fa-spin text-blue-500 text-2xl mr-3"></i>
            <span class="text-gray-600 dark:text-gray-400">Loading shipments...</span>
        </div>

        <!-- Table (NEW - much cleaner) -->
        <x-table.wrapper>
            <x-table.header>
                <x-table.th>ID</x-table.th>
                <x-table.th>Customer</x-table.th>
                <x-table.th>Origin</x-table.th>
                <x-table.th>Destination</x-table.th>
                <x-table.th>Description</x-table.th>
                <x-table.th>Weight</x-table.th>
                <x-table.th>Quantity</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Priority</x-table.th>
                <x-table.th align="right">Actions</x-table.th>
            </x-table.header>

            <x-table.body>
                @forelse ($shipments as $shipment)
                    <x-table.row>
                        <x-table.cell>
                            <div class="font-medium text-gray-900 dark:text-white">
                                {{ $shipment->tracking_number }}
                            </div>
                        </x-table.cell>

                        <x-table.cell>
                            <div class="text-gray-900 dark:text-gray-300">{{ $shipment->sender_name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $shipment->sender_phone }}</div>
                        </x-table.cell>

                        <x-table.cell>{{ $shipment->origin_city }}</x-table.cell>
                        <x-table.cell>{{ $shipment->destination_city }}</x-table.cell>

                        <x-table.cell>
                            <div class="max-w-xs truncate">{{ $shipment->description }}</div>
                        </x-table.cell>

                        <x-table.cell>{{ $shipment->weight }} kg</x-table.cell>
                        <x-table.cell>{{ $shipment->quantity }}</x-table.cell>

                        <x-table.cell>
                            <x-status-badge :status="$shipment->status" />
                        </x-table.cell>

                        <x-table.cell>
                            <span class="px-3 py-1 text-xs font-medium rounded-full
                                {{ $shipment->priority === 'express' ? 'bg-purple-100 dark:bg-purple-950/50 text-purple-800 dark:text-purple-300' : '' }}
                                {{ $shipment->priority === 'standard' ? 'bg-blue-100 dark:bg-blue-950/50 text-blue-800 dark:text-blue-300' : '' }}
                                {{ $shipment->priority === 'economy' ? 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300' : '' }}">
                                {{ ucfirst($shipment->priority) }}
                            </span>
                        </x-table.cell>

                        <x-table.cell align="right">
                            <x-table.actions 
                                :viewRoute="route('shipments.show', $shipment->id)" 
                                :editRoute="route('shipments.edit', $shipment->id)" 
                                :deleteId="$shipment->id" 
                            />
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.empty colspan="10" icon="fa-inbox" title="No shipments found" message="Try adjusting your search or filters" />
                @endforelse
            </x-table.body>
        </x-table.wrapper>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $shipments->links() }}
        </div>
    </div>

    <!-- Delete Modal (keep as is or create component if you want) -->
    @if ($deleteId)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"></div>
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full p-6 z-10">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30">
                        <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl"></i>
                    </div>
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Delete Shipment?</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Are you sure you want to delete this shipment? This action cannot be undone.
                        </p>
                    </div>
                    <div class="mt-6 flex gap-3">
                        <button wire:click="cancelDelete" class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Cancel
                        </button>
                        <button wire:click="delete" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
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