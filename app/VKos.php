<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VKos extends Model
{
    protected $table = 'v_kos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function kelurahan()
    {
        return $this->belongsTo('App\Kelurahan', 'id_desa');
    }

    public function fotos()
    {
        return $this->hasMany('App\Foto', 'id_kos');
    }

    public function transaksis()
    {
        return $this->hasMany('App\Transaksi', 'kos_id');
    }

    public function fasilitasKos()
    {
        return $this->hasMany('App\FasilitasKos', 'id_kos');
    }
}
