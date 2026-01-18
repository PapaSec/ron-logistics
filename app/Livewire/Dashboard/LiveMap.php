<?php

namespace App\Livewire\Dashboard;

use App\Models\{Shipment, VehicleLocation};
use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.app')]
#[Title('Live Map - Ron Logistics')]
class LiveMap extends Component
{
    public $selectedShipment = null;
    public $statusFilter = 'all';
    public $searchTerm = '';
    public $mapDataArray = []; // Added to store map data

    // Cities with coordinates (South African cities)
    protected $cityCoordinates = [
        'Johannesburg' => ['lat' => -26.2041, 'lng' => 28.0473],
        'Johannesburg CBD' => ['lat' => -26.2041, 'lng' => 28.0473],
        'Pretoria' => ['lat' => -25.7479, 'lng' => 28.2293],
        'Pretoria Central' => ['lat' => -25.7479, 'lng' => 28.2293],
        'Cape Town' => ['lat' => -33.9249, 'lng' => 18.4241],
        'Cape Town City' => ['lat' => -33.9249, 'lng' => 18.4241],
        'Durban' => ['lat' => -29.8587, 'lng' => 31.0218],
        'Durban Harbor' => ['lat' => -29.8587, 'lng' => 31.0218],
        'Port Elizabeth' => ['lat' => -33.9608, 'lng' => 25.6022],
        'Bloemfontein' => ['lat' => -29.0852, 'lng' => 26.1596],
        'East London' => ['lat' => -33.0153, 'lng' => 27.9116],
        'Polokwane' => ['lat' => -23.9045, 'lng' => 29.4689],
        'Nelspruit' => ['lat' => -25.4753, 'lng' => 30.9703],
        'Kimberley' => ['lat' => -28.7282, 'lng' => 24.7499],
        'Rustenburg' => ['lat' => -25.6672, 'lng' => 27.2424],
        'Pietermaritzburg' => ['lat' => -29.6167, 'lng' => 30.3928],
        'George' => ['lat' => -33.9633, 'lng' => 22.4617],
        'Welkom' => ['lat' => -27.9770, 'lng' => 26.7320],
    ];

    public function mount()
    {
        // Simulate GPS data for active shipments on first load
        $this->simulateGPSData();
        $this->updateMapData();
    }

    // Get active shipments with their vehicles and latest locations
    #[\Livewire\Attributes\Computed]
    public function activeShipments()
    {
        return Shipment::with(['vehicle.driver'])
            ->where('status', 'in_transit')
            ->when($this->searchTerm, function ($query) {
                $query->where(function ($q) {
                    $q->where('tracking_number', 'LIKE', "%{$this->searchTerm}%")
                        ->orWhere('receiver_name', 'LIKE', "%{$this->searchTerm}%")
                        ->orWhere('destination_city', 'LIKE', "%{$this->searchTerm}%");
                });
            })
            ->latest()
            ->get()
            ->map(function ($shipment) {
                // Get latest location for this shipment's vehicle
                if ($shipment->vehicle) {
                    $location = VehicleLocation::where('vehicle_id', $shipment->vehicle_id)
                        ->where('shipment_id', $shipment->id)
                        ->latest('recorded_at')
                        ->first();

                    $shipment->current_location = $location;
                }

                return $shipment;
            });
    }

    // Get map data for JavaScript - UPDATED
    #[\Livewire\Attributes\Computed]
    public function mapData()
    {
        $shipments = $this->activeShipments;

        $data = $shipments->map(function ($shipment) {
            $origin = $this->getCoordinatesForCity($shipment->origin_city);
            $destination = $this->getCoordinatesForCity($shipment->destination_city);

            return [
                'id' => $shipment->id,
                'tracking_number' => $shipment->tracking_number,
                'status' => $shipment->status,
                'priority' => $shipment->priority,
                'origin' => [
                    'city' => $shipment->origin_city,
                    'lat' => $origin['lat'],
                    'lng' => $origin['lng'],
                ],
                'destination' => [
                    'city' => $shipment->destination_city,
                    'lat' => $destination['lat'],
                    'lng' => $destination['lng'],
                ],
                'current_location' => $shipment->current_location ? [
                    'lat' => (float) $shipment->current_location->latitude,
                    'lng' => (float) $shipment->current_location->longitude,
                    'speed' => $shipment->current_location->speed,
                    'heading' => $shipment->current_location->heading,
                    'location_name' => $shipment->current_location->location_name,
                ] : $origin,
                'vehicle' => $shipment->vehicle ? [
                    'number' => $shipment->vehicle->vehicle_number,
                    'type' => $shipment->vehicle->type,
                    'driver' => $shipment->vehicle->driver ? $shipment->vehicle->driver->full_name : 'N/A',
                ] : null,
                'receiver_name' => $shipment->receiver_name,
                'estimated_delivery' => $shipment->estimated_delivery_date->format('M d, Y'),
            ];
        })->toArray();
        
        // Update the array property
        $this->mapDataArray = $data;
        
        return $data;
    }

    // Update map data and dispatch event
    public function updateMapData()
    {
        // Force recomputation of map data
        $this->mapData;
        $this->dispatch('map-data-updated', mapData: $this->mapDataArray);
    }

    // Simulate GPS data for demo purposes
    public function simulateGPSData()
    {
        $activeShipments = Shipment::where('status', 'in_transit')
            ->with('vehicle')
            ->get();

        foreach ($activeShipments as $shipment) {
            if (!$shipment->vehicle)
                continue;

            // Check if we already have recent location data (within last 5 minutes)
            $recentLocation = VehicleLocation::where('vehicle_id', $shipment->vehicle_id)
                ->where('shipment_id', $shipment->id)
                ->where('recorded_at', '>', now()->subMinutes(5))
                ->exists();

            if ($recentLocation)
                continue;

            // Get origin and destination coordinates
            $origin = $this->getCoordinatesForCity($shipment->origin_city);
            $destination = $this->getCoordinatesForCity($shipment->destination_city);

            // Generate random point along the route (simulate progress)
            $progress = rand(10, 90) / 100; // 10% to 90% progress
            $currentLat = $origin['lat'] + ($destination['lat'] - $origin['lat']) * $progress;
            $currentLng = $origin['lng'] + ($destination['lng'] - $origin['lng']) * $progress;

            // Create location record
            VehicleLocation::create([
                'vehicle_id' => $shipment->vehicle_id,
                'shipment_id' => $shipment->id,
                'latitude' => $currentLat,
                'longitude' => $currentLng,
                'speed' => rand(40, 100), // Random speed between 40-100 km/h
                'heading' => $this->calculateHeading($origin, $destination),
                'location_name' => 'En route',
                'recorded_at' => now(),
            ]);
        }
        
        $this->updateMapData();
    }

    // Get coordinates for a city
    protected function getCoordinatesForCity($cityName)
    {
        // Try exact match first
        if (isset($this->cityCoordinates[$cityName])) {
            return $this->cityCoordinates[$cityName];
        }

        // Try partial match
        foreach ($this->cityCoordinates as $city => $coords) {
            if (stripos($city, $cityName) !== false || stripos($cityName, $city) !== false) {
                return $coords;
            }
        }

        // Default to Johannesburg if not found
        return $this->cityCoordinates['Johannesburg'];
    }

    // Calculate heading direction
    protected function calculateHeading($from, $to)
    {
        $latDiff = $to['lat'] - $from['lat'];
        $lngDiff = $to['lng'] - $from['lng'];

        if (abs($latDiff) > abs($lngDiff)) {
            return $latDiff > 0 ? 'N' : 'S';
        } else {
            return $lngDiff > 0 ? 'E' : 'W';
        }
    }

    public function updated($property)
{
    // Update map when search term changes
    if ($property === 'searchTerm') {
        $this->dispatch('map-data-updated', mapData: $this->mapData);
    }
}

    // Refresh map data (called via polling)
    public function refreshMap()
    {
        // In production, this would update vehicle locations from GPS devices
        // For demo, we slightly update positions
        $this->simulateMovement();
        $this->dispatch('map-refreshed');
    }

    // Simulate vehicle movement
    protected function simulateMovement()
    {
        $recentLocations = VehicleLocation::where('recorded_at', '>', now()->subHour())
            ->with('shipment')
            ->get();

        foreach ($recentLocations as $location) {
            if (!$location->shipment)
                continue;

            $origin = $this->getCoordinatesForCity($location->shipment->origin_city);
            $destination = $this->getCoordinatesForCity($location->shipment->destination_city);

            // Move slightly towards destination
            $latDiff = ($destination['lat'] - $location->latitude) * 0.05; // Move 5% closer
            $lngDiff = ($destination['lng'] - $location->longitude) * 0.05;

            VehicleLocation::create([
                'vehicle_id' => $location->vehicle_id,
                'shipment_id' => $location->shipment_id,
                'latitude' => $location->latitude + $latDiff,
                'longitude' => $location->longitude + $lngDiff,
                'speed' => rand(40, 100),
                'heading' => $location->heading,
                'location_name' => 'En route',
                'recorded_at' => now(),
            ]);
        }
        
        $this->updateMapData();
    }

    // Select shipment
    public function selectShipment($shipmentId)
    {
        $this->selectedShipment = Shipment::with(['vehicle.driver'])->find($shipmentId);
        $this->dispatch('focus-on-shipment', shipmentId: $shipmentId);
    }

    public function render()
    {
        return view('livewire.dashboard.live-map', [
            'activeShipments' => $this->activeShipments,
            'mapData' => $this->mapData,
        ]);
    }
}