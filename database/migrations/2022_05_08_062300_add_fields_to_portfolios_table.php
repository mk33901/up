<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->uuid('uuid')->nullable();
            $table->bigInteger('user_id')->nullable()->default(0);
            $table->string('title', 100)->nullable();
            $table->string('profile', 100)->nullable();
            $table->date('completed_date')->nullable();
            $table->string('template', 100)->nullable();
            $table->longText('description')->nullable();
            $table->text('skill')->nullable();
            $table->string('url', 100)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('user_id');
            $table->dropColumn('title');
            $table->dropColumn('profile');
            $table->dropColumn('completed_date');
            $table->dropColumn('template');
            $table->dropColumn('description');
            $table->dropColumn('skill');
            $table->dropColumn('url');
            $table->dropColumn('deleted_at');
        });
    }
}
