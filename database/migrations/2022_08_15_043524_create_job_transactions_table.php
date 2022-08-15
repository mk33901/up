<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_id')->nullable()->default(0);
            $table->bigInteger('user_id')->nullable()->default(0);
            $table->bigInteger('contract_id')->nullable()->default(0);
            $table->double('amount', 15, 2)->nullable()->default(0.00);
            $table->enum('status', ['initialized', 'success','failed'])->nullable()->default('initialized');
            $table->date('procced_at')->nullable();
            $table->text('response')->nullable();
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
        Schema::dropIfExists('job_transactions');
    }
}
