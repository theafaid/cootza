<?php

namespace App\App\Auth\Domain\Services;

use App\App\Users\Domain\Resources\PrivateUserResource;

class UserLoginService
{
    public function handle($data)
    {
        if(! $token = $this->tryLogin($data))
        {
           return $this->loginFailed();
        }

        return $this->userWithToken($token);
    }

    protected function tryLogin($data)
    {
       return auth()->guard('api')->attempt($data);
    }

    protected function loginFailed()
    {
        return response()->json(
            [ 'errors' => $this->errors()],422
        );
    }

    protected function errors()
    {
       return [
            'email' => [__('auth.failed')]
        ];
    }

    protected function userWithToken($token)
    {
        return (new PrivateUserResource(auth()->user()))
            ->additional([
                'meta' => ['token' => $token]
            ]);
    }
}
