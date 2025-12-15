<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelRecord extends Model
{
    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'date',
        'quantity',
        'price_per_liter',
        'total_cost',
        'fuel_type',
        'odometer_reading',
        'distance_traveled',
        'location',
        'station_name',
        'receipt_number',
        'payment_method',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'date' => 'date',
        'quantity' => 'decimal:2',
        'price_per_liter' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'odometer_reading' => 'decimal:2',
        'distance_traveled' => 'decimal:2',
    ];

    // Relationships
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // Helper methods
    public function getFuelEfficiencyAttribute(): ?float
    {
        if ($this->distance_traveled && $this->quantity > 0) {
            return round($this->distance_traveled / $this->quantity, 2);
        }
        return null;
    }

    // Fuel efficiency in km/l
    public function calculateFuelEfficiency(): ?float
    {
        return $this->fuel_efficiency;
    }
}
