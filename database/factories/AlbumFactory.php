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
        //$user = User::inRandomOrder()->first();
        return [
            'album_name' => $this->faker->text(20),
            'album_thumb'=> $this->faker->image(),
            'description' => $this->faker->text(120),
            'created_at' => $this->faker->dateTime(),
            'user_id' => User::factory()
        ];
    }
}
