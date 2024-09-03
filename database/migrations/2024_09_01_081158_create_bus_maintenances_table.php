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
        Schema::create('bus_maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bus')->constrained('buses')->cascadeOnDelete();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->foreignId('id_m_maintenance')->constrained('m_maintenances')->cascadeOnDelete();
            $table->string('description', 255)->nullable(); // Deskripsi opsional
            $table->longText('image')->nullable(); // Gambar terkait maintenance
            $table->dateTime('date'); // Tanggal maintenance
            $table->string('location')->nullable(); // Lokasi maintenance
            $table->decimal('cost', 10, 2)->nullable(); // Biaya maintenance
            $table->longText('image_receipt')->nullable(); // Gambar tanda terima
            $table->float('latitude', 10, 8)->nullable(); // Latitude
            $table->float('longitude', 10, 8)->nullable(); // Longitude
            $table->softDeletes(); // Kolom deleted_at
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_maintenances');
    }
};
