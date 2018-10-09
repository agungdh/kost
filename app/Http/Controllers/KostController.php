<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Storage;
use agungdh\Pustaka;

class KostController extends Controller
{
    public $pustaka;

    public function __construct()
    {
        $this->middleware('CustomAuth:a,p');

        $this->pustaka = new Pustaka();
    }

    public function index()
    {
        $kosts = DB::table('v_kos')->where('id_user', session('id'))->get();

        return view('backend.kost.index', compact('kosts'))->with('pustaka', $this->pustaka);
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
        $data['latitude'] = $request->lat;
        $data['longitude'] = $request->lng;

        $insertId = DB::table('kos')->insertGetId($data);

        DB::table('foto')->insert([
                                    [
                                        'id_kos' => $insertId,
                                    ],
                                    [
                                        'id_kos' => $insertId,
                                    ],
                                    [
                                        'id_kos' => $insertId,
                                    ],
                                    [
                                        'id_kos' => $insertId,
                                    ],
                                    [
                                        'id_kos' => $insertId,
                                    ],
                                    [
                                        'id_kos' => $insertId,
                                    ],
                                ]);

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

    public function mediaLibrary($id)
    {
        $kos = DB::table('kos')->where('id', $id)->first();
        $fotos = DB::table('foto')->where('id_kos', $id)->orderBy('id', 'asc')->get();

        return view('backend.kost.medialibrary', compact('id', 'kos', 'fotos'));
    }

    public function doMediaLibrary(Request $request, $id)
    {
        $rules = [];

        for ($i = 1; $i <= 6; $i++) { 
            $rules['foto_' . $i] = 'image|max:2048';
        }

        $request->validate($rules);

        for ($i = 1; $i <= 6; $i++) { 
            $photoId = $request->input($i);

            if ($request->file('foto_' . $i)) {
                Storage::putFileAs('public/foto/kos', $request->file('foto_' . $i), $photoId);
            }

            DB::table('foto')->where('id', $photoId)->update(['deskripsi' => $request->input('deskripsi_' . $i)]);
        }

        return redirect()->route('kost.mediaLibrary', $id)->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Update Media Library Berhasil !!!',
                        'class' => 'success',
                    ]);        
    }
}
