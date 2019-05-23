<?php

namespace App\Http\Resources\UserPhoto;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPhotoResource extends JsonResource
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
            'image' => $this->image,
            'created_at' => $this->created_at->format('d.m.y')
        ];
    }
}
