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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Basic Info
            $table->string('sender_name');
            $table->string('sender_name');
            $table->string('receiver_name');
            $table->string('receiver_phone');

            // Locations
            $table->string('origin_city');
            $table->string('destination_city');

            // Package Details, 
            $table->text('description');
            $table->decimal('weight', 8, 2);
            $table->integer('quantity')->default(1);
            $table->decimal('value', 10, 2)->nullable();

            // Status
            $table->enum('status', ['pending', 'in_transit', 'delivered', 'cancelled'])->default('pending');

            // Priority
            $table->enum('priority', ['standard', 'express', 'economy']);

            // Dates
            $table->date('pickup_date');
            $table->date('estimated_delivery_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
