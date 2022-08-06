<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout_transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->double('amount', 15, 2)->nullable()->default(0.00);
            $table->uuid('beneficiary_id')->nullable();
            $table->bigInteger('contract_id')->nullable()->default(0);
            $table->bigInteger('user_id')->nullable()->default(0);
            $table->enum('status', ['pending', 'in-progress','completed'])->default('pending');
            $table->text('response')->nullable();
            $table->string('reference', 100)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('payout_transactions');
    }
}
