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
        return view('backend.kost.index');
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
