<?php

namespace App\App\Advertisements\Domain\Services;

use App\App\Advertisements\Domain\Repositories\AdvertisementRepository;
use App\App\Advertisements\Domain\Resources\AdvertisementIndexResource;
use App\App\Advertisements\Domain\Scoping\Scopes\CategoryScope;

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
            $this->advertisement->paginated($this->scopes())
        );
    }

    protected function scopes()
    {
        return [
            'category' => new CategoryScope()
        ];
    }
}
