<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'vehicle_number',
        'type',
        'make',
        'model',
        'year',
        'license_plate',
        'capacity',
        'status',
        'driver_id',
        'notes',
        'last_maintenance',
        'next_maintenance',
    ];

    protected $casts = [
        'year' => 'integer',
        'capacity' => 'decimal:2',
        'last_maintenance' => 'date',
        'next_maintenance' => 'date',
    ];

    // Relationships 
    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }

    // Helper methods 
    public function needsMaintenance(): bool
    {
        if (!$this->next_maintenance) return false;
        return $this->next_maintenance <= now();
    }

    // Check if vehicle is available
    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    // Relationship to Driver
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // Days until next maintenance
    public function getDaysUntilMaintenanceAttribute(): ?int
    {
        if (!$this->next_maintenance) return null;
        return now()->diffInDays($this->next_maintenance, false);
    }
}
