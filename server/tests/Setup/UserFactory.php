<?php

namespace Tests\Setup;


use App\Generic\Domain\Models\User;

class UserFactory
{
    public function create($data = [])
    {
        return factory(User::class)->create($data);
    }
}
