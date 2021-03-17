<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
     protected $table = 'jabatan';
     protected $dates = [
        'created_at',
        'updated_at'
    ];

      protected $fillable = [ 
        'id_jabatan',
        'nama_jabatan',
        'created_by',
        'updated_by'
    ]; 
     public function karyawan()
    {
        return $this->hasMany('App\Models\Karyawan', 'id_jabatan');
    } 


}
