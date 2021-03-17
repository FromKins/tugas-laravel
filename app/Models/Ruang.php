<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
     protected $table = 'ruang';
     protected $dates = [
        'created_at',
        'updated_at'
    ];

      protected $fillable = [ 
        'id_ruang',
        'nama_ruang',
        'kode_ruang',
        'keterangan'
    ]; 
    //  public function karyawan()
    // {
    //     return $this->hasMany('App\Models\Karyawan', 'id_jabatan');
    // } 


}
