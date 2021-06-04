<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_requires_email_and_password()
    {
        $this->postJson('auth/login')
            ->assertJsonValidationErrors(['email', 'password']);
    }

    public function test_it_returns_validation_error_if_credentials_dont_match()
    {
        $user = User::factory()->create();

        $this->json('POST', 'auth/login', [
            'email' => $user->email,
            'password' => 'fail',
        ])->assertJsonValidationErrors(['email']);
    }

    public function test_it_logs_in_returning_user()
    {
        $user = User::factory()->create();

        $this->json('POST', 'auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ])
            ->assertSuccessful()
            ->assertJsonFragment([
                'email' => $user->email,
            ]);

        $this->assertAuthenticatedAs($user);
    }

    public function test_it_saves_remember_token_when_checkbox_checked()
    {
        $user = User::factory()->create();

        $this->json('POST', 'auth/login', [
            'email' => $user->email,
            'password' => 'password',
            'remember' => true,
        ])->assertSuccessful();

        $this->assertNotEmpty($user->refresh()->getRememberToken());
    }

    public function test_it_doesnt_save_remember_token_when_checkbox_unchecked()
    {
        $user = User::factory()->create();

        $this->json('POST', 'auth/login', [
            'email' => $user->email,
            'password' => 'password',
            'remember' => false,
        ])->assertSuccessful();

        $this->assertEmpty($user->refresh()->getRememberToken());
    }
}
