<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BasicRequest;

class ForgetPasswordRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'email' => 'required|exists:users'
        ];
    }
}
