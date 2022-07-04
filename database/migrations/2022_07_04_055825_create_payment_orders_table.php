<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_id')->nullable()->default(null);
            $table->bigInteger('user_id')->nullable()->default(12);
            $table->bigInteger('job_id')->nullable()->default(12);
            $table->double('amount', 10, 2)->nullable();
            $table->string('order_currency', 10)->nullable()->default('INR');
            $table->string('customer_id', 100)->nullable();
            $table->string('order_note', 100)->nullable();
            $table->string('payment_methods', 100)->nullable();
            $table->date('order_expiry_time')->nullable();
            $table->enum('status', ['pending', 'completed','failed','cancelled'])->nullable()->default('pending');
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
        Schema::dropIfExists('payment_orders');
    }
}
