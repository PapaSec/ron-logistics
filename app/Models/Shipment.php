<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Required for the user() relationship

class Shipment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tracking_number',
        'user_id',
        'sender_name',
        'sender_phone',
        'receiver_name',
        'receiver_phone',
        'origin_city',
        'destination_city',
        'description',
        'weight',
        'quantity',
        'value',
        'status',
        'priority',
        'pickup_date',
        'vehicle_id',
        'estimated_delivery_date',
    ];

    /**
     * The attributes that should be cast to native types.
     * * NOTE: Fixed the incomplete cast definition for 'estimated_delivery_date'.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'pickup_date' => 'date',
        'estimated_delivery_date' => 'date',
    ];

    // Relationships Vehicles
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the user that owns the shipment.
     */
    public function user()
    {
        // Defines a one-to-many inverse relationship (Shipment belongs to User)
        return $this->belongsTo(User::class);
    }
}
