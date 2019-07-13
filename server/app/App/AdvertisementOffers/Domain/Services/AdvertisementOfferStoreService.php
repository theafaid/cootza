<?php

namespace App\App\AdvertisementOffers\Domain\Services;

use App\App\Advertisements\Domain\Models\Advertisement;

class AdvertisementOfferStoreService
{
    protected $advertisementStoredAttributes = ['id', 'slug', 'title', 'main_image'];

    public function handle($advertisement, $offer)
    {
        $advertisement->offers()->create([
            'provided_by' => auth()->id(),
            'content' => json_encode($this->getOfferContent($offer))
        ]);

        return response([], 201);
    }

    protected function getOfferContent($offer)
    {
        $content = [];

        if(count($offer['advertisements'])){
            $content['advertisements'] = $this->getAdvertisementsContent($offer['advertisements']);

        }else{
            $content['advertisements'] = [];
        }

        $content['money'] = $offer['money'];

        return $content;
    }

    protected function getAdvertisementsContent($advertisementsIds)
    {

        return collect($advertisementsIds)->map(function ($advertisementId) {

            return Advertisement::whereId($advertisementId)
                ->first()
                ->only(['id', 'title', 'slug', 'main_image']);
        });

    }
}
