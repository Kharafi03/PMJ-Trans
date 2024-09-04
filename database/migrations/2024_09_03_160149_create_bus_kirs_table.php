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
        Schema::create('bus_kirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bus')->constrained('buses')->cascadeOnDelete();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->string('description', 255) ->nullable();
            $table->datetime('date_test') ->nullable();
            $table->datetime('expiration') ->nullable();
            $table->decimal('cost', 10,2) ->nullable();
            $table->longText('image') ->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_kirs');
    }
};
