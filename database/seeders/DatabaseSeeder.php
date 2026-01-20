<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call the department seeder first since employees depend on departments
        $this->call([
            DepartmentSeeder::class,
            EmployeeSeeder::class,
        ]);
    }
}
