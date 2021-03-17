<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
     protected $table = 'inventaris';
     protected $dates = [
        'created_at',
        'updated_at'
    ];

      protected $fillable = [ 
        'id_inventaris',
        'nama',
        'kondisi',
        'keterangan',
        'jumlah',
        'id_jenis',
        'tanggal_register',
        'id_ruang',
        'kode_ruang',
        'id_petugas'
    ]; 
    public function jenis()
    {
        return $this->belongsTo('App\Models\Jenis', 'id_jenis');
    } 
    public function ruang()
    {
        return $this->belongsTo('App\Models\Ruang', 'id_ruang');
    } 
    


}
