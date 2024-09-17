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
        Schema::create('trip_finisheds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_booking')->constrained('bookings')->cascadeOnDelete();
            $table->decimal('trip_value', 12, 2)->nullable();
            $table->decimal('total_spend', 12, 2)->nullable();
            $table->decimal('profit', 12, 2)->nullable();
            $table->foreignId('id_ms_trip_finished')->constrained('ms_trip_finisheds')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_finisheds');
    }
};
