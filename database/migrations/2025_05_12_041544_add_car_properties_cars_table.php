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
        Schema::table('cars', function (Blueprint $table) {
            $table->string('car_image_url')->nullable()->after('car_description');
            $table->integer('car_mileage')->after('car_image_url');
            $table->integer('car_horsepower')->after('car_mileage');
            $table->integer('car_top_speed')->after('car_horsepower');
            $table->string('car_fuel_type')->after('car_top_speed');
            $table->integer('car_seats')->after('car_fuel_type');
            $table->string('car_engine')->after('car_seats');
            $table->integer('car_market_price')->after('car_engine');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('car_image_url');
            $table->dropColumn('car_mileage');
            $table->dropColumn('car_horsepower');
            $table->dropColumn('car_top_speed');
            $table->dropColumn('car_fuel_type');
            $table->dropColumn('car_seats');
            $table->dropColumn('car_engine');
            $table->dropColumn('car_market_price');
        });
    }
};