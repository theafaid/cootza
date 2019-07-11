<?php

namespace App\App\Auth\Actions;

use App\App\Auth\Domain\Requests\UserRegisterFormRequest;
use App\App\Auth\Domain\Services\UserRegisterService;
use App\App\Auth\Responders\UserRegisterResponder;

class UserRegisterAction
{
    protected $service, $responder;

    public function __construct(UserRegisterService $service, UserRegisterResponder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke(UserRegisterFormRequest $request)
    {
        return $this->responder->respond(
            $this->service->handle(
                $request->validated()
            )
        );
    }
}
