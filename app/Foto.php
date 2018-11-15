<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
    						'id_kos',
    						'deskripsi',
    					];

    public function user()
    {
        return $this->belongsTo('App\Kos', 'id_kos');
    }
}
