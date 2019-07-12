<?php

namespace App\App\AdvertisementOffers\Actions;

use App\App\Advertisements\Domain\Models\Advertisement;

class StoreAdvertisementOfferAction
{
    public function __invoke(Advertisement $advertisement)
    {
       if($advertisement->owner->is(auth()->user())) return response([], 403);

       dd(request()->all());

       $advertisement->offers()->create([
           'offered_by' => auth()->id(),

       ]);
    }
}

