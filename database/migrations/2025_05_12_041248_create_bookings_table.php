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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->foreignId('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->references('user_id')->on('users')->onDelete('cascade');
            $table->datetime('booking_start');
            $table->datetime('booking_end');
            $table->integer('booking_status'); // Remove default value and keep it required
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE bookings AUTO_INCREMENT = 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
