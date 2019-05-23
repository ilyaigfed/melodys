<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'password'   => 'required|min:8|max:50',
            'r_password' => 'required|same:password',
        ];
    }
}
