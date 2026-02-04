<div class="h-screen flex flex-col bg-[#E4EBE7] dark:bg-[#1f2431]" wire:poll.30s="refreshMap">
    <!-- Modern Header -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] border-b border-gray-300 dark:border-gray-700 px-6 py-3">
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
                    <i
                        class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" wire:model.live="searchTerm" placeholder="Track shipment..."
                        class="pl-9 pr-4 py-2 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white rounded-lg border border-gray-300 dark:border-gray-700 focus:border-[#138898] focus:ring-1 focus:ring-[#138898] w-48 text-sm">
                </div>
                <button wire:click="refreshMap"
                    class="p-2 bg-[#138898] hover:bg-[#0f6b78] text-white rounded-lg transition">
                    <i class="fas fa-sync-alt text-sm"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="flex-1 flex overflow-hidden">
        <!-- Left Panel - Shipments List -->
        <div class="w-80 bg-[#E4EBE7] dark:bg-[#1f2431] border-r border-gray-400 dark:border-gray-700 flex flex-col">
            <!-- Shipments Header -->
            <div class="p-4 border-b border-gray-300 dark:border-gray-700">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Active Shipments</h3>
                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ count($activeShipments) }} total</span>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Click to track on map</p>
            </div>

            <!-- Shipment Items -->
            <div class="flex-1 overflow-y-auto sidebar-scrollbar">
                <div class="p-3 space-y-2">
                    @forelse ($activeShipments as $shipment)
                        <div wire:click="selectShipment({{ $shipment->id }})"
                            class="group p-3 rounded-lg border border-gray-300 dark:border-gray-700 hover:border-[#138898] cursor-pointer transition-all duration-200 {{ $selectedShipment && $selectedShipment->id == $shipment->id ? 'border-[#138898] bg-[#138898]/5' : '' }}">
                            <!-- Tracking Number & Status -->
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-2 h-2 rounded-full {{ $shipment->status == 'in_transit' ? 'bg-green-500 animate-pulse' : 'bg-blue-500' }}">
                                    </div>
                                    <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $shipment->tracking_number }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-1">
                                    @if($shipment->priority === 'express')
                                        <span
                                            class="text-[10px] px-1.5 py-0.5 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 rounded">EXPRESS</span>
                                    @endif
                                    <span
                                        class="text-xs text-gray-500 dark:text-gray-400">{{ $shipment->estimated_delivery_date->format('M d') }}</span>
                                </div>
                            </div>

                            <!-- Route -->
                            <div class="mb-2">
                                <div class="flex items-center gap-1 text-xs text-gray-600 dark:text-gray-400 mb-1">
                                    <i class="fas fa-route text-[10px]"></i>
                                    <span>Route</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-sm font-medium text-gray-900 dark:text-white">{{ $shipment->origin_city }}</span>
                                    <i class="fas fa-arrow-right text-xs text-gray-400 mx-1"></i>
                                    <span
                                        class="text-sm font-medium text-gray-900 dark:text-white">{{ $shipment->destination_city }}</span>
                                </div>
                            </div>

                            <!-- Receiver & Vehicle -->
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div>
                                    <div class="text-gray-500 dark:text-gray-400 mb-0.5">Receiver</div>
                                    <div class="font-medium text-gray-900 dark:text-white truncate">
                                        {{ $shipment->receiver_name }}</div>
                                </div>
                                @if($shipment->vehicle)
                                    <div>
                                        <div class="text-gray-500 dark:text-gray-400 mb-0.5">Vehicle</div>
                                        <div class="font-medium text-gray-900 dark:text-white">
                                            {{ $shipment->vehicle->vehicle_number }}</div>
                                    </div>
                                @endif
                            </div>

                            <!-- Status Bar -->
                            <div class="mt-3 pt-2 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1">
                                        @if($shipment->current_location && $shipment->current_location->speed)
                                            <i class="fas fa-tachometer-alt text-[10px] text-gray-400"></i>
                                            <span
                                                class="text-xs text-gray-600 dark:text-gray-400">{{ $shipment->current_location->speed }}
                                                km/h</span>
                                        @endif
                                    </div>
                                    <x-status-badge :status="$shipment->status" size="xs" />
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div
                                class="w-12 h-12 mx-auto bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-3">
                                <i class="fas fa-truck text-gray-400"></i>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">No active shipments</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500">All shipments are delivered or pending</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Middle Panel - Map -->
        <div class="flex-1 relative bg-gray-100 dark:bg-gray-900" wire:ignore>
            <div id="map" class="w-full h-full"></div>

            <!-- Map Controls -->
            <div class="absolute top-4 right-4 z-[1000] flex flex-col gap-2">
                <button onclick="window.zoomIn()"
                    class="w-10 h-10 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition flex items-center justify-center">
                    <i class="fas fa-plus text-gray-700 dark:text-gray-300"></i>
                </button>
                <button onclick="window.zoomOut()"
                    class="w-10 h-10 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition flex items-center justify-center">
                    <i class="fas fa-minus text-gray-700 dark:text-gray-300"></i>
                </button>
                <button wire:click="refreshMap"
                    class="w-10 h-10 bg-[#138898] rounded-lg shadow-lg hover:bg-[#0f6b78] transition flex items-center justify-center">
                    <i class="fas fa-sync-alt text-white"></i>
                </button>
            </div>

            <!-- Map Legend -->
            <div
                class="absolute bottom-4 left-4 z-[1000] bg-white dark:bg-gray-800 rounded-lg shadow-xl p-4 border border-gray-300 dark:border-gray-700">
                <div class="flex items-center gap-2 mb-3">
                    <i class="fas fa-legend text-[#138898]"></i>
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Legend</span>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-blue-500 border border-white"></div>
                        <span class="text-xs text-gray-700 dark:text-gray-300">Origin Point</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-green-500 border border-white"></div>
                        <span class="text-xs text-gray-700 dark:text-gray-300">Destination</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div
                            class="w-4 h-4 rounded-full bg-[#138898] border-2 border-white flex items-center justify-center">
                            <i class="fas fa-truck text-white text-[8px]"></i>
                        </div>
                        <span class="text-xs text-gray-700 dark:text-gray-300">Active Vehicle</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Shipment Details -->
        @if($selectedShipment)
            <div
                class="w-96 bg-white dark:bg-gray-800 border-l border-gray-300 dark:border-gray-700 overflow-y-auto sidebar-scrollbar">
                <!-- Header -->
                <div class="p-4 border-b border-gray-300 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Shipment Details</h3>
                        <button wire:click="$set('selectedShipment', null)"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <!-- Tracking Info Card -->
                    <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3 mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                                <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $selectedShipment->tracking_number }}
                                </span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span
                                    class="text-xs px-2 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded">
                                    {{ ucfirst($selectedShipment->priority) }}
                                </span>
                                <x-status-badge :status="$selectedShipment->status" size="xs" />
                            </div>
                        </div>

                        <!-- Location Info -->
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 mb-0.5">From</div>
                                <div class="font-medium text-gray-900 dark:text-white">{{ $selectedShipment->origin_city }}
                                </div>
                            </div>
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 mb-0.5">To</div>
                                <div class="font-medium text-gray-900 dark:text-white">
                                    {{ $selectedShipment->destination_city }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tracker Timeline -->
                <div class="p-4 border-b border-gray-300 dark:border-gray-700">
                    <h4 class="text-xs font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <i class="fas fa-history text-[#138898]"></i>
                        Tracker
                    </h4>

                    <div class="space-y-3">
                        <!-- Timeline Item 1 -->
                        <div class="flex items-start gap-3">
                            <div class="relative">
                                <div class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <div
                                    class="absolute left-1/2 transform -translate-x-1/2 top-6 w-0.5 h-4 bg-green-200 dark:bg-green-800/30">
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Package heading Airport
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Shipment departed from warehouse
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs font-medium text-gray-900 dark:text-white">09:00 PM</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Today</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline Item 2 -->
                        <div class="flex items-start gap-3">
                            <div class="relative">
                                <div class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <div
                                    class="absolute left-1/2 transform -translate-x-1/2 top-6 w-0.5 h-4 bg-green-200 dark:bg-green-800/30">
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Checking warehouse</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Package sorted and ready for
                                            dispatch</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs font-medium text-gray-900 dark:text-white">09:00 AM</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Today</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline Item 3 (Current) -->
                        <div class="flex items-start gap-3">
                            <div class="relative">
                                <div
                                    class="w-6 h-6 rounded-full bg-[#138898] flex items-center justify-center animate-pulse">
                                    <i class="fas fa-truck text-white text-xs"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">In transit</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">On the way to destination</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs font-medium text-gray-900 dark:text-white">Now</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Live</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact & Details -->
                <div class="p-4">
                    <h4 class="text-xs font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <i class="fas fa-info-circle text-[#138898]"></i>
                        Contact & Details
                    </h4>

                    <div class="space-y-3">
                        <!-- Receiver Info -->
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#138898] flex items-center justify-center">
                                    <i class="fas fa-user text-white text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $selectedShipment->receiver_name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $selectedShipment->destination_city }}, SA</p>
                                </div>
                            </div>
                        </div>

                        <!-- Vehicle & Driver -->
                        @if($selectedShipment->vehicle)
                            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-truck text-gray-400 text-sm"></i>
                                        <span
                                            class="text-sm font-medium text-gray-900 dark:text-white">{{ $selectedShipment->vehicle->vehicle_number }}</span>
                                    </div>
                                    <span
                                        class="text-xs text-gray-500 dark:text-gray-400">{{ $selectedShipment->vehicle->type }}</span>
                                </div>
                                @if($selectedShipment->vehicle->driver)
                                    <div class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-user-circle"></i>
                                        <span>{{ $selectedShipment->vehicle->driver->full_name }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Estimated Delivery -->
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-clock text-gray-400 text-sm"></i>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Estimated Delivery</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $selectedShipment->estimated_delivery_date->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Distance</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        @php
                                            $origin = $this->getCoordinatesForCity($selectedShipment->origin_city);
                                            $destination = $this->getCoordinatesForCity($selectedShipment->destination_city);
                                            $distance = sqrt(pow($destination['lat'] - $origin['lat'], 2) + pow($destination['lng'] - $origin['lng'], 2));
                                            echo round($distance * 111, 0) . ' km';
                                        @endphp
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')
    <link href="https://unpkg.com/maplibre-gl@3.6.2/dist/maplibre-gl.css" rel="stylesheet" />
    <style>
        #map {
            width: 100%;
            height: 100%;
            min-height: 500px;
        }

        .maplibregl-popup-content {
            padding: 15px;
            border-radius: 10px;
            min-width: 250px;
        }

        /* Professional Markers */
        .truck-pin {
            width: 32px;
            height: 32px;
            background: #138898;
            border: 3px solid white;
            border-radius: 50%;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .truck-pin i {
            color: white;
            font-size: 14px;
        }

        .origin-pin,
        .dest-pin {
            width: 20px;
            height: 20px;
            border: 3px solid white;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .origin-pin {
            background: #3b82f6;
        }

        .dest-pin {
            background: #10b981;
        }

        /* Mobile Responsive Sidebar */
        @media (max-width: 1024px) {
            .shipment-details-panel {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                z-index: 9999 !important;
                width: 100% !important;
                max-width: 100% !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/maplibre-gl@3.6.2/dist/maplibre-gl.js"></script>
    <script>
        let map, markers = [], routes = [];

        function initMap() {
            if (map) {
    map.remove();
    map = null;
    markers = [];
}


            map = new maplibregl.Map({
                container: 'map',
                style: {
                    version: 8,
                    sources: { osm: { type: 'raster', tiles: ['https://tile.openstreetmap.org/{z}/{x}/{y}.png'], tileSize: 256 } },
                    layers: [{ id: 'osm', type: 'raster', source: 'osm' }]
                },
                center: [24.67, -28.48],
                zoom: 5.5
            });

            map.addControl(new maplibregl.NavigationControl(), 'top-right');

            map.on('load', () => {
                map.addSource('routes', { type: 'geojson', data: { type: 'FeatureCollection', features: [] } });
                map.addLayer({ id: 'routes', type: 'line', source: 'routes', paint: { 'line-color': '#7c3aed', 'line-width': 4, 'line-opacity': 0.9, 'line-cap': 'round', 'line-join': 'round' } });

                const data = @json($mapData);
                if (data?.length) plotShipments(data);
            });
        }

        function plotShipments(data) {
            if (!map) return setTimeout(() => plotShipments(data), 500);

            markers.forEach(m => m.remove());
            markers = [];

            const bounds = new maplibregl.LngLatBounds();
            const routeLines = [];

            data.forEach(s => {
                if (!s.origin?.lat || !s.destination?.lat || !s.current_location?.lat) return;

                // Origin
                const originEl = document.createElement('div');
                originEl.className = 'origin-pin';
                const origin = new maplibregl.Marker({ element: originEl })
                    .setLngLat([s.origin.lng, s.origin.lat])
                    .setPopup(new maplibregl.Popup().setHTML(`
                    <b> ${s.origin.city}</b><br>
                    <small>${s.tracking_number}</small>
                `))
                    .addTo(map);
                markers.push(origin);
                bounds.extend([s.origin.lng, s.origin.lat]);

                // Destination
                const destEl = document.createElement('div');
                destEl.className = 'dest-pin';
                const dest = new maplibregl.Marker({ element: destEl })
                    .setLngLat([s.destination.lng, s.destination.lat])
                    .setPopup(new maplibregl.Popup().setHTML(`
                    <b> ${s.destination.city}</b><br>
                    <small>${s.receiver_name}</small><br>
                    <small>ETA: ${s.estimated_delivery}</small>
                `))
                    .addTo(map);
                markers.push(dest);
                bounds.extend([s.destination.lng, s.destination.lat]);

                // Truck
                const truckEl = document.createElement('div');
                truckEl.className = 'truck-pin';
                truckEl.innerHTML = '<i class="fas fa-truck"></i>';

                if (s.current_location.heading) {
                    const rotationMap = { N: 0, E: 90, S: 180, W: 270 };
                    truckEl.style.transform = `rotate(${rotationMap[s.current_location.heading] || 0}deg)`;
                }

                const truck = new maplibregl.Marker({
                    element: truckEl,
                    anchor: 'bottom'
                })
                    .setLngLat([s.current_location.lng, s.current_location.lat])
                    .setPopup(new maplibregl.Popup().setHTML(`
                    <b>${s.vehicle?.number || 'N/A'}</b><br>
                    <small>Driver: ${s.vehicle?.driver || 'N/A'}</small><br>
                    <small>Speed: ${s.current_location.speed || 0} km/h</small><br>
                    <small>${s.tracking_number}</small>
                `))
                    .addTo(map);
                markers.push(truck);
                bounds.extend([s.current_location.lng, s.current_location.lat]);

                // Route line
                routeLines.push({
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
            });


            if (map.getSource('routes')) {
                map.getSource('routes').setData({ type: 'FeatureCollection', features: routeLines });
            }

            if (!bounds.isEmpty()) {
                map.fitBounds(bounds, {
                    padding: {
                        top: 100,
                        bottom: 100,
                        left: window.innerWidth > 1200 ? 420 : 80,
                        right: 80
                    },
                    maxZoom: 10,
                    duration: 1200
                });

            }
        }

        document.addEventListener('DOMContentLoaded', () => setTimeout(initMap, 300));

        document.addEventListener('livewire:init', () => {
            Livewire.on('map-data-updated', e => plotShipments(e.mapData));
            Livewire.on('map-refreshed', () => map?.resize());
            Livewire.on('focus-on-shipment', e => {
                const data = @json($mapData);
                const s = data?.find(x => x.id === e.shipmentId);
                if (s?.current_location) {
                    map.flyTo({ center: [s.current_location.lng, s.current_location.lat], zoom: 10, duration: 1500 });
                }
            });
        });

        window.zoomIn = () => map?.zoomIn();
        window.zoomOut = () => map?.zoomOut();
    </script>
@endpush