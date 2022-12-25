<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFunctionToMysql extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("

        CREATE FUNCTION get_hexa_coin(budget float) RETURNS int DETERMINISTIC
        BEGIN
             
             DECLARE hexa_coin int;
        
           IF budget <= 10 THEN
              SET hexa_coin = 2;
        
           ELSEIF budget > 10 AND budget <= 100 THEN
              SET hexa_coin = 5;
        
           ELSE
              SET hexa_coin = 10;
        
           END IF;
        
           RETURN hexa_coin;
         
        END ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
