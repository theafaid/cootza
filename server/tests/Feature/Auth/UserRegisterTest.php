<?php

namespace Tests\Feature\Auth;

use App\Generic\Domain\Models\User;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    /**  @test */
    function it_requires_a_name()
    {
        $this->postJson(route('register'))
            ->assertJsonValidationErrors(['name']);
    }

    /**  @test */
    function it_requires_an_email()
    {
        $this->postJson(route('register'))
            ->assertJsonValidationErrors(['email']);
    }

    /**  @test */
    function it_requires_a_valid_email()
    {
        $this->postJson(route('register'), ['email' => 'test'])
            ->assertJsonValidationErrors(['email']);
    }

    /**  @test */
    function it_requires_a_unique_email()
    {
        $user = UserFactory::create();

        $this->postJson(route('register'), [
            'email' => $user->email
        ])->assertJsonValidationErrors(['email']);
    }

    /**  @test */
    function it_requires_a_password()
    {
        $this->postJson(route('register'))
            ->assertJsonValidationErrors(['password']);
    }

    /**  @test */
    function it_requires_a_confirmed_password()
    {
        $this->postJson(route('register'), ['password' => 'test'])
            ->assertJsonValidationErrors(['password']);

        $this->postJson(route('register'), [
            'password' => 'testtest',
            'password_confirmation' => 'anothertest'
        ])->assertJsonValidationErrors(['password']);
    }

    /** @test */
    function it_registers_a_user()
    {
       $this->register('john@gmail.com');

        $this->assertDatabaseHas('users', ['email' => 'john@gmail.com']);
    }

    /** @test */
    function it_returns_a_user_after_registration()
    {
        $this->register($email = 'john@gmail.com')
            ->assertJsonFragment([
                'email' => $email
             ]);
    }

    function register($email = null)
    {
        return $this->postJson(route('register'), [
            'name' => 'John Doe',
            'email' => $email ?: 'john@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
    }

}
