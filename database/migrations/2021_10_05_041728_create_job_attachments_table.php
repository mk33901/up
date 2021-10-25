<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_attachments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_id')->nullable()->default(12);
            $table->string('name', 100)->nullable();
            $table->string('path',255)->nullable();
            $table->string('host', 100)->nullable();
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
        Schema::dropIfExists('job_attachments');
    }
}
