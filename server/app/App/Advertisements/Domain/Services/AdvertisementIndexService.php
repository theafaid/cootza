<?php

namespace App\App\Advertisements\Domain\Services;

use App\App\Advertisements\Domain\Repositories\AdvertisementRepository;
use App\App\Advertisements\Domain\Resources\AdvertisementIndexResource;
use App\App\Advertisements\Domain\Scoping\Scopes\CategoryScope;

class AdvertisementIndexService
{
    protected $advertisement;

    /**
     * AdvertisementIndexService constructor.
     * @param AdvertisementRepository $advertisement
     */
    public function __construct(AdvertisementRepository $advertisement)
    {
        $this->advertisement = $advertisement;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handle()
    {
        return AdvertisementIndexResource::collection(
            $this->advertisement->paginated($this->scopes())
        );
    }

    /**
     * @return array
     */
    protected function scopes()
    {
        return [
            'category' => new CategoryScope()
        ];
    }
}
