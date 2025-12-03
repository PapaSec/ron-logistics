<div class="lg:col-span-2 bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl shadow-sm p-6 transition-colors duration-200">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
        <i class="fas fa-history text-green-500 mr-2"></i>
        Recent Shipment Activity
    </h3>
    <div class="space-y-3">
        @forelse($recentShipments as $shipment)
        <div class="flex items-start space-x-3 p-3 hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg transition-colors">
            <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center 
                {{ $shipment->status === 'delivered' ? 'bg-green-100 dark:bg-green-900/30 text-green-600' : '' }}
                {{ $shipment->status === 'in_transit' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600' : '' }}
                {{ $shipment->status === 'pending' ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-600' : '' }}
                {{ $shipment->status === 'cancelled' ? 'bg-red-100 dark:bg-red-900/30 text-red-600' : '' }}">
                <i class="fas fa-{{ $shipment->status === 'delivered' ? 'check' : ($shipment->status === 'in_transit' ? 'truck' : ($shipment->status === 'pending' ? 'clock' : 'times')) }} text-xs"></i>
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