<?php

namespace App\App\Advertisements\Domain\Models;

use App\App\Categories\Domain\Models\Category;
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function preferredCategoryToSwapWith()
    {
        return $this->belongsTo(Category::class, 'preferably_swap_with', 'id');
    }
}
