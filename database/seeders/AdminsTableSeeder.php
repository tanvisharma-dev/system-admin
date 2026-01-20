<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Ankit',        // Replace with actual name
            'email' => 'admin@example.com', // Replace with the email you want
            'password' => Hash::make('123'), // Replace with a secure password
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
