<?php

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
        Schema::table('employees', function (Blueprint $table) {
            // Employee category: trainee, intern, or employee
            $table->enum('employee_category', ['trainee', 'intern', 'employee'])->after('employment_type')->nullable();
            
            // Fields for trainee and intern
            $table->date('training_start_date')->after('employee_category')->nullable();
            $table->date('training_end_date')->after('training_start_date')->nullable();
            
            // Fields for employee
            $table->boolean('contract_renewable')->after('training_end_date')->default(false);
            $table->integer('paid_leave_per_month')->after('contract_renewable')->nullable();
            
            // Document upload field
            $table->string('experience_letter_path')->after('paid_leave_per_month')->nullable();
            
            // Employment status field
            $table->enum('employment_status', ['active', 'resigned', 'terminated'])->after('experience_letter_path')->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn([
                'employee_category',
                'training_start_date',
                'training_end_date',
                'contract_renewable',
                'paid_leave_per_month',
                'experience_letter_path',
                'employment_status'
            ]);
        });
    }
};
