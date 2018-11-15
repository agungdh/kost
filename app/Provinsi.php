<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'prop';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function kabupatens()
    {
        return $this->hasMany('App\Kabupaten', 'prop_id');
    }
}
