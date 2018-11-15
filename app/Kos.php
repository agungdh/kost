<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    protected $table = 'kos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
    						'id_user',
    						'nama',
    						'alamat',
    						'id_desa',
    						'tipe',
    						'bulanan',
    						'tahunan',
    						'deskripsi',
    						'kamartersedia',
    						'latitude',
    						'longitude',
    						'verified_alamat',
    					];

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
}
