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
        Schema::create('bus_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bus')->constrained('buses')->cascadeOnDelete();
            $table->longText('image'); // Jika Anda ingin menyimpan path gambar, gunakan tipe string
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_images');
    }
};
