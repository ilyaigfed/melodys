<?php

namespace App\Http\Controllers\Track;

use App\Track;
use App\TrackLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrackLikeController extends Controller
{
    public function create(Track $track)
    {
        $user = auth()->user();

        TrackLike::create([
            'user_id' => $user->id,
            'track_id' => $track->id
        ]);

        return response(null, 200);
    }

    public function destroy(Track $track)
    {
        $user = auth()->user();

        $like = TrackLike::where([
            ['user_id', $user->id],
            ['track_id', $track->id]
        ])->first();

        $like->forceDelete();

        return response(null, 200);
    }
}
