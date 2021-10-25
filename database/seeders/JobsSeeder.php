<?php

namespace Database\Seeders;

use App\Models\Jobs;
use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jobs::factory(100)->create();
    }
}
