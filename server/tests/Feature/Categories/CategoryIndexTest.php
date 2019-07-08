<?php

namespace Tests\Feature\Categories;

use Facades\Tests\Setup\CategoryFactory;
use Tests\TestCase;

class CategoryIndexTest extends TestCase
{
    /** @test */
    function it_returns_a_collection_of_categories()
    {
        $categories = CategoryFactory::create(2);

        $response = $this->getJson(route('categories.index'));

        $response->assertJsonCount(2);

        $categories->each(function ($category) use ($response){
            $response->assertJsonFragment(['slug' => $category->slug]);
        });
    }

    /** @test */
    function it_returns_parents_only()
    {
         CategoryFactory::withChildren(2)->create();

         $this->getJson(route('categories.index'))
            ->assertJsonCount(1);
    }

    /** @test */
    function it_returns_categories_ordered_by_latest()
    {
        $categories = CategoryFactory::create(3);

        $this->getJson(route('categories.index'))
            ->assertSeeInOrder([
                $categories[2]->slug,
                $categories[1]->slug,
                $categories[0]->slug
            ]);
    }
}
