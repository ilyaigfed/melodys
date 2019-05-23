<?php

namespace App\Http\Controllers\Playlist;

use App\Helpers\FileSaver;
use App\Http\Requests\Playlist\CreatePlaylistRequest;
use App\Http\Resources\Playlist\PlaylistResource;
use App\Http\Resources\Playlist\PlaylistsResource;
use App\Http\Resources\Playlist\PlaylistWithTracksResource;
use App\Playlist;
use App\Profile;
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
        $data['link'] = Profile::generateLink($request->title);

        if($request->has('release_date'))
            $data['release_date'] = Carbon::createFromFormat('Y-m-d', $request->release_date)->toDateString();

        $playlist = Playlist::create($data);

        PlaylistResource::withoutWrapping();
        return new PlaylistResource($playlist);
    }

    public function index()
    {
        return new PlaylistsResource(Playlist::orderBy('created_at', 'desc')->get());
    }

    public function indexAlbums()
    {
        $albums = Playlist::whereHas('playlist_type', function($q) {
            $q->where('name', 'EP');
            $q->orWhere('name', 'Альбом');
            $q->orWhere('name', 'Демо');
            $q->orWhere('name', 'Сингл');
        })->orderBy('created_at', 'desc')->get();

        return new PlaylistsResource($albums);
    }

    public function indexPlaylists()
    {
        $playlists = Playlist::whereHas('playlist_type', function($q) {
            $q->where('name', 'Лайв');
            $q->orWhere('name', 'Плейлист');
            $q->orWhere('name', 'Подборка');
            $q->orWhere('name', 'Ремиксы');
        })->orderBy('created_at', 'desc')->get();

        return new PlaylistsResource($playlists);
    }

    public function show(Playlist $playlist)
    {
        PlaylistWithTracksResource::withoutWrapping();
        return new PlaylistWithTracksResource($playlist);
    }
}
