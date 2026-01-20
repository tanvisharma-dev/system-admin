<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Temporarily disable foreign key constraints
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear the departments table
        Department::truncate();
        
        // Re-enable foreign key constraints
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Create default departments
        $departments = [
            [
                'name' => 'Human Resources',
                'description' => 'Responsible for recruiting, hiring, and managing employee benefits and relations.',
                'status' => 1,
            ],
            [
                'name' => 'Finance',
                'description' => 'Manages company finances, budgeting, accounting, and financial reporting.',
                'status' => 1,
            ],
            [
                'name' => 'Information Technology',
                'description' => 'Manages and maintains company technology infrastructure and systems.',
                'status' => 1,
            ],
            [
                'name' => 'Marketing',
                'description' => 'Develops and implements marketing strategies to promote the company\'s products or services.',
                'status' => 1,
            ],
            [
                'name' => 'Sales',
                'description' => 'Responsible for selling company products or services and managing client relationships.',
                'status' => 1,
            ],
            [
                'name' => 'Operations',
                'description' => 'Oversees the production and delivery of the company\'s products or services.',
                'status' => 1,
            ],
            [
                'name' => 'Research and Development',
                'description' => 'Focuses on innovation and development of new products or services.',
                'status' => 1,
            ],
            [
                'name' => 'Customer Service',
                'description' => 'Provides support and assistance to customers before, during, and after purchases.',
                'status' => 1,
            ],
            [
                'name' => 'Legal',
                'description' => 'Handles legal matters, compliance, and risk management for the company.',
                'status' => 1,
            ],
            [
                'name' => 'Administration',
                'description' => 'Provides administrative support to ensure efficient operation of the company.',
                'status' => 1,
            ],
        ];
        
        foreach ($departments as $department) {
            Department::create($department);
        }
        
        $this->command->info('Departments seeded successfully!');
    }
}