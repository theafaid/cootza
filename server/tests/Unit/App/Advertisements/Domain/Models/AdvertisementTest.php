<?php

namespace Tests\Unit\App\Ads\Domain\Models;

use App\App\AdvertisementOffer\Domain\Models\AdvertisementOffer;
use Facades\Tests\Setup\AdvertisementOfferFactory;
use App\App\Categories\Domain\Models\Category;
use Facades\Tests\Setup\AdvertisementFactory;
use Illuminate\Database\Eloquent\Collection;
use Facades\Tests\Setup\CategoryFactory;
use Facades\Tests\Setup\UserFactory;
use App\Generic\Domain\Models\User;
use Tests\TestCase;

class AdvertisementTest extends TestCase
{
    /** @test */
    function it_belongs_to_a_category()
    {
        $ad = AdvertisementFactory::createIn(
            CategoryFactory::createChild()
        );

        $this->assertInstanceOf(Category::class, $ad->category);
    }

    /** @test */
    function can_fetch_preferred_category_to_swap_with()
    {
        $category= CategoryFactory::createChild();
        $preferredCategoryToSwapWith = CategoryFactory::createChild();

        $ad = AdvertisementFactory::preferredSwapWith($preferredCategoryToSwapWith)
            ->createIn($category);

        $this->assertEquals(
            $preferredCategoryToSwapWith->id,
            $ad->preferredCategoryToSwapWith->id
        );
    }

    /** @test */
    function it_belongs_to_a_user()
    {
        $ad = AdvertisementFactory::ownedBy($user = UserFactory::create())->create();

        $this->assertInstanceOf(User::class, $ad->owner);

        $this->assertEquals($user->id, $ad->owner->id);
    }

    /** @test */
    function it_has_offers()
    {
        $advertisement = AdvertisementFactory::create();

        AdvertisementOfferFactory::assignedTo($advertisement)->create(2);

        $this->assertInstanceOf(Collection::class, $advertisement->offers);

        $this->assertInstanceOf(AdvertisementOffer::class, $advertisement->offers->random());
    }
}
