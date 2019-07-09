<?php

namespace App\App\Advertisements\Domain\Resources;

use App\App\Categories\Domain\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'category' => new CategoryResource($this->whenLoaded('category'))
        ];
    }
}
