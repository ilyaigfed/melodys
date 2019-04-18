<?php

namespace App\Http\Resources\Track;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TracksResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return TrackResource::collection($this);
    }
}
