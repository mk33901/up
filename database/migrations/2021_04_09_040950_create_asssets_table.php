<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asssets', function (Blueprint $table) {
            $table->id();
            $table->morphs('taggable');
            $table->string('name', 100)->nullable()->default('text');
            $table->string('path', 100)->nullable()->default('text');
            $table->string('type', 100)->nullable()->default('text');
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
        Schema::dropIfExists('asssets');
    }
}
