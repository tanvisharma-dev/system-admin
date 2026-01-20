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
        Schema::table('employees', function (Blueprint $table) {
            // Rename existing email to personal_email
            $table->renameColumn('email', 'personal_email');
        });
        
        Schema::table('employees', function (Blueprint $table) {
            // Add professional email fields
            $table->string('professional_email')->after('personal_email')->nullable();
            $table->string('professional_email_password')->after('professional_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Rename personal_email back to email
            $table->renameColumn('personal_email', 'email');
            
            // Drop professional email fields
            $table->dropColumn(['professional_email', 'professional_email_password']);
        });
    }
};
