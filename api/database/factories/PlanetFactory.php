<?php

namespace Database\Factories;

use App\Models\Planet;
use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Planet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => ucfirst($this->faker->unique()->word),
            'rotation_period' => mt_rand(0, 2) ? mt_rand(1, 9999) : null,
            'orbital_period' => mt_rand(0, 2) ? mt_rand(1, 9999) : null,
            'diameter' => mt_rand(0, 2) ? mt_rand(1, 999999) : null,
            'climate' => mt_rand(0, 2) ? Arr::random(['temperature', 'arid', 'frozen']) : null,
            'gravity' => null,
            'terrains' => array_slice(Arr::shuffle(['forest', 'desert', 'swamp', 'jungle']), 0, mt_rand(1, 3)),
            'diameter' => mt_rand(0, 2) ? mt_rand(0, 9999) : null,
            'population' => mt_rand(0, 2) ? mt_rand(1, 999999999999) : null,
        ];
    }
}
