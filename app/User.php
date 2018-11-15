<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
    						
    					];

    public function kosses()
    {
        return $this->hasMany('App\Kos', 'id_user');
    }
}
