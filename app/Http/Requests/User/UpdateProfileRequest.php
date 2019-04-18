<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BasicRequest;

class UpdateProfileRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'name'       => 'max:25',
            'link'       => 'max:35|regex:/^[a-zA-Z0-9_]+$/',
            'about'      => 'max:255',
            'image'      => 'image|mimes:jpeg,png|max:5120',
            'instagram'  => 'nullable|regex:/^[a-zA-Z0-9._]+$/',
            'website'    => 'nullable|url',
            'twitter'    => 'nullable|regex:/^[A-Za-z0-9_]+$/|max:15'
        ];
    }
}
