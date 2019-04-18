<?php

namespace App\Http\Requests\Track;

use App\Http\Requests\BasicRequest;

class DeleteTrackRequest extends BasicRequest
{
    public function authorize()
    {
        $track = $this->route('track');
        $user = auth()->user();

        return $user->can('forceDelete', $track);
    }
}
