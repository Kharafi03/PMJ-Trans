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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 255)->nullable();
            $table->foreignId('id_cus')->constrained('users')->cascadeOnDelete();
            //$table->string('destination_point', 255)->nullable();
            //$table->time('destination_time')->nullable();
            $table->integer('capacity')->nullable();
            $table->dateTime('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('pickup_point', 255)->nullable();
            //$table->time('pickup_time')->nullable();
            $table->integer('fleet_amount')->nullable();
            $table->boolean('legrest')->nullable();
            $table->string('description')->nullable();
            $table->decimal('trip_nominal', 12, 2)->nullable();
            $table->decimal('minimum_dp', 12, 2)->nullable();
            $table->foreignId('id_ms_booking')->constrained('ms_bookings')->cascadeOnDelete();
            $table->foreignId('id_ms_payment')->constrained('ms_payment_bookings')->cascadeOnDelete();
            $table->decimal('payment_received', 12, 2)->nullable();
            $table->decimal('payment_remaining', 12, 2)->nullable();
            $table->decimal('total_booking_spend',12 , 2)->nullable();
            $table->decimal('profit',12 , 2)->nullable();
            $table->boolean('ticket_sent')->nullable()->default(false);  // Kolom untuk menandai email tiket
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
