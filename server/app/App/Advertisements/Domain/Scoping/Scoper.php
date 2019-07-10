<?php

namespace App\App\Advertisements\Domain\Scoping;

use App\App\Advertisements\Domain\Scoping\Contracts\Scope;
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
        foreach($scopes as $key => $scope){
            if(in_array($key, $this->request->keys())){
                if(! $scope instanceof Scope) continue;

                $scope->apply($builder, $this->request->get($key));
            }

        }

        return $builder;
    }
}
