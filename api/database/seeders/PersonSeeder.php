<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Planet;
use Arr;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $planetIds = Planet::pluck('id')->toArray();
        $people = Person::factory(50)->make();
        $people->each(function ($person) use ($planetIds) {
            $person->planet_id = mt_rand(0, 3) ? Arr::random($planetIds) : null;
            $person->save();
        });
    }
}