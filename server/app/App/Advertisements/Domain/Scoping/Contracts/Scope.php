<?php

namespace App\App\Advertisements\Domain\Scoping\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Scope
{
    public function apply(Builder $builder, $value);
}
