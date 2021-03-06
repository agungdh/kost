<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'desa';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function kecamatan()
    {
        return $this->belongsTo('App\Kecamatan', 'kec_id');
    }

    public function desas()
    {
        return $this->hasMany('App\Kos', 'id_desa');
    }
}
