<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widrows', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('ben_id', 100)->nullable();
            $table->double('amount', 15, 2)->nullable()->default(0.00);
            $table->enum('status', ['pending', 'completed','failed'])->nullable()->default('pending');
            $table->text('response')->nullable();
            $table->date('proceed_at')->nullable();
            $table->boolean('is_completed')->nullable()->default(false);
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
        Schema::dropIfExists('widrows');
    }
}
