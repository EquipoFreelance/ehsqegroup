<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{

    protected $table = 'docente';

    protected $fillable = [
        'cod_persona',
        'activo'
    ];

    protected $attributes = array(
       'deleted' => 0,
    );

    // Un Docente pertence a un persona
    public function persona()
    {
      return $this->belongsTo('App\Persona', 'cod_persona');
    }

    // Un Docente puede tener muchos horarios
    public function horario()
    {
      return $this->hasMany('App\Models\Horario', 'cod_docente');
    }

    public function addHorarios()
    {
        return $this->belongsToMany('App\Models\Horario', 'horario_docente', 'cod_docente', 'cod_horario')->withTimestamps();
    }




}
