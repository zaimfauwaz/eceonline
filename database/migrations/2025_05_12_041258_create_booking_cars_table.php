<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_cars', function (Blueprint $table) {
            $table->id('booking_car_id');
            $table->foreignId('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
            $table->foreignId('car_id')->references('car_id')->on('cars')->onDelete('cascade');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE booking_cars AUTO_INCREMENT = 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_cars');
    }
};
