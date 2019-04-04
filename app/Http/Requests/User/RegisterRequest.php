<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'terms'      => 'accepted',
            'name'       => 'required|unique:users|max:30',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:8|max:50',
            'r_password' => 'required|same:password'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ])->setStatusCode(400, 'Validation error'));
    }
}
