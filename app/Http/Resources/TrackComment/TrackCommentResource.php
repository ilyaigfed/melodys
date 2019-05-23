<?php

namespace App\Http\Resources\TrackComment;

use App\Http\Resources\User\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackCommentResource extends JsonResource
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
            'id' => $this->id,
            'text' => $this->text,
            'user' => new ProfileResource($this->user->profile),
            'created_at' => $this->created_at->format('d.m.y H:i')
        ];
    }
}
