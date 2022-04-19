<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBudgetFieldsToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
           $table->enum('budget_type', ['monthly', 'fixed_cost'])->nullable()->default('fixed_cost');
           $table->decimal('max_price', 8, 2)->nullable()->default(0);
           $table->decimal('budget', 8, 2)->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('budget_type');
            $table->dropColumn('max_price');
        });
    }
}
