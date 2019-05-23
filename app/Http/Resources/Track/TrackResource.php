<?php

namespace App\Http\Resources\Track;

use App\Helpers\MP3File;
use App\Http\Resources\User\ProfileResource;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackResource extends JsonResource
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
                'file'        => $this->file,
                'duration'    => $this->duration,
                'genre'       => $this->genre,
                'likes_count' => $this->likes()->count(),
                'liked'       => $this->isLiked($this->id, $user->id),
                'user'        => new ProfileResource($this->user->profile)
            ];
        }
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'link'        => $this->link,
            'image'       => $this->image,
            'file'        => $this->file,
            'duration'    => $this->duration,
            'genre'       => $this->genre,
            'likes_count' => $this->likes()->count(),
            'user'        => new ProfileResource($this->user->profile)
        ];
    }
}
