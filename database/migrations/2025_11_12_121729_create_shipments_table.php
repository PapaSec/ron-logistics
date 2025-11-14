<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'estimated_delivery_date' => 'date',
        'weight' => 'decimal:2',
        'value' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}