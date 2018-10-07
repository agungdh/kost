<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class KostController extends Controller
{
    public function __construct()
    {
        $this->middleware('CustomAuth:a,p');
    }

    public function index()
    {
        $kosts = DB::table('v_kos')->where('id_user', session('id'))->get();

        return view('backend.kost.index', compact('kosts'));
    }

    public function create()
    {
        return view('backend.kost.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'prop' => 'required',
            'kab' => 'required',
            'kec' => 'required',
            'desa' => 'required',
            'tipe' => 'required',
            'bulanan' => 'required_without:tahunan',
            'tahunan' => 'required_without:bulanan',
            'kamartersedia' => 'required|numeric',
            'deskripsi' => 'required',
        ]);

        $data = $request->only('nama', 'alamat', 'tipe', 'bulanan', 'tahunan', 'kamartersedia', 'deskripsi');
        $data['id_desa'] = $request->desa;
        $data['id_user'] = session('id');

        DB::table('kos')->insert($data);

        return redirect()->route('kost.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Tambah Data Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
