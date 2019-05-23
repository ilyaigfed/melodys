<?php

namespace App\Http\Resources\TrackComment;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TrackCommentsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'count' => $this->count(),
            'comments' => TrackCommentResource::collection($this)
        ];
    }
}
