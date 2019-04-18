<?php

namespace App\Http\Requests\Track;

use App\Http\Requests\BasicRequest;

class UpdateTrackRequest extends BasicRequest
{
    public function authorize()
    {
        $user = auth()->user();
        $track = $this->route('track');

        return $user->can('update', $track);
    }

    public function rules()
    {
        return [
            'link'        => 'unique:tracks',
            'description' => 'string|max:255',
            'image'       => 'image|mimes:jpeg,png|max:5120',
            'playlist_id' => 'exists:playlists,id'
        ];
    }

}
