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

Route::resources([
	'/admin/user' => 'UserController',
]);

// Route::get('/createadmin', function() {
// 	DB::table('user')->where('username', 'admin')->delete();
// 	DB::table('user')->insert(['username' => 'admin', 'password' => Hash::make('admin'), 'nama' => 'Administrator', 'level' => 'a']);

// 	return redirect()->route('login');
// });

// Route::get('/test', function() {
// 	echo bin2hex(random_bytes(64));
// });