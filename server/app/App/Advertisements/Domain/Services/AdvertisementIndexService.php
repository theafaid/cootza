<?php

namespace App\App\Advertisements\Domain\Services;

use App\App\Advertisements\Domain\Repositories\AdvertisementRepository;
use App\App\Advertisements\Domain\Resources\AdvertisementIndexResource;

class AdvertisementIndexService
{
    protected $advertisement;

    public function __construct(AdvertisementRepository $advertisement)
    {
        $this->advertisement = $advertisement;
    }

    public function handle()
    {
        return AdvertisementIndexResource::collection(
            $this->advertisement->paginated()
        );
    }
}
