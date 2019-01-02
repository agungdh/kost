<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Kos;

class PesananPemilik extends Controller
{
    public function __construct()
    {
        $this->middleware('CustomAuth:p');
    }

    function index() {
    	// Kos::join('transaksi', 'kos.id', '=', 'transaksi.kos_id')
    	$transaksis = Transaksi::join('kos', 'transaksi.kos_id', '=', 'kos.id')
    						->select('transaksi.*', 'transaksi.id as id_transaksi', 'kos.*', 'kos.id as id_kos')
    						->where('kos.id_user', session('id'))
    						->get();
		// dd($transaksis);
		
    	return view('backend.pesanan.pemilik.index', compact(['transaksis']))->with('pustaka', new \agungdh\Pustaka());
    }
}
