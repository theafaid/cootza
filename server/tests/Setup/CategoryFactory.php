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

    public function create($count = null)
    {
        $category = factory(Category::class, $count)->create();

        if($this->childrenCount){
            $category->children()->save(
                factory(Category::class, $count)->create()
            );
        }
        return $category;
    }
}
