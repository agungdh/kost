<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Storage;

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

        return redirect()->route('profile')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Profil Berhasil !!!',
                        'class' => 'success',
                    ]);
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

            return redirect()->route('chpass')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Password Berhasil !!!',
                        'class' => 'success',
                    ]);
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
        $request->validate([
            'foto' => 'required|max:1024|image',
        ]);

        Storage::putFileAs('public/profilephoto', $request->file('foto'), session('id'));

        return redirect()->route('foto')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Foto Berhasil !!!',
                        'class' => 'success',
                    ]);
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
