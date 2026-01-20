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
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->string('original_filename'); // Original name of uploaded file
            $table->string('file_path'); // Path where file is stored
            $table->string('file_type'); // csv or excel
            $table->integer('file_size'); // File size in bytes
            $table->integer('total_rows')->nullable(); // Total rows processed
            $table->integer('success_rows')->nullable(); // Successfully processed rows
            $table->integer('error_rows')->nullable(); // Rows with errors
            $table->text('error_details')->nullable(); // JSON or text of error details
            $table->string('upload_status')->default('pending'); // pending, processing, completed, failed
            $table->timestamp('processed_at')->nullable(); // When processing completed
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
        Schema::dropIfExists('attendance_records');
    }
};
