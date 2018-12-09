<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;

class PesananUser extends Controller
{
    function index() {
    	$transaksi = Transaksi::where('user_id_pencari_kos', session('id'))->get();

    	return view('backend.pesanan.user.index', compact(['transaksi']));
    }
}
