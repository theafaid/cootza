<?php

namespace App\App\Advertisements\Domain\Scoping\Scopes;

use App\App\Advertisements\Domain\Scoping\Contracts\Scope;
use App\App\Categories\Domain\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class CategoryScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        $category = Category::whereSlug($value)->first();

        return $builder->whereHas('category', function($builder) use ($value, $category){

            $builder->whereIn(
                'slug',
                $category->parent_id ? [$value] : $category->children->pluck('slug')
            );
        });
    }
}
