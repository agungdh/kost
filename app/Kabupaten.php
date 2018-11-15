<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'kab';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function provinsi()
    {
        return $this->belongsTo('App\Provinsi', 'prop_id');
    }

    public function kecamatans()
    {
        return $this->hasMany('App\Kecamatan', 'kab_id');
    }
}
