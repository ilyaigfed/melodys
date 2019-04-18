<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BasicRequest;

class GetFollowingsRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'id' => 'required|exists:users'
        ];
    }
}
