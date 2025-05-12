<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ember Marian',
            'email' => 'ember@eceonline.com',
            'role' => 3, // Assuming 3 is the role for staff
            'password' => bcrypt('ECEOnline'), // Use a secure password
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 1, // Assuming branch_id 1 exists
        ]);

        DB::table('users')->insert([
            'name' => 'Jackson Smith',
            'email' => 'jackson@eceonline.com',
            'role' => 9, // Assuming 9 is the role for admin
            'password' => bcrypt('ECEOnline'), // Use a secure password
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 1, // Assuming branch_id 1 exists
        ]);

        DB::table('users')->insert([
            'name' => 'Alice Wang',
            'email' => 'alice@eceonline.com',
            'role' => 7, // Assuming 7 is the role for customer
            'password' => bcrypt('ECEOnline'), // Use a secure password
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}