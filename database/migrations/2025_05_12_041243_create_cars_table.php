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
        Schema::create('cars', function (Blueprint $table) {
            $table->id('car_id');
            $table->foreignId('branch_id')->references('branch_id')->on('branches')->onDelete('cascade');
            $table->string('car_brand');
            $table->string('car_model');
            $table->string('car_color');
            $table->string('car_type');
            $table->integer('car_transmission');
            $table->integer('car_generation')->nullable();
            $table->string('car_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
        DB::statement('ALTER TABLE cars AUTO_INCREMENT = 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
