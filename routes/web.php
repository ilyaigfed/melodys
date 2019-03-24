<?php

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/reset', 'User\PasswordController@reset')->name('user.reset');
