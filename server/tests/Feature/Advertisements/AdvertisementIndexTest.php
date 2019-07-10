<?php

namespace Tests\Feature\Advertisements;

use Facades\Tests\Setup\AdvertisementFactory;
use Facades\Tests\Setup\CategoryFactory;
use Tests\TestCase;

class AdvertisementIndexTest extends TestCase
{
    /** @test */
    function it_returns_a_collection_of_latest_paginated_advertisements()
    {
        $ads = AdvertisementFactory::create(3);

        $response = $this->getJson(route('advertisements.index'));

        $response->assertSeeInOrder([
            'slug' => $ads[2]->slug,
            'slug' => $ads[1]->slug,
            'slug' => $ads[0]->slug,
        ]);

        $response->assertJsonStructure([
            'data', 'links', 'meta'
        ]);

        $ads->each(function ($ad) use ($response){
            $response->assertJsonFragment(['slug' => $ad->slug]);
        });
    }

    /** @test */
    function can_filter_advertisements_by_its_category()
    {
        $ads = AdvertisementFactory::create(2);

        $otherAd = AdvertisementFactory::create();

        $response = $this->getJson(route('advertisements.index', ['category' => $ads[0]->category->slug]));

        $response->assertJsonCount(2, 'data');

        $response->assertJsonFragment(
            ['slug' => $ads[0]->slug],
            ['slug' => $ads[1]->slug]
        );

        $response->assertJsonMissing(['slug' => $otherAd->slug]);
    }

    /** @test */
    function when_filtering_by_parent_category_it_returns_all_ads_in_all_children_of_the_parent_category()
    {
        $parentCategory = CategoryFactory::withChildren(3)->createParent();
        $ads = AdvertisementFactory::createIn($parentCategory->children->random(), 5);
        $otherAds = AdvertisementFactory::create(3);

        $response = $this->getJson(route('advertisements.index', ['category' => $parentCategory->slug]));

        $response->assertJsonCount(5, 'data');

        $ads->each(function ($ad) use ($response) {
            $response->assertJsonFragment(['slug' => $ad->slug]);
        });

        $response->assertJsonMissing(['slug' => $otherAds->random()->slug]);
    }

}
