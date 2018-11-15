<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Hash;
use Storage;
use App\User;
use App\Kos;
use App\Foto;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('CustomAuth:a');
    }

    public function index()
    {
        $users = User::where('id', '<>',session('id'))->get();

        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:user,email',
            'password' => 'required|confirmed',
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'level' => 'required',
        ]);

        $data = $request->only('email', 'nama', 'alamat', 'nohp', 'level');
        $data['password'] = Hash::make($request->password);
        $data['verified_nohp'] = 'y';
        $data['active'] = 'y';

        User::create($data);

        return redirect()->route('user.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Tambah User Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    public function destroy($id)
    {
        $kosts = Kos::where('id_user', $id)->get();

        foreach ($kosts as $kos) {
            foreach ($kos->fotos as $item) {
                if (file_exists(storage_path('app/public/foto/kos/' . $item->id))) {
                    unlink(storage_path('app/public/foto/kos/' . $item->id));
                }
            }
            Foto::where('id_kos', $kos->id)->delete();
        }

        Kos::where('id_user', $id)->delete();

        if (file_exists(storage_path('app/public/profilephoto/' . $id))) {
            unlink(storage_path('app/public/profilephoto/' . $id));
        }

        User::destroy($id);

        return redirect()->route('user.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Hapus User Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    public function profile($id)
    {
        $user = User::find($id);

        return view('backend.user.profile', compact('user'));
    }

    public function doProfile(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'active' => 'required',
            'verified_nohp' => 'required',
        ]);

        $user = $request->only('nama', 'alamat', 'nohp', 'active', 'verified_nohp');

        User::where('id', $id)->update($user);

        return redirect()->route('user.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Profil Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    public function chpass($id)
    {
        $user = User::find($id);
     
        return view('backend.user.chpass', compact('user'));
    }

    public function doChpass(Request $request, $id)
    {
        $request->validate([
            'newpassword' => 'required|confirmed',
        ]);

        User::where('id', $id)->update(['password' => Hash::make($request->newpassword)]);

        return redirect()->route('user.index')->with('alert', [
                    'title' => 'BERHASIL !!!',
                    'message' => 'Ubah Password Berhasil !!!',
                    'class' => 'success',
                ]);
    }

    public function foto($id)
    {
        $user = User::find($id);
        
        return view('backend.user.foto', compact(['user']));
    }

    public function doFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|max:1024|image',
        ]);

        Storage::putFileAs('public/profilephoto', $request->file('foto'), $id);

        return redirect()->route('user.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Foto Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    public function chemail($id)
    {
        $user = User::find($id);

        return view('backend.user.chemail', compact(['user']));
    }

    public function doChemail(Request $request, $id)
    {
        $request->validate([
            'newemail' => 'required|email|unique:user,email',
        ]);

        User::where('id', $id)->update([
                                                        'email' => $request->newemail,
                                                    ]);

        return redirect()->route('user.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Email Berhasil !!!',
                        'class' => 'success',
                    ]);
    }
}
