<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->bigInteger('user_id')->nullable()->default(12);
            $table->morphs('taggable');
            $table->string('action', 100)->nullable();
            $table->bigInteger('action_by')->nullable()->default(12);
            $table->string('request_url')->nullable();
            $table->text('data')->nullable();
            $table->boolean('is_read')->nullable()->default(false);
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
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('action');
            $table->dropColumn('action_by');
            $table->dropColumn('request_url');
            $table->dropColumn('data');
            $table->dropColumn('is_read');
            $table->dropMorphs('taggable');
            $table->dropSoftDeletes();
        });
    }
}
