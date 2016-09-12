<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupStudent extends Model
{
    protected $table = 'grupo_alumno';

    public function grupo()
    {
        return $this->belongsTo('App\Models\Grupo', 'cod_grupo', 'id');
    }
}
