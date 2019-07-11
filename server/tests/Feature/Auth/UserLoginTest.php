<?php

namespace Tests\Feature\Auth;

use App\Generic\Domain\Models\User;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class UserLoginTest extends TestCase
{

    /** @test */
    function it_requires_an_email()
    {
        $this->endPoint()->assertJsonValidationErrors(['email']);
    }

    /** @test */
    function it_requires_an_valid_email()
    {
        $this->endPoint(['email' => 'test'])
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    function it_requires_a_password()
    {
         $this->endPoint()->assertJsonValidationErrors(['password']);
    }

    /** @test */
    function it_returns_a_validation_error_with_wrong_credentials()
    {
        $this->endPoint($this->fakeData())
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    function it_returns_a_token_with_user_if_credentials_do_match()
    {
        $user = UserFactory::create(['password' => 'testtest']);

        $response = $this->endPoint([
            'email' => $user->email,
            'password' => 'testtest'
        ]);

        $response->assertJsonStructure([
            'meta' => ['token']
        ]);

        $response->assertJsonFragment(['email' => $user->email]);
    }

    function endPoint($data = [])
    {
        return $this->postJson(route('login'), $data);
    }

    function fakeData()
    {
        return [
            'email' => 'test@test.com',
            'password' => 'testtest'
        ];
    }
}

