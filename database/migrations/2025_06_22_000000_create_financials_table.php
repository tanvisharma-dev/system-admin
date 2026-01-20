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
        if (!Schema::hasTable('financials')) {
            Schema::create('financials', function (Blueprint $table) {
                $table->id();
                $table->date('date');
                $table->enum('type', ['Income', 'Expense']);
                $table->string('category', 100);
                $table->text('description')->nullable();
                $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
                $table->decimal('amount', 10, 2);
                $table->string('payment_mode', 50)->nullable();
                $table->enum('status', ['Paid', 'Pending']);
                $table->text('remarks')->nullable();
                $table->timestamps();
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
        // We don't want to drop the table as per requirements
        // Schema::dropIfExists('financials');
    }
};