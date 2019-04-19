<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BasicRequest;

class FollowRequest extends BasicRequest
{

    public function all($keys = null)
    {
        $request = parent::all($keys);
        $request['user'] = $this->route('user')->id;

        return $request;
    }

    public function rules()
    {
        return [
            'user' => 'not_in:'.auth()->user()->id
        ];
    }

    public function messages()
    {
        return [
            'user.not_in' => 'Поле не должно равняться id авторизованного пользователя.'
        ];
    }
}
