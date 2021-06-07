<?php

namespace Tests\Feature\Auth;

use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeopleIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_fails_if_not_authenticated()
    {
        $this->getJson('api/people')
            ->assertUnauthorized();
    }

    public function test_it_returns_people_list()
    {
        $user = User::factory()->create();
        $people = Person::factory(3)->create();

        $this->actingAs($user);

        $this->getJson('api/people')
            ->assertSuccessful()
            ->assertJsonCount(3, 'data')
            ->assertJsonFragment([
                'name' => $people->random()->name
            ]);
    }

    public function test_it_paginate_by_default()
    {
        $user = User::factory()->create();
        Person::factory(20)->create();

        $this->actingAs($user);

        $this->getJson('api/people')
            ->assertSuccessful()
            ->assertJsonCount(10, 'data');
    }

    public function test_it_paginate_by_param()
    {
        $user = User::factory()->create();
        Person::factory(10)->create();

        $this->actingAs($user);

        $this->getJson('api/people?per_page=5')
            ->assertSuccessful()
            ->assertJsonCount(5, 'data');
    }

    public function test_it_returns_validation_error_when_per_page_is_wrong_format()
    {
        $user = User::factory()->create();
        Person::factory(20)->create();

        $this->actingAs($user);

        $this->getJson('api/people?per_page=xxx')
            ->assertJsonValidationErrors(['per_page']);
    }

    public function test_it_returns_validation_error_when_per_page_exceeds_limit()
    {
        $user = User::factory()->create();
        Person::factory(20)->create();

        $this->actingAs($user);

        $this->getJson('api/people?per_page=9999')
            ->assertJsonValidationErrors(['per_page']);
    }
}
