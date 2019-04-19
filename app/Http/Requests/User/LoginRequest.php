<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BasicRequest;

class LoginRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'email'    => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Поле обязательно для заполнения.',
            'password.required' => 'Поле обязательно для заполнения.',
        ];
    }
}
