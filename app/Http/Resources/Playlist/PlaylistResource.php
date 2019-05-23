<?php

namespace App\Http\Resources\Playlist;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistResource extends JsonResource
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
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'link'        => $this->link,
            'image'       => $this->image,
            'playlist_type' => $this->playlist_type->name,
            'genre' => $this->genre->name
        ];
    }
}
