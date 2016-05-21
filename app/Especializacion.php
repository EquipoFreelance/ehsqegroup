<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especializacion extends Model
{
    protected $table = 'especializacion';

    protected $fillable = [
        'nom_esp', 'activo'
    ];

}
