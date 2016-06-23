<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    protected $table = 'taller';

    protected $fillable = [
        'nom_taller',
        'activo'
    ];

    protected $attributes = array(
       'deleted' => 0,
    );

}
