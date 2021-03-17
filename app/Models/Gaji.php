<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
     protected $table = 'gaji';
      protected $fillable = [ 
        'karyawan_id',
        'gaji',
        'hari',
        'jam',
        'totalgaji'
    ]; 
     public function karyawan()
    {
        return $this->hasMany('App\Models\Karyawan', 'karyawan_id');
    }

}
