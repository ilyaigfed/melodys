<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'user'
],function() {
    Route::post('/register', 'UserController@register');
    Route::post('/login', 'UserController@login');
    Route::post('/logout', 'UserController@logout')->middleware(['jwt.auth']);
    Route::get('/me', 'UserController@me')->middleware(['jwt.auth']);
    Route::post('/forgotpassword', 'UserController@forgotPassword')->name('user.forgot');
    Route::post('/info', 'UserController@changeInformation')->middleware(['jwt.auth']);
    Route::get('/{name}', 'UserController@find');
});