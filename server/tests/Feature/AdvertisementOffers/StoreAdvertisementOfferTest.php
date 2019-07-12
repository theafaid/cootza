<?php

namespace Tests\Features\AdvertisementOffers;

use Facades\Tests\Setup\AdvertisementFactory;
use Facades\Tests\Setup\UserFactory;
use Facades\Tests\Setup\AdvertisementOfferFactory;
use Tests\TestCase;

class StoreAdvertisementOfferTest extends TestCase
{
    /** @test */
    function it_fails_if_un_authenticated_user_try_to_add_offer()
    {
        $advertisement = AdvertisementFactory::create();

        $this->postJson(route('advertisement.offers', $advertisement ->slug), [])
            ->assertStatus(401);
    }

    /** @test */
    function it_fails_if_the_offer_provider_wants_to_swap_with_his_own_advertisement()
    {
        $user = UserFactory::create();

        $userAdvertisements = AdvertisementFactory::ownedBy($user)->create(2);

        $offerContent = AdvertisementOfferFactory::generateFakeOfferContent();

        $response = $this->jsonAs(
            $user,
            'POST',
            route('advertisement.offers', $userAdvertisements[0]),
            $offerContent
        );

        $response->assertStatus(403);
    }
}
