<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProposalStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `proposals` CHANGE `status` `status` ENUM('pending','accepted','cancelled','withdrow') CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'pending';");
        Schema::table('proposals', function (Blueprint $table) {
            $table->text('withdrow_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn('withdrow');
        });
    }
}
