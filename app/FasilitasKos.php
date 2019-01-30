<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FasilitasKos extends Model
{
    protected $table = 'fasilitas_kos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
    						'id_fasilitas',
    						'id_kos',
    					];

	public function masterFasilitas()
    {
        return $this->belongsTo('App\MasterFasilitas', 'id_fasilitas');
    }

	public function kos()
    {
        return $this->belongsTo('App\Kos', 'id_kos');
    }
}
