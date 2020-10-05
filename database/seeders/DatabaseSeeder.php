<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User, Photo, Album};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Photo::truncate();
        Album::truncate();
        User::truncate();
  User::factory(40)->has(
       Album::factory(10)->has(
           Photo::factory(20)
       )
  )->create();
/*
        $this->call(UserSeeder::class);
        $this->call(AlbumSeeder::class);
        $this->call(PhotoSeeder::class);
*/
    }
}
