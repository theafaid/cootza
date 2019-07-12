<?php

namespace Tests\Setup;

use App\App\Categories\Domain\Models\Category;

class CategoryFactory
{
    protected $childrenCount = 0;

    /**
     * @param $count
     * @return $this
     */
    public function withChildren($count)
    {
        $this->childrenCount = $count;

        return $this;
    }

    /**
     * @param $count
     * @return $this
     */
    public function withAds($count)
    {
        $this->adsCount = $count;

        return $this;
    }


    /**
     * Create a parent which has no parents
     * @param null $count
     * @return mixed
     */
    public function createParent($count = null)
    {
        // Multiple Categories >> returns multiple
        if($count) return factory(Category::class, $count)->create();

        // Single Category

        $parentCategory = factory(Category::class)->create();

        if($this->childrenCount) $this->createChild($parentCategory);

        return $parentCategory;
    }

    /**
     * Create a child category which has parent
     * @param null $parentCategory
     * @return mixed
     */
    public function createChild($parentCategory = null)
    {
        $parentCategory = $parentCategory ?: factory(Category::class)->create();

        return $parentCategory->children()->save(
           factory(Category::class)->create()
        ); // return parent
    }
}
