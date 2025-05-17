<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


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
            'password' => bcrypt('Staff1345'), // Use a secure password
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 1, // Assuming branch_id 1 exists
        ]);

        DB::table('users')->insert([
            'name' => 'Jackson Smith',
            'email' => 'jackson@eceonline.com',
            'role' => 9, // Assuming 9 is the role for admin
            'password' => bcrypt('Admin1345'), // Use a secure password
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 1, // Assuming branch_id 1 exists
        ]);

        DB::table('users')->insert([
            'name' => 'Alice Wang',
            'email' => 'alice@gmail.com',
            'role' => 7, // Assuming 7 is the role for customer
            'password' => bcrypt('Alice1345'), // Use a secure password
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Adding additional staff users
        DB::table('users')->insert([
            'name' => 'Sophia Johnson',
            'email' => 'sophia@eceonline.com',
            'role' => 3,
            'password' => bcrypt('Staff1345'),
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'Liam Brown',
            'email' => 'liam@eceonline.com',
            'role' => 3,
            'password' => bcrypt('Staff1345'),
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 3,
        ]);

        DB::table('users')->insert([
            'name' => 'Olivia Davis',
            'email' => 'olivia@eceonline.com',
            'role' => 3,
            'password' => bcrypt('Staff1345'),
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 4,
        ]);

        DB::table('users')->insert([
            'name' => 'Noah Wilson',
            'email' => 'noah@eceonline.com',
            'role' => 3,
            'password' => bcrypt('Staff1345'),
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 5,
        ]);

        DB::table('users')->insert([
            'name' => 'Emma Martinez',
            'email' => 'emma@eceonline.com',
            'role' => 3,
            'password' => bcrypt('Staff1345'),
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 6,
        ]);

        DB::table('users')->insert([
            'name' => 'James Anderson',
            'email' => 'james@eceonline.com',
            'role' => 3,
            'password' => bcrypt('Staff1345'),
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 7,
        ]);

        DB::table('users')->insert([
            'name' => 'Ava Thomas',
            'email' => 'ava@eceonline.com',
            'role' => 3,
            'password' => bcrypt('Staff1345'),
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 8,
        ]);

        DB::table('users')->insert([
            'name' => 'William Garcia',
            'email' => 'william@eceonline.com',
            'role' => 3,
            'password' => bcrypt('Staff1345'),
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 9,
        ]);

        DB::table('users')->insert([
            'name' => 'Isabella Rodriguez',
            'email' => 'isabella@eceonline.com',
            'role' => 3,
            'password' => bcrypt('Staff1345'),
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 10,
        ]);

        // Adding additional admin users
        DB::table('users')->insert([
            'name' => 'Mason Lee',
            'email' => 'mason@eceonline.com',
            'role' => 9,
            'password' => bcrypt('Admin1345'),
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 1, // Main branch
        ]);

        DB::table('users')->insert([
            'name' => 'Mia Harris',
            'email' => 'mia@eceonline.com',
            'role' => 9,
            'password' => bcrypt('Admin1345'),
            'created_at' => now(),
            'updated_at' => now(),
            'branch_id' => 1, // Main branch
        ]);

        // Update StaffSeeder to create 10 staff members with real names and emails
        $staffMembers = [
            ['name' => 'John Doe', 'email' => 'john.doe@eceonline.com'],
            ['name' => 'Jane Smith', 'email' => 'jane.smith@eceonline.com'],
            ['name' => 'Michael Brown', 'email' => 'michael.brown@eceonline.com'],
            ['name' => 'Emily Davis', 'email' => 'emily.davis@eceonline.com'],
            ['name' => 'Chris Wilson', 'email' => 'chris.wilson@eceonline.com'],
            ['name' => 'Sarah Johnson', 'email' => 'sarah.johnson@eceonline.com'],
            ['name' => 'David Martinez', 'email' => 'david.martinez@eceonline.com'],
            ['name' => 'Laura Garcia', 'email' => 'laura.garcia@eceonline.com'],
            ['name' => 'James Anderson', 'email' => 'james.anderson@eceonline.com'],
            ['name' => 'Sophia Thomas', 'email' => 'sophia.thomas@eceonline.com'],
        ];

        foreach ($staffMembers as $index => $staff) {
            DB::table('users')->insert([
                'name' => $staff['name'],
                'email' => $staff['email'],
                'role' => 3, // Role for staff
                'password' => bcrypt('Staff1345'),
                'created_at' => now(),
                'updated_at' => now(),
                'branch_id' => ($index % 10) + 1, // Distribute staff across 10 branches
            ]);
        }
    }
}