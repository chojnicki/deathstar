<?php

namespace Tests\Feature\Auth;

use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeopleDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_fails_if_not_authenticated()
    {
        $this->deleteJson('api/people/1')
            ->assertUnauthorized();
    }

    public function test_it_removes_person_from_database()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();

        $this->actingAs($user);

        $this->deleteJson('api/people/' . $person->id)
            ->assertSuccessful()
            ->assertJsonFragment([
                'name' => $person->name
            ]);
    }

    public function test_it_returns_person_after_deleting()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();

        $this->actingAs($user);

        $this->assertDatabaseHas('people', ['id' => $person->id]);

        $this->deleteJson('api/people/' . $person->id);

        $this->assertDatabaseMissing('people', ['id' => $person->id]);
    }
}
