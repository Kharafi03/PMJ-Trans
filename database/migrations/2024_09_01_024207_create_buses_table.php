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
        Schema::create('buses', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai primary key
            $table->string('name', 24);
            $table->string('type',255)->nullable();
            $table->string('license_plate', 16)->nullable();
            $table->integer('production_year')->nullable();
            $table->string('color', 24)->nullable();
            $table->string('machine_number', 255)->nullable();
            $table->string('chassis_number', 255)->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('baggage')->nullable();
            $table->foreignId('ms_buses_id')->constrained('ms_buses')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
