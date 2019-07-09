<?php

namespace Tests\Setup;

use App\App\Categories\Domain\Models\Category;

class CategoryFactory
{
    protected $childrenCount = 0;

    public function withChildren($count)
    {
        $this->childrenCount = $count;

        return $this;
    }

    public function withAds($count)
    {
        $this->adsCount = $count;

        return $this;
    }

    public function createParent($count = null)
    {
        if($count) return factory(Category::class, $count)->create();

        $category = factory(Category::class)->create();

        if($this->childrenCount){
            factory(Category::class, $this->childrenCount)
                ->create(['parent_id' => $category->id]);
        }

        return $category;
    }

    public function createChild()
    {
        $mainCategory = factory(Category::class)->create();

        return $mainCategory->children()->save(
           factory(Category::class)->create([
               'parent_id' => $mainCategory->id
           ])
        );
    }
}
