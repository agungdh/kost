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

Route::resources([
	'/admin/user' => 'UserController',
]);

// Route::get('/createadmin', function() {
// 	DB::table('user')->where('username', 'admin')->delete();
// 	DB::table('user')->insert(['username' => 'admin', 'password' => Hash::make('admin'), 'nama' => 'Administrator', 'level' => 'a']);

// 	return redirect()->route('login');
// });

// Route::get('/test/randomkey', function() {
// 	echo bin2hex(random_bytes(64));
// });

// Route::get('/test/json', function() {
// 	$json = 
// 		'{
// 		  "results": [
// 		    {
// 		      "gender": "male",
// 		      "name": {
// 		        "title": "mr",
// 		        "first": "rolf",
// 		        "last": "hegdal"
// 		      },
// 		      "location": {
// 		        "street": "ljan terrasse 346",
// 		        "city": "vear",
// 		        "state": "rogaland",
// 		        "postcode": "3095",
// 		        "coordinates": {
// 		          "latitude": "54.8646",
// 		          "longitude": "-97.3136"
// 		        },
// 		        "timezone": {
// 		          "offset": "-10:00",
// 		          "description": "Hawaii"
// 		        }
// 		      },
// 		      "email": "rolf.hegdal@example.com",
// 		      "login": {
// 		        "uuid": "c4168eac-84b8-46ea-b735-c9da9bfb97fd",
// 		        "username": "bluefrog786",
// 		        "password": "ingrid",
// 		        "salt": "GtRFz4NE",
// 		        "md5": "5c581c5748fc8c35bd7f16eac9efbb55",
// 		        "sha1": "c3feb8887abed9ec1561b9aa2c9f58de21d1d3d9",
// 		        "sha256": "684c478a98b43f1ef1703b35b8bbf61b27dbc93d52acd515e141e97e04447712"
// 		      },
// 		      "dob": {
// 		        "date": "1975-11-12T06:34:44Z",
// 		        "age": 42
// 		      },
// 		      "registered": {
// 		        "date": "2015-11-04T22:09:36Z",
// 		        "age": 2
// 		      },
// 		      "phone": "66976498",
// 		      "cell": "40652479",
// 		      "id": {
// 		        "name": "FN",
// 		        "value": "12117533881"
// 		      },
// 		      "picture": {
// 		        "large": "https://randomuser.me/api/portraits/men/65.jpg",
// 		        "medium": "https://randomuser.me/api/portraits/med/men/65.jpg",
// 		        "thumbnail": "https://randomuser.me/api/portraits/thumb/men/65.jpg"
// 		      },
// 		      "nat": "NO"
// 		    }
// 		  ],
// 		  "info": {
// 		    "seed": "2da87e9305069f1d",
// 		    "results": 1,
// 		    "page": 1,
// 		    "version": "1.2"
// 		  }
// 		}'
// 	;

// 	dd([json_decode($json), json_decode($json, TRUE)]);
// });

Route::get('/test/mail', 'AuthController@doForgetPassword');