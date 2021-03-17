<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
     protected $table = 'peminjaman';
     protected $dates = [
        'created_at',
        'updated_at'
    ];

      protected $fillable = [ 
        'id_peminjaman',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status_peminjaman',
        'id_pegawai'
    ]; 
   public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai', 'id_pegawai');
    } 


}
