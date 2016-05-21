<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspecializacionTipo extends Model
{
    protected $table = 'especializacion_tipo';

    protected $attributes = array(
       'deleted' => 0,
    );
    
    protected $fillable = [
        'nom_esp_type', 'activo'
    ];

}
