<?php

namespace Tests\Unit\Generic\Domain\Models;

use App\App\AdvertisementOffers\Domain\Models\AdvertisementOffer;
use App\App\Advertisements\Domain\Models\Advertisement;
use App\Generic\Domain\Models\User;
use Facades\Tests\Setup\AdvertisementFactory;
use Facades\Tests\Setup\AdvertisementOfferFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Database\Eloquent\Collection;
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

    /** @test */
    function it_has_offers()
    {
        $user = UserFactory::create();

        $userAdvertisement  = AdvertisementFactory::ownedBy($user)->create();

        AdvertisementOfferFactory::assignedTo($userAdvertisement)
            ->providedBy($user)->create(2);

        $this->assertInstanceOf(Collection::class, $user->offers);
        $this->assertInstanceOf(AdvertisementOffer::class, $user->offers->random());
    }

    /** @test */
    function can_check_if_has_made_offer_for_an_advertisement_before()
    {
        $user = UserFactory::create();
        $advertisement = AdvertisementFactory::ownedBy(UserFactory::create())->create();

        AdvertisementOfferFactory::assignedTo($advertisement)
            ->providedBy($user)->create();

        $this->assertTrue($user->fresh()->hasMadeOfferFor($advertisement));
    }
}
