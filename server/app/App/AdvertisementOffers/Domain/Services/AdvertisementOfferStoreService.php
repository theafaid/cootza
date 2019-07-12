<?php

namespace App\App\AdvertisementOffers\Domain\Services;

use App\App\Advertisements\Domain\Models\Advertisement;

class AdvertisementOfferStoreService
{
    public function handle($advertisement, $offer)
    {
       $content = $this->getOfferContent($offer);

        $advertisement->offers()->create([
            'provided_by' => auth()->id(),
            'content' => json_encode($content)
        ]);

        return response([], 201);
    }

    protected function getOfferContent($offer)
    {
        $content = [];

        if(count($offer['advertisements'])){

            $content['advertisements'] = $this->offerAdvertisementStoredContent(
              $this->providedAdvertisementsForOffer($offer['advertisements'])
            );

        }

        $content['money'] = $offer['money'];

        return $content;
    }

    protected function providedAdvertisementsForOffer($advertisementsIds)
    {
        $advertisements = collect($advertisementsIds)->map(function ($advertisementId) {

            return Advertisement::find($advertisementId);

        })->filter(function ($advertisement) {

            return $advertisement->ownedBy(auth()->user());

        });

        return $advertisements;

    }

    protected function offerAdvertisementStoredContent($providedAdvertisements)
    {
        $content = [];

        foreach($providedAdvertisements as $advertisement){

            array_push($content, [
                'id' => $advertisement->id,
                'title' => $advertisement->title,
                'slug' => $advertisement->slug,
                'main_image' => null
            ]);

        }

        return $content;
    }
}
