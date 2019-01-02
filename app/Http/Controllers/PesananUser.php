<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Storage;
use App\Helpers\trxHelper;

class PesananUser extends Controller
{
    function index() {
    	$transaksis = Transaksi::where('user_id_pencari_kos', session('id'))->get();

    	return view('backend.pesanan.user.index', compact(['transaksis']))->with('pustaka', new \agungdh\Pustaka());
    }

    function cancel($id) {
        trxHelper::changeStatus($id, 'c');

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

        return redirect()->route('pesananUser.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Upload Foto Berhasil !!!',
                        'class' => 'success',
                    ]);
    }
}
