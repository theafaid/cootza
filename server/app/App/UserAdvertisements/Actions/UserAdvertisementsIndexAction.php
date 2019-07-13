<?php

namespace App\App\UserAdvertisements\Actions;


class UserAdvertisementsIndexAction
{
    public function __invoke()
    {
        return auth()->user()->advertisements;
    }
}
