<?php

namespace App\App\Auth\Responders;

class UserLogoutResponder
{
    public function respond()
    {
        return response()->json([], 200);
    }
}
