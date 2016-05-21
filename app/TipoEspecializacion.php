<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEspecializacion extends Model
{
    protected $table = 'especializacion_tipo';
    
    protected $fillable = [
        'nom_esp_type', 'activo'
    ];

}
