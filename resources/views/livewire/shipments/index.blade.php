<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Total Items -->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] text-black/50 dark:text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold">{{ $stats['total'] }}</p>
                    <p class="text-sm opacity-60">Total Items</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-950/50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-box text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] text-black/50 dark:text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold">{{ $stats['pending'] }}</p>
                    <p class="text-sm opacity-60">Pending</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-950/50 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-p text-green-600 dark:text-green-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- In Transit -->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] text-black/50 dark:text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold">{{ $stats['in_transit'] }}</p>
                    <p class="text-sm opacity-60">In Transit</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-950/50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shipping-fast  text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Delivered -->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] text-black/50 dark:text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold">{{ $stats['delivered'] }}</p>
                    <p class="text-sm opacity-60">Delivered</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-950/50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-truck text-yellow-600 dark:text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-list-ul text-blue-500 mr-2"></i> All Shipments List
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Manage and track all shipments across your logistics network</p>
        </div>

        <x-button href="{{ route('shipments.create') }}" icon="fas fa-plus-circle">
            New Shipments
        </x-button>
    </div>

    <div class="bg-[#E4EBE7] dark:bg-[#272d3e] rounded-lg shadow-sm border-gray-200 dark:border-gray-700 p-6">
        <!-- Filters -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
            <!-- Search input -->
            <div class="relative">
                <div class="absolute inset-y-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
                </div>
                <input type="text" wire:model.live="search" placeholder="Search Shipments here..."
                    class="w-full pl-10 pr-4 py-2.5 bg-white/5 text-gray-700 dark:text-white placeholder-gray-500 rounded-xl border border-gray-500 focus:border-blue-500/50 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                    value="{{ request('search') }}">
            </div>

            <!-- Status filter -->
            <div>
                <select wire:model.live="statusFilter"
                    class="w-full px-4 py-2.5 bg-white/5 text-gray-700 dark:text-white border border-gray-500 rounded-xl focus:border-blue-500/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all">
                    <option value="all">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="in_transit">In Transit</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <!-- Priority filter -->
            <div>
                <select wire:model.live="priorityFilter"
                    class="w-full px-4 py-2.5 bg-white/5 text-gray-700 dark:text-white border border-gray-500 rounded-xl focus:border-blue-500/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all">
                    <option value="all">All Priority</option>
                    <option value="standard">Standard</option>
                    <option value="express">Express</option>
                    <option value="economy">Economy</option>
                </select>
            </div>

            <!-- Per page selector -->
            <div>
                <select wire:model.live="perPage"
                    class="w-full px-4 py-2.5 bg-white/5 text-gray-700 dark:text-white border border-gray-500 rounded-xl focus:border-blue-500/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>
            </div>

            <!-- Clear Filters button - Always visible -->
            <div>
                <button wire:click="clearFilters"
                    class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-xl transition-all duration-200">
                    <i class="fas fa-times-circle mr-2"></i>
                    Clear Filters
                </button>
            </div>
        </div>

        <!-- Shipments Table with Horizontal Scrollbar -->
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow table-scrollbar">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-blue-300 dark:bg-blue-500">
                        <!-- Headers -->
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Customer
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Origin
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Destination
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Weight
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Quantity
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Priority
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
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
                                        <a href="#"
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="#"
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