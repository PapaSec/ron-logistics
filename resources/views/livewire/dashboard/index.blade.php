<div class="space-y-6">

    <!-- Welcome Message -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-chart-pie text-[#138898] mr-2"></i> Dashboard Overview
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Welcome back! Here's what's happening today.</p>
        </div>
        <div class="flex items-center space-x-3">
            <!-- Quick Action Buttons -->
            <x-button href="{{ route('shipments.create') }}" icon="fas fa-plus-circle">
                New Shipment
            </x-button>
        </div>
    </div>

    <!-- TOP METRICS ROW -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Total Shipments-->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] rounded-sm shadow-sm p-6 transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Shipments</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-boxes text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-xs text-green-500 font-medium">
                    <i class="fas fa-arrow-up mr-1"></i>+12% from last month
                </span>
            </div>
        </div>

        <!-- Card 2: Monthly Revenue -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        ${{ number_format($stats['monthly_revenue'], 2) }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Monthly Revenue</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-green-600 dark:text-green-400 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-xs text-green-500 font-medium">
                    <i class="fas fa-arrow-up mr-1"></i>+8.5% from last month
                </span>
            </div>
        </div>

        <!-- Card 3: On-Time Delivery -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['on_time_rate'] }}%</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">On-Time Delivery</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-xs text-green-500 font-medium">
                    <i class="fas fa-check-circle mr-1"></i>+2.3% improvement
                </span>
            </div>
        </div>

        <!-- Card 4: Active Vehicles -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['active_vehicles'] }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Active Vehicles</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-truck text-orange-600 dark:text-orange-400 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-xs text-gray-500">
                    3 on route, 9 available
                </span>
            </div>
        </div>
    </div>

    <!-- MIDDLE SECTION - Charts and Distribution -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Shipment Status Chart (Left) -->
        <div
            class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                <i class="fas fa-chart-line text-blue-500 mr-2"></i>
                Shipment Status Overview
            </h3>
            <div class="h-64 flex items-center justify-center text-gray-400">
                <!-- We'll add Chart.js here later -->
                <div class="text-center">
                    <i class="fas fa-chart-pie text-4xl mb-3"></i>
                    <p>Status Distribution Chart</p>
                    <p class="text-sm">(Chart.js will go here)</p>
                </div>
            </div>
        </div>

        <!-- Recent Activity (Right) -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                <i class="fas fa-history text-green-500 mr-2"></i>
                Recent Activity
            </h3>
            <div class="space-y-4">
                <!-- We'll add dynamic activity feed here -->
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-list-alt text-3xl mb-3"></i>
                    <p>Recent shipments timeline</p>
                    <p class="text-sm">(Will show last 5 shipments)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM SECTION - Detailed Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Status Breakdown -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                <i class="fas fa-chart-pie text-purple-500 mr-2"></i>
                Status Breakdown
            </h3>
            <div class="space-y-3">
                @foreach(['pending', 'in_transit', 'delivered', 'cancelled'] as $status)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-full mr-3 
                                {{ $status === 'pending' ? 'bg-amber-500' : '' }}
                                {{ $status === 'in_transit' ? 'bg-blue-500' : '' }}
                                {{ $status === 'delivered' ? 'bg-green-500' : '' }}
                                {{ $status === 'cancelled' ? 'bg-red-500' : '' }}">
                            </span>
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </span>
                        </div>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $stats[$status . '_shipments'] ?? 0 }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Priority Distribution -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                <i class="fas fa-flag text-yellow-500 mr-2"></i>
                Priority Distribution
            </h3>
            <div class="space-y-3">
                @foreach(['express', 'standard', 'economy'] as $priority)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span
                                class="px-3 py-1 text-xs font-medium rounded-full mr-3
                                {{ $priority === 'express' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300' : '' }}
                                {{ $priority === 'standard' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' : '' }}
                                {{ $priority === 'economy' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}">
                                {{ ucfirst($priority) }}
                            </span>
                        </div>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ Shipment::where('priority', $priority)->count() }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

</div>