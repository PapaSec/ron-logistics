<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceRecord extends Model
{
    protected $fillable = [
        'vehicle_id',
        'maintenance_number',
        'date',
        'type',
        'service_provider',
        'description',
        'odometer_reading',
        'parts_cost',
        'labor_cost',
        'total_cost',
        'status',
        'next_service_date',
        'next_service_odometer',
        'invoice_number',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'date' => 'date',
        'odometer_reading' => 'decimal:2',
        'parts_cost' => 'decimal:2',
        'labor_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'next_service_date' => 'date',
        'next_service_odometer' => 'decimal:2',
    ];

    // Relationships
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Helper Methods
    public function isOverdue(): bool
    {
        if (!$this->next_service_date) return false;
        return $this->next_service_date < now();
    }

    public function isDueSoon(): bool
    {
        if (!$this->next_service_date) return false;
        return $this->next_service_date <= now()->addDays(30);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'scheduled' => 'blue',
            'in_progress' => 'yellow',
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'gray',
        };
    }
}