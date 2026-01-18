<div class="h-screen flex flex-col bg-gray-50 dark:bg-gray-900" wire:poll.30s="refreshMap">
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
        <!-- Left Panel - Shipments List -->
        <div class="w-80 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col">
            <!-- Shipments Header -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
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
        <div class="flex-1 relative bg-gray-100 dark:bg-gray-900" wire:ignore>
            <div id="map" class="w-full h-full"></div>
            
            <!-- Map Controls -->
            <div class="absolute top-4 right-4 z-[1000] flex flex-col gap-2">
                <button onclick="window.zoomIn()" class="w-10 h-10 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition flex items-center justify-center">
                    <i class="fas fa-plus text-gray-700 dark:text-gray-300"></i>
                </button>
                <button onclick="window.zoomOut()" class="w-10 h-10 bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition flex items-center justify-center">
                    <i class="fas fa-minus text-gray-700 dark:text-gray-300"></i>
                </button>
                <button wire:click="refreshMap" class="w-10 h-10 bg-[#138898] rounded-lg shadow-lg hover:bg-[#0f6b78] transition flex items-center justify-center">
                    <i class="fas fa-sync-alt text-white"></i>
                </button>
            </div>

            <!-- Map Legend -->
            <div class="absolute bottom-4 left-4 z-[1000] bg-white dark:bg-gray-800 rounded-lg shadow-xl p-4 border border-gray-200 dark:border-gray-700">
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
                        <div class="w-4 h-4 rounded-full bg-[#138898] border-2 border-white flex items-center justify-center">
                            <i class="fas fa-truck text-white text-[8px]"></i>
                        </div>
                        <span class="text-xs text-gray-700 dark:text-gray-300">Active Vehicle</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Shipment Details -->
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

                <!-- Tracker Timeline -->
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
/* Map container fixes */
#map {
    width: 100% !important;
    height: 100% !important;
    min-height: 500px;
    z-index: 1;
}

/* Fix Leaflet container */
.leaflet-container {
    font-family: inherit !important;
    width: 100% !important;
    height: 100% !important;
    background: #e5e7eb !important;
    z-index: 1 !important;
}

.dark .leaflet-container {
    background: #1f2937 !important;
}

/* Fix tile rendering - CRITICAL FIX */
.leaflet-tile {
    max-width: none !important;
    max-height: none !important;
    image-rendering: crisp-edges;
    image-rendering: -webkit-optimize-contrast;
}

.leaflet-container img {
    max-width: none !important;
}

/* Custom scrollbar */
.sidebar-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.sidebar-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.sidebar-scrollbar::-webkit-scrollbar-thumb {
    background: #138898;
    border-radius: 3px;
}

.sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #0f6b78;
}

.dark .sidebar-scrollbar::-webkit-scrollbar-track {
    background: #374151;
}

.dark .sidebar-scrollbar::-webkit-scrollbar-thumb {
    background: #138898;
}

/* Ensure proper z-index for map elements */
.leaflet-marker-pane {
    z-index: 650 !important;
}

.leaflet-shadow-pane {
    z-index: 600 !important;
}

.leaflet-overlay-pane {
    z-index: 500 !important;
}

/* Map controls */
.leaflet-control-zoom {
    border: none !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.leaflet-control-zoom a {
    background: white;
    border: 1px solid #e5e7eb;
    color: #4b5563;
}

.dark .leaflet-control-zoom a {
    background: #374151;
    border-color: #4b5563;
    color: #d1d5db;
}

.leaflet-control-zoom a:hover {
    background: #f9fafb;
}

.dark .leaflet-control-zoom a:hover {
    background: #4b5563;
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
// Global variables
let map = null;
let markersLayer = null;
let isMapInitialized = false;

// Initialize map with proper tile loading
function initMap() {
    console.log('Initializing map...');
    
    const mapContainer = document.getElementById('map');
    if (!mapContainer) {
        console.error('Map container not found!');
        return false;
    }
    
    // Clean up existing map
    if (map) {
        map.off();
        map.remove();
        map = null;
        markersLayer = null;
        isMapInitialized = false;
    }
    
    // Clear container completely
    mapContainer.innerHTML = '';
    mapContainer.style.height = '100%';
    
    try {
        // Create map with proper configuration
        map = L.map('map', {
            center: [-28.4793, 24.6727], // Center of South Africa
            zoom: 6,
            zoomControl: false,
            attributionControl: true,
            preferCanvas: false,
            fadeAnimation: true,
            zoomAnimation: true,
            markerZoomAnimation: true
        });
        
        // Add tile layer with proper error handling
        const tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19,
            minZoom: 5,
            tileSize: 256,
            crossOrigin: true,
            errorTileUrl: '', // Prevent error tile display
            updateWhenIdle: false,
            updateWhenZooming: false,
            keepBuffer: 2
        });
        
        // Listen for tile loading events
        tileLayer.on('loading', () => {
            console.log('Tiles loading...');
        });
        
        tileLayer.on('load', () => {
            console.log('Tiles loaded successfully');
        });
        
        tileLayer.on('tileerror', (error) => {
            console.warn('Tile loading error:', error);
        });
        
        tileLayer.addTo(map);
        
        // Add zoom control in top right
        L.control.zoom({ 
            position: 'topright' 
        }).addTo(map);
        
        // Create markers layer group
        markersLayer = L.layerGroup().addTo(map);
        
        // Wait for map to fully render
        map.whenReady(() => {
            console.log('Map is ready');
            isMapInitialized = true;
            
            // Force invalidate size multiple times
            setTimeout(() => {
                if (map) {
                    map.invalidateSize(true);
                    console.log('First resize completed');
                }
            }, 100);
            
            setTimeout(() => {
                if (map) {
                    map.invalidateSize(true);
                    console.log('Second resize completed');
                }
            }, 300);
            
            setTimeout(() => {
                if (map) {
                    map.invalidateSize(true);
                    console.log('Third resize completed');
                }
            }, 500);
        });
        
        console.log('Map initialized successfully');
        return true;
        
    } catch (error) {
        console.error('Failed to initialize map:', error);
        isMapInitialized = false;
        return false;
    }
}

// Plot shipments on map
function plotShipments(mapData) {
    if (!map || !markersLayer || !isMapInitialized) {
        console.log('Map not ready, will retry...');
        setTimeout(() => plotShipments(mapData), 500);
        return;
    }
    
    console.log('Plotting shipments:', mapData?.length || 0);
    
    // Clear existing markers
    markersLayer.clearLayers();
    
    if (!mapData || mapData.length === 0) {
        console.log('No shipments to plot');
        return;
    }
    
    const bounds = L.latLngBounds();
    
    mapData.forEach((shipment) => {
        try {
            // Validate coordinates
            if (!shipment.origin?.lat || !shipment.origin?.lng ||
                !shipment.destination?.lat || !shipment.destination?.lng ||
                !shipment.current_location?.lat || !shipment.current_location?.lng) {
                console.warn('Invalid coordinates for shipment:', shipment.tracking_number);
                return;
            }
            
            // Origin marker (blue circle)
            const originMarker = L.circleMarker(
                [shipment.origin.lat, shipment.origin.lng], 
                {
                    radius: 8,
                    fillColor: '#3b82f6',
                    color: '#ffffff',
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.8
                }
            ).addTo(markersLayer);
            
            originMarker.bindPopup(`
                <div style="padding: 8px; min-width: 200px;">
                    <div style="font-weight: 600; color: #3b82f6; margin-bottom: 4px;">
                        📍 Origin Point
                    </div>
                    <div style="font-size: 14px; margin-bottom: 2px;">
                        <strong>City:</strong> ${shipment.origin.city}
                    </div>
                    <div style="font-size: 12px; color: #666;">
                        <strong>Tracking:</strong> ${shipment.tracking_number}
                    </div>
                </div>
            `);
            
            bounds.extend([shipment.origin.lat, shipment.origin.lng]);
            
            // Destination marker (green circle)
            const destMarker = L.circleMarker(
                [shipment.destination.lat, shipment.destination.lng], 
                {
                    radius: 8,
                    fillColor: '#10b981',
                    color: '#ffffff',
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.8
                }
            ).addTo(markersLayer);
            
            destMarker.bindPopup(`
                <div style="padding: 8px; min-width: 200px;">
                    <div style="font-weight: 600; color: #10b981; margin-bottom: 4px;">
                        🎯 Destination
                    </div>
                    <div style="font-size: 14px; margin-bottom: 2px;">
                        <strong>City:</strong> ${shipment.destination.city}
                    </div>
                    <div style="font-size: 12px; color: #666;">
                        <strong>Receiver:</strong> ${shipment.receiver_name}
                    </div>
                    <div style="font-size: 12px; color: #666;">
                        <strong>ETA:</strong> ${shipment.estimated_delivery}
                    </div>
                </div>
            `);
            
            bounds.extend([shipment.destination.lat, shipment.destination.lng]);
            
            // Vehicle marker (custom truck icon)
            const vehicleIcon = L.divIcon({
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
                        position: relative;
                    ">
                        <i class="fas fa-truck" style="color: white; font-size: 13px;"></i>
                        ${shipment.current_location.speed ? `
                            <div style="
                                position: absolute;
                                bottom: -18px;
                                background: rgba(19, 136, 152, 0.9);
                                color: white;
                                padding: 2px 6px;
                                border-radius: 10px;
                                font-size: 10px;
                                font-weight: 600;
                                white-space: nowrap;
                            ">
                                ${shipment.current_location.speed} km/h
                            </div>
                        ` : ''}
                    </div>
                `,
                iconSize: [32, 32],
                iconAnchor: [16, 16],
                popupAnchor: [0, -16],
                className: 'custom-vehicle-marker'
            });
            
            const vehicleMarker = L.marker(
                [shipment.current_location.lat, shipment.current_location.lng],
                { icon: vehicleIcon }
            ).addTo(markersLayer);
            
            vehicleMarker.bindPopup(`
                <div style="padding: 8px; min-width: 220px;">
                    <div style="font-weight: 600; color: #138898; margin-bottom: 6px; font-size: 15px;">
                        🚚 ${shipment.vehicle?.number || 'N/A'}
                    </div>
                    <div style="font-size: 13px; margin-bottom: 3px;">
                        <strong>Driver:</strong> ${shipment.vehicle?.driver || 'N/A'}
                    </div>
                    <div style="font-size: 13px; margin-bottom: 3px;">
                        <strong>Type:</strong> ${shipment.vehicle?.type || 'N/A'}
                    </div>
                    <div style="font-size: 13px; margin-bottom: 3px;">
                        <strong>Speed:</strong> ${shipment.current_location.speed || 0} km/h
                    </div>
                    <div style="font-size: 13px; margin-bottom: 3px;">
                        <strong>Heading:</strong> ${shipment.current_location.heading || 'N/A'}
                    </div>
                    <div style="margin-top: 6px; padding-top: 6px; border-top: 1px solid #e5e7eb;">
                        <div style="font-size: 12px; color: #666;">
                            Tracking: ${shipment.tracking_number}
                        </div>
                    </div>
                </div>
            `);
            
            bounds.extend([shipment.current_location.lat, shipment.current_location.lng]);
            
            // Route polyline (dashed purple line)
            const routePoints = [
                [shipment.origin.lat, shipment.origin.lng],
                [shipment.current_location.lat, shipment.current_location.lng],
                [shipment.destination.lat, shipment.destination.lng]
            ];
            
            L.polyline(routePoints, {
                color: '#8b5cf6',
                weight: 3,
                opacity: 0.6,
                dashArray: '10, 10',
                lineJoin: 'round'
            }).addTo(markersLayer);
            
        } catch (error) {
            console.error('Error plotting shipment:', shipment.tracking_number, error);
        }
    });
    
    // Fit bounds to show all markers with padding
    if (bounds.isValid()) {
        setTimeout(() => {
            map.fitBounds(bounds, { 
                padding: [60, 60],
                maxZoom: 12,
                animate: true,
                duration: 0.5
            });
        }, 100);
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, preparing map initialization...');
    
    // Wait for layout to be ready
    setTimeout(() => {
        const initialized = initMap();
        
        if (initialized) {
            // Get initial data from Livewire
            const initialData = window.livewire?.find('live-map')?.mapDataArray;
            
            if (initialData && initialData.length > 0) {
                console.log('Plotting initial data:', initialData.length);
                setTimeout(() => plotShipments(initialData), 800);
            } else {
                console.log('No initial data available');
            }
        }
    }, 500);
});

// Handle window resize
let resizeTimer;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        if (map && isMapInitialized) {
            map.invalidateSize(true);
            console.log('Map resized after window resize');
        }
    }, 200);
});

// Livewire event listeners
document.addEventListener('livewire:init', () => {
    console.log('Livewire initialized, setting up listeners...');
    
    Livewire.on('map-data-updated', (event) => {
        console.log('Map data updated event received:', event.mapData?.length || 0);
        if (event.mapData) {
            plotShipments(event.mapData);
        }
    });
    
    Livewire.on('map-refreshed', () => {
        console.log('Map refresh requested');
        if (map && isMapInitialized) {
            map.invalidateSize(true);
        }
    });
    
    Livewire.on('focus-on-shipment', (event) => {
        console.log('Focus on shipment:', event.shipmentId);
        
        if (!map || !isMapInitialized) return;
        
        // Find the shipment in current data
        const component = window.livewire?.find('live-map');
        const mapData = component?.mapDataArray;
        
        if (mapData) {
            const shipment = mapData.find(s => s.id === event.shipmentId);
            if (shipment && shipment.current_location) {
                map.setView(
                    [shipment.current_location.lat, shipment.current_location.lng], 
                    10,
                    { animate: true, duration: 1 }
                );
                
                // Find and open the vehicle marker popup
                markersLayer.eachLayer((layer) => {
                    if (layer instanceof L.Marker) {
                        const latLng = layer.getLatLng();
                        if (Math.abs(latLng.lat - shipment.current_location.lat) < 0.001 &&
                            Math.abs(latLng.lng - shipment.current_location.lng) < 0.001) {
                            setTimeout(() => layer.openPopup(), 500);
                        }
                    }
                });
            }
        }
    });
});

// Zoom control functions
window.zoomIn = () => {
    if (map && isMapInitialized) {
        map.zoomIn();
    }
};

window.zoomOut = () => {
    if (map && isMapInitialized) {
        map.zoomOut();
    }
};
</script>
@endpush