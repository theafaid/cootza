<?php

namespace Tests\Features\AdvertisementOffers;

use Facades\Tests\Setup\AdvertisementOfferFactory;
use Facades\Tests\Setup\AdvertisementFactory;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class StoreAdvertisementOfferTest extends TestCase
{
    /** @test */
    function it_fails_if_un_authenticated_user_try_to_add_offer()
    {
        $advertisement = AdvertisementFactory::create();

        $this->postJson(route('advertisement.offers', $advertisement->slug), [])
            ->assertStatus(401);
    }

    /** @test */
    function it_fails_when_provider_make_an_offer_to_his_own_advertisement()
    {
        $this->endPoint(
            $user = UserFactory::create(),
            $userAdvertisements = AdvertisementFactory::ownedBy($user)->create(2),
            100,
            $userAdvertisements[0]
        )->assertStatus(403);
    }

    /** @test */
    function it_requires_a_money_if_no_advertisement_provided_for_the_offer()
    {

        $this->endPoint($user = UserFactory::create(), [],null)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['offer.advertisements', 'offer.money']);

    }

    /** @test */
    function selected_advertisements_for_offer_cannot_be_duplicated()
    {
        $user = UserFactory::create();
        $userAdvertisement = AdvertisementFactory::ownedBy($user)->create();

        $this->endPoint($user, [$userAdvertisement, $userAdvertisement], 100)
            ->assertJsonValidationErrors(['offer.advertisements.0'])
            ->assertStatus(422);
    }

    /** @test */
    function advertisements_and_money_keys_for_offer_must_be_presented()
    {
        $user = UserFactory::create();
        $otherAdvertisement = AdvertisementFactory::ownedBy(UserFactory::create())->create();

        $this->jsonAs( $user,'POST', route('advertisement.offers', $otherAdvertisement->slug), [] )
            ->assertStatus(422)
            ->assertJsonValidationErrors(['offer.advertisements', 'offer.money']);
    }

    /** @test */
    function it_failes_when_offer_provider_make_offer_with_advertisements_not_owned_by_him()
    {
        $user = UserFactory::create();
        $advertisementOwnedByOtherUser = AdvertisementFactory::ownedBy(UserFactory::create())->create();
        $otherAdvertisement = AdvertisementFactory::ownedBy(UserFactory::create())->create();

        $response = $this->endPoint(
            $user,
            [$advertisementOwnedByOtherUser],
            100,
            $otherAdvertisement
        );

        $response->assertJsonValidationErrors(['offer.advertisements.0']);
        $response->assertStatus(422);
    }

    /** @test */
    function it_requires_at_least_one_of_money_currency()
    {
        $this->endPoint(
            $user = UserFactory::create(),
            AdvertisementFactory::ownedBy($user)->create(2),
            0
        )
            ->assertJsonValidationErrors(['offer.money'])
            ->assertStatus(422);
    }


    /** @test */
    function a_user_can_make_an_offer_provided_to_an_advertisement()
    {
        $this->endPoint(
            $user = UserFactory::create(),
            $userAdvertisements = AdvertisementFactory::ownedBy($user)->create(3),
            100,
            $otherAdvertisement = AdvertisementFactory::ownedBy(UserFactory::create())->create()

        )->assertStatus(201);

        $this->assertNotNull($otherAdvertisement->offers);

        $this->assertEquals(
            json_encode(AdvertisementOfferFactory::generateOfferContent($userAdvertisements, 100)),
            $otherAdvertisement->offers->first()->content
        );
    }

    /** @test */
    function a_user_can_make_an_offer_with_advertisements_only()
    {
        $this->endPoint(
            $user = UserFactory::create(),
            $userAdvertisements = AdvertisementFactory::ownedBy($user)->create(3),
            null,
            $otherAdvertisement = AdvertisementFactory::ownedBy(UserFactory::create())->create()

        )->assertStatus(201);

        $this->assertNotNull($otherAdvertisement->offers);

        $this->assertEquals(
            json_encode(AdvertisementOfferFactory::generateOfferContent($userAdvertisements)),
            $otherAdvertisement->offers->first()->content
        );
    }

    /** @test */
    function a_user_can_make_an_offer_with_money_only()
    {
        $this->endPoint(
            $user = UserFactory::create(),
            null,
            100,
            $otherAdvertisement = AdvertisementFactory::ownedBy(UserFactory::create())->create()

        )->assertStatus(201);

        $this->assertNotNull($otherAdvertisement->offers);

        $this->assertEquals(
            json_encode(
                AdvertisementOfferFactory::generateOfferContent([], 100)),
                $otherAdvertisement->offers->first()->content
            );
    }

    function endPoint($user, $advertisements = null, $money = null, $providedTo = null )
    {

        $providedTo = $providedTo ?
            $providedTo->slug : AdvertisementFactory::ownedBy(UserFactory::create())->create()->slug;

        return $this->jsonAs(
            $user,
            'POST',
            route('advertisement.offers', $providedTo), [
                'offer' => [
                    'advertisements' => count(collect($advertisements)) ? collect($advertisements)->pluck('id') : [],
                    'money' => $money
                ]
            ]
        );
    }
}
