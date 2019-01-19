<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Storage;
use App\Helpers\trxHelper;
use App\Helpers\notifMail;

class PesananUser extends Controller
{
    public function __construct()
    {
        $this->middleware('CustomAuth:u');
    }

    function index() {
    	$transaksis = Transaksi::where('user_id_pencari_kos', session('id'))->get();

    	return view('backend.pesanan.user.index', compact(['transaksis']))->with('pustaka', new \agungdh\Pustaka());
    }

    function cancel($id) {
        trxHelper::changeStatus($id, 'c');

        notifMail::userCancelTransaksi($id);

    	return redirect()->route('pesananUser.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Pembatalan Pesanan Berhasil !!!',
                        'class' => 'success',
                    ]);
    }

    function upBukti(Request $r, $id) {
        $r->validate([
            'berkas__' . $id => 'required|max:4096|image'
        ]);
        $trx = Transaksi::find($id);
        Storage::putFileAs('public/foto/bukti', $r->file('berkas__' . $id), $id);
        $trx->waktu_upload_bukti = date('Y-m-d H:i:s');
        $trx->save();

        notifMail::userUploadBukti($trx->id);
        
        return redirect()->route('pesananUser.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Upload Foto Berhasil !!!',
                        'class' => 'success',
                    ]);
    }
}
