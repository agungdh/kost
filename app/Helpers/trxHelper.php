<?php
namespace App\Helpers;

use App\Transaksi;

class trxHelper {
	public static function changeStatus($id, $status) {
		$trx = Transaksi::find($id);
    	$trx->status = $status;
    	$trx->save();
	}
}
?>