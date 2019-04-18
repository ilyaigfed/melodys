<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BasicRequest;

class GetProfileRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'user' => 'required',
            'by' => 'in:id,link,name,email'
        ];
    }
}
