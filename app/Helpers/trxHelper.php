<?php
namespace App\Helpers;

use App\Transaksi;

class trxHelper {
	public static function changeStatus($id, $status) {
		$trx = Transaksi::find($id);
    	$trx->status = $status;
    	if ($status == 'a' || $status == 'd') {
    		if ($status == 'a') {
    			$kos = $trx->kos;
    			$kos->kamartersedia -= $trx->jumlah_kamar;
    			$kos->save();
    		}
    		$trx->waktu_validasi = date('Y-m-d H:i:s');
    	}
    	$trx->save();
	}
}
?>