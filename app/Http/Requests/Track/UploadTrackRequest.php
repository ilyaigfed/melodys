<?php

namespace App\Http\Requests\Track;

use App\Http\Requests\BasicRequest;
use App\Rules\AvailableFileDuration;
use Illuminate\Support\Facades\Validator;

class UploadTrackRequest extends BasicRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'       => 'required',
            'link'        => 'required|unique:tracks',
            'description' => 'string|max:255',
            'image'       => 'image|mimes:jpeg,png|max:5120',
            'file'        => ['bail', 'required', 'file', 'mimes:mpga', new AvailableFileDuration],
            'playlist_id' => 'exists:playlists,id'
        ];
    }
}
