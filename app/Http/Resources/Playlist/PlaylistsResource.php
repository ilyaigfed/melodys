<?php

namespace App\Http\Resources\Playlist;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PlaylistsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return PlaylistResource::collection($this);
    }
}
