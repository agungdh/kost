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
        $provinsis_raw = DB::table('prop')->get();

        $provinsis = [];
        foreach ($provinsis_raw as $value) {
            $provinsis[$value->id] = $value->nama_prop; 
        }

        return view('backend.kost.create', compact('provinsis'));
    }

    public function store(Request $request)
    {
        //
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
