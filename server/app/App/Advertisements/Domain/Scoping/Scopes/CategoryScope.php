<?php

namespace App\App\Advertisements\Domain\Scoping\Scopes;

use App\App\Advertisements\Domain\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class CategoryScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        return $builder->whereHas('category', function($builder) use ($value){
            $builder->where('slug', $value);
        });
    }
}
