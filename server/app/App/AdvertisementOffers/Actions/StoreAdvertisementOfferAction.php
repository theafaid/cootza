<?php

namespace App\App\AdvertisementOffers\Actions;

use App\App\Advertisements\Domain\Models\Advertisement;

class StoreAdvertisementOfferAction
{
    public function __invoke(Advertisement $advertisement)
    {
       if($advertisement->owner->is(auth()->user())) return response([], 403);

       $ads = collect(request('offer')['advertisements'])->map(function ($advertisementId) {
           return Advertisement::find($advertisementId);
       });


       $content['advertisements'] = [];

       foreach($ads as $ad){
           array_push($content['advertisements'], [
               'id' => $ad->id,
               'title' => $ad->title,
               'slug' => $ad->slug,
               'main_image' => $ad->main_image
           ]);
       }

       $content['additional_money'] = request('offer')['additional_money'];


       $advertisement->offers()->create([
           'provided_by' => auth()->id(),
           'content' => json_encode($content)
       ]);

       return response([], 201);
    }
}

