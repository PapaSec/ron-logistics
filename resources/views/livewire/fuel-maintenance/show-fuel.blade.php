<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-gas-pump text-[#138898] mr-2"></i> Fuel Record Details
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Complete information for fuel record</p>
        </div>

        <div class="flex items-center space-x-3">
            <x-button style="back" href="{{ route('fuel-maintenance.index') }}" icon="fas fa-arrow-left">
                Back to List
            </x-button>
            <x-button href="{{ route('fuel-maintenance.edit-fuel', $fuelRecord->id) }}" style="edit" icon="fas fa-edit">
                Edit Record
            </x-button>
        </div>
    </div>

    <!-- Record Banner -->
    <div class="bg-[#138898] rounded-xl p-6 text-white">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <p class="text-sm font-medium text-blue-100">Receipt Number</p>
                <h1 class="text-3xl font-bold mt-1 font-mono">{{ $fuelRecord->receipt_number ?? 'N/A' }}</h1>
                <p class="text-blue-100 mt-2 flex items-center">
                    <i class="fas fa-calendar mr-2"></i>
                    {{ $fuelRecord->date->format('F d, Y') }}
                </p>
            </div>
            <div class="mt-4 md:mt-0 text-right">
                <div class="text-sm text-blue-100">Total Cost</div>
                <div class="text-3xl font-bold mt-1">R {{ number_format($fuelRecord->total_cost, 2) }}</div>
            </div>
        </div>
    </div>

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
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">{{ $fuelRecord->vehicle->vehicle_number }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Make & Model</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $fuelRecord->vehicle->make }} {{ $fuelRecord->vehicle->model }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Type</label>
                    <p class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">
                            {{ $fuelRecord->vehicle->type }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Driver Information -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-user text-green-500 mr-3"></i>
                Driver Information
            </h3>
            <div class="space-y-4">
                @if($fuelRecord->driver)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Driver Name</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">{{ $fuelRecord->driver->full_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Driver Number</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $fuelRecord->driver->driver_number }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Phone</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $fuelRecord->driver->phone }}</p>
                    </div>
                @else
                    <p class="text-gray-400 text-sm italic">No driver assigned to this record</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Fuel Details -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
            <i class="fas fa-tint text-yellow-500 mr-3"></i>
            Fuel Details
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <i class="fas fa-tint text-blue-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Quantity</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ number_format($fuelRecord->quantity, 2) }} L</p>
            </div>
            
            <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                <i class="fas fa-dollar-sign text-green-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Price per Liter</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">R {{ number_format($fuelRecord->price_per_liter, 2) }}</p>
            </div>
            
            <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                <i class="fas fa-file-invoice-dollar text-purple-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Cost</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">R {{ number_format($fuelRecord->total_cost, 2) }}</p>
            </div>
            
            <div class="text-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                <i class="fas fa-fire text-orange-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fuel Type</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $fuelRecord->fuel_type }}</p>
            </div>
        </div>
    </div>

    <!-- Odometer & Efficiency -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-tachometer-alt text-blue-500 mr-3"></i>
                Odometer Reading
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Current Reading</label>
                    <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($fuelRecord->odometer_reading, 0) }} km</p>
                </div>
                @if($fuelRecord->distance_traveled)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Distance Traveled</label>
                        <p class="mt-1 text-lg text-gray-900 dark:text-white font-semibold">{{ number_format($fuelRecord->distance_traveled, 0) }} km</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-chart-line text-green-500 mr-3"></i>
                Fuel Efficiency
            </h3>
            <div class="space-y-4">
                @if($fuelRecord->fuel_efficiency)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Efficiency (km/L)</label>
                        <p class="mt-1 text-2xl font-bold text-green-600 dark:text-green-400">{{ $fuelRecord->fuel_efficiency }} km/L</p>
                    </div>
                    <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <p class="text-sm text-green-800 dark:text-green-300">
                            <i class="fas fa-leaf mr-2"></i>
                            @if($fuelRecord->fuel_efficiency > 10)
                                Excellent fuel efficiency
                            @elseif($fuelRecord->fuel_efficiency > 7)
                                Good fuel efficiency
                            @else
                                Below average efficiency
                            @endif
                        </p>
                    </div>
                @else
                    <p class="text-gray-400 text-sm italic">Distance traveled not recorded</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Location & Payment Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-map-marker-alt text-red-500 mr-3"></i>
                Location
            </h3>
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">City/Area</label>
                    <p class="text-sm text-gray-900 dark:text-white font-medium">{{ $fuelRecord->location ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Fuel Station</label>
                    <p class="text-sm text-gray-900 dark:text-white">{{ $fuelRecord->station_name ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-credit-card text-purple-500 mr-3"></i>
                Payment
            </h3>
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Payment Method</label>
                    <p class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300">
                            {{ ucfirst(str_replace('_', ' ', $fuelRecord->payment_method)) }}
                        </span>
                    </p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Receipt Number</label>
                    <p class="text-sm text-gray-900 dark:text-white font-mono">{{ $fuelRecord->receipt_number ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-info-circle text-gray-500 mr-3"></i>
                Record Info
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Record ID</span>
                    <span class="text-sm text-gray-900 dark:text-white font-medium">#{{ $fuelRecord->id }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Created</span>
                    <span class="text-sm text-gray-900 dark:text-white">{{ $fuelRecord->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Notes -->
    @if($fuelRecord->notes)
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-sticky-note text-yellow-500 mr-3"></i>
                Notes
            </h3>
            <div class="bg-white dark:bg-white/5 p-4 rounded-lg border border-gray-200 dark:border-white/10">
                <p class="text-sm text-gray-900 dark:text-white whitespace-pre-wrap">{{ $fuelRecord->notes }}</p>
            </div>
        </div>
    @endif
</div>