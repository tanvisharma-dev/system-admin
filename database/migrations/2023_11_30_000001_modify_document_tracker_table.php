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
        // Check if the document_tracker table exists
        if (Schema::hasTable('document_tracker')) {
            // Add new columns to the existing table
            Schema::table('document_tracker', function (Blueprint $table) {
                // Check if columns don't exist before adding them
                if (!Schema::hasColumn('document_tracker', 'document_type')) {
                    $table->string('document_type')->nullable()->after('employee_id');
                }
                if (!Schema::hasColumn('document_tracker', 'file_path')) {
                    $table->string('file_path')->nullable()->after('document_type');
                }
                if (!Schema::hasColumn('document_tracker', 'notes')) {
                    $table->text('notes')->nullable()->after('file_path');
                }
                if (!Schema::hasColumn('document_tracker', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (!Schema::hasColumn('document_tracker', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }
            });
        } else {
            // Create the table if it doesn't exist
            Schema::create('document_tracker', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('employee_id')->nullable();
                $table->string('document_type')->nullable();
                $table->string('file_path')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
                
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
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
        // We don't want to drop the table or remove columns as per requirements
        // Just remove the columns we added
        if (Schema::hasTable('document_tracker')) {
            Schema::table('document_tracker', function (Blueprint $table) {
                if (Schema::hasColumn('document_tracker', 'document_type')) {
                    $table->dropColumn('document_type');
                }
                if (Schema::hasColumn('document_tracker', 'file_path')) {
                    $table->dropColumn('file_path');
                }
                if (Schema::hasColumn('document_tracker', 'notes')) {
                    $table->dropColumn('notes');
                }
            });
        }
    }
};