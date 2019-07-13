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
            'slug' => $this->slug,
            'description' => $this->description,
            'main_image' => $this->main_image,
            'created_at' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->diffForHumans(),
            'category' => new CategoryResource($this->whenLoaded('category'))
        ];
    }
}
