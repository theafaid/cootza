<?php

namespace Tests\Feature\Advertisements;

use Facades\Tests\Setup\AdvertisementFactory;
use Tests\TestCase;

class AdvertisementIndexTest extends TestCase
{
    /** @test */
    function it_returns_a_collection_of_latest_advertisements()
    {
        $ads = AdvertisementFactory::create(3);

        $response = $this->getJson(route('advertisements.index'));

        $ads->each(function ($ad) use ($response){
            $response->assertJsonFragment(['slug' => $ad->slug]);
        });

        $response->assertSeeInOrder([
            'slug' => $ads[2]->slug,
            'slug' => $ads[1]->slug,
            'slug' => $ads[0]->slug,
        ]);

    }
}
