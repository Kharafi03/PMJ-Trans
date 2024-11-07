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
            $table->string('kir_code')->nullable();
            $table->foreignId('id_bus')->constrained('buses')->cascadeOnDelete();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->string('description', 255) ->nullable();
            $table->date('date_test') ->nullable();
            $table->date('expiration') ->nullable();
            $table->decimal('nominal', 12,2) ->nullable();
            $table->longText('image') ->nullable();
            $table->foreignId('id_m_method_payment')->constrained('m_method_payments')->cascadeOnDelete();
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
