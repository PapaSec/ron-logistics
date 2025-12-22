<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shipment_id')->nullable()->constrained()->nullOnDelete();
            
            // GPS Coordinates
            $table->decimal('latitude', 10, 8)->comment('GPS Latitude');
            $table->decimal('longitude', 11, 8)->comment('GPS Longitude');
            
            // Additional tracking data
            $table->decimal('speed', 5, 2)->nullable()->comment('Speed in km/h');
            $table->string('heading', 10)->nullable()->comment('Direction: N, S, E, W, NE, etc.');
            $table->string('location_name')->nullable()->comment('City or area name');
            
            // Timestamps
            $table->timestamp('recorded_at')->comment('When location was recorded');
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['vehicle_id', 'recorded_at']);
            $table->index('shipment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_locations');
    }
};