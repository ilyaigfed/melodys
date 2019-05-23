<?php

namespace App\Http\Requests\Setting;

use App\Http\Requests\BasicRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'show_profile_photos' => 'boolean',
            'show_profile_posts' => 'boolean',
            'posts_only_from_me' => 'boolean'
        ];
    }
}
