<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class LoginController extends Controller
{
    public function login()
    {
    	return view('template/login');
    }

    public function doLogin(Request $request)
    {
    	$user = DB::table('user')
			    		->where('username', $request->username)
			    		->first();

		if ($user != null) {
			if (Hash::check($request->password, $user->password)) {
				session([
					'id_user' => $user->id_user,
					'username' => $user->username,
					'password' => $user->password,
					'nama' => $user->nama,
					'level' => $user->level,
					'login' => true
				]);

				return redirect()->route('root');
			}
		}

		return redirect()->route('login')->with('input', ['username' => $request->username, 'password' => $request->password]);
    }

    public function register()
    {
    	// 
    }

    public function doRegister()
    {
    	// 
    }

    public function account()
    {
    	// 
    }

    public function chAccount()
    {
    	// 
    }

    public function chpassAccount()
    {
    	// 
    }

    public function doLogout()
    {
    	session()->flush();

    	return redirect()->route('root');
    }

}
