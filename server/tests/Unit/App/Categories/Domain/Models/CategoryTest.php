<?php

namespace Tests\Unit\App\Categories\Domain\Models;

use App\App\Advertisements\Domain\Models\Advertisement;
use App\App\Categories\Domain\Models\Category;
use Facades\Tests\Setup\AdvertisementFactory;
use Illuminate\Database\Eloquent\Collection;
use Facades\Tests\Setup\CategoryFactory;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /** @test */
    function it_has_children()
    {
        $category = CategoryFactory::withChildren(1)->createParent();

        $this->assertInstanceOf(Collection::class, $category->children);
        $this->assertInstanceOf(Category::class, $category->children->first());
    }

    /** @test */
    function can_belongs_to_a_category()
    {
        $category = CategoryFactory::withChildren(1)->createParent();

        $this->assertInstanceOf
        (
            Category::class ,
            $category->children[0]->parent
        );
    }

    /** @test */
    function can_fetch_parents()
    {
        $parent = CategoryFactory::withChildren(3)->createParent();

        $this->assertTrue(
            Category::parents()->get()->contains($parent)
        );

        $this->assertFalse(
            Category::parents()->get()->contains($parent->children->random())
        );
    }

    /** @test */
    function it_has_many_advertisements()
    {
        $child = CategoryFactory::createChild();

        $this->assertInstanceOf
        (
            Collection::class,
            $child->advertisements
        );

        $ads = AdvertisementFactory::createIn($child, 3);

        $this->assertInstanceOf(
            Advertisement::class,
            $ads->random()
        );
    }
}
