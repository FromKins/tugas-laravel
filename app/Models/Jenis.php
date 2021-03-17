<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
     protected $table = 'jenis';
     protected $dates = [
        'created_at',
        'updated_at'
    ];

      protected $fillable = [ 
        'id_jenis',
        'nama_jenis',
        'kode_jenis',
        'keterangan'
    ]; 
    //  public function karyawan()
    // {
    //     return $this->hasMany('App\Models\Karyawan', 'id_jabatan');
    // } 


}
