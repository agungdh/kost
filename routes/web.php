<?php

// root
Route::get('/', 'MainController@index')->name('root');

// log
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

// dashboard
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');

// admin
Route::get('/profile', 'AdminController@profile')->name('profile');
Route::put('/profile', 'AdminController@doProfile')->name('doProfile');
Route::get('/chpass', 'AdminController@chpass')->name('chpass');
Route::put('/chpass', 'AdminController@doChpass')->name('doChpass');
Route::get('/foto', 'AdminController@foto')->name('foto');
Route::put('/foto', 'AdminController@doFoto')->name('doFoto');
Route::get('/chemail', 'AdminController@chemail')->name('chemail');
Route::put('/chemail', 'AdminController@doChemail')->name('doChemail');
Route::get('/confirmchemail', 'AdminController@confirmChemail')->name('confirmChemail');

// public ajaxs
Route::post('/publicajax/prop', 'PublicAjaxController@prop')->name('publicAjax.prop');
Route::post('/publicajax/kab', 'PublicAjaxController@kab')->name('publicAjax.kab');
Route::post('/publicajax/kec', 'PublicAjaxController@kec')->name('publicAjax.kec');
Route::post('/publicajax/desa', 'PublicAjaxController@desa')->name('publicAjax.desa');
Route::post('/publicajax/getdatadaerahbydesa', 'PublicAjaxController@getDataDaerahByDesa')->name('publicAjax.getDataDaerahByDesa');

// kost
Route::get('/kost/{id}/medialibrary', 'KostController@mediaLibrary')->name('kost.mediaLibrary');
Route::put('/kost/{id}/domedialibrary', 'KostController@doMediaLibrary')->name('kost.doMediaLibrary');
Route::get('/kost/dodeletephoto', 'KostController@doDeletePhoto')->name('kost.doDeletePhoto');

// user
Route::get('/user', 'UserController@index')->name('user.index');
Route::get('/user/{id}/profile', 'UserController@profile')->name('user.profile');
Route::put('/user/{id}/profile', 'UserController@doProfile')->name('user.doProfile');
Route::get('/user/{id}/chpass', 'UserController@chpass')->name('user.chpass');
Route::put('/user/{id}/chpass', 'UserController@doChpass')->name('user.doChpass');
Route::get('/user/{id}/foto', 'UserController@foto')->name('user.foto');
Route::put('/user/{id}/foto', 'UserController@doFoto')->name('user.doFoto');
Route::get('/user/{id}/chemail', 'UserController@chemail')->name('user.chemail');
Route::put('/user/{id}/chemail', 'UserController@doChemail')->name('user.doChemail');
Route::get('/user/create', 'UserController@create')->name('user.create');
Route::post('/user', 'UserController@store')->name('user.store');
Route::delete('/user/{id}', 'UserController@destroy')->name('user.destroy');

// resources
Route::resources([
	'/kost' => 'KostController',
]);
