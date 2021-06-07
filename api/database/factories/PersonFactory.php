<?php

namespace Database\Factories;

use App\Models\Person;
use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'planet_id' => mt_rand(0, 5) ? mt_rand(1, 10) : null,
            'height' => mt_rand(50, 250),
            'mass' => mt_rand(30, 300),
            'hair_color' => Arr::random(['blond', 'black', null]),
            'skin_color' => Arr::random(['light', 'dark', null]),
            'eye_color' => Arr::random(['blue', 'green', 'red', null]),
            'gender' => mt_rand(0, 2) ? Arr::random(['male', 'female']) : null,
            'born_at' => $bornAt = mt_rand(-200, 200),
            'died_at' => mt_rand(0, 3) ? null : $bornAt + mt_rand(1, 100),
        ];
    }
}