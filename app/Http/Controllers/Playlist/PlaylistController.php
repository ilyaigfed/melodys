<?php

namespace App\Http\Controllers\Playlist;

use App\Helpers\FileSaver;
use App\Http\Requests\Playlist\CreatePlaylistRequest;
use App\Playlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlaylistController extends Controller
{
    public function create(CreatePlaylistRequest $request)
    {
        $data = $request->all();
        $user = auth()->user();

        if($request->hasFile('image'))
            $data['image'] = FileSaver::save((new Playlist()), 'image', $request->file('image'), 'playlist_images');

        $data['user_id'] = $user->id;

        if($request->has('release_date'))
            $data['release_date'] = Carbon::createFromFormat('d/m/Y', $request->release_date)->toDateString();

        $playlist = Playlist::create($data);

        return $playlist;
    }
}
