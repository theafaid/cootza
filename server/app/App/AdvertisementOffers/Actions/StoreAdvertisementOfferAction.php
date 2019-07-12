<?php

namespace App\App\AdvertisementOffers\Actions;

use App\App\AdvertisementOffers\Domain\Services\AdvertisementOfferStoreService;
use App\App\AdvertisementOffers\Responders\AdvertisementOffersStoreResponder;
use App\App\Advertisements\Domain\Models\Advertisement;
use App\App\AdvertisementOffers\Domain\Requests\AdvertisementOfferStoreRequest;

class StoreAdvertisementOfferAction
{
    protected $service, $responder;

    public function __construct(
        AdvertisementOfferStoreService $service,
        AdvertisementOffersStoreResponder $responder) {

        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke(Advertisement $advertisement, AdvertisementOfferStoreRequest $request)
    {

        return $this->responder->respond(
            $this->service->handle($advertisement, $request->validated()['offer'])
        );
    }
}

