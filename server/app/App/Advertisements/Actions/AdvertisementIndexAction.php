<?php

namespace App\App\Advertisements\Actions;

use App\App\Advertisements\Domain\Services\AdvertisementIndexService;
use App\App\Advertisements\Responders\AdvertisementIndexResponder;

class AdvertisementIndexAction
{
    protected $service, $responder;

    /**
     * AdvertisementIndexAction constructor.
     * @param AdvertisementIndexService $service
     * @param AdvertisementIndexResponder $responder
     */
    public function __construct(AdvertisementIndexService $service, AdvertisementIndexResponder $responder)
    {
        $this->service   = $service;
        $this->responder = $responder;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        return $this->responder->respond(
            $this->service->handle()
        );
    }
}
