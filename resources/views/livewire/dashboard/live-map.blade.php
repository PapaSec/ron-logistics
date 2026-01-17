<div class="h-screen flex flex-col bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-[#138898] rounded-lg flex items-center justify-center">
                    <i class="fas fa-map-marked-alt text-white"></i>
                </div>
                <div>
                    <h1 class="text-lg font-semibold text-gray-900 dark:text-white">Tracker</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Live Shipment Monitoring</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input 
                        type="text" 
                        wire:model.live="searchTerm"
                        placeholder="Track shipment..."
                        class="pl-9 pr-4 py-2 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white rounded-lg border border-gray-300 dark:border-gray-700 focus:border-[#138898] focus:ring-1 focus:ring-[#138898] w-48 text-sm"
                    >
                </div>
                <button wire:click="refreshMap" class="p-2 bg-[#138898] hover:bg-[#0f6b78] text-white rounded-lg transition">
                    <i class="fas fa-sync-alt text-sm"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="flex-1 flex overflow-hidden">
        <!-- Left Panel -->
        <div class="w-80 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Active Shipments</h3>
                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ count($this->activeShipments) }} total</span>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Click to track on map</p>
            </div>

            <div class="flex-1 overflow-y-auto" style="scrollbar-width: thin;">
                <div class="p-3 space-y-2">
                    @forelse ($this->activeShipments as $shipment)
                        <div 
                            wire:click="selectShipment({{ $shipment->id }})"
                            onclick="focusShipment({{ $shipment->id }})"
                            class="p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-[#138898] cursor-pointer transition {{ $selectedShipment && $selectedShipment->id == $shipment->id ? 'border-[#138898] bg-[#138898]/5' : '' }}"
                        >
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-green-500" style="animation: pulse 2s infinite;"></div>
                                    <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $shipment->tracking_number }}
                                    </span>
                                </div>
                                <span class="text-xs text-gray-500">{{ $shipment->estimated_delivery_date->format('M d') }}</span>
                            </div>
                            
                            <div class="mb-2">
                                <div class="flex items-center gap-1 text-xs text-gray-600 dark:text-gray-400 mb-1">
                                    <i class="fas fa-route" style="font-size: 10px;"></i>
                                    <span>Route</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $shipment->origin_city }}</span>
                                    <i class="fas fa-arrow-right text-xs text-gray-400"></i>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $shipment->destination_city }}</span>
                                </div>
                            </div>
                            
                            <div class="text-xs">
                                <div class="text-gray-500 dark:text-gray-400">Receiver</div>
                                <div class="font-medium text-gray-900 dark:text-white truncate">{{ $shipment->receiver_name }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-truck text-gray-400 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-500">No active shipments</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="flex-1 relative">
            <div id="map"></div>
            
            <div class="absolute top-4 right-4 flex flex-col gap-2" style="z-index: 1000;">
                <button onclick="zoomIn()" class="w-10 h-10 bg-white rounded-lg shadow-lg hover:shadow-xl transition flex items-center justify-center">
                    <i class="fas fa-plus text-gray-700"></i>
                </button>
                <button onclick="zoomOut()" class="w-10 h-10 bg-white rounded-lg shadow-lg hover:shadow-xl transition flex items-center justify-center">
                    <i class="fas fa-minus text-gray-700"></i>
                </button>
            </div>

            <div class="absolute bottom-4 left-4 bg-white rounded-lg shadow-lg p-3" style="z-index: 1000;">
                <div class="text-xs font-semibold text-gray-900 mb-2">Legend</div>
                <div class="space-y-1.5 text-xs">
                    <div class="flex items-center gap-2">
                        <div style="width: 12px; height: 12px; border-radius: 50%; background: #3b82f6;"></div>
                        <span>Origin</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div style="width: 12px; height: 12px; border-radius: 50%; background: #10b981;"></div>
                        <span>Destination</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div style="width: 12px; height: 12px; border-radius: 50%; background: #138898;"></div>
                        <span>Vehicle</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        @if($selectedShipment)
            <div class="w-96 bg-white dark:bg-gray-800 border-l border-gray-200 dark:border-gray-700 overflow-y-auto">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Shipment Details</h3>
                        <button wire:click="$set('selectedShipment', null)" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3 mb-4">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-2 h-2 rounded-full bg-green-500" style="animation: pulse 2s infinite;"></div>
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $selectedShipment->tracking_number }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            <div>
                                <div class="text-gray-500 mb-0.5">From</div>
                                <div class="font-medium text-gray-900 dark:text-white">{{ $selectedShipment->origin_city }}</div>
                            </div>
                            <div>
                                <div class="text-gray-500 mb-0.5">To</div>
                                <div class="font-medium text-gray-900 dark:text-white">{{ $selectedShipment->destination_city }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4">
                    <div class="space-y-3">
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#138898] flex items-center justify-center">
                                    <i class="fas fa-user text-white text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $selectedShipment->receiver_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $selectedShipment->destination_city }}, SA</p>
                                </div>
                            </div>
                        </div>
                        
                        @if($selectedShipment->vehicle)
                            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3">
                                <div class="flex items-center gap-2 mb-1">
                                    <i class="fas fa-truck text-gray-400 text-sm"></i>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $selectedShipment->vehicle->vehicle_number }}</span>
                                </div>
                                @if($selectedShipment->vehicle->driver)
                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                        Driver: {{ $selectedShipment->vehicle->driver->full_name }}
                                    </div>
                                @endif
                            </div>
                        @endif
                        
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3">
                            <div class="text-xs text-gray-500 mb-1">Estimated Delivery</div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $selectedShipment->estimated_delivery_date->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
/* CRITICAL: Fix for Tailwind CSS conflicts */
#map {
    width: 100%;
    height: 100%;
    z-index: 1;
}

#map img {
    max-width: none !important;
    max-height: none !important;
}

.leaflet-container {
    width: 100%;
    height: 100%;
}

.leaflet-container img {
    max-width: none !important;
    max-height: none !important;
}

.leaflet-tile {
    max-width: none !important;
}

.leaflet-div-icon {
    background: transparent !important;
    border: none !important;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
let map;
let markers = [];
const mapData = @json($this->mapData);

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        // Initialize map
        map = L.map('map').setView([-28.4793, 24.6727], 6);
        
        // Use CartoDB tiles (free, no API key needed, fast loading)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '© OpenStreetMap contributors © CARTO',
            subdomains: 'abcd',
            maxZoom: 20
        }).addTo(map);
        
        setTimeout(() => map.invalidateSize(), 100);
        
        plotShipments();
    }, 200);
});

function plotShipments() {
    markers.forEach(m => map.removeLayer(m));
    markers = [];
    
    if (!mapData || mapData.length === 0) return;
    
    mapData.forEach(shipment => {
        // Origin
        const origin = L.circleMarker([shipment.origin.lat, shipment.origin.lng], {
            radius: 7,
            fillColor: '#3b82f6',
            color: '#fff',
            weight: 2,
            fillOpacity: 0.9
        }).addTo(map);
        origin.bindPopup(`<b>Origin:</b> ${shipment.origin.city}`);
        markers.push(origin);
        
        // Destination
        const dest = L.circleMarker([shipment.destination.lat, shipment.destination.lng], {
            radius: 7,
            fillColor: '#10b981',
            color: '#fff',
            weight: 2,
            fillOpacity: 0.9
        }).addTo(map);
        dest.bindPopup(`<b>Destination:</b> ${shipment.destination.city}`);
        markers.push(dest);
        
        // Vehicle
        const icon = L.divIcon({
            html: '<div style="width:28px;height:28px;background:#138898;border-radius:50%;border:3px solid white;box-shadow:0 2px 4px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;"><i class="fas fa-truck" style="color:white;font-size:11px;"></i></div>',
            iconSize: [28, 28],
            iconAnchor: [14, 14],
            className: ''
        });
        
        const vehicle = L.marker([shipment.current_location.lat, shipment.current_location.lng], {icon}).addTo(map);
        
        let popup = `<div style="min-width:180px;"><b>${shipment.tracking_number}</b><br>`;
        popup += `<b>Receiver:</b> ${shipment.receiver_name}<br>`;
        if (shipment.vehicle) {
            popup += `<b>Driver:</b> ${shipment.vehicle.driver}<br>`;
        }
        if (shipment.current_location.speed) {
            popup += `<b>Speed:</b> ${shipment.current_location.speed} km/h<br>`;
        }
        popup += `<b>ETA:</b> ${shipment.estimated_delivery}</div>`;
        
        vehicle.bindPopup(popup);
        markers.push(vehicle);
        
        // Route
        const route = L.polyline([
            [shipment.origin.lat, shipment.origin.lng],
            [shipment.current_location.lat, shipment.current_location.lng],
            [shipment.destination.lat, shipment.destination.lng]
        ], {
            color: '#8b5cf6',
            weight: 2,
            opacity: 0.6
        }).addTo(map);
        markers.push(route);
    });
}

function focusShipment(id) {
    const s = mapData.find(x => x.id === id);
    if (s && map) {
        map.setView([s.current_location.lat, s.current_location.lng], 8);
    }
}

function zoomIn() {
    if (map) map.zoomIn();
}

function zoomOut() {
    if (map) map.zoomOut();
}
</script>
@endpush