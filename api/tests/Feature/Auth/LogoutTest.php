<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_logs_out()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->json('POST', 'auth/logout')
            ->assertSuccessful();

        $this->assertGuest();
    }
}
