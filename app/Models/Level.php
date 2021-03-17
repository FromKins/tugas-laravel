<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
     protected $table = 'level';
     protected $dates = [
        'created_at',
        'updated_at'
    ];

      protected $fillable = [ 
        'id_level',
        'nama_level'
    ]; 
    //  public function karyawan()
    // {
    //     return $this->hasMany('App\Models\Karyawan', 'id_jabatan');
    // } 


}
