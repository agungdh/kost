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
Route::get('/dashboard', 'MainController@dashboard')->name('dashboard');

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
Route::get('/publicajax/getdatadaerahbydesa/{id}', 'PublicAjaxController@getDataDaerahByDesa')->name('publicAjax.getDataDaerahByDesa');

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

Route::get('/kos', 'KosController@index')->name('kos.index');
Route::get('/kos/{id}/medialibrary', 'KosController@mediaLibrary')->name('kos.mediaLibrary');
Route::get('/kos/{id}/edit', 'KosController@edit')->name('kos.edit');
Route::put('/kos/{id}', 'KosController@update')->name('kos.update');
Route::delete('/kos/{id}', 'KosController@destroy')->name('kos.destroy');

// tambahan
Route::get('/tentangkami', 'MainController@tentangKami')->name('tentangKami');
Route::get('/hubungikami', 'MainController@hubungiKami')->name('hubungiKami');
Route::get('/metodepembayaran', 'MainController@metodePembayaran')->name('metodePembayaran');

// resources
Route::resources([
	'/kost' => 'KostController',
]);

// dump db
Route::get('/dumpdb', 'MainController@dumpDB')->name('dumpdb');

// dummy
Route::get('/dummy/temp/{id?}', 'DummyController@temp')->name('dummy.temp');
Route::get('/dummy/testmodelprovinsi/{id}', 'DummyController@testModelProvinsi')->name('dummy.testModelProvinsi');
Route::get('/dummy/testmodelkabupaten/{id}', 'DummyController@testModelKabupaten')->name('dummy.testModelKabupaten');
Route::get('/dummy/testmodelkecamatan/{id}', 'DummyController@testModelKecamatan')->name('dummy.testModelKecamatan');
Route::get('/dummy/testmodelkelurahan/{id}', 'DummyController@testModelKelurahan')->name('dummy.testModelKelurahan');
Route::get('/dummy/testxhr', 'DummyController@testXhr')->name('dummy.testXhr');
Route::any('/dummy/clienttestxhr', 'DummyController@clientTestXhr')->name('dummy.clientTestXhr');
Route::any('/dummy/generateqrcode', 'DummyController@generateQRCode')->name('dummy.generateQRCode');

// pemesanan
Route::get('/pesan/{id?}', 'MainController@pesan')->name('pesan');
Route::post('/pesan/{id}', 'MainController@doPesan')->name('doPesan');

// admin pesanan
Route::get('/pesanan', 'PesananAdmin@index')->name('pesananAdmin.index');
Route::put('/pesanan/{id}/action', 'PesananAdmin@acc')->name('pesananAdmin.terima');
Route::patch('/pesanan/{id}/action', 'PesananAdmin@dcc')->name('pesananAdmin.tolak');

// pemilik pesanan
Route::get('/pezanan', 'PesananPemilik@index')->name('pesananPemilik.index');
Route::put('/pezanan/{id}', 'PesananPemilik@do')->name('pesananPemilik.do');

// user pesanan
Route::get('/pecanan', 'PesananUser@index')->name('pesananUser.index');
Route::delete('/pecanan/{id}', 'PesananUser@cancel')->name('pesananUser.cancel');
Route::put('/pecanan/{id}', 'PesananUser@do')->name('pesananUser.do');
Route::post('/pecanan/{id}', 'PesananUser@upBukti')->name('pesananUser.upBukti');

// invoice
Route::get('{id}/invoice', 'MainController@invoice')->name('invoice');

// cancel transaksi > 1 hari
Route::get('cancellebihsehari', 'MainController@cancelLebihSehari')->name('cancelLebihSehari');