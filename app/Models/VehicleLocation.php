<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    
}
