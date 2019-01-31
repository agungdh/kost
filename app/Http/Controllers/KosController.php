<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Storage;

use App\Kos;
use App\Foto;
use App\FasilitasKos;

class KosController extends Controller
{
    public function __construct()
    {
        $this->middleware('CustomAuth:a');
    }

    public function index()
    {
        $kosts = Kos::all();

        return view('backend.kos.index', compact('kosts'))->with('pustaka', new \agungdh\Pustaka());
    }

    public function mediaLibrary($id)
    {
        $kos = Kos::find($id);
        $fotos = Foto::where('id_kos', $id)->orderBy('id', 'asc')->get();

        return view('backend.kos.medialibrary', compact('id', 'kos', 'fotos'));
    }

    public function edit($id)
    {
        $kost = Kos::find($id);
        
        $kost->desa = $kost->kelurahan->id;
        $kost->kec = $kost->kelurahan->kecamatan->id;
        $kost->kab = $kost->kelurahan->kecamatan->kabupaten->id;
        $kost->prop = $kost->kelurahan->kecamatan->kabupaten->provinsi->id;

        $kost->lat = $kost->latitude;
        $kost->lng = $kost->longitude;

        return view('backend.kos.edit', compact('kost'));
    }

    public function update(Request $request, $id)
    {        
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            // 'prop' => 'required',
            // 'kab' => 'required',
            'kec' => 'required',
            'desa' => 'required',
            'tipe' => 'required',
            // 'bulanan' => 'required_without:tahunan|numeric',
            'tahunan' => 'required|numeric',
            'kamartersedia' => 'required|numeric',
            'deskripsi' => 'required',
        ]);

        $data = $request->only('nama', 'alamat', 'tipe', 'tahunan', 'kamartersedia', 'deskripsi');
        $data['id_desa'] = $request->desa;
        $data['latitude'] = $request->lat;
        $data['longitude'] = $request->lng;

        Kos::where('id', $id)->update($data);

        FasilitasKos::where('id_kos', $id)->delete();
        if($request->fasilitas) {
            // dd($request->fasilitas);
            $fk = [];
            foreach($request->fasilitas as $f) {
                $fk[] = [
                    'id_kos' => $id,
                    'id_fasilitas' => $f,
                ];
            }
            // dd($fk);
            FasilitasKos::insert($fk);
        }

        return redirect()->route('kos.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Data Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    public function destroy($id)
    {        
        $foto = Foto::where('id_kos', $id)->get();

        foreach ($foto as $item) {
            if (file_exists(storage_path('app/public/foto/kos/' . $item->id))) {
                unlink(storage_path('app/public/foto/kos/' . $item->id));
            }
        }

        Foto::where('id_kos', $id)->delete();
        FasilitasKos::where('id_kos', $id)->delete();
        Kos::destroy($id);

        return redirect()->route('kos.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Hapus Data Berhasil !!!',
                        'class' => 'success',
                    ]);
    }
}
