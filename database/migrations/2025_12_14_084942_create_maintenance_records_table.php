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
        Schema::create('maintenance_records', function (Blueprint $table) {
            $table->id();
            
            // Vehicle
            $table->unsignedBigInteger('vehicle_id');
            
            // Maintenance Details
            $table->string('maintenance_number')->unique()->comment('e.g., MNT-001');
            $table->date('date');
            $table->enum('type', [
                'routine',
                'repair',
                'inspection',
                'tire_change',
                'oil_change',
                'brake_service',
                'other'
            ])->default('routine');
            
            // Service Details
            $table->string('service_provider')->nullable()->comment('Workshop/Mechanic name');
            $table->text('description');
            $table->decimal('odometer_reading', 10, 2)->comment('km at service');
            
            // Cost
            $table->decimal('parts_cost', 10, 2)->default(0);
            $table->decimal('labor_cost', 10, 2)->default(0);
            $table->decimal('total_cost', 10, 2);
            
            // Status
            $table->enum('status', [
                'scheduled',
                'in_progress',
                'completed',
                'cancelled'
            ])->default('completed');
            
            // Next Service
            $table->date('next_service_date')->nullable();
            $table->decimal('next_service_odometer', 10, 2)->nullable()->comment('Next service at km');
            
            // Additional Info
            $table->string('invoice_number')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->comment('User who recorded');
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_records');
    }
};