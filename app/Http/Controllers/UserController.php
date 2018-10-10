<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('CustomAuth:a');
    }

    public function index()
    {
        $users = DB::table('user')->where('id', '<>',session('id'))->get();

        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {

    }

    public function destroy($id)
    {

    }

    public function profile($id)
    {
        $user = DB::table('user')
                        ->where('id', $id)
                        ->first();

        return view('backend.user.profile', compact('user'));
    }

    public function doProfile(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'level' => 'required',
            'active' => 'required',
        ]);

        $user = $request->only('nama', 'alamat', 'nohp', 'level', 'active');

        DB::table('user')
                ->where('id', $id)
                ->update($user);

        return redirect()->route('user.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Profil Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    public function chpass($id)
    {
        $user = DB::table('user')
                        ->where('id', $id)
                        ->first();

        return view('backend.user.chpass', compact('user'));
    }

    public function doChpass(Request $request, $id)
    {
        $request->validate([
            'newpassword' => 'required|confirmed',
        ]);

        DB::table('user')->where('id', $id)->update(['password' => Hash::make($request->newpassword)]);

        return redirect()->route('user.index')->with('alert', [
                    'title' => 'BERHASIL !!!',
                    'message' => 'Ubah Password Berhasil !!!',
                    'class' => 'success',
                ]);
    }

    public function foto($id)
    {
        return view('backend.user.foto');
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

    public function chemail($id)
    {
        return view('backend.user.chemail');
    }

    public function doChemail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:user,email',
        ]);

        $data['token'] = bin2hex(random_bytes(16));
        $data['temp_email'] = $request->email;

        DB::table('user')->where('id', session('id'))->update($data);

        $user = DB::table('user')->where('id', session('id'))->first();

        if (!Hash::check($request->oldpassword, $user->password)) {
            return redirect()->route('chemail')->with('alert', [
                        'title' => 'ERROR !!!',
                        'message' => 'Password salah !!!',
                        'class' => 'error',
                    ]);
        }

        $html = view('template.email.gantiemail', compact('user'))->with('token', $data['token'])->with('temp_email', $data['temp_email'])->render();

        $this->mail($data['temp_email'], 'Ubah email akun', $html);

        return redirect()->route('chemail')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Silakan cek email baru untuk konfirmasi',
                        'class' => 'success',
                    ]);
    }
}
