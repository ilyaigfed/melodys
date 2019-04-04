<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/reset_password', 'Auth\ResetPasswordController@resetPassword')->name('auth.reset.password');
