<?php

namespace Tests\Feature\Auth;

use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class UserLogoutTest extends TestCase
{
    /** @test */
    function it_fails_if_user_hasnt_logged_in()
    {
        $this->postJson(route('logout'))
            ->assertStatus(401);
    }

    /** @test */
    function it_make_user_logout_if_authenticated()
    {
        $this->jsonAs(UserFactory::create(), 'POST', route('logout'))
            ->assertStatus(200);

        $this->assertNull(auth()->guard('api')->user());

    }
}

