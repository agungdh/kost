<?php
namespace App\Helpers;

use App\Transaksi;

class trxHelper {
	public static function changeStatus($id, $status, $time = false) {
		$trx = Transaksi::find($id);
    	$trx->status = $status;
    	if ($time) {
    		$trx->waktu_validasi = date('Y-m-d H:i:s');
    	}
    	$trx->save();
	}
}
?>