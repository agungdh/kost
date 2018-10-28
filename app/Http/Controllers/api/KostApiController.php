<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use DB;

class KostApiController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
    	$kosts = DB::table('v_kos')->get();

        return json_encode($kosts);
    }

}
