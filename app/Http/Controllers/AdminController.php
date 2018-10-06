<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('CustomAuth:a,p');
	}

	public function dashboard()
	{   
        return view('template.backend.dashboard');
    }

    public function profile()
    {
        $user = DB::table('user')
                        ->where('id', session('id'))
                        ->first();

        return view('template.backend.profile', compact('user'));
    }

    public function doProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
        ]);

        $user = $request->only('nama', 'alamat', 'nohp');

        DB::table('user')
                ->where('id', session('id'))
                ->update($user);

        session($user);

        return redirect()->route('dashboard');
    }

    public function chpass()
    {
        return view('template.backend.chpass');
    }

    public function doChpass(Request $request)
    {
    	$request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|confirmed',
        ]);

        $user = DB::table('user')->where('id', session('id'))->first();

        if (Hash::check($request->oldpassword, $user->password)) {
            DB::table('user')->where('id', session('id'))->update(['password' => Hash::make($request->newpassword)]);

            return redirect()->route('dashboard');
        } 

        return redirect()->route('chpass')->with('alert', [
                        'title' => 'ERROR !!!',
                        'message' => 'Password Salah !!!',
                        'class' => 'error',
                    ]);
    }

    public function foto()
    {
        return view('template.backend.foto');
    }

    public function doFoto(Request $request)
    {
        $user = DB::table('user')
                        ->where('id', session('id'))
                        ->first();

        
    }

    public function chemail()
    {
        $user = DB::table('user')
                        ->where('id', session('id'))
                        ->first();

        
    }

    public function doChemail(Request $request)
    {
        $user = DB::table('user')
                        ->where('id', session('id'))
                        ->first();

        
    }
}
