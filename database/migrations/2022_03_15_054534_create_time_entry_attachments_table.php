<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeEntryAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_entry_attachments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable()->default(null);
            $table->bigInteger('time_entry_id')->nullable()->default(12);
            $table->string('name')->nullable();
            $table->time('time')->nullable();
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
        Schema::dropIfExists('time_entry_attachments');
    }
}
