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
        Schema::table('document_tracker', function (Blueprint $table) {
            $table->string('resume_path')->nullable()->after('contract');
            $table->string('aadhar_path')->nullable()->after('resume_path');
            $table->string('pan_path')->nullable()->after('aadhar_path');
            $table->string('offer_letter_path')->nullable()->after('pan_path');
            $table->string('joining_letter_path')->nullable()->after('offer_letter_path');
            $table->string('contract_path')->nullable()->after('joining_letter_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_tracker', function (Blueprint $table) {
            $table->dropColumn([
                'resume_path',
                'aadhar_path', 
                'pan_path',
                'offer_letter_path',
                'joining_letter_path',
                'contract_path'
            ]);
        });
    }
};
