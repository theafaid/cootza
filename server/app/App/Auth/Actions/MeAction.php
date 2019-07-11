<?php

namespace App\App\Auth\Actions;

use App\App\Auth\Domain\Requests\UserLoginFormRequest;
use App\App\Auth\Domain\Resources\PrivateUserResource;
use App\App\Auth\Domain\Services\UserLoginService;
use App\App\Auth\Responders\UserLoginResponder;

class MeAction
{
    protected $service, $responder;

    public function __construct(UserLoginService $service, UserLoginResponder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        return new PrivateUserResource(auth()->user());
    }
}
