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

    public function testXhr(Request $request)
    {
        $obj = new \stdClass();

        $obj->httpMethod = $this->httpMethod;
        $obj->request = $request->all();

        echo json_encode($obj);
    }

    public function clientTestXhr(Request $request)
    {
        return view('dummy.clienttestxhr');
    }

    public function generateQRCode()
    {
        $qrCode = new \Endroid\QrCode\QrCode('Life is too short to be generating QR codes');

        return response($qrCode->writeString())
            ->withHeaders([
                'Content-Type' => $qrCode->getContentType(),
            ]);
    }
}
