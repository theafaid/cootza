<?php

namespace App\App\Advertisements\Actions;

use App\App\Advertisements\Responders\AdvertisementIndexResponder;
use App\App\Advertisements\Domain\Services\AdvertisementIndexService;

class AdvertisementIndexAction
{
    protected $service, $responder;

    public function __construct(AdvertisementIndexService $service, AdvertisementIndexResponder $responder)
    {
        $this->service   = $service;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        return $this->responder->respond(
            $this->service->handle()
        );
    }
}
