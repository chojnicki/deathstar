<?php

namespace Database\Seeders;

use App\Models\Planet;
use Illuminate\Database\Seeder;

class PlanetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Planet::factory(10)->create();
    }
}
