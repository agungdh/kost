<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class DummyController extends Controller
{
    var $httpMethod;

    public function __construct(Request $request) {
        $this->httpMethod = $request->method();
    }

    public function testxhr(Request $request)
    {
    	$obj = new \stdClass();

        $obj->httpMethod = $this->httpMethod;
        $obj->request = $request->all();

        echo json_encode($obj);
    }
}
