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
        Schema::table('attendances', function (Blueprint $table) {
            $table->string('comment')->nullable()->after('hours');
            // Update status enum to include 'HL' option if it doesn't already exist
            DB::statement("ALTER TABLE attendances MODIFY COLUMN status ENUM('P','A','L','HL','WFH') DEFAULT NULL");
            // Add employee_id_value column if it doesn't exist
            if (!Schema::hasColumn('attendances', 'employee_id_value')) {
                $table->string('employee_id_value', 20)->nullable()->after('employee_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('comment');
            // We don't revert the status enum or employee_id_value changes as they might be used elsewhere
        });
    }
};