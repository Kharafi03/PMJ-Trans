<?php

use Doctrine\DBAL\Schema\ForeignKeyConstraint;
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
        Schema::create('outcomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_m_outcome')->constrained('m_outcomes')->cascadeOnDelete();
            $table->foreignId('id_booking')->constrained('bookings')->cascadeOnDelete();
            $table->foreignId('id_m_method_payment')->constrained('m_method_payments')->cascadeOnDelete();
            $table->string('description')->nullable();
            $table->decimal('nominal', 12, 2)->nullable();
            $table->dateTime('datetime')->nullable();
            $table->longText('image_receipt')->nullable();
            $table->boolean('check');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outcomes');
    }
};
