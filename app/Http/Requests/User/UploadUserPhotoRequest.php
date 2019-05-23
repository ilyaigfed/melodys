<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BasicRequest;
use Illuminate\Foundation\Http\FormRequest;

class UploadUserPhotoRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpeg,png'
        ];
    }
}
