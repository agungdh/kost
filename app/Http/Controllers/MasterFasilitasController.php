<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterFasilitas;

class MasterFasilitasController extends Controller
{
    public function __construct()
    {
        $this->middleware('CustomAuth:a');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masterFasilitas = MasterFasilitas::all();

        return view('backend.masterfasilitas.index', compact('masterFasilitas'))->with('pustaka', new \agungdh\Pustaka());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.masterfasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas' => 'required',
        ]);

        $data = $request->only('fasilitas');
        
        MasterFasilitas::create($data);

        return redirect()->route('masterfasilitas.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Tambah Master Fasilitas Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $masterfasilitas = MasterFasilitas::find($id);

        return view('backend.masterfasilitas.edit', compact('masterfasilitas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fasilitas' => 'required',
        ]);

        $data = $request->only('fasilitas');

        MasterFasilitas::where('id', $id)->update($data);

        return redirect()->route('masterfasilitas.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Ubah Data Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MasterFasilitas::destroy($id);

        return redirect()->route('masterfasilitas.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Hapus Master Fasilitas Berhasil !!!',
                        'class' => 'success',
                    ]);
    }
}
