<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BasicRequest;

class UnfollowRequest extends BasicRequest
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
}
