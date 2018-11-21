<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
    						'user_id_pencari_kos',
    						'kos_id',
    						'waktu_transaksi',
    						'lama_kost',
    						'jenis_lama_kost',
    						'harga',
    						'waktu_validasi',
    						'user_id_validasi',
    					];

	public function userPencariKos()
    {
        return $this->belongsTo('App\User', 'user_id_pencari_kos');
    }    					

	public function userValidator()
    {
        return $this->belongsTo('App\User', 'user_id_validasi');
    }    					

	public function kos()
    {
        return $this->belongsTo('App\Kos', 'kos_id');
    }    					
}
