<?php

use Illuminate\Support\Facades\Route;

// LOGIN
// need authentication middleware
Route::get('/login', 'Auth\LoginController@showLoginForm' /* can put class */)->name('login');

// REGISTER
Route::get('/register', 'Auth\RegisterController@showRegistrationForm' /* can put class */)->name('register');


// FORGET PASSWORD
Route::get('/forget-password', 'Auth\ForgotPasswordController@showLinkRequestForm' /* can put class */)->name('password.request');

// RESET PASSWORD
Route::get('/password-reset/{token}', 'Auth\ResetPasswordController@showResetForm' /* can put class */)->name('password.reset');

// LOGOUT
Route::get('/logout', 'Auth\LoginController@logout' /* can put class */)->name('logout');
