<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Car::factory(10)->create();

        $this->call([
            StaffSeeder::class,
            // Add other seeders here
        ]);
       
    }
}
