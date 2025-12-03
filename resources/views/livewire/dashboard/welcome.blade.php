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