<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        
        <x-stats-card 
            title="Total Vehicles" 
            :value="$stats['total']" 
            icon="fas fa-car" 
            color="blue" 
            iconBg="bg-blue-400 dark:bg-blue-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Last 30 days" />

        <x-stats-card 
            title="Available Vehicles" 
            :value="$stats['available']"
            icon="fas fa-check-circle" 
            color="green" 
            iconBg="bg-green-400 dark:bg-green-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Last 30 days" />

        <x-stats-card 
            title="Under Maintenance" 
            :value="$stats['maintenance']" 
            icon="fas fa-tools" 
            color="purple" 
            iconBg="bg-purple-400 dark:bg-purple-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Last 30 days" />

        <x-stats-card 
            title="In Use Vehicles" 
            :value="$stats['in_use']"
            icon="fas fa-times-circle" 
            color="yellow" 
            iconBg="bg-yellow-400 dark:bg-yellow-950/50" 
            iconColor="text-white" 
            showTrend="true" 
            trendText="Last 30 days" />
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-truck-moving text-[#138898] mr-2"></i> All Vehicles List
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Manage and monitor all vehicles in your fleet</p>
        </div>
        <x-button href="{{ route('vehicles.create') }}" icon="fas fa-plus-circle">
            New Vehicle
        </x-button>
    </div>

    <!-- Flash Messages (NEW - much cleaner) -->
    @if (session()->has('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

    @if (session()->has('error'))
        <x-alert type="error">{{ session('error') }}</x-alert>
    @endif

    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-lg shadow-sm p-6">
        <x-table.wrapper>
    <x-table.header>
        <x-table.th>Vehicle #</x-table.th>
        <x-table.th>Type</x-table.th>
        <x-table.th>Make & Model</x-table.th>
        <x-table.th>Status</x-table.th>
        <x-table.th align="right">Actions</x-table.th>
    </x-table.header>

    <x-table.body>
        @forelse ($vehicles as $vehicle)
            <x-table.row>
                <x-table.cell>{{ $vehicle->vehicle_number }}</x-table.cell>
                <x-table.cell>{{ $vehicle->type }}</x-table.cell>
                <x-table.cell>{{ $vehicle->make }} {{ $vehicle->model }}</x-table.cell>
                <x-table.cell><x-status-badge :status="$vehicle->status" /></x-table.cell>
                <x-table.cell align="right">
                    <x-table.actions :viewRoute="route('vehicles.show', $vehicle)" :editRoute="route('vehicles.edit', $vehicle)" :deleteId="$vehicle->id" />
                </x-table.cell>
            </x-table.row>
        @empty
            <x-table.empty colspan="5" />
        @endforelse
    </x-table.body>
</x-table.wrapper>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $vehicles->links() }}
        </div>
    </div>
    
</div>
