<?php

namespace App\App\Advertisements\Domain\Resources;

use App\App\Users\Domain\Resources\PublicUserResource;

class AdvertisementResource extends AdvertisementIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request), [
                'owner' => new PublicUserResource($this->owner)
            ]
        );
    }
}
