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
        Schema::table('reminders', function (Blueprint $table) {
            $table->enum('recipient_type', ['all', 'department', 'individual'])->default('all')->after('type');
            $table->unsignedBigInteger('department_id')->nullable()->after('recipient_type');
            $table->unsignedInteger('employee_id')->nullable()->after('department_id');
            
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reminders', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['employee_id']);
            $table->dropColumn(['recipient_type', 'department_id', 'employee_id']);
        });
    }
};
