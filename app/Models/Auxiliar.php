<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{

    protected $table = 'auxiliar';

    protected $fillable = [
        'cod_persona',
        'activo'
    ];

    protected $attributes = array(
       'deleted' => 0,
    );

    // Un auxiliar pertence a un persona
    public function persona()
    {
      return $this->belongsTo('App\Persona', 'cod_persona');
    }

    public function addHorarios()
    {
        return $this->belongsToMany('App\Models\Horario', 'horario_auxiliar', 'cod_auxiliar', 'cod_horario')->withTimestamps()->withPivot('activo');
    }

}
