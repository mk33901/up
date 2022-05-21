<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddStoreProcedureToJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        DROP PROCEDURE IF EXISTS `getJobs`;
CREATE PROCEDURE `getJobs`(IN `user_id` BIGINT, IN `offsets` BIGINT, IN `limits` INT)
    BEGIN
SELECT
            jobs.*,
            categories.name as categories,
            specializations.name as specializations,
            job_preferences.job_id,job_preferences.english_level,job_preferences.hours_per_week,job_preferences.hire_date,job_preferences.no_of_professionals,job_preferences.type_of_talent,job_preferences.location,
            clients.user_id,clients.uuid as cuuid,clients.name,clients.description,clients.company_name,clients.company_website,clients.company_tag_line,clients.company_description,clients.company_owner,clients.company_phone,clients.company_vat,clients.company_timezone,clients.company_country,clients.company_address,clients.company_city,clients.company_zip,
            job_bookmarks.id as bookmark
        FROM
            jobs
        JOIN  job_preferences ON
            job_preferences.job_id = jobs.id
        JOIN  categories ON
            categories.id = jobs.category_id
        JOIN  specializations ON
            specializations.id = jobs.speciality_id
        join clients ON
            clients.id=jobs.client_id
            left join job_bookmarks on  job_bookmarks.job_id=jobs.id and job_bookmarks.user_id=user_id order by jobs.id desc limit offsets,limits;
            END;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP PROCEDURE IF EXISTS `getJobs`");
    }
}
