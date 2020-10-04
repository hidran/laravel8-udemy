<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(30)->create();
    }
}
