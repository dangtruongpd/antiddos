<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@home')->name('home');

Route::post('/update-config', 'HomeController@updateConfig')->name('update-config');

Route::get('/captcha', 'ReCaptchaController@showCaptcha')->name('captcha.show');

Route::post('/captcha', 'ReCaptchaController@captcha')->name('captcha.check');

Route::prefix('/bot')->group(function() {

    Route::get('cache-bot-ip-list', 'GetBotIpController@index');
    Route::get('get-bot-ip-list', 'GetBotIpController@getBotIpList');
    Route::get('delete-bot-ip-list', 'GetBotIpController@deleteBotIpList');

});


// Route::get('/login', 'LoginController@login')->name('login');