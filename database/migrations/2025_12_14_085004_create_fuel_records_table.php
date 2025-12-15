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
        Schema::create('fuel_records', function (Blueprint $table) {
            $table->id();
            
            // Vehicle & Driver
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            
            // Fuel Details
            $table->date('date');
            $table->decimal('quantity', 10, 2)->comment('Liters');
            $table->decimal('price_per_liter', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->string('fuel_type')->default('Diesel')->comment('Diesel, Petrol, etc.');
            
            // Odometer
            $table->decimal('odometer_reading', 10, 2)->comment('Current km reading');
            $table->decimal('distance_traveled', 10, 2)->nullable()->comment('Since last fill-up');
            
            // Location & Station
            $table->string('location')->nullable()->comment('City/Area');
            $table->string('station_name')->nullable()->comment('Fuel station name');
            
            // Receipt & Payment
            $table->string('receipt_number')->nullable();
            $table->enum('payment_method', ['cash', 'card', 'fuel_card', 'account'])->default('cash');
            
            // Additional Info
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->comment('User who recorded');
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_records');
    }
};