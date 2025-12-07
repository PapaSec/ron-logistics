<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {  // ← Fixed spelling
            $table->id();
            
            // Basic Info
            $table->string('vehicle_number')->unique()->comment('e.g., VEH-001');
            $table->string('type')->comment('e.g., Truck, Van, Pickup');
            $table->string('make')->nullable()->comment('e.g., Toyota, Ford');
            $table->string('model')->nullable()->comment('e.g., Hilux, F-150');
            $table->integer('year')->nullable();
            $table->string('license_plate')->unique();
            
            // Capacity & Status
            $table->decimal('capacity', 8, 2)->nullable()->comment('Max load in kg');
            $table->enum('status', [
                'available',
                'in_use',
                'maintenance',
                'out_of_service'
            ])->default('available');
            
            // Assignment (for drivers)
            $table->unsignedBigInteger('driver_id')->nullable()
                ->comment('Will be linked to drivers table later');
            
            // Optional fields
            $table->text('notes')->nullable();
            $table->date('last_maintenance')->nullable();
            $table->date('next_maintenance')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');  
    }
};