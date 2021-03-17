<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
     protected $table = 'pegawai';
     protected $dates = [
        'created_at',
        'updated_at'
    ];

      protected $fillable = [ 
        'id_pegawai',
        'nama_pegawai',
        'nik',
        'alamat'
    ]; 
    //  public function karyawan()
    // {
    //     return $this->hasMany('App\Models\Karyawan', 'id_jabatan');
    // } 


}
