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

        $response = $this->jsonAs(
            $user,
            'POST',
            route('advertisement.offers', $userAdvertisements[0]), [
                'offer' => ['advertisements' => $userAdvertisements->pluck('id'), 'money' => 100]
            ]
        );

        $response->assertStatus(403);
    }

    /** @test */
    function it_requires_a_money_if_no_advertisement_provided_for_the_offer()
    {
        $user = UserFactory::create();

        $otherAdvertisement = AdvertisementFactory::ownedBy(UserFactory::create())->create();

        $response = $this->jsonAs(
            $user,
            'POST',
            route('advertisement.offers', $otherAdvertisement->slug),
            ['offer' => ['advertisements' => [], 'money' => null]]
        );

        $response->assertJsonValidationErrors(['offer.advertisements', 'offer.money']);

        $response->assertStatus(422);

    }

    /** @test */
    function selected_advertisements_for_offer_cannot_be_duplicated()
    {

        $user = UserFactory::create();

        $userAdvertisements = AdvertisementFactory::ownedBy($user)->create(3);

        $otherAdvertisement= AdvertisementFactory::ownedBy(UserFactory::create())->create();

        $response = $this->jsonAs(
            $user, 'POST', route('advertisement.offers', $otherAdvertisement->slug),[
                'offer' => ['advertisements' => [$userAdvertisements[0]->id, $userAdvertisements[0]->id], 'money' => 100]
            ]
        );

        $response->assertJsonValidationErrors(['offer.advertisements.0']);
        $response->assertStatus(422);
    }

    /** @test */
    function advertisements_and_money_keys_for_offer_must_be_presented()
    {
        $user = UserFactory::create();

        $otherAdvertisement = AdvertisementFactory::ownedBy(UserFactory::create())->create();

        $response = $this->jsonAs(
            $user,
            'POST',
            route('advertisement.offers', $otherAdvertisement->slug),[]
        );

        $response->assertJsonValidationErrors(['offer.advertisements', 'offer.money']);

        $response->assertStatus(422);

    }

    /** @test */
    function it_requires_a_valid_offer_with_advertisements_owned_by_provider()
    {
        $user = UserFactory::create();
        $advertisementOwnedByOtherUser = AdvertisementFactory::ownedBy(UserFactory::create())->create();
        $otherAdvertisement = AdvertisementFactory::ownedBy(UserFactory::create())->create();

        $response = $this->jsonAs(
            $user, 'POST', route('advertisement.offers', $otherAdvertisement->slug),[
                'offer' => ['advertisements' => [$advertisementOwnedByOtherUser->id], 'money' => 100]
            ]
        );
        $this->assertEquals(json_encode(['advertisements' => [], 'money' => 100]), $otherAdvertisement->offers->first()->content);
        $response->assertStatus(201);
    }

    /** @test */
    function it_request_at_one_of_currency_for_money()
    {
        $user = UserFactory::create();

        $userAdvertisements = AdvertisementFactory::ownedBy($user)->create(3);

        $otherAdvertisement= AdvertisementFactory::ownedBy(UserFactory::create())->create();

        $response = $this->jsonAs(
            $user, 'POST', route('advertisement.offers', $otherAdvertisement->slug),[
                'offer' => ['advertisements' => $userAdvertisements->pluck('id'), 'money' => 0]
            ]
        );

        $response->assertJsonValidationErrors(['offer.money']);
        $response->assertStatus(422);
    }


    /** @test */
    function a_user_can_make_an_offer_provided_to_an_advertisement()
    {
        $this->withoutExceptionHandling();
        $user = UserFactory::create();

        $userAdvertisements = AdvertisementFactory::ownedBy($user)->create(3);

        $otherAdvertisement= AdvertisementFactory::ownedBy(UserFactory::create())->create();

        $response = $this->jsonAs(
            $user, 'POST', route('advertisement.offers', $otherAdvertisement->slug),[
                'offer' => ['advertisements' => $userAdvertisements->pluck('id'), 'money' => 100]
            ]
        );

        $response->assertStatus(201);

        $this->assertNotNull($otherAdvertisement->offers);

        $this->assertEquals(
            json_encode(AdvertisementOfferFactory::generateOfferContent($userAdvertisements)),
            $otherAdvertisement->offers->first()->content
        );
    }


    //    /** @test */
//    function a_user_can_make_an_offer_provided_to_an_advertisement()
//    {
//        $user = UserFactory::create();
//
//        $userAdvertisements = AdvertisementFactory::ownedBy($user)->create(3);
//
//        $this->jsonAs(
//            $use
//        )
//    }

}
