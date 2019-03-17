<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'user'
],function() {
    Route::post('/register', 'UserController@register');
    Route::post('/login', 'UserController@login');
    Route::post('/logout', 'UserController@logout')->middleware(['jwt.auth']);
    Route::post('/me', 'UserController@me')->middleware(['jwt.auth']);
    Route::post('/forgot', 'UserController@forgotPassword')->name('user.forgot');
});