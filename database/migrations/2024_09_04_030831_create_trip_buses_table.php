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
        Schema::create('trip_buses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_booking')->constrained('bookings')->cascadeOnDelete();
            $table->foreignId('id_bus')->constrained('buses')->cascadeOnDelete();
            //$table->foreignId('id_customer')->constrained('users')->cascadeOnDelete()->nullable();
            $table->foreignId('id_driver')->constrained('users')->cascadeOnDelete();
            $table->foreignId('id_codriver')->constrained('users')->cascadeOnDelete();
            $table->decimal('nominal', 12, 2)->nullable();
            $table->boolean('legrest')->nullable();
            $table->integer('km_start')->nullable();
            $table->integer('km_end')->nullable();
            $table->decimal('total_spend', 12, 2)->nullable();
            $table->decimal('total_spend_bbm', 12, 2)->nullable();
            $table->foreignId('id_ms_trip')->constrained('ms_trips')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_buses');
    }
};
