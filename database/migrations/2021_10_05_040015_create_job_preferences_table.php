<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_preferences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_id')->nullable()->default(12);
            $table->enum('english_level', ['any', 'better','fluent','native'])->nullable();
            $table->enum('hours_per_week', ['30plus', '30minus','0'])->nullable();
            $table->enum('hire_date', ['1-3', '1 week','2 weeks','1 month'])->nullable();
            $table->enum('no_of_professionals', ['1', '1plus'])->nullable();
            $table->enum('type_of_talent', ['independent', 'Agency'])->nullable();
            $table->string('location',255)->nullable()->default(0);
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
        Schema::dropIfExists('job_preferences');
    }
}
