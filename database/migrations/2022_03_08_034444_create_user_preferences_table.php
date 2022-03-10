<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->default(12);
            $table->enum('availability', ['more30', 'less30','open','none'])->nullable();
            $table->enum('visibility', ['public', 'private','members_only'])->nullable();
            $table->bigInteger('category_id')->nullable()->default(12);
            $table->string('video_introduction', 100)->nullable();
            $table->string('video_type', 100)->nullable();
            $table->string('title', 100)->nullable();
            $table->text('overview')->nullable();
            $table->float('hourly_rate')->nullable();
            $table->string('currency', 100)->nullable();
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
        Schema::dropIfExists('user_preferences');
    }
}
