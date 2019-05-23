<?php

namespace App\Http\Resources\UserPost;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserPostsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return UserPostResource::collection($this);
    }
}
