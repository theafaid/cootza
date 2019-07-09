<?php

namespace App\App\Advertisements\Actions;

use App\App\Advertisements\Domain\Resources\AdvertisementResource;
use App\App\Advertisements\Responders\AdvertisementShowResponder;
use App\App\Advertisements\Domain\Models\Advertisement;

class AdvertisementShowAction
{
    protected $responder;

    public function __construct(AdvertisementShowResponder $responder)
    {
        $this->responder = $responder;
    }

    public function __invoke(Advertisement $advertisement)
    {
        return $this->responder->respond(
            new AdvertisementResource($advertisement)
        );
    }
}
