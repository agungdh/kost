<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use DB;

class KostApiController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
    	$kosts = DB::table('v_kos')->get();
        $requestData = $request->all();
        $requestHeader = [$request->header('username'), $request->header('password')];

        return json_encode([$kosts, $requestData, $requestHeader]);
    }

}
