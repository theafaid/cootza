<?php

namespace App\App\Categories\Domain\Services;

use App\App\Categories\Domain\Repositories\CategoryRepository;
use App\App\Categories\Domain\Resources\CategoryResource;

class CategoryIndexService
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function handle()
    {
        return CategoryResource::collection(
            $this->category->parents()
        );
    }
}
