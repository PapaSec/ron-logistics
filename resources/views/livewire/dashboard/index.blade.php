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
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Card 1 -->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] rounded-lg shadow-sm border border-gray-200 dark:border-gray-800 p-6 transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Shipments</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">1,234</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-950/50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-box text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] rounded-lg shadow-sm border border-gray-200 dark:border-gray-800 p-6 transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Active Deliveries</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">89</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-950/50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-truck text-green-600 dark:text-green-400 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Card 3 -->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] rounded-lg shadow-sm border border-gray-200 dark:border-gray-800 p-6 transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Completed</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">567</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-950/50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Card 4 -->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] rounded-lg shadow-sm border border-gray-200 dark:border-gray-800 p-6 transition-colors duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Revenue</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">$45K</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-950/50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-yellow-600 dark:text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>
        
    </div>
    
</div>