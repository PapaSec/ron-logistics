<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'driver_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'phone_alt',
        'license_number',
        'license_type',
        'license_expiry',
        'hire_date',
        'employment_type',
        'status',
        'address',
        'city',
        'state',
        'postal_code',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
        'notes',
        'last_medical_checkup',
        'next_medical_checkup',
    ];

    protected $casts = [
        'license_expiry' => 'date',
        'hire_date' => 'date',
        'last_medical_checkup' => 'date',
        'next_medical_checkup' => 'date',
    ];

    // Relationships
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function currentVehicle()
    {
        return $this->hasOne(Vehicle::class)->where('status', 'in_use');
    }

    // Helper methods
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function licenseExpiringSoon(): bool
    {
        if (!$this->license_expiry) return false;
        return $this->license_expiry <= now()->addDays(30);
    }

    public function medicalCheckupDue(): bool
    {
        if (!$this->next_medical_checkup) return false;
        return $this->next_medical_checkup <= now();
    }

    public function getDaysUntilLicenseExpiryAttribute(): ?int
    {
        if (!$this->license_expiry) return null;
        return now()->diffInDays($this->license_expiry, false);
    }
}