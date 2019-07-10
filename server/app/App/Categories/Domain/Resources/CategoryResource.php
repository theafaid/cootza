<?php

namespace App\App\Categories\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'parent' => new CategoryResource($this->parent),
            'children' =>  CategoryResource::collection($this->whenLoaded('children'))
        ];
    }
}
