<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class AlbumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Album::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cats = [

            'abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife', 'fashion', 'people', 'nature', 'sports', 'technics', 'transport'
        ];
        //$user = User::inRandomOrder()-

        return [
            'album_name' => $this->faker->text(60),
            'album_thumb' => $this->faker->imageUrl(640, 480,
                $this->faker->randomElement($cats))
            ,
            'description' => $this->faker->text(120),

            'user_id' => User::factory()
        ];
    }
}
