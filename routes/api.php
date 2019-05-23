<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Profile;
use App\Track;
use App\Playlist;

Route::bind('user', function ($value, $route) {
    $user = User::find($value);

    if(!$user) {
        $profile = Profile::where('link', $value)->first();
        if($profile) {
            $user = $profile->user;
        }
    }

    return $user;
});

Route::bind('track', function ($value, $route) {
    $track = Track::find($value);

    if(!$track) {
        $track = Track::where('link', $value)->first();
    }

    return $track;
});

Route::bind('playlist', function ($value, $route) {
    $playlist = Playlist::find($value);

    if(!$playlist) {
        $playlist = Playlist::where('link', $value)->first();
    }

    return $playlist;
});

//Route::group(['prefix' => 'method'], function() {
    Route::group(['prefix' => 'user'], function() {
        Route::group(['namespace' => 'User'], function() {
            /*
            * User/AuthController
            */

            Route::post('/registration', 'AuthController@register');
            Route::post('/login', 'AuthController@login');
            Route::get('/logout', 'AuthController@logout')->middleware(['jwt.auth']);
            Route::get('/refresh', 'AuthController@refresh');

            /*
             * User/PasswordController
             */

            Route::post('/password_recovery', 'PasswordController@forget')->name('auth.forget.password');
            Route::get('/password_reset', 'PasswordController@reset')->name('auth.reset.password');
            Route::put('me/password', 'PasswordController@change')->middleware(['jwt.auth']);

            /*
             * User/ProfileController
             */

            Route::put('me/profile', 'ProfileController@update')->middleware(['jwt.auth']);
            Route::get('me/profile', 'ProfileController@me')->middleware(['jwt.auth']);
            Route::get('{user}/profile', 'ProfileController@get');

            /*
             * User/FollowingController
             */

            Route::get('{user}/following', 'FollowingController@getSeveral');
            Route::post('{user}/following', 'FollowingController@follow')->middleware(['jwt.auth']);
            Route::delete('{user}/following', 'FollowingController@unfollow')->middleware(['jwt.auth']);

            /*
             * User/FollowerController
             */

            Route::get('{user}/follower', 'FollowerController@getSeveral');

            /*
             * Track/GetController
             */

            Route::get('{user}/track', 'TrackController@getSeveral');

            /*
             * User/PlaylistController
             */

            Route::get('{user}/playlist/album', 'PlaylistController@indexAlbums');
            Route::get('{user}/playlist/playlist', 'PlaylistController@indexPlaylists');
            Route::get('{user}/playlist', 'PlaylistController@index');


            /*
             * User/DeleteController
             */

            Route::delete('me', 'DeleteController@delete')->middleware(['jwt.auth']);

            /*
             * User/DurationController
             */

            Route::get('me/duration', 'DurationController@get')->middleware(['jwt.auth']);

            /*
             * User/UserPhotoController
             */

            Route::post('me/photo', 'UserPhotoController@upload')->middleware(['jwt.auth']);
            Route::get('{user}/photo', 'UserPhotoController@index');
            Route::delete('me/photo/{photo}', 'UserPhotoController@destroy')->middleware(['jwt.auth']);

            /*
             * User/UserPostController
             */

            Route::get('{user}/post', 'UserPostController@index');
            Route::post('{user}/post', 'UserPostController@create')->middleware(['jwt.auth']);

            /*
             * User/SettingController
             */

            Route::get('me/setting', 'SettingController@index')->middleware(['jwt.auth']);
            Route::put('me/setting', 'SettingController@update')->middleware(['jwt.auth']);

            /*
             * User/StreamController
             */

            Route::get('me/stream', 'StreamController@index')->middleware(['jwt.auth']);
        });
    });

    Route::group(['namespace' => 'Track', 'prefix' => 'track'], function() {
        /*
         * Track/TrackController
         */

        Route::post('/', 'TrackController@upload')->middleware(['jwt.auth']);
        Route::get('/{track}', 'TrackController@get');
        Route::delete('/{track}', 'TrackController@delete')->middleware(['jwt.auth']);
        Route::put('/{track}', 'TrackController@update')->middleware(['jwt.auth']);

        /*
         * Track/TrackLikeController
         */

        Route::get('/{track}/like', 'TrackLikeController@create')->middleware(['jwt.auth']);
        Route::delete('/{track}/like', 'TrackLikeController@destroy')->middleware(['jwt.auth']);

        /*
         * Track/TrackCommentController
         */

        Route::get('/{track}/comment', 'TrackCommentController@index');
        Route::post('/{track}/comment', 'TrackCommentController@create')->middleware(['jwt.auth']);

    });

    Route::group(['namespace' => 'Playlist', 'prefix' => 'playlist'], function() {
        /*
         * Playlist/PlaylistController
         */

        Route::post('/', 'PlaylistController@create')->middleware(['jwt.auth']);
        Route::get('/album', 'PlaylistController@indexAlbums');
        Route::get('/playlist', 'PlaylistController@indexPlaylists');
        Route::get('/', 'PlaylistController@index');
        Route::get('/{playlist}', 'PlaylistController@show');

        /*
         * Playlist/PlaylistLikeController
         */

        Route::get('/{playlist}/like', 'PlaylistLikeController@create')->middleware(['jwt.auth']);
        Route::delete('/{playlist}/like', 'PlaylistLikeController@destroy')->middleware(['jwt.auth']);
    });

    Route::group(['namespace' => 'Genre', 'prefix' => 'genre'], function() {
        /*
         * Genre/GenreController
         */

        Route::get('/', 'GenreController@index')->middleware(['jwt.auth']);
    });

    Route::group(['namespace' => 'PlaylistType', 'prefix' => 'playlist_type'], function() {
        /*
         * PlaylistType/PlaylistTypeController
         */

        Route::get('/', 'PlaylistTypeController@index')->middleware(['jwt.auth']);
    });
//});