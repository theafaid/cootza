<?php

namespace App\App\Users\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PublicUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => null,
            'member_since' => $this->created_at->diffForHumans(),
            'phone' => '0123456789',
            'social' => $this->social,
        ];
    }
}
