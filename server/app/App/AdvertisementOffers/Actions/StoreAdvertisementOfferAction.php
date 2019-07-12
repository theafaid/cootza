<?php

namespace App\App\AdvertisementOffers\Actions;

use App\App\Advertisements\Domain\Models\Advertisement;

class StoreAdvertisementOfferAction
{
    public function __invoke(Advertisement $advertisement)
    {
       if($advertisement->owner->is(auth()->user())) return response([], 403);

       $advertisement->offers()->create([
           'provided_by' => auth()->id(),
           'content' => json_encode(request('offer'))
       ]);

       return response([], 201);
    }
}

