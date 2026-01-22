<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Card 1: Total Shipments -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl shadow-sm p-6 transition-colors duration-200">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Shipments</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                <i class="fas fa-boxes text-blue-600 dark:text-blue-400 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-300 dark:border-gray-700">
            <div class="flex items-center justify-between text-xs">
                <span class="text-green-500 font-medium">
                    <i class="fas fa-arrow-up mr-1"></i>+12%
                </span>
                <span class="text-gray-500">from last month</span>
            </div>
            <div class="h-16">
                <canvas id="miniChart1"></canvas>
            </div>
        </div>
    </div>

    <!-- Card 2: Monthly Revenue -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl shadow-sm p-6 transition-colors duration-200">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">
                    R{{ number_format($stats['monthly_revenue'], 2) }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Fuel Cost</p>
            </div>
            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                <i class="fas fa-gas-pump text-green-600 dark:text-green-400 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-300 dark:border-gray-700">
            <div class="flex items-center justify-between text-xs">
                <span class="text-green-500 font-medium">
                    <i class="fas fa-arrow-up mr-1"></i>+8.5%
                </span>
                <span class="text-gray-500">from last month</span>
            </div>
            <div class="h-16">
                <canvas id="miniChart2"></canvas>
            </div>
        </div>
    </div>

    <!-- Card 3: On-Time Delivery -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl shadow-sm p-6 transition-colors duration-200">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['on_time_rate'] }}%</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">On-Time Delivery</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                <i class="fas fa-clock text-purple-600 dark:text-purple-400 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-300 dark:border-gray-700">
            <div class="flex items-center justify-between text-xs">
                <span class="text-green-500 font-medium">
                    <i class="fas fa-check-circle mr-1"></i>+2.3%
                </span>
                <span class="text-gray-500">improvement</span>
            </div>
            <div class="h-16 flex justify-center">
                <canvas id="miniChart3" class="w-16 h-16"></canvas>
            </div>
        </div>
    </div>

    <!-- Card 4: Active Vehicles -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl shadow-sm p-6 transition-colors duration-200">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['active_vehicles'] }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Active Vehicles</p>
            </div>
            <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                <i class="fas fa-truck text-orange-600 dark:text-orange-400 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-300 dark:border-gray-700">
            <div class="flex items-center justify-between text-xs">
                <span class="text-blue-500 font-medium">
                    {{ \App\Models\Vehicle::where('status', 'in_use')->count() }} on route
                </span>
                <span class="text-gray-500">
                    {{ \App\Models\Vehicle::where('status', 'available')->count() }} available
                </span>
            </div>
            <div class="h-16">
                <canvas id="miniChart4"></canvas>
            </div>
        </div>
    </div>
</div>