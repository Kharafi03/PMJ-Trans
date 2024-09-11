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
        Schema::create('trip_bus_spends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_trip_bus')->constrained('trip_buses')->cascadeOnDelete();
            $table->foreignId('id_m_spend')->constrained('m_spends')->cascadeOnDelete();
            $table->string('description')->nullable();
            $table->decimal('nominal')->nullable();
            $table->integer('kilometer')->nullable();
            $table->longText('image_receipt')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->float('latitude', 10,8)->nullable();
            $table->float('longitude', 10,8)->nullable();
            $table->softDeletes(); // Kolom deleted_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_bus_spends');
    }
};