<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\trxHelper;

class PesananAdmin extends Controller
{
    function index() {
    	$transaksis = Transaksi::all();

    	return view('backend.pesanan.admin.index', compact(['transaksis']))->with('pustaka', new \agungdh\Pustaka());
    }

    function acc($id) {
    	trxHelper::changeStatus($id, 'a');

    	return redirect()->route('pesananAdmin.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Validasi Berhasil, Transaksi Telah Diterima !!!',
                        'class' => 'success',
                    ]);
    }

    function dcc($id) {
    	trxHelper::changeStatus($id, 'd');

    	return redirect()->route('pesananAdmin.index')->with('alert', [
                        'title' => 'BERHASIL !!!',
                        'message' => 'Validasi Berhasil, Transaksi Telah Ditolak !!!',
                        'class' => 'success',
                    ]);
    }

}
