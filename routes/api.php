<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'method'], function() {
    Route::group(['namespace' => 'User'], function() {

        /*
         * User/AuthController
         */

        Route::post('/user.register', 'AuthController@register');
        Route::post('/user.login', 'AuthController@login');
        Route::post('/user.logout', 'AuthController@logout')->middleware(['jwt.auth']);

        /*
         * User/PasswordController
         */

        Route::post('/user.forgetPassword', 'PasswordController@forget')->name('auth.forget.password');
        Route::post('/user.resetPassword', 'PasswordController@reset')->name('auth.reset.password');

        /*
         * User/ProfileController
         */

        Route::post('/user.updateProfile', 'ProfileController@update')->middleware(['jwt.auth']);
        Route::get('/user.get', 'ProfileController@get');

        /*
         * User/FollowingController
         */

        Route::get('/user.getFollowings', 'FollowingController@getSeveral');
        Route::post('/user.follow', 'FollowingController@follow')->middleware(['jwt.auth']);
        Route::post('/user.unfollow', 'FollowingController@unfollow')->middleware(['jwt.auth']);

        /*
         * User/FollowerController
         */

        Route::get('/user.getFollowers', 'FollowerController@getSeveral');
    });
});