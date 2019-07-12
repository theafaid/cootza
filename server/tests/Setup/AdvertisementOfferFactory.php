<?php

namespace Tests\Setup;

use App\App\AdvertisementOffer\Domain\Models\AdvertisementOffer as Offer;
use App\App\Advertisements\Domain\Models\Advertisement;
use App\Generic\Domain\Models\User;
use Facades\Tests\Setup\UserFactory;

class AdvertisementOfferFactory
{
    protected $advertisement = null, $presenter = null;

    public function assignedTo(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;

        return $this;
    }

    public function offeredBy(User $presenter)
    {
        $this->presenter = $presenter;

        return $this;
    }

    public function create($count = null)
    {
        return factory(Offer::class, $count)->create([
            'provided_to'      => $this->getAssignedAdvertisement(),
            'offered_by'       => $this->getOfferPresenter()
        ]);
    }

    protected function getAssignedAdvertisement()
    {
        return $this->advertisement ? $this->advertisement->id : AdvertisementFactory::create();
    }

    protected function getOfferPresenter()
    {
        if(! $this->presenter){
            // By logic, when providing an advertisement without providing a presenter
            // the presenter will be the advertisement owner
            if($this->advertisement) return $this->advertisement->owner->id;

            // When no advertisement also this means 100% no logic
            // because the offer which provided to the advertisement will has advertisement with owner
            // and the presenter will be different with the advertisement owner
            return UserFactory::create();
        }

        return $this->presenter->id;
    }
}
