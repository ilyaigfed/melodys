<?php

namespace App\Http\Resources\Playlist;

use App\Http\Resources\Track\TracksResource;
use App\Http\Resources\User\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistWithTracksResource extends JsonResource
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

        if($user) {
            return [
                'id'          => $this->id,
                'title'       => $this->title,
                'description' => $this->description,
                'link'        => $this->link,
                'image'       => $this->image,
                'playlist_type' => $this->playlist_type->name,
                'genre' => $this->genre->name,
                'liked' => $this->isLiked($this->id, $user->id),
                'likes_count' => $this->likes()->count(),
                'tracks' => new TracksResource($this->tracks),
                'user' => new ProfileResource($this->user->profile)
            ];
        }
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'link'        => $this->link,
            'image'       => $this->image,
            'playlist_type' => $this->playlist_type->name,
            'genre' => $this->genre->name,
            'tracks' => new TracksResource($this->tracks),
            'user' => new ProfileResource($this->user->profile)
        ];
    }
}
