<?php

namespace App\App\Auth\Domain\Repositories;

use App\Generic\Domain\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __call($name, $arguments)
    {
        return $this->user->$name(...$arguments);
    }

    public function create($data)
    {
        return $this->user->create($data);
    }
}
