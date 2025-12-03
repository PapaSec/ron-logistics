<div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl shadow-sm p-6 transition-colors duration-200">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            <i class="fas fa-chart-pie text-purple-500 mr-2"></i>
            Status Distribution
        </h3>
        <div class="text-xs text-gray-500">{{ now()->format('M d, Y') }}</div>
    </div>
    
    <!-- Modern Donut Chart -->
    <div class="h-48 mb-4">
        <canvas id="statusDonutChart"></canvas>
    </div>
    
    <!-- Status Breakdown -->
    <div class="space-y-3">
        @php
            $statuses = [
                'pending' => ['count' => $stats['pending'], 'color' => 'rgb(251, 191, 36)'],
                'in_transit' => ['count' => $stats['in_transit'], 'color' => 'rgb(59, 130, 246)'],
                'delivered' => ['count' => $stats['delivered'], 'color' => 'rgb(34, 197, 94)'],
                'cancelled' => ['count' => $stats['cancelled'], 'color' => 'rgb(239, 68, 68)']
            ];
        @endphp
        
        @foreach($statuses as $status => $data)
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <span class="w-3 h-3 rounded-full mr-3" style="background-color: {{ $data['color'] }}"></span>
                <span class="text-sm text-gray-700 dark:text-gray-300">
                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                </span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-sm font-medium text-gray-900 dark:text-white">
                    {{ $data['count'] }}
                </span>
                <span class="text-xs text-gray-500">
                    ({{ $stats['total'] > 0 ? round(($data['count'] / $stats['total']) * 100, 1) : 0 }}%)
                </span>
            </div>
        </div>
        @endforeach
    </div>
</div>