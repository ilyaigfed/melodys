<?php

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/resetpassword', 'UserController@resetPassword')->name('user.reset');
