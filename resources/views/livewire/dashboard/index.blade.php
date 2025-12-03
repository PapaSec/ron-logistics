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
            <x-button href="{{ route('shipments.create') }}" icon="fas fa-plus-circle">
                New Shipment
            </x-button>
        </div>
    </div>

    <!-- TOP METRICS ROW WITH PROFESSIONAL CHARTS -->
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

            <!-- Mini Chart Container -->
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-green-500 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i>+12%
                    </span>
                    <span class="text-gray-500">from last month</span>
                </div>
                <!-- Chart.js Mini Chart -->
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
                        ${{ number_format($stats['monthly_revenue'], 2) }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Monthly Revenue</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-green-600 dark:text-green-400 text-xl"></i>
                </div>
            </div>

            <!-- Mini Chart Container -->
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-green-500 font-medium">
                        <i class="fas fa-arrow-up mr-1"></i>+8.5%
                    </span>
                    <span class="text-gray-500">from last month</span>
                </div>
                <!-- Chart.js Mini Bar Chart -->
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

            <!-- Mini Chart Container -->
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-green-500 font-medium">
                        <i class="fas fa-check-circle mr-1"></i>+2.3%
                    </span>
                    <span class="text-gray-500">improvement</span>
                </div>
                <!-- Chart.js Donut Chart -->
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

            <!-- Mini Chart Container -->
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-blue-500 font-medium">3 on route</span>
                    <span class="text-gray-500">9 available</span>
                </div>
                <!-- Chart.js Stacked Bar Chart -->
                <div class="h-16">
                    <canvas id="miniChart4"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- MIDDLE SECTION - Main Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Shipment Trends Chart -->
        <div
            class="lg:col-span-2 bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl shadow-sm p-6 transition-colors duration-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    <i class="fas fa-chart-line text-blue-500 mr-2"></i>
                    Shipment Trends (Last 6 Months)
                </h3>
                <div class="flex items-center space-x-2">
                    <button
                        class="text-xs px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                        Monthly
                    </button>
                    <button
                        class="text-xs px-3 py-1 rounded-full text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800">
                        Weekly
                    </button>
                </div>
            </div>
            <!-- Main Area Chart -->
            <div class="h-64">
                <canvas id="mainAreaChart"></canvas>
            </div>
        </div>

        <!-- Status Distribution Chart -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl shadow-sm p-6 transition-colors duration-200">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                <i class="fas fa-chart-pie text-purple-500 mr-2"></i>
                Status Distribution
            </h3>

            <!-- Modern Donut with Inner Text -->
            <div class="relative h-64 flex items-center justify-center">
                <canvas id="modernStatusChart"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total Shipments</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div
            class="lg:col-span-2 bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl shadow-sm p-6 transition-colors duration-200">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                <i class="fas fa-history text-green-500 mr-2"></i>
                Recent Shipment Activity
            </h3>
            <div class="space-y-3">
                @php
                    $recentShipments = App\Models\Shipment::latest()->take(5)->get();
                @endphp

                @forelse($recentShipments as $shipment)
                    <div
                        class="flex items-start space-x-3 p-3 hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg transition-colors">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center 
                                        {{ $shipment->status === 'delivered' ? 'bg-green-100 dark:bg-green-900/30 text-green-600' : '' }}
                                        {{ $shipment->status === 'in_transit' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600' : '' }}
                                        {{ $shipment->status === 'pending' ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-600' : '' }}
                                        {{ $shipment->status === 'cancelled' ? 'bg-red-100 dark:bg-red-900/30 text-red-600' : '' }}">
                            <i
                                class="fas fa-{{ $shipment->status === 'delivered' ? 'check' : ($shipment->status === 'in_transit' ? 'truck' : ($shipment->status === 'pending' ? 'clock' : 'times')) }} text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                {{ $shipment->tracking_number }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $shipment->origin_city }} → {{ $shipment->destination_city }}
                            </p>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-xs font-medium text-gray-900 dark:text-white">
                                {{ $shipment->weight }} kg
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $shipment->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-400">
                        <i class="fas fa-inbox text-3xl mb-3"></i>
                        <p>No recent shipments</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl shadow-sm p-6 transition-colors duration-200">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                <i class="fas fa-tachometer-alt text-yellow-500 mr-2"></i>
                Quick Stats
            </h3>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Average Delivery Time</p>
                    <p class="text-xl font-bold text-gray-900 dark:text-white">2.3 days</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Shipments This Week</p>
                    <p class="text-xl font-bold text-gray-900 dark:text-white">147</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Revenue Today</p>
                    <p class="text-xl font-bold text-gray-900 dark:text-white">$1,845</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Pending Pickups</p>
                    <p class="text-xl font-bold text-gray-900 dark:text-white">23</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Scripts -->
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart.js default config for your theme
            const isDark = document.documentElement.classList.contains('dark');
            const gridColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
            const textColor = isDark ? '#9ca3af' : '#6b7280';

            Chart.defaults.color = textColor;
            Chart.defaults.borderColor = gridColor;

            // 1. Mini Sparkline - Total Shipments
            const miniChart1 = new Chart(document.getElementById('miniChart1'), {
                type: 'line',
                data: {
                    labels: ['', '', '', '', '', '', '', ''],
                    datasets: [{
                        data: {{ json_encode($weeklyData) }},
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { enabled: false } },
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    }
                }
            });

            // 2. Mini Bar Chart - Revenue
            const miniChart2 = new Chart(document.getElementById('miniChart2'), {
                type: 'bar',
                data: {
                    labels: ['', '', '', '', '', '', '', ''],
                    datasets: [{
                        data: [30, 40, 45, 50, 49, 60, 70, 91],
                        backgroundColor: 'rgba(34, 197, 94, 0.6)',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { enabled: false } },
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    }
                }
            });

            // 3. Donut Chart - On-Time Rate
            const modernStatusChart = new Chart(document.getElementById('modernStatusChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'In Transit', 'Delivered', 'Cancelled'],
                    datasets: [{
                        data: [
                            {{ $stats['pending'] }},
                            {{ $stats['in_transit'] }},
                            {{ $stats['delivered'] }},
                            {{ $stats['cancelled'] }}
                        ],
                        backgroundColor: [
                            'rgb(251, 191, 36)',
                            'rgb(59, 130, 246)',
                            'rgb(34, 197, 94)',
                            'rgb(239, 68, 68)'
                        ],
                        borderWidth: 0,
                        borderRadius: 8,
                        spacing: 2,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: isDark ? '#1f2937' : '#ffffff',
                            titleColor: isDark ? '#f9fafb' : '#111827',
                            bodyColor: isDark ? '#f9fafb' : '#111827',
                            borderColor: gridColor,
                            borderWidth: 1,
                        }
                    },
                    cutout: '75%',
                }
            });

            // 4. Mini Stacked Bar - Vehicles (placeholder data)
            const miniChart4 = new Chart(document.getElementById('miniChart4'), {
                type: 'bar',
                data: {
                    labels: [''],
                    datasets: [
                        {
                            data: [3],
                            backgroundColor: 'rgb(59, 130, 246)',
                        },
                        {
                            data: [9],
                            backgroundColor: 'rgb(34, 197, 94)',
                        }
                    ]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { enabled: false } },
                    scales: {
                        x: { display: false, stacked: true },
                        y: { display: false, stacked: true }
                    }
                }
            });

            // 5. Large Area Chart - Shipment Trends
            const mainAreaChart = new Chart(document.getElementById('mainAreaChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_column($monthlyData, 'month')) !!},
                    datasets: [{
                        label: 'Shipments',
                        data: {!! json_encode(array_column($monthlyData, 'count')) !!},
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: isDark ? '#1f2937' : '#ffffff',
                            titleColor: isDark ? '#f9fafb' : '#111827',
                            bodyColor: isDark ? '#f9fafb' : '#111827',
                            borderColor: gridColor,
                            borderWidth: 1,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: gridColor },
                            ticks: { color: textColor }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: textColor }
                        }
                    }
                }
            });

            // 6. Donut Chart - Status Distribution
            const statusDonutChart = new Chart(document.getElementById('statusDonutChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'In Transit', 'Delivered', 'Cancelled'],
                    datasets: [{
                        data: [
                                    {{ $stats['pending'] }},
                                    {{ $stats['in_transit'] }},
                                    {{ $stats['delivered'] }},
                            {{ $stats['cancelled'] }}
                        ],
                        backgroundColor: [
                            'rgb(251, 191, 36)',
                            'rgb(59, 130, 246)',
                            'rgb(34, 197, 94)',
                            'rgb(239, 68, 68)'
                        ],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { color: textColor, padding: 15 }
                        },
                        tooltip: {
                            backgroundColor: isDark ? '#1f2937' : '#ffffff',
                            titleColor: isDark ? '#f9fafb' : '#111827',
                            bodyColor: isDark ? '#f9fafb' : '#111827',
                            borderColor: gridColor,
                            borderWidth: 1,
                        }
                    },
                    cutout: '60%',
                }
            });
        });
    </script>
@endpush