<div class="lg:col-span-2 bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl shadow-sm p-6 transition-colors duration-200">
    <!-- Header with Alpine tabs -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                <i class="fas fa-chart-line text-[#138898] mr-2"></i>
                Shipment Analytics
            </h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Track your shipment performance</p>
        </div>
        
        <!-- Time Frame Tabs with Alpine -->
        <div x-data="{
            timeFrame: 'monthly',
            currentStats: {}
        }" 
        x-init="$watch('timeFrame', (value) => {
            updateMainChart(allChartData[value]);
            currentStats = computeStats(allChartData[value].data);
        })"
        class="inline-flex rounded-lg border border-gray-200 dark:border-gray-700 p-1 bg-white/50 dark:bg-gray-800/50">
            <button @click="timeFrame = 'monthly'" 
                    class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200"
                    :class="{ 'bg-[#138898] text-white shadow-sm' : timeFrame === 'monthly', 'text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400' : timeFrame !== 'monthly' }">
                Monthly
            </button>
            <button @click="timeFrame = 'yearly'" 
                    class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200"
                    :class="{ 'bg-[#138898] text-white shadow-sm' : timeFrame === 'yearly', 'text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400' : timeFrame !== 'yearly' }">
                Yearly
            </button>
        </div>
    </div>

    <!-- Chart Stats with Alpine bindings -->
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="text-center p-4 bg-white/50 dark:bg-gray-800/50 rounded-lg">
            <p x-text="currentStats.total" class="text-2xl font-bold text-gray-900 dark:text-white"></p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Total Shipments</p>
        </div>
        <div class="text-center p-4 bg-white/50 dark:bg-gray-800/50 rounded-lg">
            <p x-text="currentStats.average" class="text-2xl font-bold text-gray-900 dark:text-white"></p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Average</p>
        </div>
        <div class="text-center p-4 bg-white/50 dark:bg-gray-800/50 rounded-lg">
            <p x-text="currentStats.trend" :class="currentStats.trendClass" class="text-2xl font-bold"></p>
            <p class="text-xs text-gray-500 dark:text-gray-400">Growth</p>
        </div>
    </div>

    <!-- Main Chart Container -->
    <div class="h-64">
        <canvas id="shipmentTrendsChart"></canvas>
    </div>
</div>