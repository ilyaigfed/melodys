<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function() {
    Route::group(['namespace' => 'Auth'], function() {
        Route::post('/create', 'RegisterController@create');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LogoutController@logout')->middleware(['jwt.auth']);
        Route::post('/forgot_password', 'ForgotPasswordController@forgotPassword')->name('auth.forgot.password');
    });

    Route::group(['namespace' => 'User'], function() {
        Route::post('/set_profile', 'ProfileController@update')->middleware(['jwt.auth']);
        Route::get('/{user}', 'ProfileController@findOne');
        Route::get('/{user}/followings', 'FollowingController@find');
        Route::get('/{user}/followers', 'FollowerController@find');
        Route::post('/{user}/followers', 'FollowerController@follow')->middleware(['jwt.auth']);
        Route::delete('/{user}/followers', 'FollowerController@unfollow')->middleware(['jwt.auth']);
    });
});