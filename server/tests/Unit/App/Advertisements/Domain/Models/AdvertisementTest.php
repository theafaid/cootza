<?php

namespace Tests\Unit\App\Ads\Domain\Models;

use App\App\Categories\Domain\Models\Category;
use Facades\Tests\Setup\CategoryFactory;
use Facades\Tests\Setup\AdvertisementFactory;
use Tests\TestCase;

class AdvertisementTest extends TestCase
{
    /** @test */
    function it_belongs_to_a_category()
    {
        $child = CategoryFactory::createChild();

        $ad = AdvertisementFactory::createNewIn($child);

        $this->assertInstanceOf(Category::class, $ad->category);
    }

    /** @test */
    function can_fetch_preferred_category_to_swap_with()
    {
        $category= CategoryFactory::createChild();
        $preferredCategoryToSwapWith = CategoryFactory::createChild();

        $ad = AdvertisementFactory::preferredSwapWith($preferredCategoryToSwapWith)
            ->createNewIn($category);

        $this->assertEquals(
            $preferredCategoryToSwapWith->id,
            $ad->preferredCategoryToSwapWith->id
        );
    }
}
