<?php

namespace App\Http\Requests\Track;

use App\Http\Requests\BasicRequest;

class GetTrackRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'by'    => 'in:id,link,name,email',
            'track' => 'required'
        ];
    }
}
