<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterFasilitas extends Model
{
    protected $table = 'master_fasilitas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
    						'fasilitas',
    					];
}
