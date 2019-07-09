<?php

namespace App\App\Advertisements\Domain\Scoping;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Scoper
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder, array $scopes)
    {

    }
}
