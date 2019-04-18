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
        $profile = $user->profile;

        return [
            'id'      => $profile->id,
            'name'    => $profile->name,
            'image'   => $profile->image,
            'link'    => $profile->link,
            'user_id' => $profile->user_id
        ];
    }
}
