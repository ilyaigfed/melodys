<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BasicRequest;

class RegisterRequest extends BasicRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:8|max:50',
            'r_password' => 'required|same:password',
            'name'       => 'required|max:30',
            'terms'      => 'accepted',
        ];
    }

    public function messages()
    {
        return [
            'terms.accepted'      => 'Правила должны быть приняты.',
            'name.required'       => 'Поле обязательно для заполнения.',
            'name.max'            => 'Поле должно содержать максимум 30 символов.',
            'email.required'      => 'Поле обязательно для заполнения.',
            'email.email'         => 'Поле не соответствует формату email.',
            'email.unique'        => 'Email уже используется.',
            'password.required'   => 'Поле обязательно для заполнения.',
            'password.min'        => 'Поле должно содержать минимум 8 символов.',
            'password.max'        => 'Поле должно содержать максимум 50 символов.',
            'r_password.required' => 'Поле обязательно для заполнения.',
            'r_password.same'     => "Поле не совпадает с полем 'Пароль'.",
        ];
    }
}
