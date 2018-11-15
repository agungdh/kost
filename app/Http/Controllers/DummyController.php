<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\Kelurahan;

class DummyController extends Controller
{
    var $httpMethod;

    public function __construct(Request $request) {
        $this->httpMethod = $request->method();
    }

    public function testModelProvinsi($id)
    {
        $provinsi = Provinsi::find($id);

        return view('dummy.testmodelprovinsi', compact('provinsi'));
    }

    public function testModelKabupaten($id)
    {
        $kabupaten = Kabupaten::find($id);
        
        return view('dummy.testmodelkabupaten', compact('kabupaten'));
    }

    public function testModelKecamatan($id)
    {
        $kecamatan = Kecamatan::find($id);

        return view('dummy.testmodelkecamatan', compact('kecamatan'));
    }

    public function testModelKelurahan($id)
    {
        $kelurahan = Kelurahan::find($id);

        return view('dummy.testmodelkelurahan', compact('kelurahan'));
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
