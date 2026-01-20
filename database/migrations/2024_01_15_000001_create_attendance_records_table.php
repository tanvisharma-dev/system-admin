<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->string('original_filename');
            $table->string('file_path');
            $table->string('file_extension');
            $table->bigInteger('file_size');
            $table->string('mime_type');
            $table->enum('status', ['uploaded', 'processing', 'processed', 'failed'])->default('uploaded');
            $table->integer('total_rows')->nullable();
            $table->integer('success_count')->default(0);
            $table->integer('error_count')->default(0);
            $table->text('error_message')->nullable();
            $table->timestamp('uploaded_at');
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};
