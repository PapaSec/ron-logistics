<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
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
        'estimated_delivery_date',
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'estimated'
    ];
}
