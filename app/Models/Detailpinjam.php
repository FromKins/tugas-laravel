<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detailpinjam extends Model
{
     protected $table = 'detail_pinjam';
     protected $dates = [
        'created_at',
        'updated_at'
    ];

      protected $fillable = [ 
        'id_detail_pinjam',
        'id_inventaris',
        'jumlah'
    ]; 
  public function inventaris()
    {
        return $this->belongsTo('App\Models\Inventaris', 'id_inventaris');
    } 

}
