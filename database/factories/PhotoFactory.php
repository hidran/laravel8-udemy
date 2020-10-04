<?php

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(60),
            'description'=> $this->faker->text(128),
            'img_path'=> $this->faker->imageUrl(),
            'created_at' => $this->faker->dateTime(),
            'album_id' => \App\Models\Album::factory()
        ];
    }
}
