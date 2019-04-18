<?php

namespace App\Http\Requests\Playlist;

use App\Http\Requests\BasicRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePlaylistRequest extends BasicRequest
{
    public function rules()
    {
        return [
            'title'        => 'required',
            'link'        => 'required|unique:playlists',
            'description' => 'string|max:255',
            'image'       => 'image|mimes:jpeg,png|max:5120',
            'playlist_type_id' => 'required|exists:playlist_types,id',
            'release_date' => 'date_format:d/m/Y'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ])->setStatusCode(400, 'Validation error'));
    }
}
