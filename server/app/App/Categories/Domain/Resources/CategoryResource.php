<?php

namespace App\App\Categories\Domain\Resources;

use App\App\Categories\Domain\Models\Category;
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
            'children' =>  CategoryResource::collection($this->whenLoaded('children'))
        ];
    }
}
