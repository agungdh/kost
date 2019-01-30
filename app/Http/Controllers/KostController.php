<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Storage;
use App\Kos;
use App\Foto;

class KostController extends Controller
{
    public function __construct()
    {
        $this->middleware('CustomAuth:p');
    }

    public function index()
    {  
        $kosts = Kos::where('id_user', session('id'))->get();

        return view('backend.kost.index', compact('kosts'))->with('pustaka', new \agungdh\Pustaka());
    }

    public function create()
    {
        return view('backend.kost.create');
    }

    public function store(Request $request)
    {
        if($request->fasilitas) {
            dd($request->fasilitas);
        } else {
            die("gak ada fasilitas");
        }
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
        $data['id_user'] = session('id');
        $data['latitude'] = $request->lat;
        $data['longitude'] = $request->lng;
        $data['verified_alamat'] = 'n';

        $kos = Kos::create($data);

        Foto::insert([
                        [
                            'id_kos' => $kos->id,
                        ],
                        [
                            'id_kos' => $kos->id,
                        ],
                        [
                            'id_kos' => $kos->id,
                        ],
                        [
                            'id_kos' => $kos->id,
                        ],
                        [
                            'id_kos' => $kos->id,
                        ],
                        [
                            'id_kos' => $kos->id,
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
        if (!$this->checkAuthorization($id, session('id'))) {
            return redirect()->route('kost.index');
        }

        return redirect()->route('kost.edit', $id);
    }

    public function edit($id)
    {
        if (!$this->checkAuthorization($id, session('id'))) {
            return redirect()->route('kost.index');
        }

        $kost = Kos::find($id);
        
        $kost->desa = $kost->kelurahan->id;
        $kost->kec = $kost->kelurahan->kecamatan->id;
        $kost->kab = $kost->kelurahan->kecamatan->kabupaten->id;
        $kost->prop = $kost->kelurahan->kecamatan->kabupaten->provinsi->id;

        $kost->lat = $kost->latitude;
        $kost->lng = $kost->longitude;

        return view('backend.kost.edit', compact('kost'));
    }

    public function update(Request $request, $id)
    {
        if (!$this->checkAuthorization($id, session('id'))) {
            return redirect()->route('kost.index');
        }
        
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
        $data['id_user'] = session('id');
        $data['latitude'] = $request->lat;
        $data['longitude'] = $request->lng;

        $oldKost = Kos::find($id);

        if(    $oldKost->alamat != $data['alamat']
            || $oldKost->id_desa != $data['id_desa']
            || $oldKost->latitude !== $data['latitude']
            || $oldKost->longitude !== $data['longitude']) 
        {
            $data['verified_alamat'] = 'n';
        }

        Kos::where('id', $id)->update($data);

        return redirect()->route('kost.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Data Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    public function destroy($id)
    {
        if (!$this->checkAuthorization($id, session('id'))) {
            return redirect()->route('kost.index');
        }
        $kost = Kos::find($id);

        $foto = Foto::where('id_kos', $id)->get();

        foreach ($foto as $item) {
            if (file_exists(storage_path('app/public/foto/kos/' . $item->id))) {
                unlink(storage_path('app/public/foto/kos/' . $item->id));
            }
        }

        Foto::where('id_kos', $id)->delete();
        $kost->delete();

        return redirect()->route('kost.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Hapus Data Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    public function mediaLibrary($id)
    {
        if (!$this->checkAuthorization($id, session('id'))) {
            return redirect()->route('kost.index');
        }
        
        $kos = Kos::find($id);
        $fotos = Foto::where('id_kos', $id)->orderBy('id', 'asc')->get();

        return view('backend.kost.medialibrary', compact('id', 'kos', 'fotos'));
    }

    public function doMediaLibrary(Request $request, $id)
    {
        if (!$this->checkAuthorization($id, session('id'))) {
            return redirect()->route('kost.index');
        }
        
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

            Foto::where('id', $photoId)->update(['deskripsi' => $request->input('deskripsi_' . $i)]);
        }

        return redirect()->route('kost.mediaLibrary', $id)->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Update Media Library Berhasil !!!',
                        'class' => 'success',
                    ]);        
    }

    public function doDeletePhoto(Request $request)
    {
        $id_kos = Foto::where('id', $request->id)->first()->id_kos;
        
        if (file_exists(storage_path('app/public/foto/kos/' . $request->id))) {
            unlink(storage_path('app/public/foto/kos/' . $request->id));
        }

        return redirect()->route('kost.mediaLibrary', $id_kos)->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Hapus Foto Berhasil !!!',
                        'class' => 'success',
                    ]); 
    }

    private function checkAuthorization($id_kos, $id_user)
    {
        return Kos::where('id_user', $id_user)->where('id', $id_kos)->first();
    }
}
