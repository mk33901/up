<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invites', function (Blueprint $table) {
            $table->uuid('uuid')->nullable();
            $table->bigInteger('job_id')->nullable()->default(12);
            $table->bigInteger('user_id')->nullable()->default(12);
            $table->text('description')->nullable();
            $table->enum('status', ['accept', 'reject','pending'])->nullable()->default('pending');
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
        Schema::table('invites', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('job_id');
            $table->dropColumn('user_id');
            $table->dropColumn('description');
            $table->dropColumn('status');
            $table->dropColumn('delete_at');
        });
    }
}
