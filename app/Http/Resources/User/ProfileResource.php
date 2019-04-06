<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'id'        => $this->id,
            'name'      => $this->name,
            'about'     => $this->about,
            'image'     => $this->image,
            'instagram' => $this->instagram,
            'website'   => $this->website,
            'twitter'   => $this->twitter,
            'link'      => $this->link
        ];
    }
}
