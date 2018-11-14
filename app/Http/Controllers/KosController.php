<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Storage;

class KosController extends Controller
{
    public function __construct()
    {
        $this->middleware('CustomAuth:a');
    }

    public function index()
    {
    	$kosts = DB::table('v_kos')->get();

        return view('backend.kos.index', compact('kosts'))->with('pustaka', new \agungdh\Pustaka());
    }

    public function mediaLibrary($id)
    {
        $kos = DB::table('kos')->where('id', $id)->first();
        $fotos = DB::table('foto')->where('id_kos', $id)->orderBy('id', 'asc')->get();

        return view('backend.kos.medialibrary', compact('id', 'kos', 'fotos'));
    }

    public function edit($id)
    {
        $kost = DB::table('kos')->where('id', $id)->first();

        $desa = DB::table('desa')->where('id', $kost->id_desa)->first();
        $kec = DB::table('kec')->where('id', $desa->kec_id)->first();
        $kab = DB::table('kab')->where('id', $kec->kab_id)->first();
        $prop = DB::table('prop')->where('id', $kab->prop_id)->first();

        $kost->prop = $prop->id;
        $kost->kab = $kab->id;
        $kost->kec = $kec->id;
        $kost->desa = $desa->id;

        $kost->lat = $kost->latitude;
        $kost->lng = $kost->longitude;

        return view('backend.kos.edit', compact('kost'));
    }

    public function update(Request $request, $id)
    {        
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'prop' => 'required',
            'kab' => 'required',
            'kec' => 'required',
            'desa' => 'required',
            'tipe' => 'required',
            'bulanan' => 'required_without:tahunan|numeric',
            'tahunan' => 'required_without:bulanan|numeric',
            'kamartersedia' => 'required|numeric',
            'deskripsi' => 'required',
        ]);

        $data = $request->only('nama', 'alamat', 'tipe', 'bulanan', 'tahunan', 'kamartersedia', 'deskripsi');
        $data['id_desa'] = $request->desa;
        $data['latitude'] = $request->lat;
        $data['longitude'] = $request->lng;

        DB::table('kos')->where('id', $id)->update($data);

        return redirect()->route('kos.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Data Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    public function destroy($id)
    {        
        $foto = DB::table('foto')
                        ->where('id_kos', $id)
                        ->get();

        foreach ($foto as $item) {
            if (file_exists(storage_path('app/public/foto/kos/' . $item->id))) {
                unlink(storage_path('app/public/foto/kos/' . $item->id));
            }
        }

        DB::table('foto')
                ->where('id_kos', $id)
                ->delete();

        DB::table('kos')
                ->where('id', $id)
                ->delete();

        return redirect()->route('kos.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Hapus Data Berhasil !!!',
                        'class' => 'success',
                    ]);
    }
}
