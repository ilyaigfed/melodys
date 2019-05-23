<?php

namespace App\Http\Resources\UserPost;

use App\Http\Resources\User\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'created_at' => $this->created_at->format('d.m.y H:i'),
            'updated_at' => $this->updated_at->format('d.m.y H:i'),
            'author' => new ProfileResource($this->author->profile)
        ];
    }
}
