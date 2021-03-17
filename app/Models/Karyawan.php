<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
     protected $table = 'karyawan';
     protected $dates = [
        'created_at',
        'updated_at'
    ];

      protected $fillable = [ 
        'nik',
        'nama',
        'jk',
        'tempat_lahir',
        'tanggal_lahir',
        'id_jabatan',
        'agama',
        'no_tlp',
        'alamat'
    ]; 

     public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan', 'id_jabatan');
    } 

    public function gaji()
    {
        return $this->belongsTo('App\Models\Gaji', 'nama');
    } 


}
