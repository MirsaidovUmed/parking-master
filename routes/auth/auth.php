<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

//Authentication Routes...
Route::get('/','App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::get('login','App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login','App\Http\Controllers\Auth\LoginController@login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
//Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset');
