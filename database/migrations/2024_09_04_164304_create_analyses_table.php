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
        Schema::create('analyses', function (Blueprint $table) {
            $table->id();
            $table->date('month');
            $table->integer('total_bus');
            $table->integer('total_driver');
            $table->decimal('total_income');
            $table->decimal('total_spending');
            $table->decimal('total_profit');
            $table->integer('total_customer');
            $table->integer('total_trip_finish');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analyses');
    }
};