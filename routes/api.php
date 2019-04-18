<?php

use Illuminate\Support\Facades\Route;

//Route::group(['prefix' => 'method'], function() {
    Route::group(['prefix' => 'user'], function() {
        Route::group(['namespace' => 'User'], function() {
            /*
            * User/AuthController
            */

            Route::post('/registration', 'AuthController@register');
            Route::post('/login', 'AuthController@login');
            Route::get('/logout', 'AuthController@logout')->middleware(['jwt.auth']);

            /*
             * User/PasswordController
             */

            Route::post('/password_recovery', 'PasswordController@forget')->name('auth.forget.password');
            Route::get('/password_reset', 'PasswordController@reset')->name('auth.reset.password');

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
             * User/DeleteController
             */

            Route::delete('me', 'DeleteController@delete')->middleware(['jwt.auth']);

            /*
             * User/DurationController
             */

            Route::get('me/duration', 'DurationController@get')->middleware(['jwt.auth']);
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

    });

    Route::group(['namespace' => 'Playlist', 'prefix' => 'playlist'], function() {
        /*
         * Playlist/PlaylistController
         */

        Route::post('/', 'PlaylistController@create')->middleware(['jwt.auth']);
    });
//});