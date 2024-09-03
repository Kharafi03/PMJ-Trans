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
            $table->string('name', 24); // Kolom name dengan tipe varchar panjang 24 karakter
            $table->string('license_plate', 10); // Kolom license_plate dengan tipe varchar panjang 8 karakter
            $table->integer('production_year'); // Kolom production_year dengan tipe integer
            $table->string('color', 10); // Kolom color dengan tipe varchar panjang 10 karakter
            $table->string('machine_number', 255); // Kolom machine_number dengan tipe varchar panjang 255 karakter
            $table->string('chassis_number', 255); // Kolom chassis_number dengan tipe varchar panjang 255 karakter
            $table->integer('capacity'); // Kolom capacity dengan tipe integer
            $table->integer('baggage'); // Kolom baggage dengan tipe integer
            $table->foreignId('ms_buses_id')->constrained('ms_buses')->cascadeOnDelete();
            $table->softDeletes(); // Kolom deleted_at
            $table->timestamps(); // Kolom created_at dan updated_at
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
