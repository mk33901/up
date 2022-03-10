<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable()->default(null);
            $table->bigInteger('job_id')->nullable()->default(0);
            $table->bigInteger('user_id')->nullable()->default(0);
            $table->float('rate')->unsigned()->nullable()->default(0);
            $table->enum('duration', ['6+', '3-6','1-3','1'])->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('proposals');
    }
}
