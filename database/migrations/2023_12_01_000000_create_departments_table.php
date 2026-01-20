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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1); // 1 = active, 0 = inactive
            $table->timestamps();
        });

        // Add department_id foreign key to employees table
        Schema::table('employees', function (Blueprint $table) {
            // First create the new column
            $table->unsignedBigInteger('department_id')->nullable()->after('department');
            
            // Then add the foreign key constraint
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // First remove the foreign key constraint from employees table
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });

        // Then drop the departments table
        Schema::dropIfExists('departments');
    }
};