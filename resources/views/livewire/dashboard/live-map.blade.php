<div class="h-screen flex flex-col bg-gray-50 dark:bg-gray-900">
    <!-- Modern Header -->
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
        <!-- Left Panel - Shipments List (Clean Design) -->
        <div class="w-80 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col">
            <!-- Shipments Header -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Active Shipments</h3>
                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ count($this->activeShipments) }} total</span>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Click to track on map</p>
            </div>

            <!-- Shipment Items - Clean Design -->
            <div class="flex-1 overflow-y-auto sidebar-scrollbar">
                <div class="p-3 space-y-2">
                    @forelse ($this->activeShipments as $shipment)
                        <div 
                            wire:click="selectShipment({{ $shipment->id }})"
                            class="group p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-[#138898] cursor-pointer transition-all duration-200 {{ $selectedShipment && $selectedShipment->id == $shipment->id ? 'border-[#138898] bg-[#138898]/5' : '' }}"
                        >
                            <!-- Tracking Number & Status -->
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full {{ $shipment->status == 'in_transit' ? 'bg-green-500 animate-pulse' : 'bg-blue-500' }}"></div>
                                    <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $shipment->tracking_number }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-1">
                                    @if($shipment->priority === 'express')
                                        <span class="text-[10px] px-1.5 py-0.5 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 rounded">EXPRESS</span>
                                    @endif
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $shipment->estimated_delivery_date->format('M d') }}</span>
                                </div>
                            </div>
                            
                            <!-- Route -->
                            <div class="mb-2">
                                <div class="flex items-center gap-1 text-xs text-gray-600 dark:text-gray-400 mb-1">
                                    <i class="fas fa-route text-[10px]"></i>
                                    <span>Route</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $shipment->origin_city }}</span>
                                    <i class="fas fa-arrow-right text-xs text-gray-400 mx-1"></i>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $shipment->destination_city }}</span>
                                </div>
                            </div>
                            
                            <!-- Receiver & Vehicle -->
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div>
                                    <div class="text-gray-500 dark:text-gray-400 mb-0.5">Receiver</div>
                                    <div class="font-medium text-gray-900 dark:text-white truncate">{{ $shipment->receiver_name }}</div>
                                </div>
                                @if($shipment->vehicle)
                                    <div>
                                        <div class="text-gray-500 dark:text-gray-400 mb-0.5">Vehicle</div>
                                        <div class="font-medium text-gray-900 dark:text-white">{{ $shipment->vehicle->vehicle_number }}</div>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Status Bar -->
                            <div class="mt-3 pt-2 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1">
                                        @if($shipment->current_location && $shipment->current_location->speed)
                                            <i class="fas fa-tachometer-alt text-[10px] text-gray-400"></i>
                                            <span class="text-xs text-gray-600 dark:text-gray-400">{{ $shipment->current_location->speed }} km/h</span>
                                        @endif
                                    </div>
                                    <x-status-badge :status="$shipment->status" size="xs" />
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="w-12 h-12 mx-auto bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-3">
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
        <div class="flex-1 relative bg-gray-100 dark:bg-gray-900">
            <div id="map" class="w-full h-full"></div>
            
            <!-- Map Controls -->
            <div class="absolute top-4 right-4 flex flex-col gap-2">
                <button onclick="zoomIn()" class="w-8 h-8 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition flex items-center justify-center">
                    <i class="fas fa-plus text-gray-700 dark:text-gray-300 text-sm"></i>
                </button>
                <button onclick="zoomOut()" class="w-8 h-8 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition flex items-center justify-center">
                    <i class="fas fa-minus text-gray-700 dark:text-gray-300 text-sm"></i>
                </button>
                <button wire:click="refreshMap" class="w-8 h-8 bg-[#138898] rounded-lg shadow-md hover:bg-[#0f6b78] transition flex items-center justify-center">
                    <i class="fas fa-sync-alt text-white text-sm"></i>
                </button>
            </div>

            <!-- Map Legend -->
            <div class="absolute bottom-4 left-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-3 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-legend text-[#138898] text-sm"></i>
                    <span class="text-xs font-semibold text-gray-900 dark:text-white">Legend</span>
                </div>
                <div class="space-y-1.5">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-blue-500 border border-white"></div>
                        <span class="text-xs text-gray-700 dark:text-gray-300">Origin</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-green-500 border border-white"></div>
                        <span class="text-xs text-gray-700 dark:text-gray-300">Destination</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-[#138898] border border-white flex items-center justify-center">
                            <i class="fas fa-truck text-white text-[8px]"></i>
                        </div>
                        <span class="text-xs text-gray-700 dark:text-gray-300">Vehicle</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Shipment Details (Like Chipster) -->
        @if($selectedShipment)
            <div class="w-96 bg-white dark:bg-gray-800 border-l border-gray-200 dark:border-gray-700 overflow-y-auto sidebar-scrollbar">
                <!-- Header -->
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Shipment Details</h3>
                        <button wire:click="$set('selectedShipment', null)" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
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
                                <span class="text-xs px-2 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded">
                                    {{ ucfirst($selectedShipment->priority) }}
                                </span>
                                <x-status-badge :status="$selectedShipment->status" size="xs" />
                            </div>
                        </div>
                        
                        <!-- Location Info -->
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 mb-0.5">From</div>
                                <div class="font-medium text-gray-900 dark:text-white">{{ $selectedShipment->origin_city }}</div>
                            </div>
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 mb-0.5">To</div>
                                <div class="font-medium text-gray-900 dark:text-white">{{ $selectedShipment->destination_city }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tracker Timeline (Like Chipster) -->
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
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
                                <div class="absolute left-1/2 transform -translate-x-1/2 top-6 w-0.5 h-4 bg-green-200 dark:bg-green-800/30"></div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Package heading Airport</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Shipment departed from warehouse</p>
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
                                <div class="absolute left-1/2 transform -translate-x-1/2 top-6 w-0.5 h-4 bg-green-200 dark:bg-green-800/30"></div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Checking warehouse</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Package sorted and ready for dispatch</p>
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
                                <div class="w-6 h-6 rounded-full bg-[#138898] flex items-center justify-center animate-pulse">
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
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $selectedShipment->receiver_name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $selectedShipment->destination_city }}, SA</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Vehicle & Driver -->
                        @if($selectedShipment->vehicle)
                            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-truck text-gray-400 text-sm"></i>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $selectedShipment->vehicle->vehicle_number }}</span>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $selectedShipment->vehicle->type }}</span>
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
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $selectedShipment->estimated_delivery_date->format('M d, Y') }}</p>
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* CRITICAL FIX: Force map container to have explicit dimensions */
        #map {
            width: 100% !important;
            height: 100% !important;
            z-index: 1;
        }
        
        /* FIX: Ensure map tiles load completely */
        .leaflet-container {
            width: 100% !important;
            height: 100% !important;
            background: #f5f5f5;
        }
        
        /* FIX: Remove any max-width constraints on map images */
        .leaflet-container img {
            max-width: none !important;
            max-height: none !important;
        }
        
        /* FIX: Ensure tiles don't have weird dimensions */
        .leaflet-tile-container img {
            width: 256px !important;
            height: 256px !important;
        }
        
        /* Custom scrollbar styles */
        .sidebar-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 2px;
        }
        .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        .dark .sidebar-scrollbar::-webkit-scrollbar-thumb {
            background: #4b5563;
        }
        .dark .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }
        
        /* Map markers */
        .leaflet-div-icon {
            background: transparent !important;
            border: none !important;
        }
        
        /* Animation for active shipment */
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mapData = @json($this->mapData);
        
        // CRITICAL FIX: Wait for DOM to be fully ready and add timeout
        setTimeout(() => {
            // Initialize map with proper options
            const map = L.map('map', {
                preferCanvas: true, // Better performance
                zoomControl: true,
                attributionControl: true
            }).setView([-28.4793, 24.6727], 6);
            
            // CRITICAL FIX: Force map to recalculate size after initialization
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
            
            // Add tile layer with proper error handling
            const tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19,
                minZoom: 5,
                // CRITICAL: Add these options to prevent tile loading issues
                detectRetina: false,
                updateWhenIdle: false,
                updateWhenZooming: false,
                keepBuffer: 2
            }).addTo(map);
            
            // Handle tile loading errors
            tileLayer.on('tileerror', function(error) {
                console.log('Tile loading error:', error);
            });
            
            let markers = [];
            let routes = [];
            
            // Plot shipments on map
            function plotShipments() {
                markers.forEach(marker => marker.remove());
                routes.forEach(route => route.remove());
                markers = [];
                routes = [];
                
                if (mapData.length === 0) return;
                
                mapData.forEach(shipment => {
                    // Origin marker
                    const originMarker = L.circleMarker([shipment.origin.lat, shipment.origin.lng], {
                        radius: 7,
                        fillColor: '#3b82f6',
                        color: '#ffffff',
                        weight: 2,
                        opacity: 0.9,
                        fillOpacity: 0.9
                    }).addTo(map);
                    
                    originMarker.bindPopup(`<strong>Origin:</strong> ${shipment.origin.city}`);
                    markers.push(originMarker);
                    
                    // Destination marker
                    const destMarker = L.circleMarker([shipment.destination.lat, shipment.destination.lng], {
                        radius: 7,
                        fillColor: '#10b981',
                        color: '#ffffff',
                        weight: 2,
                        opacity: 0.9,
                        fillOpacity: 0.9
                    }).addTo(map);
                    
                    destMarker.bindPopup(`<strong>Destination:</strong> ${shipment.destination.city}`);
                    markers.push(destMarker);
                    
                    // Vehicle marker
                    const vehicleIcon = L.divIcon({
                        className: 'vehicle-marker',
                        html: `
                            <div style="
                                width: 32px; 
                                height: 32px; 
                                background: #138898;
                                border-radius: 50%; 
                                border: 3px solid white;
                                box-shadow: 0 3px 6px rgba(0,0,0,0.3);
                                display: flex; 
                                align-items: center; 
                                justify-content: center;
                            ">
                                <i class="fas fa-truck" style="color: white; font-size: 12px;"></i>
                            </div>`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 16]
                    });
                    
                    const vehicleMarker = L.marker([shipment.current_location.lat, shipment.current_location.lng], {
                        icon: vehicleIcon
                    }).addTo(map);
                    
                    let popupContent = `
                        <div style="min-width: 200px; padding: 8px;">
                            <strong>${shipment.tracking_number}</strong><br>
                            <strong>Receiver:</strong> ${shipment.receiver_name}<br>
                    `;
                    
                    if (shipment.vehicle) {
                        popupContent += `<strong>Driver:</strong> ${shipment.vehicle.driver}<br>`;
                    }
                    
                    if (shipment.current_location.speed) {
                        popupContent += `<strong>Speed:</strong> ${shipment.current_location.speed} km/h<br>`;
                    }
                    
                    popupContent += `<strong>ETA:</strong> ${shipment.estimated_delivery}</div>`;
                    
                    vehicleMarker.bindPopup(popupContent);
                    markers.push(vehicleMarker);
                    
                    // Route line
                    const routeLine = L.polyline([
                        [shipment.origin.lat, shipment.origin.lng],
                        [shipment.current_location.lat, shipment.current_location.lng],
                        [shipment.destination.lat, shipment.destination.lng]
                    ], {
                        color: '#138898',
                        weight: 2,
                        opacity: 0.5,
                        dashArray: '6, 4'
                    }).addTo(map);
                    routes.push(routeLine);
                });
                
                // CRITICAL FIX: Force map refresh after plotting
                setTimeout(() => {
                    map.invalidateSize();
                }, 200);
            }
            
            plotShipments();
            
            // Zoom functions
            window.zoomIn = function() {
                map.zoomIn();
            };
            
            window.zoomOut = function() {
                map.zoomOut();
            };
            
            // CRITICAL FIX: Invalidate map size on window resize
            window.addEventListener('resize', function() {
                map.invalidateSize();
            });
            
            // Make map available globally for debugging
            window.mapInstance = map;
            
        }, 250); // Give DOM time to render
    });
    </script>
@endpush