<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-wrench text-[#138898] mr-2"></i> Maintenance Record Details
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Complete maintenance service information</p>
        </div>

        <div class="flex items-center space-x-3">
            <x-button style="back" href="{{ route('fuel-maintenance.index') }}" icon="fas fa-arrow-left">
                Back to List
            </x-button>
            <x-button href="{{ route('fuel-maintenance.edit-maintenance', $maintenanceRecord->id) }}" style="edit" icon="fas fa-edit">
                Edit Record
            </x-button>
        </div>
    </div>

    <!-- Record Banner -->
    <div class="bg-[#138898] rounded-xl p-6 text-white">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <p class="text-sm font-medium text-blue-100">Maintenance Number</p>
                <h1 class="text-3xl font-bold mt-1 font-mono">{{ $maintenanceRecord->maintenance_number }}</h1>
                <p class="text-blue-100 mt-2 flex items-center">
                    <i class="fas fa-calendar mr-2"></i>
                    {{ $maintenanceRecord->date->format('F d, Y') }}
                </p>
            </div>
            <div class="mt-4 md:mt-0 text-right">
                <div class="text-sm text-blue-100">Status</div>
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium !text-white !border-white !bg-white/20 mt-1">
                    {{ ucfirst($maintenanceRecord->status) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Status Alerts -->
    @if($maintenanceRecord->isOverdue())
        <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-red-500 mr-3 text-xl"></i>
                <div>
                    <p class="text-red-800 dark:text-red-300 font-medium">Next Service Overdue</p>
                    <p class="text-sm text-red-700 dark:text-red-400 mt-1">
                        The next maintenance service is overdue. Please schedule immediately.
                    </p>
                </div>
            </div>
        </div>
    @elseif($maintenanceRecord->isDueSoon())
        <div class="bg-orange-50 dark:bg-orange-900/20 border-l-4 border-orange-500 p-4 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-clock text-orange-500 mr-3 text-xl"></i>
                <div>
                    <p class="text-orange-800 dark:text-orange-300 font-medium">Service Due Soon</p>
                    <p class="text-sm text-orange-700 dark:text-orange-400 mt-1">
                        Next maintenance service is due on {{ $maintenanceRecord->next_service_date->format('F d, Y') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Information Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Vehicle Information -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-truck text-blue-500 mr-3"></i>
                Vehicle Information
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Vehicle Number</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">{{ $maintenanceRecord->vehicle->vehicle_number }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Make & Model</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $maintenanceRecord->vehicle->make }} {{ $maintenanceRecord->vehicle->model }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Type</label>
                    <p class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">
                            {{ $maintenanceRecord->vehicle->type }}
                        </span>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Odometer at Service</label>
                    <p class="mt-1 text-lg text-gray-900 dark:text-white font-semibold">{{ number_format($maintenanceRecord->odometer_reading, 0) }} km</p>
                </div>
            </div>
        </div>

        <!-- Service Details -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-tools text-green-500 mr-3"></i>
                Service Details
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Maintenance Type</label>
                    <p class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300">
                            {{ ucfirst(str_replace('_', ' ', $maintenanceRecord->type)) }}
                        </span>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Service Provider</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">{{ $maintenanceRecord->service_provider ?? 'N/A' }}</p>
                </div>
                @if($maintenanceRecord->invoice_number)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Invoice Number</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white font-mono">{{ $maintenanceRecord->invoice_number }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
            <i class="fas fa-file-alt text-yellow-500 mr-3"></i>
            Service Description
        </h3>
        <div class="bg-white dark:bg-white/5 p-4 rounded-lg border border-gray-200 dark:border-white/10">
            <p class="text-sm text-gray-900 dark:text-white">{{ $maintenanceRecord->description }}</p>
        </div>
    </div>

    <!-- Cost Breakdown -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
            <i class="fas fa-calculator text-blue-500 mr-3"></i>
            Cost Breakdown
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <i class="fas fa-cogs text-blue-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Parts Cost</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">R {{ number_format($maintenanceRecord->parts_cost, 2) }}</p>
            </div>
            
            <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                <i class="fas fa-user-cog text-green-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Labor Cost</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">R {{ number_format($maintenanceRecord->labor_cost, 2) }}</p>
            </div>
            
            <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                <i class="fas fa-dollar-sign text-purple-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Cost</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">R {{ number_format($maintenanceRecord->total_cost, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Next Service Schedule -->
    @if($maintenanceRecord->next_service_date || $maintenanceRecord->next_service_odometer)
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                <i class="fas fa-calendar-plus text-orange-500 mr-3"></i>
                Next Service Schedule
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if($maintenanceRecord->next_service_date)
                    <div class="p-4 bg-white dark:bg-white/5 rounded-lg border border-gray-200 dark:border-white/10">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Next Service Date</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">
                                    {{ $maintenanceRecord->next_service_date->format('F d, Y') }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $maintenanceRecord->next_service_date->diffForHumans() }}
                                </p>
                            </div>
                            <i class="fas fa-calendar text-3xl text-gray-300 dark:text-gray-600"></i>
                        </div>
                    </div>
                @endif

                @if($maintenanceRecord->next_service_odometer)
                    <div class="p-4 bg-white dark:bg-white/5 rounded-lg border border-gray-200 dark:border-white/10">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Next Service Odometer</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">
                                    {{ number_format($maintenanceRecord->next_service_odometer, 0) }} km
                                </p>
                            </div>
                            <i class="fas fa-tachometer-alt text-3xl text-gray-300 dark:text-gray-600"></i>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Notes -->
    @if($maintenanceRecord->notes)
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-sticky-note text-yellow-500 mr-3"></i>
                Additional Notes
            </h3>
            <div class="bg-white dark:bg-white/5 p-4 rounded-lg border border-gray-200 dark:border-white/10">
                <p class="text-sm text-gray-900 dark:text-white whitespace-pre-wrap">{{ $maintenanceRecord->notes }}</p>
            </div>
        </div>
    @endif

    <!-- Record Information -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
            <i class="fas fa-info-circle text-gray-500 mr-3"></i>
            Record Information
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-3 bg-white dark:bg-white/5 rounded-lg">
                <p class="text-xs text-gray-500 dark:text-gray-400">Record ID</p>
                <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">#{{ $maintenanceRecord->id }}</p>
            </div>
            <div class="text-center p-3 bg-white dark:bg-white/5 rounded-lg">
                <p class="text-xs text-gray-500 dark:text-gray-400">Created</p>
                <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $maintenanceRecord->created_at->format('M d, Y') }}</p>
            </div>
            <div class="text-center p-3 bg-white dark:bg-white/5 rounded-lg">
                <p class="text-xs text-gray-500 dark:text-gray-400">Last Updated</p>
                <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $maintenanceRecord->updated_at->format('M d, Y') }}</p>
            </div>
            <div class="text-center p-3 bg-white dark:bg-white/5 rounded-lg">
                <p class="text-xs text-gray-500 dark:text-gray-400">Status</p>
                <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ ucfirst($maintenanceRecord->status) }}</p>
            </div>
        </div>
    </div>
</div>