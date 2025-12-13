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
        Schema::table('shipments', function (Blueprint $table) {
            // Add vehicle_id column after status (or wherever you prefer)
            $table->unsignedBigInteger('vehicle_id')->nullable()->after('status');
            
            // Add foreign key constraint
            $table->foreign('vehicle_id')
                  ->references('id')
                  ->on('vehicles')
                  ->onDelete('set null'); // Set to null if vehicle is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['vehicle_id']);
            
            // Then drop the column
            $table->dropColumn('vehicle_id');
        });
    }
};