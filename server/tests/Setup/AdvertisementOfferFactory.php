<?php

namespace Tests\Setup;

use App\App\AdvertisementOffer\Domain\Models\AdvertisementOffer as Offer;
use App\App\Advertisements\Domain\Models\Advertisement;
use Facades\Tests\Setup;

class AdvertisementOfferFactory
{
    protected $advertisement = null;

    public function assignedTo(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;

        return $this;
    }

    public function create($count = null)
    {
        return factory(Offer::class, $count)->create([
            'advertisement_id' => $this->getAssignedAdvertisement()

        ]);
    }

    protected function getAssignedAdvertisement()
    {
        return $this->advertisement ? $this->advertisement->id : AdvertisementFactory::create();
    }
}
