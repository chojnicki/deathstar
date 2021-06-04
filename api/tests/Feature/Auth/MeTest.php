<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_fails_if_not_authenticated()
    {
        $this->getJson('auth/me')
            ->assertUnauthorized();
    }

    public function test_it_returns_current_logged_user_data()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->getJson('auth/me')
            ->assertSuccessful()
            ->assertJsonFragment([
                'email' => $user->email,
            ]);
    }
}
