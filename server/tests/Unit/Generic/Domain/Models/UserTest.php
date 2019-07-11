<?php

namespace Tests\Unit\Generic\Domain\Models;

use App\Generic\Domain\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    function it_hashes_password_when_creating_new_user()
    {
        $user = factory(User::class)->create([
            'password' => 'test'
        ]);

        $this->assertNotEquals('test', $user->password);
    }
}
