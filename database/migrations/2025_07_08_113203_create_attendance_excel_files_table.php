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
        Schema::create('attendance_excel_files', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // original filename
            $table->string('url'); // storage path or URL
            $table->timestamp('upload_date'); // upload timestamp
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
        Schema::dropIfExists('attendance_excel_files');
    }
};
