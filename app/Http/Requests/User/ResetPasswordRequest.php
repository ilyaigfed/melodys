<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BasicRequest;

class ResetPasswordRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'token' => 'required|exists:password_resets'
        ];
    }
}
