<div class="space-y-6">
    @livewire('dashboard.welcome')

    @livewire('dashboard.top-metrics', ['stats' => $stats, 'weeklyData' => $weeklyData])

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @livewire('dashboard.shipment-trends', ['chartDataMonthly' => $chartDataMonthly, 'chartDataYearly' => $chartDataYearly])

        @livewire('dashboard.status-distribution', ['stats' => $stats])
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @livewire('dashboard.recent-activity')

        @livewire('dashboard.quick-stats')
    </div>
</div>

<!-- Chart.js Scripts -->
<script>
    // All chart data precomputed from server 
    const allChartData = {
        monthly: @json($chartDataMonthly),
        yearly: @json($chartDataYearly),
    };

    // Function to compute stats (mirrors PHP logic)
    function computeStats(data) {
        const total = data.reduce((sum, val) => sum + val, 0);
        const average = Math.round(total / data.length);
        const trend = data[data.length - 1] - data[0];
        const trendClass = trend >= 0 ? 'text-green-500' : 'text-red-500';
        return {
            total: total,
            average: average,
            trend: Math.abs(trend),
            trendClass: trendClass
        };
    }

    // Store chart instances globally so we can update them
    let shipmentTrendsChart = null;
    let miniChart1 = null;
    let miniChart2 = null;
    let miniChart3 = null;
    let miniChart4 = null;
    let statusDonutChart = null;

    document.addEventListener('DOMContentLoaded', function () {
        initializeCharts();

        // Trigger initial update for default timeFrame
        const alpineComponent = document.querySelector('[x-data]');
        if (alpineComponent) {
            const timeFrame = Alpine.$data(alpineComponent).timeFrame;
            updateMainChart(allChartData[timeFrame]);
            Alpine.$data(alpineComponent).currentStats = computeStats(allChartData[timeFrame].data);
        }
    });

    function initializeCharts() {
        const isDark = document.documentElement.classList.contains('dark');
        const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)'; // More subtle grids
        const textColor = isDark ? '#9ca3af' : '#6b7280';

        Chart.defaults.color = textColor;
        Chart.defaults.borderColor = gridColor;

        // 1. Mini Sparkline - Total Shipments (updated to smoother, modern look)
        miniChart1 = new Chart(document.getElementById('miniChart1'), {
            type: 'line',
            data: {
                labels: ['', '', '', '', '', '', '', ''],
                datasets: [{
                    data: @json($weeklyData),
                    borderColor: 'rgb(139, 92, 246)', // Purple like image
                    backgroundColor: createGradient(document.getElementById('miniChart1').getContext('2d'), isDark, 'rgb(139, 92, 246, 0.2)', 'rgb(139, 92, 246, 0)'),
                    borderWidth: 2,
                    fill: true,
                    tension: 0.5, // Smoother curve
                    pointRadius: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                scales: { x: { display: false }, y: { display: false } }
            }
        });

        // 2. Mini Bar Chart - Revenue (updated colors)
        miniChart2 = new Chart(document.getElementById('miniChart2'), {
            type: 'bar',
            data: {
                labels: ['', '', '', '', '', '', '', ''],
                datasets: [{
                    data: [30, 40, 45, 50, 49, 60, 70, 91],
                    backgroundColor: 'rgba(52, 211, 153, 0.6)', // Green like image
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                scales: { x: { display: false }, y: { display: false } }
            }
        });

        // 3. Mini Donut Chart - On-Time Rate (updated colors and cutout)
        miniChart3 = new Chart(document.getElementById('miniChart3'), {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [@json($stats['on_time_rate']), 100 - @json($stats['on_time_rate'])],
                    backgroundColor: ['rgb(139, 92, 246)', 'rgba(229, 231, 235, 0.1)'], // Purple
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                cutout: '75%', // Thinner ring for modern look
            }
        });

        // 4. Mini Stacked Bar - Vehicles (updated colors)
        miniChart4 = new Chart(document.getElementById('miniChart4'), {
            type: 'bar',
            data: {
                labels: [''],
                datasets: [
                    { data: [3], backgroundColor: 'rgb(59, 130, 246)', borderRadius: 4 },
                    { data: [9], backgroundColor: 'rgb(52, 211, 153)', borderRadius: 4 } // Green
                ]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                scales: { x: { display: false, stacked: true }, y: { display: false, stacked: true } }
            }
        });

        // 5. Main Shipment Trends Chart - Made more "insane" with stacked areas, gradients, smooth curves like images
        const mainChartCtx = document.getElementById('shipmentTrendsChart').getContext('2d');
        shipmentTrendsChart = new Chart(mainChartCtx, {
            type: 'line',
            data: {
                labels: allChartData.monthly.labels,
                datasets: [
                    {
                        label: 'Series 1',
                        data: allChartData.monthly.data.map(d => d * 0.6), // Dummy split for stacked look
                        borderColor: 'rgb(139, 92, 246)', // Purple line
                        backgroundColor: createGradient(mainChartCtx, isDark, 'rgba(139, 92, 246, 0.4)', 'rgba(139, 92, 246, 0)'),
                        borderWidth: 3,
                        fill: true,
                        tension: 0.5, // Smoother waves
                        pointBackgroundColor: 'rgb(139, 92, 246)',
                        pointBorderColor: isDark ? '#1f2431' : '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 0, // No points for clean look
                        pointHoverRadius: 5,
                    },
                    {
                        label: 'Series 2',
                        data: allChartData.monthly.data.map(d => d * 0.4), // Dummy lower series
                        borderColor: 'rgb(52, 211, 153)', // Green line
                        backgroundColor: createGradient(mainChartCtx, isDark, 'rgba(52, 211, 153, 0.4)', 'rgba(52, 211, 153, 0)'),
                        borderWidth: 3,
                        fill: true,
                        tension: 0.5,
                        pointRadius: 0,
                    }
                ]
            },
            options: getChartOptions(isDark, gridColor, textColor)
        });

        // 6. Status Donut Chart (updated cutout and colors for modern feel)
        statusDonutChart = new Chart(document.getElementById('statusDonutChart'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'In Transit', 'Delivered', 'Cancelled'],
                datasets: [{
                    data: [
                        @json($stats['pending']),
                        @json($stats['in_transit']),
                        @json($stats['delivered']),
                        @json($stats['cancelled'])
                    ],
                    backgroundColor: [
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(52, 211, 153, 0.8)', // Updated to green
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: isDark ? '#1f2431' : '#ffffff',
                    borderWidth: 2,
                    borderRadius: 6,
                    spacing: 4, // More spacing
                    hoverOffset: 16,
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
                        padding: 12,
                        callbacks: {
                            label: function (context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((context.parsed / total) * 100);
                                return `${context.label}: ${context.parsed} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '80%', // Thinner for insane modern look
            }
        });
    }

    function createGradient(ctx, isDark, startColor, endColor) {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, startColor || (isDark ? 'rgba(59, 130, 246, 0.4)' : 'rgba(59, 130, 246, 0.2)'));
        gradient.addColorStop(1, endColor || (isDark ? 'rgba(59, 130, 246, 0)' : 'rgba(59, 130, 246, 0)'));
        return gradient;
    }

    function getChartOptions(isDark, gridColor, textColor) {
        return {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }, // Hide legend for clean look
                tooltip: {
                    backgroundColor: isDark ? '#1f2937' : '#ffffff',
                    titleColor: isDark ? '#f9fafb' : '#111827',
                    bodyColor: isDark ? '#f9fafb' : '#111827',
                    borderColor: gridColor,
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: { label: (context) => `${context.dataset.label}: ${context.parsed.y}` } // Show series
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor, drawBorder: false },
                    ticks: { color: textColor, padding: 10, font: { size: 12 } },
                    border: { display: false },
                    stacked: true // For stacked area look
                },
                x: {
                    grid: { color: gridColor, drawBorder: false },
                    ticks: { color: textColor, padding: 10, font: { size: 12 } },
                    border: { display: false },
                    stacked: true
                }
            },
            interaction: { intersect: false, mode: 'index' },
            elements: {
                line: { shadowColor: 'rgba(0,0,0,0.3)', shadowBlur: 10, shadowOffsetX: 0, shadowOffsetY: 4 } // Add shadow for insane depth
            }
        };
    }

    function updateMainChart(chartData) {
        if (shipmentTrendsChart) {
            shipmentTrendsChart.data.labels = chartData.labels;
            shipmentTrendsChart.data.datasets[0].data = chartData.data.map(d => d * 0.6);
            shipmentTrendsChart.data.datasets[1].data = chartData.data.map(d => d * 0.4);
            shipmentTrendsChart.update();
        }
    }
</script>