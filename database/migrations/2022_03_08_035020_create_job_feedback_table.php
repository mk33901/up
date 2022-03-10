<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_feedback', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('reason')->nullable();
            $table->text('feedback')->nullable();
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
        Schema::dropIfExists('job_feedback');
    }
}
