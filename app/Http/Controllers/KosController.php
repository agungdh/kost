<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Storage;
use agungdh\Pustaka;

class KosController extends Controller
{
    public $pustaka;

    public function __construct()
    {
        $this->middleware('CustomAuth:a');

        $this->pustaka = new Pustaka();
    }

    public function index()
    {
    	$kosts = DB::table('v_kos')->get();

        return view('backend.kos.index', compact('kosts'))->with('pustaka', $this->pustaka);
    }

    public function mediaLibrary($id)
    {
        $kos = DB::table('kos')->where('id', $id)->first();
        $fotos = DB::table('foto')->where('id_kos', $id)->orderBy('id', 'asc')->get();

        return view('backend.kos.medialibrary', compact('id', 'kos', 'fotos'));
    }
}
