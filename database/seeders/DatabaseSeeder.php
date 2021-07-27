<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{AlbumCategory, User, Photo, Album, Category};

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

        User::truncate();
        AlbumCategory::truncate();
        Category::truncate();
        Album::truncate();
        Photo::truncate();


        User::factory(50)->has(
            Album::factory(20)->has(
                Photo::factory(20)
            )
        )->create();
        $this->call(CategorySeeder::class);
        $this->call(AlbumCategorySeeder::class);

    }
}
