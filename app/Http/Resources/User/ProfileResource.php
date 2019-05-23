<?php

namespace App\Http\Resources\User;

use App\Following;
use App\Profile;
use App\User;
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
        $user = auth()->user();
        $tracks = $this->user->tracks()->count();
        $followers = $this->user->followers()->count();
        $followings = $this->user->followings()->count();

        if($user) {
            $isFollowing = Following::where('follower_id', $user->id)->first();
            return [
                'id'        => $this->id,
                'name'      => $this->name,
                'about'     => $this->about,
                'image'     => $this->image,
                'instagram' => $this->instagram,
                'website'   => $this->website,
                'twitter'   => $this->twitter,
                'link'      => $this->link,
                'user_id'   => $this->user_id,
                'is_following' => !!$isFollowing,
                'tracks_count' => $tracks,
                'followers_count' => $followers,
                'followings_count' => $followings,
                'settings' => $this->user->setting
            ];
        }
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'about'     => $this->about,
            'image'     => $this->image,
            'instagram' => $this->instagram,
            'website'   => $this->website,
            'twitter'   => $this->twitter,
            'link'      => $this->link,
            'user_id'   => $this->user_id,
            'tracks_count' => $tracks,
            'followers_count' => $followers,
            'followings_count' => $followings,
            'settings' => $this->user->setting
        ];
    }
}
