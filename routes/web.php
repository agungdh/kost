<?php

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

Route::get('/', 'MainController@index')->name('root');

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@doLogin')->name('doLogin');
Route::get('/logout', 'AuthController@doLogout')->name('doLogout');
Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@doRegister')->name('doRegister');
Route::get('/activate', 'AuthController@activate')->name('activate');
Route::post('/resendactivate', 'AuthController@resendActivate')->name('resendActivate');
Route::get('/successresendactivate', 'AuthController@successResendActivate')->name('successResendActivate');
Route::get('/forgetpassword', 'AuthController@forgetPassword')->name('forgetPassword');
Route::post('/forgetpassword', 'AuthController@doForgetPassword')->name('doForgetPassword');
Route::get('/forgetpasswordchpass', 'AuthController@forgetPasswordChPass')->name('forgetPasswordChPass');
Route::post('/forgetpasswordchpass', 'AuthController@doForgetPasswordChPass')->name('doForgetPasswordChPass');

Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');

Route::get('/profile', 'AdminController@profile')->name('profile');
Route::put('/profile', 'AdminController@doProfile')->name('doProfile');
Route::get('/chpass', 'AdminController@chpass')->name('chpass');
Route::put('/chpass', 'AdminController@doChpass')->name('doChpass');
Route::get('/foto', 'AdminController@foto')->name('foto');
Route::put('/foto', 'AdminController@doFoto')->name('doFoto');

Route::resources([
	'/user' => 'UserController',
]);