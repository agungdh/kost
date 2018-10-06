<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
        dd(session()->all());
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
    	$user = DB::table('user')
                        ->where('id', session('id'))
                        ->first();

        
    }

    public function doChpass(Request $request)
    {
    	$user = DB::table('user')
                        ->where('id', session('id'))
                        ->first();

        
    }

    public function foto()
    {
        $user = DB::table('user')
                        ->where('id', session('id'))
                        ->first();

        
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
