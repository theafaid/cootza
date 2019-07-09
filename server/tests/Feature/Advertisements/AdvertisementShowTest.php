<?php

namespace Tests\Feature\Advertisements;

use Facades\Tests\Setup\AdvertisementFactory;
use Tests\TestCase;

class AdvertisementShowTest extends TestCase
{
    /** @test */
    function it_fails_if_a_product_cant_be_found()
    {
        $this->getJson(route('advertisements.show', 'does-not-exists'))
            ->assertStatus(404);
    }

    /** @test */
    function it_shows_a_product()
    {
        $ad = AdvertisementFactory::create();

        $this->getJson(route('advertisements.show', $ad->slug))
            ->assertStatus(200)
            ->assertJsonFragment(['slug' => $ad->slug])
            ->assertJsonCount(1);
    }
}
