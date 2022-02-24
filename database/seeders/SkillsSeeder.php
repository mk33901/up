<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skills;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skills::factory(10)->create();
    }
}
