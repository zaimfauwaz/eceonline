<?php
// This seeder is no longer in use.

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example seed data for bookings
        DB::table('bookings')->insert([
            [
                'booking_id' => 1,
                'user_id' => 3,
                'approved_by' => 1,
                'booking_start' => now()->addDays(3),
                'booking_end' => now()->addDays(4),
                'booking_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'user_id' => 3,
                'approved_by' => null,
                'booking_start' => now()->addDays(100),
                'booking_end' => now()->addDays(101),
                'booking_status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 0 - Pending, 1 - Approved, 2 - Rejected
        ]);

        // PIVOT TABLE SEEDING
        // Seed booking_cars pivot table
        DB::table('booking_cars')->insert([
            [
                'booking_id' => 1,
                'car_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 1,
                'car_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'car_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // END OF PIVOT TABLE SEEDING
    }
}