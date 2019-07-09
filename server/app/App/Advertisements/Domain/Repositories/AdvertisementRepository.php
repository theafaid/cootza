<?php

namespace App\App\Advertisements\Domain\Repositories;

use App\App\Advertisements\Domain\Models\Advertisement;

class AdvertisementRepository
{
    protected $advertisement;

    public function __construct(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;
    }

    public function __call($name, $arguments)
    {
        return $this->advertisement->$name(...$arguments);
    }

    public function paginated($count = 15)
    {
        return $this->advertisement->latest()->paginate($count);
    }
}
