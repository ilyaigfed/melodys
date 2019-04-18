<?php

namespace App\Http\Requests\Track;

use App\Http\Requests\BasicRequest;

class GetSeveralTracksRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'user_id' => 'required'
        ];
    }
}
