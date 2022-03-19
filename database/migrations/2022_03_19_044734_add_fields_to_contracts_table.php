<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->enum('payment_option', ['hourly', 'fixed']);
            $table->float('price')->nullable();
            $table->integer('weekly_limit')->unsigned()->nullable()->default(0);
            $table->boolean('allow_time_entry')->nullable()->default(false);
            $table->float('automatic_amount')->nullable()->default(0);
            $table->string('job_titile')->nullable();
            $table->longText('description')->nullable();
            $table->date('last_payment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('payment_option');
            $table->dropColumn('price');
            $table->dropColumn('weekly_limit');
            $table->dropColumn('allow_time_entry');
            $table->dropColumn('automatic_amount');
            $table->dropColumn('job_titile');
            $table->dropColumn('description');
            $table->dropColumn('last_payment');
        });
    }
}
