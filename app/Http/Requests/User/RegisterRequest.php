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
            'terms'      => 'accepted',
            'name'       => 'required|max:30',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:8|max:50',
            'r_password' => 'required|same:password'
        ];
    }
}
