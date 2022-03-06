<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable()->default(null);
            $table->string('title', 100)->nullable()->default('text');
            $table->longText('description')->nullable();
            $table->integer('category_id')->unsigned()->nullable()->default(0);
            $table->integer('speciality_id')->unsigned()->nullable()->default(0);
            $table->integer('edit_scope')->unsigned()->nullable()->default(0);
            $table->string('time')->nullable()->default(0);
            $table->string('level_experience')->nullable()->default(0);
            $table->bigInteger('user_id')->nullable()->default(0);
            $table->bigInteger('client_id')->nullable()->default(0);
            $table->integer('budget')->nullable()->default(0);
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
        Schema::dropIfExists('jobs');
    }
}
