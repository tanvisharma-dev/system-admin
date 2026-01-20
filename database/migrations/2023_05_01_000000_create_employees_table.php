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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 20)->unique();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('phone', 15)->nullable();
            $table->date('dob')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('employment_type', 50)->nullable();
            $table->string('department', 100)->nullable();
            $table->string('designation', 100)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};