<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Album;
class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       Album::factory(30)->create();
    }
}
