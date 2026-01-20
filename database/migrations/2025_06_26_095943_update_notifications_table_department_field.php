<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if the department column exists
        if (Schema::hasColumn('notifications', 'department')) {
            // First add a new department_id column
            Schema::table('notifications', function (Blueprint $table) {
                $table->unsignedBigInteger('department_id')->nullable()->after('department');
            });
            
            // Then migrate data from department to department_id
            // Use PHP to handle the data migration instead of a direct SQL JOIN to avoid collation issues
            $notifications = DB::table('notifications')->whereNotNull('department')->get();
            foreach ($notifications as $notification) {
                $department = DB::table('departments')->where('name', 'like', '%' . $notification->department . '%')->first();
                if ($department) {
                    DB::table('notifications')->where('id', $notification->id)->update(['department_id' => $department->id]);
                }
            }
            
            // Then drop the old department column
            Schema::table('notifications', function (Blueprint $table) {
                $table->dropColumn('department');
            });
            
            // Add foreign key constraint
            Schema::table('notifications', function (Blueprint $table) {
                $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Check if the department_id column exists
        if (Schema::hasColumn('notifications', 'department_id')) {
            // First add a new department column
            Schema::table('notifications', function (Blueprint $table) {
                $table->string('department')->nullable()->after('recipient_type');
            });
            
            // Then migrate data from department_id to department
            // Use PHP to handle the data migration instead of a direct SQL JOIN to avoid collation issues
            $notifications = DB::table('notifications')->whereNotNull('department_id')->get();
            foreach ($notifications as $notification) {
                $department = DB::table('departments')->where('id', $notification->department_id)->first();
                if ($department) {
                    DB::table('notifications')->where('id', $notification->id)->update(['department' => $department->name]);
                }
            }
            
            // Drop the foreign key constraint and department_id column
            Schema::table('notifications', function (Blueprint $table) {
                $table->dropForeign(['department_id']);
                $table->dropColumn('department_id');
            });
        }
    }
};
