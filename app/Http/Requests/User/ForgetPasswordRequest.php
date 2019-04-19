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

    public function messages()
    {
        return [
            'email.required' => 'Поле обязательно для заполнения.',
            'email.exists'   => 'Email не существует.'
        ];
    }
}
