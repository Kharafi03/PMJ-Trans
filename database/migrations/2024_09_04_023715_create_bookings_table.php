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
            $table->foreignId('id_cus')->constrained('users')->cascadeOnDelete();
            $table->string('destination_point', 50)->nullable();
            $table->dateTime('destination_time')->nullable();
            $table->integer('capacity')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('pickup_point', 50)->nullable();
            $table->dateTime('pickup_time')->nullable();
            $table->string('fleet_type')->nullable();
            $table->integer('fleet_amount')->nullable();
            $table->decimal('trip_nominal', 10, 2)->nullable();
            $table->decimal('minimum_dp', 10, 2)->nullable();
            $table->foreignId('id_ms_payment')->constrained('ms_payment_bookings')->cascadeOnDelete();
            $table->decimal('payment_received', 10, 2)->nullable();
            $table->decimal('payment_remaining', 10, 2)->nullable();
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
