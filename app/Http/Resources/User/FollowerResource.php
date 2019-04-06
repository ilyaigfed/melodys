<?php

namespace App\Http\Resources\User;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = User::find($this->follower_id);

        return [
            'id'    => $user->id,
            'name'  => $user->name,
            'image' => $user->image,
            'link'  => $user->link
        ];
    }
}
