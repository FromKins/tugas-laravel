<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{

    /**
     * @var string
     */
    protected $table = 'roles';
     protected $fillable = [ 
        'id',
        'nama'
    ]; 
}