<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::create([
            'car_name' => 'Toyota Corolla',
            'car_model' => '2022',
            'car_year' => 2022,
            'car_color' => 'White',
            'car_plate_number' => 'ABC123',
            'branch_id' => 1,
            'car_status' => 'Available',
            'car_image_url' => 'https://example.com/toyota-corolla.jpg',
        ]);

        Car::create([
            'car_name' => 'Honda Civic',
            'car_model' => '2021',
            'car_year' => 2021,
            'car_color' => 'Black',
            'car_plate_number' => 'XYZ789',
            'branch_id' => 1,
            'car_status' => 'Available',
            'car_image_url' => 'https://example.com/honda-civic.jpg',
        ]);
    }
}
