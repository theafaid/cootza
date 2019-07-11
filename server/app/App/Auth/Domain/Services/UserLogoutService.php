<?php

namespace App\App\Auth\Domain\Services;

class UserLogoutService
{
    public function logout()
    {
        auth()->guard('api')->logout();
    }
}
