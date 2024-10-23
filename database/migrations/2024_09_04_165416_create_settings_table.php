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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('logo');
            $table->longText('address');
            $table->string('email');
            $table->string('contact');
            $table->string('open_hours');
            $table->longText('description');
            $table->longText('maps');
            $table->string('sosmed_ig');
            $table->string('sosmed_fb');
            $table->string('sosmed_yt');
            $table->longText('footer');
            $table->longText('about_us');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};