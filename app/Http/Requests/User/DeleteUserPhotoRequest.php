<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DeleteUserPhotoRequest extends FormRequest
{
    public function authorize()
    {
        $photo = $this->route('photo');
        $user = auth()->user();

        return $user->can('forceDelete', $photo);
    }
}
