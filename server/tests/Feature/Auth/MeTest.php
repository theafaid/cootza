<?php

namespace Tests\Feature\Auth;

use App\Generic\Domain\Models\User;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class  MeTest extends TestCase
{
    /** @test */
    function it_fails_when_user_isnt_authenticated()
    {
        $this->getJson(route('me'))
            ->assertStatus(401);
    }

    /** @test */
    function it_returns_user_details_when_authenticated()
    {
        $user = UserFactory::create();

        $this->jsonAs($user, 'GET', route('me'))
            ->assertJsonFragment(['email' => $user->email]);
    }
}

