<?php

namespace App\Http\Requests\UserPost;

use App\Http\Requests\BasicRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserPostRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'text' => 'string|required'
        ];
    }
}
