<?php

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Get all employees with department names but no department_id
        $employees = Employee::whereNotNull('department')
            ->whereNull('department_id')
            ->get();

        foreach ($employees as $employee) {
            // Find a department with a matching name
            $department = Department::where('name', 'like', '%' . $employee->department . '%')->first();
            
            if ($department) {
                // Update the employee with the correct department_id
                $employee->department_id = $department->id;
                $employee->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // This migration cannot be reversed as it updates data
    }
};