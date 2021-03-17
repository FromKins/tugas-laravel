<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admins extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id_petugas','id_level', 'role_id', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //  public function karyawan() {
    //     return $this->belongsTo('App\Models\Karyawan', 'karyawan_id');
    // }

    public function role(){
        return $this->belongsTo('App\Models\Roles', 'role_id');
    }
    public function level(){
        return $this->belongsTo('App\Models\Level', 'id_level');
    }
}
