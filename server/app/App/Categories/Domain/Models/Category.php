<?php

namespace App\App\Categories\Domain\Models;

use App\App\Advertisements\Domain\Models\Advertisement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
        'icon'
    ];

    public function scopeParents(Builder $builder)
    {
        $builder->where('parent_id', null);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'category_id', 'id');
    }
}
