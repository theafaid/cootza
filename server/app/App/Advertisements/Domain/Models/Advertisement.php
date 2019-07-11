<?php

namespace App\App\Advertisements\Domain\Models;

use App\App\Advertisements\Domain\Scoping\Scoper;
use App\App\Categories\Domain\Models\Category;
use App\Generic\Domain\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id',
        'preferably_swap_with'
    ];

    protected $with = ['category'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function scopeWithScopes(Builder $builder, $scopes = [])
    {
        return (new Scoper(request()))->apply($builder, $scopes);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function preferredCategoryToSwapWith()
    {
        return $this->belongsTo(Category::class, 'preferably_swap_with', 'id');
    }
}
