<?php

namespace Tests\Feature\Auth;

use App\Models\Person;
use App\Models\Planet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeopleUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_fails_if_not_authenticated()
    {
        $this->patchJson('api/people/1')
            ->assertUnauthorized();
    }

    public function test_it_saves_new_data_to_database()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();
        $planet = Planet::factory()->create();
        $data = Person::factory()->make()->planet()->associate($planet)->toArray();
        $this->actingAs($user);

        $this->patchJson('api/people/' . $person->id, $data)
            ->assertSuccessful();

        $this->assertNotEmpty( // assertArraySubset deprecated, workaround
            array_diff_assoc($data,  $person->refresh()->toArray())
        );
    }


    public function test_it_returns_updated_person()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();
        $planet = Planet::factory()->create();
        $data = Person::factory()->make()->planet()->associate($planet)->toArray();
        $this->actingAs($user);

        $this->patchJson('api/people/' . $person->id, $data)
            ->assertSuccessful()
            ->assertJsonFragment([
                'name' => $data['name'],
                'height' => $data['height'],
            ]);
    }
}
