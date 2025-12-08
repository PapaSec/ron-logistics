<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Total Items -->
        <x-stats-card title="Total Items" :value="$stats['total']" icon="fas fa-box" color="blue"
            iconBg="bg-blue-400 dark:bg-blue-950/50" iconColor="text-white" showTrend="true" trendText="Last 30 days" />

        <!-- Pending -->
        <x-stats-card title="Pending Shipments" :value="$stats['pending']" icon="fas fa-hourglass-half" color="green"
            iconBg="bg-green-400 dark:bg-green-950/50" iconColor="text-white" showTrend="true"
            trendText="Last 30 days" />

        <!-- In Transit -->
        <x-stats-card title="In Transit" :value="$stats['in_transit']" icon="fas fa-shipping-fast" color="purple"
            iconBg="bg-purple-400 dark:bg-purple-950/50" iconColor="text-white" showTrend="true"
            trendText="Last 30 days" />

        <x-stats-card title="Delivered" :value="$stats['delivered']" icon="fas fa-truck" color="yellow"
            iconBg="bg-yellow-400 dark:bg-yellow-950/50" iconColor="text-white" showTrend="true"
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

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 p-4 rounded-lg mb-4">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                <p class="text-green-800 dark:text-green-300 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 p-4 rounded-lg mb-4">
            <div class="flex items-center">
                <i class="fas fa-times-circle text-red-500 mr-3 text-xl"></i>
                <p class="text-red-800 dark:text-red-300 font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-lg shadow-sm p-6">
        <!-- Filters -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
            <!-- Search input -->
            <x-inputs.text name="search" placeholder="Search Shipments..." icon="fas fa-search" model="live"
                value="{{ request('search') }}" />

            <!-- Status filter -->
            <x-inputs.select name="statusFilter" model="statusFilter" icon="fas fa-filter" :options="[
        'all' => 'All Status',
        'pending' => 'Pending',
        'in_transit' => 'In Transit',
        'delivered' => 'Delivered',
        'cancelled' => 'Cancelled'
    ]" selected="{{ $statusFilter ?? 'all' }}" />

            <!-- Priority filter -->
            <x-inputs.select name="priorityFilter" model="priorityFilter" icon="fas fa-flag" :options="[
        'all' => 'All Priority',
        'standard' => 'Standard',
        'express' => 'Express',
        'economy' => 'Economy'
    ]"
            selected="{{ $priorityFilter ?? 'all' }}" />

            <!-- Per page selector -->
            <x-inputs.select name="perPage" model="perPage" icon="fas fa-list-ol" :options="[
        '10' => '10 per page',
        '25' => '25 per page',
        '50' => '50 per page',
        '100' => '100 per page'
    ]"
    selected="{{ $perPage ?? '10' }}" />

            <!-- Clear Filters button - Always visible -->
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

        <!-- Shipments Table with Horizontal Scrollbar -->
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow table-scrollbar">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-[#138898]">
                        <!-- Headers -->
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Customer
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Origin
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Destination
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Weight
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Quantity
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Priority
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($shipments as $shipment)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">

                                <!-- Tracking Number -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $shipment->tracking_number }}
                                    </div>
                                </td>

                                <!-- Customer (Sender) -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-300">
                                        {{ $shipment->sender_name }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $shipment->sender_phone }}
                                    </div>
                                </td>

                                <!-- Origin -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                    {{ $shipment->origin_city }}
                                </td>

                                <!-- Destination -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                    {{ $shipment->destination_city }}
                                </td>

                                <!-- Description -->
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                    <div class="max-w-xs truncate">
                                        {{ $shipment->description }}
                                    </div>
                                </td>

                                <!-- Weight -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                    {{ $shipment->weight }} kg
                                </td>

                                <!-- Quantity -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                    {{ $shipment->quantity }}
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-status-badge :status="$shipment->status" />
                                </td>

                                <!-- Priority -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium rounded-full
                                                                                        {{ $shipment->priority === 'express' ? 'bg-purple-100 dark:bg-purple-950/50 text-purple-800 dark:text-purple-300' : '' }}
                                                                                        {{ $shipment->priority === 'standard' ? 'bg-blue-100 dark:bg-blue-950/50 text-blue-800 dark:text-blue-300' : '' }}
                                                                                        {{ $shipment->priority === 'economy' ? 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300' : '' }}
                                                                                    ">
                                        {{ ucfirst($shipment->priority) }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- View Button -->
                                        <a href="{{ route('shipments.show', $shipment->id) }}"
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('shipments.edit', $shipment->id) }}"
                                            class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <button wire:click="confirmDelete({{ $shipment->id }})"
                                            class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-6 py-12 text-center">
                                    <div class="text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-inbox text-4xl mb-4"></i>
                                        <p class="text-lg font-medium">No shipments found</p>
                                        <p class="text-sm">Try adjusting your search or filters</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $shipments->links() }}
        </div>
    </div>

    <!-- Delete Modal -->
    @if ($deleteId)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"></div>

            <!-- Modal -->
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full p-6 z-10">

                    <!-- Icon -->
                    <div
                        class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30">
                        <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl"></i>
                    </div>

                    <!-- Content -->
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Delete Shipment?</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Are you sure you want to delete this shipment? This action cannot be undone.
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex gap-3">
                        <button wire:click="cancelDelete"
                            class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Cancel
                        </button>
                        <button wire:click="delete"
                            class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Delete
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif

    <!-- Custom horizontal scrollbar styles -->
    <style>
        /* Webkit horizontal scrollbar styles */
        .table-scrollbar::-webkit-scrollbar {
            height: 6px;
        }

        .table-scrollbar::-webkit-scrollbar-track {
            background: transparent;
            border-radius: 10px;
            margin: 0 10px;
        }

        .table-scrollbar::-webkit-scrollbar-thumb {
            background: #023543;
            border-radius: 10px;
        }

        .table-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #138898;
        }

        /* Dark mode horizontal scrollbar styles */
        .dark .table-scrollbar::-webkit-scrollbar-thumb {
            background: #138898;
        }

        .dark .table-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #138898;
        }

        /* Firefox horizontal scrollbar styles */
        .table-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: #138898 transparent;
        }

        .dark .table-scrollbar {
            scrollbar-color: #138898 transparent;
        }
    </style>
</div>