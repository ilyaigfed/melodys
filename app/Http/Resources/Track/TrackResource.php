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
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'link'        => $this->link,
            'image'       => $this->image,
            'file'        => $this->file,
            'user'        => new ProfileResource($this->user->profile)
        ];
    }
}
