<?php

namespace App\App\Auth\Actions;

use App\App\Auth\Domain\Services\UserLogoutService;
use App\App\Auth\Responders\UserLogoutResponder;

class UserLogoutAction
{
    protected $service, $responder;

    public function __construct(UserLogoutService $service, UserLogoutResponder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $this->service->logout();

        return $this->responder->respond();
    }
}
