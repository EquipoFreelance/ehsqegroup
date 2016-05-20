<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEspecialidad extends Model
{
    protected $table = 'especialidad_tipo';

    protected $fillable = [
        'nom_esp_type', 'activo'
    ];

}
