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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('driver_number')->unique()->comment('e.g., DRV-001');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('phone');
            $table->string('phone_alt')->nullable()->comment('Alternative phone');
            
            // License Information
            $table->string('license_number')->unique();
            $table->enum('license_type', [
                'Code 8', 
                'Code 10', 
                'Code 14',
                'Forklift',
            ])->default('Code 10');
            $table->date('license_expiry');
            
            // Employment Details
            $table->date('hire_date')->nullable();
            $table->enum('employment_type', [
                'full_time',
                'part_time',
                'contract'
            ])->default('full_time');
            $table->enum('status', [
                'active',
                'inactive',
                'on_leave',
                'suspended'
            ])->default('active');
            
            // Address
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            
            // Emergency Contact
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            
            // Additional Information
            $table->text('notes')->nullable();
            $table->date('last_medical_checkup')->nullable();
            $table->date('next_medical_checkup')->nullable();
            
            $table->timestamps();
            $table->softDeletes(); // Soft delete for record keeping
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};