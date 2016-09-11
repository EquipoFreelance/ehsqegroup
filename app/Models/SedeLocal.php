<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SedeLocal extends Model
{
    protected $table = 'sede_local';

    protected $fillable = [
        'nom_local',
        'direccion',
        'cod_sede',
        'activo'
    ];

    protected $attributes = array(
       'deleted' => 0,
    );

    protected $visible = ['id', 'nom_local', 'cod_sede'];

    /* Un local pertenece a una Sede */
    public function sede()
    {
        return $this->belongsTo('App\Models\Sede', 'cod_sede');
    }

    // Un Local puede estar en muchos horarios
    public function horario()
    {
      return $this->hasMany('App\Models\Horario', 'cod_local');
    }

}
