<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\Playlist\PlaylistsResource;
use App\Playlist;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlaylistController extends Controller
{
    public function index(User $user)
    {
        return new PlaylistsResource($user->playlists()->orderBy('created_at', 'desc')->get());
    }

    public function indexAlbums(User $user)
    {
        $albums = $user->playlists()->whereHas('playlist_type', function($q) {
            $q->where('name', 'EP');
            $q->orWhere('name', 'Альбом');
            $q->orWhere('name', 'Демо');
            $q->orWhere('name', 'Сингл');
        })->orderBy('created_at', 'desc')->get();

        return new PlaylistsResource($albums);
    }

    public function indexPlaylists(User $user)
    {
        $playlists = $user->playlists()->whereHas('playlist_type', function($q) {
            $q->where('name', 'Лайв');
            $q->orWhere('name', 'Плейлист');
            $q->orWhere('name', 'Подборка');
            $q->orWhere('name', 'Ремиксы');
        })->orderBy('created_at', 'desc')->get();

        return new PlaylistsResource($playlists);
    }
}
