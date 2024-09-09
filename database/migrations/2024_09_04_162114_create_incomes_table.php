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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_code')->constrained('bookings')->cascadeOnDelete();
            $table->foreignId('id_m_income')->constrained('m_incomes')->cascadeOnDelete();
            $table->foreignId('id_m_method_payment')->constrained('m_method_payments')->cascadeOnDelete();
            $table->string('description')->nullable();
            $table->decimal('nominal')->nullable();
            $table->foreignId('id_ms_income')->constrained('ms_incomes')->cascadeOnDelete();
            $table->dateTime('datetime')->nullable();
            $table->longText('image_receipt')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
