<?php

namespace Tests\Unit\App\Categories\Domain\Models;

use App\App\Categories\Domain\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Facades\Tests\Setup\CategoryFactory;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /** @test */
    function it_has_children()
    {
        $category = CategoryFactory::withChildren(1)->create();

        $this->assertInstanceOf(Collection::class, $category->children);
        $this->assertInstanceOf(Category::class, $category->children->first());
    }

    /** @test */
    function can_belongs_to_a_category()
    {
        $category = CategoryFactory::withChildren(1)->create();

        $this->assertInstanceOf(Category::class , $category->children[0]->parent);
    }

    /** @test */
    function can_fetch_parents()
    {
        $parent = CategoryFactory::withChildren(3)->create();

        $this->assertTrue(
            Category::parents()->get()->contains($parent)
        );

        $this->assertFalse(
            Category::parents()->get()->contains($parent->children->random())
        );
    }
}
