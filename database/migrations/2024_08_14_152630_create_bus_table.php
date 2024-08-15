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
        Schema::create('bus', function (Blueprint $table) {
            $table->string('id')->primary(); // Custom string ID as primary key
            $table->string('nama_bus'); // Nama Bus
            $table->string('plat_nomor')->unique(); // Plat Nomor
            $table->year('tahun'); // Tahun
            $table->string('warna'); // Warna
            $table->string('no_mesin')->unique(); // No Mesin
            $table->string('no_sasis')->unique(); // No Sasis
            $table->integer('jumlah_penumpang'); // Jumlah Penumpang
            $table->integer('bagasi'); // Bagasi
            $table->string('gambar1')->nullable(); // Gambar1
            $table->string('gambar2')->nullable(); // Gambar2
            $table->string('gambar3')->nullable(); // Gambar3
            $table->string('gambar4')->nullable(); // Gambar4
            $table->enum('status', ['aktif', 'tidak_aktif']); // Status
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus');
    }
};
