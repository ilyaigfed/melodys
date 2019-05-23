<?php

namespace App\Http\Controllers\Playlist;

use App\Playlist;
use App\PlaylistLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlaylistLikeController extends Controller
{
    public function create(Playlist $playlist)
    {
        $user = auth()->user();

        PlaylistLike::create([
            'user_id' => $user->id,
            'playlist_id' => $playlist->id
        ]);

        return response(null, 200);
    }

    public function destroy(Playlist $playlist)
    {
        $user = auth()->user();

        $like = PlaylistLike::where([
            ['user_id', $user->id],
            ['playlist_id', $playlist->id]
        ])->first();

        $like->forceDelete();

        return response(null, 200);
    }
}
