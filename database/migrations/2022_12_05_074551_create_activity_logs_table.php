<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->morphs('model');
            $table->bigInteger('action_by')->nullable()->default(0);
            $table->string('action', 100)->nullable();
            $table->text('data')->nullable();
            $table->text('existing_data')->nullable();
            $table->text('updated_data')->nullable();
            $table->string('request_url')->nullable();
            $table->boolean('is_read')->nullable()->default(false);
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
        Schema::dropIfExists('activity_logs');
    }
}
