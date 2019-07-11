<?php

namespace App\App\Auth\Domain\Services;

use App\App\Auth\Domain\Repositories\UserRepository;
use App\App\Auth\Domain\Resources\PrivateUserResource;

class UserRegisterService
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function handle($data)
    {
        $user = $this->user->create($data);

        return new PrivateUserResource($user);
    }
}
