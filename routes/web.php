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

Route::get('/', function () {
    if (session('login') != true) {
    	return redirect()->route('login');
    } else {
    	dd(session()->all());
    }
})->name('root');

Route::get('/admin/login', 'AuthController@login')->name('login');
Route::post('/admin/login', 'AuthController@doLogin')->name('doLogin');
Route::get('/admin/logout', 'AuthController@doLogout')->name('doLogout');
Route::get('/admin/register', 'AuthController@register')->name('register');
Route::post('/admin/register', 'AuthController@doRegister')->name('doRegister');
Route::get('/admin/activate', 'AuthController@activate')->name('activate');

Route::resources([
	'/admin/user' => 'UserController',
]);