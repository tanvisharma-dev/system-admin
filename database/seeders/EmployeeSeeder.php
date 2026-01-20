<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the employees table first
        // Using delete instead of truncate to avoid foreign key constraint issues
        DB::table('employees')->delete();
        
        // Get all department IDs
        $departments = Department::all();
        
        if ($departments->isEmpty()) {
            $this->command->info('No departments found. Please run the DepartmentSeeder first.');
            return;
        }
        
        // Create sample employees
        $employees = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '555-123-4567',
                'address' => '123 Main St, Anytown, USA',
                'department_id' => $departments->random()->id,
                'position' => 'Manager',
                'salary' => 75000.00,
                'hire_date' => '2020-01-15',
                'status' => 'active',
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '555-987-6543',
                'address' => '456 Oak Ave, Somewhere, USA',
                'department_id' => $departments->random()->id,
                'position' => 'Developer',
                'salary' => 65000.00,
                'hire_date' => '2021-03-10',
                'status' => 'active',
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Johnson',
                'email' => 'michael.johnson@example.com',
                'phone' => '555-456-7890',
                'address' => '789 Pine St, Nowhere, USA',
                'department_id' => $departments->random()->id,
                'position' => 'Analyst',
                'salary' => 60000.00,
                'hire_date' => '2019-11-05',
                'status' => 'active',
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Williams',
                'email' => 'emily.williams@example.com',
                'phone' => '555-789-0123',
                'address' => '321 Elm St, Anyplace, USA',
                'department_id' => $departments->random()->id,
                'position' => 'HR Specialist',
                'salary' => 55000.00,
                'hire_date' => '2022-02-20',
                'status' => 'active',
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Brown',
                'email' => 'david.brown@example.com',
                'phone' => '555-234-5678',
                'address' => '654 Maple Ave, Somewhere, USA',
                'department_id' => $departments->random()->id,
                'position' => 'Accountant',
                'salary' => 58000.00,
                'hire_date' => '2020-07-12',
                'status' => 'inactive',
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Miller',
                'email' => 'sarah.miller@example.com',
                'phone' => '555-345-6789',
                'address' => '987 Cedar St, Nowhere, USA',
                'department_id' => $departments->random()->id,
                'position' => 'Marketing Specialist',
                'salary' => 62000.00,
                'hire_date' => '2021-09-30',
                'status' => 'active',
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Wilson',
                'email' => 'robert.wilson@example.com',
                'phone' => '555-456-7890',
                'address' => '135 Birch Ave, Anytown, USA',
                'department_id' => $departments->random()->id,
                'position' => 'IT Support',
                'salary' => 52000.00,
                'hire_date' => '2022-01-05',
                'status' => 'active',
            ],
            [
                'first_name' => 'Jennifer',
                'last_name' => 'Taylor',
                'email' => 'jennifer.taylor@example.com',
                'phone' => '555-567-8901',
                'address' => '246 Walnut St, Somewhere, USA',
                'department_id' => $departments->random()->id,
                'position' => 'Operations Manager',
                'salary' => 72000.00,
                'hire_date' => '2019-05-15',
                'status' => 'active',
            ],
            [
                'first_name' => 'William',
                'last_name' => 'Anderson',
                'email' => 'william.anderson@example.com',
                'phone' => '555-678-9012',
                'address' => '369 Spruce St, Nowhere, USA',
                'department_id' => $departments->random()->id,
                'position' => 'Financial Analyst',
                'salary' => 63000.00,
                'hire_date' => '2020-11-20',
                'status' => 'inactive',
            ],
            [
                'first_name' => 'Lisa',
                'last_name' => 'Thomas',
                'email' => 'lisa.thomas@example.com',
                'phone' => '555-789-0123',
                'address' => '159 Aspen Ave, Anyplace, USA',
                'department_id' => $departments->random()->id,
                'position' => 'Administrative Assistant',
                'salary' => 48000.00,
                'hire_date' => '2021-06-10',
                'status' => 'active',
            ],
        ];
        
        // Insert employees into the database
        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
