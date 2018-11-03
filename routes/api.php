<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/test', 'api\KostApiController@index');

// public ajaxs
Route::post('/publicajax/prop', 'api\PublicAjaxController@prop');
Route::post('/publicajax/kab', 'api\PublicAjaxController@kab');
Route::post('/publicajax/kec', 'api\PublicAjaxController@kec');
Route::post('/publicajax/desa', 'api\PublicAjaxController@desa');
Route::post('/publicajax/getdatadaerahbydesa', 'api\PublicAjaxController@getDataDaerahByDesa');
