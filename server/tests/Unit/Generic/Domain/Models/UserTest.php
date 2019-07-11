<?php

namespace Tests\Unit\Generic\Domain\Models;

use App\App\Advertisements\Domain\Models\Advertisement;
use App\Generic\Domain\Models\User;
use Facades\Tests\Setup\AdvertisementFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Support\Collection;
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

    /** @test */
    function it_has_advertisements()
    {
        AdvertisementFactory::ownedBy($user = UserFactory::create())->create(2);

        $this->assertInstanceOf(Collection::class, $user->advertisements);

        $this->assertInstanceOf(Advertisement::class, $user->advertisements->random());
    }
}
