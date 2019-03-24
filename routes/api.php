<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'user'
],function() {
    Route::get('/{name}', 'User\UserController@find');
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/login', 'User\AuthController@login');
    Route::post('/logout', 'User\AuthController@logout')->middleware(['jwt.auth']);
});

Route::group([
    'prefix' => 'password'
], function () {
    Route::post('/forgot', 'User\PasswordController@forgot')->name('user.forgot');
});

Route::group([
    'prefix' => 'register'
], function () {
    Route::post('/', 'User\RegisterController@register');
});

Route::group([
    'prefix' => 'settings'
], function () {
    Route::post('/', 'User\UserInfoController@change')->middleware(['jwt.auth']);
});