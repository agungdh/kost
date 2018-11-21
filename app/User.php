<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
                            'email',
                            'password',
                            'nama',
                            'alamat',
                            'nohp',
                            'level',
                            'active',
                            'token',
                            'temp_email',
                            'verified_nohp',
    					];

    public function kosses()
    {
        return $this->hasMany('App\Kos', 'id_user');
    }

    public function transaksiPencariKosses()
    {
        return $this->hasMany('App\Transaksi', 'user_id_pencari_kos');
    }

    public function transaksiValidators()
    {
        return $this->hasMany('App\Transaksi', 'user_id_validasi');
    }
}
