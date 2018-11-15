<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kec';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function kabupaten()
    {
        return $this->belongsTo('App\Kabupaten', 'kab_id');
    }

    public function kelurahans()
    {
        return $this->hasMany('App\Kelurahan', 'kec_id');
    }
}
