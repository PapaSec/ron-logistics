<div class="h-screen flex flex-col bg-gray-50 dark:bg-gray-900" wire:poll.30s="refreshMap">
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
                    <input type="text" wire:model.live="searchTerm" placeholder="Track shipment..."
                        class="pl-9 pr-4 py-2 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white rounded-lg border border-gray-300 dark:border-gray-700 focus:border-[#138898] focus:ring-1 focus:ring-[#138898] w-48 text-sm">
                </div>
                <button wire:click="refreshMap" class="p-2 bg-[#138898] hover:bg-[#0f6b78] text-white rounded-lg transition">
                    <i class="fas fa-sync-alt text-sm"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="flex-1 flex overflow-hidden">
        <div class="w-80 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Active Shipments</h3>
            </div>

            <div class="flex-1 overflow-y-auto sidebar-scrollbar p-3 space-y-2">
                @forelse ($activeShipments as $shipment)
                    <div wire:click="selectShipment({{ $shipment->id }})"
                        class="p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-[#138898] cursor-pointer transition-all {{ $selectedShipment && $selectedShipment->id == $shipment->id ? 'border-[#138898] bg-[#138898]/5' : '' }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white">{{ $shipment->tracking_number }}</span>
                            <x-status-badge :status="$shipment->status" size="xs" />
                        </div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">
                            {{ $shipment->origin_city }} <i class="fas fa-arrow-right mx-1"></i> {{ $shipment->destination_city }}
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 text-xs mt-10">No active shipments</p>
                @endforelse
            </div>
        </div>

        <div class="flex-1 relative bg-gray-100 dark:bg-gray-900" wire:ignore>
            <div id="map" class="absolute inset-0"></div>

            <div class="absolute top-4 right-4 z-[1000] flex flex-col gap-2">
                <button onclick="window.zoomIn()" class="w-10 h-10 bg-white dark:bg-gray-800 rounded shadow flex items-center justify-center">
                    <i class="fas fa-plus"></i>
                </button>
                <button onclick="window.zoomOut()" class="w-10 h-10 bg-white dark:bg-gray-800 rounded shadow flex items-center justify-center">
                    <i class="fas fa-minus"></i>
                </button>
            </div>

            <div class="absolute bottom-4 left-4 z-[1000] bg-white dark:bg-gray-800 rounded-lg shadow p-3 text-xs space-y-2">
                <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-blue-500"></div> Origin</div>
                <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-green-500"></div> Destination</div>
                <div class="flex items-center gap-2"><div class="w-3 h-3 bg-[#138898] rounded flex items-center justify-center"><i class="fas fa-truck text-[8px] text-white"></i></div> Vehicle</div>
            </div>
        </div>

        @if($selectedShipment)
            <div class="w-80 bg-white dark:bg-gray-800 border-l border-gray-200 dark:border-gray-700 p-4">
                <div class="flex justify-between mb-4">
                    <h3 class="font-bold">Shipment Details</h3>
                    <button wire:click="$set('selectedShipment', null)"><i class="fas fa-times"></i></button>
                </div>
                <div class="space-y-4">
                   <div class="bg-gray-50 dark:bg-gray-900 p-3 rounded">
                        <p class="text-xs text-gray-500">From</p>
                        <p class="text-sm font-medium">{{ $selectedShipment->origin_city }}</p>
                        <p class="text-xs text-gray-500 mt-2">To</p>
                        <p class="text-sm font-medium">{{ $selectedShipment->destination_city }}</p>
                   </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')
<link href="https://unpkg.com/maplibre-gl@3.6.2/dist/maplibre-gl.css" rel="stylesheet" />
<style>
    #map { width: 100%; height: 100%; }
    .truck-pin {
        width: 32px; height: 32px; background: #138898; border: 2px solid white;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2); cursor: pointer; color: white;
    }
    .origin-pin { width: 14px; height: 14px; background: #3b82f6; border: 2px solid white; border-radius: 50%; }
    .dest-pin { width: 14px; height: 14px; background: #10b981; border: 2px solid white; border-radius: 50%; }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/maplibre-gl@3.6.2/dist/maplibre-gl.js"></script>
<script>
    let map, markers = [];

    function initMap() {
        if (map) return;

        map = new maplibregl.Map({
            container: 'map',
            style: {
                version: 8,
                sources: { 'osm': { type: 'raster', tiles: ['https://tile.openstreetmap.org/{z}/{x}/{y}.png'], tileSize: 256 } },
                layers: [{ id: 'osm', type: 'raster', source: 'osm' }]
            },
            center: [24.67, -28.48],
            zoom: 5
        });

        map.on('load', () => {
            // Register the route source and layer
            map.addSource('route-source', { type: 'geojson', data: { type: 'FeatureCollection', features: [] } });
            map.addLayer({
                id: 'route-layer',
                type: 'line',
                source: 'route-source',
                paint: { 'line-color': '#138898', 'line-width': 4, 'line-opacity': 0.6, 'line-dasharray': [2, 1] }
            });

            // Plot initial data
            plotShipments(@json($mapData));
        });
    }

    function plotShipments(data) {
        if (!map || !map.isStyleLoaded()) return;

        // Clear markers
        markers.forEach(m => m.remove());
        markers = [];

        const bounds = new maplibregl.LngLatBounds();
        const routeFeatures = [];

        data.forEach(s => {
            if (!s.origin?.lat || !s.destination?.lat || !s.current_location?.lat) return;

            // 1. Origin Marker
            const oEl = document.createElement('div'); oEl.className = 'origin-pin';
            markers.push(new maplibregl.Marker({ element: oEl }).setLngLat([s.origin.lng, s.origin.lat]).addTo(map));

            // 2. Destination Marker
            const dEl = document.createElement('div'); dEl.className = 'dest-pin';
            markers.push(new maplibregl.Marker({ element: dEl }).setLngLat([s.destination.lng, s.destination.lat]).addTo(map));

            // 3. Truck Marker
            const tEl = document.createElement('div'); tEl.className = 'truck-pin';
            tEl.innerHTML = '<i class="fas fa-truck"></i>';
            markers.push(new maplibregl.Marker({ element: tEl, anchor: 'center' }).setLngLat([s.current_location.lng, s.current_location.lat]).addTo(map));

            // 4. Create Route Path (Line)
            routeFeatures.push({
                type: 'Feature',
                geometry: {
                    type: 'LineString',
                    coordinates: [
                        [s.origin.lng, s.origin.lat],
                        [s.current_location.lng, s.current_location.lat],
                        [s.destination.lng, s.destination.lat]
                    ]
                }
            });

            bounds.extend([s.origin.lng, s.origin.lat]);
            bounds.extend([s.destination.lng, s.destination.lat]);
        });

        // Update Line Layer
        map.getSource('route-source').setData({ type: 'FeatureCollection', features: routeFeatures });

        if (!bounds.isEmpty()) {
            map.fitBounds(bounds, { padding: 50, maxZoom: 10 });
        }
    }

    // Livewire Events
    document.addEventListener('livewire:init', () => {
        setTimeout(initMap, 100);

        Livewire.on('map-data-updated', (e) => plotShipments(e[0].mapData));
        
        Livewire.on('focus-on-shipment', (e) => {
            // Find the shipment in mapData and fly to its truck position
            const shipment = @json($mapData).find(x => x.id == e[0].shipmentId);
            if(shipment) {
                map.flyTo({ center: [shipment.current_location.lng, shipment.current_location.lat], zoom: 12 });
            }
        });
    });

    window.zoomIn = () => map?.zoomIn();
    window.zoomOut = () => map?.zoomOut();
</script>
@endpush