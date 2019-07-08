<?php

namespace App\App\Categories\Domain\Repositories;

use App\App\Categories\Domain\Models\Category;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function __call($name, $arguments)
    {
        return $this->category->$name(...$arguments);
    }

    public function parents($direction = 'desc')
    {
        return $this->category
            ->with('children.children')
            ->parents()
            ->orderBy('id', $direction)
            ->get();
    }
}
