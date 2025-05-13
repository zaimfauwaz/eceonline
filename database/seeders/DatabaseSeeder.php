<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Branch;
use App\Models\Car;
use App\Models\Booking;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Branch::factory(10)->create();
        Car::factory(10)->create();

        $this->call([
            StaffSeeder::class,
            BookingSeeder::class,
            // Add other seeders here
        ]);
       
    }
}
