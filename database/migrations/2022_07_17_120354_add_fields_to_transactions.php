<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('order_id', 100)->nullable();
            $table->string('order_token')->nullable();
            $table->text('payment_response')->nullable();
            $table->double('amount', 8, 0)->nullable()->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('order_id');
            $table->dropColumn('order_token');
            $table->dropColumn('payment_response');
            $table->dropColumn('amount');
        });
    }
}
