<?php

namespace Tests\Feature\Auth;

use App\Generic\Domain\Models\User;
use Tests\TestCase;

class UserLoginTest extends TestCase
{

    /** @test */
    function it_requires_an_email()
    {
        $this->postJson(route('login'))
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    function it_requires_an_valid_email()
    {
        $this->postJson(route('login'), ['email' => 'test'])
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    function it_requires_a_password()
    {
        $this->postJson(route('login'))
            ->assertJsonValidationErrors(['password']);
    }

    /** @test */
    function it_returns_a_validation_error_with_wrong_credentials()
    {
        $this->postJson(route('login'), [
            'email' => 'test@test.com',
            'password' => 'testtest'
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    function it_returns_a_token_with_user_if_credentials_do_match()
    {
        $user = factory(User::class)->create(['password' => 'testtest']);

        $response = $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => 'testtest'
        ]);

        $response->assertJsonStructure([
            'meta' => ['token']
        ]);

        $response->assertJsonFragment(['email' => $user->email]);
    }


}

