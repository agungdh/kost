<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use DB;

class PublicAjaxController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('cors');   
    }

    public function prop()
    {
        $props = DB::table('prop')->get();

        echo json_encode($props);
    }

    public function kab(Request $request)
    {
        $kabs = DB::table('kab')->where('prop_id', $request->prop)->get();

        echo json_encode($kabs);
    }

    public function kec(Request $request)
    {
        $kecs = DB::table('kec')->where('kab_id', $request->kab)->get();

        echo json_encode($kecs);
    }

    public function desa(Request $request)
    {
        $desas = DB::table('desa')->where('kec_id', $request->kec)->get();

        echo json_encode($desas);
    }

    public function getDataDaerahByDesa(Request $request)
    {
        $data = DB::table('v_daerah')->where('desa_id', $request->desa)->first();

        echo json_encode($data);
    }

}
