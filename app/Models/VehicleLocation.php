<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleLocation extends Model
{
    protected $fillable = [
        'vehicle_id',
        'shipment_id',
        'latitude',
        'longitude',
        'speed',
        'heading',
        'location_name',
        'recorded_at',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'speed' => 'decimal:2',
        'recorded_at' => 'datetime',
    ];

    // Relationships
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    // Helper: Get latest location for a vehicle
    public static function latestForVehicle($vehicleId)
    {
        return self::where('vehicle_id', $vehicleId)
            ->latest('recorded_at')
            ->first();
    }

    // Helper: Get location history for a shipment
    public static function historyForShipment($shipmentId, $limit = 50)
    {
        return self::where('shipment_id', $shipmentId)
            ->orderBy('recorded_at', 'desc')
            ->limit($limit)
            ->get();
    }
}