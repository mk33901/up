<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use PhpParser\Node\Stmt\Foreach_;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all();
        Foreach($user as $u)
        {
            $u->profile = '';
            $u->save();
            // dd($u);
        }
        dd($user);
       // \App\Models\User::factory()->count(1000)->hasClient(1)->create();
    }
}
