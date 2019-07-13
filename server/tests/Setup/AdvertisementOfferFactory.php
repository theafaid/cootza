<?php

namespace Tests\Setup;

use App\App\AdvertisementOffers\Domain\Models\AdvertisementOffer as Offer;
use App\App\Advertisements\Domain\Models\Advertisement;
use Facades\Tests\Setup\UserFactory;
use Facades\Tests\Setup\AdvertisementFactory;
use App\Generic\Domain\Models\User;

class AdvertisementOfferFactory
{
    protected $advertisement = null;
    protected $provider = null;
    protected $offerContent = [];

    public function assignedTo(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;

        return $this;
    }

    public function providedBy(User $provider)
    {
        $this->provider = $provider;

        return $this;
    }

    public function withContent($advertisements = [], $price = null)
    {
        foreach($advertisements as $advertisement){
            array_push($this->offerContent['advertisements'], [
                'title' => $advertisement->title,
                'slug'  => $advertisement->slug,
                'main_image' => null
            ]);
        }

        $this->offerContent['money'] = $price;

        return $this;
    }

    public function create($count = null)
    {
        return factory(Offer::class, $count)->create([
            'provided_to'      => $this->getAssignedAdvertisement(),
            'provided_by'      => $this->getOfferProvider(),
            'content'          => $this->getOfferContent()
        ]);
    }

    protected function getAssignedAdvertisement()
    {
        return $this->advertisement ? $this->advertisement->id : AdvertisementFactory::create();
    }

    protected function getOfferProvider()
    {
        if(! $this->provider){
            // By logic, when providing an advertisement without providing a provider
            // the provider will be the advertisement owner
            if($this->advertisement) return $this->advertisement->owner->id;

            // When no advertisement also this means 100% no logic
            // because the offer which provided to the advertisement will has advertisement with owner
            // and the provider will be different with the advertisement owner
            return UserFactory::create();
        }

        return $this->provider->id;
    }

    protected function getOfferContent()
    {
        return json_encode(
            $this->offerContent ?: $this->generateOfferContent()
        );
    }

    public function generateOfferContent($advertisements = null, $money = null)
    {
        if(! is_null($advertisements)){
            $data['advertisements'] = [];

            foreach($advertisements as $advertisement){
                array_push($data['advertisements'], [
                        'id' => $advertisement->id,
                        'title' => $advertisement->title,
                        'slug'  => $advertisement->slug,
                        'main_image' => null,
                    ]
                );
            }
        }else{
            $data['advertisements'] = [];
        }

        $data['money'] = $money;

        return $data;
    }
}
