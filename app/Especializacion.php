<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especializacion extends Model
{
    protected $table = 'especializacion';

    protected $attributes = array(
       'deleted' => 0,
    );
    
    protected $fillable = [
        'nom_esp', 'activo'
    ];

}
