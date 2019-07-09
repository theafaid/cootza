<?php

namespace App\App\Advertisements\Actions;

use App\App\Advertisements\Domain\Models\Advertisement;
use App\App\Advertisements\Domain\Resources\AdvertisementIndexResource;

class AdvertisementIndexAction
{
    public function __invoke()
    {
        return AdvertisementIndexResource::collection(
            Advertisement::all()
        );
    }
}
