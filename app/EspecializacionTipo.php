<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspecializacionTipo extends Model
{
    protected $table = 'especializacion_tipo';

    protected $fillable = [
        'nom_esp_type', 'activo'
    ];

}
