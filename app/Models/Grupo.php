<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupo';

    protected $fillable = [
        'cod_modalidad',
        'cod_esp_tipo',
        'cod_esp',
        'nom_grupo',
        'cod_sede',
        'descripcion',
        'fe_inicio',
        'fe_fin',
        'num_min',
        'num_max',
        'activo'
    ];

    protected $attributes = array(
       'deleted' => 0,
    );

    /**
     * Pertenece a una Sede
     */
    public function sede()
    {
        return $this->belongsTo('App\Models\Sede', 'cod_sede');
    }

    /*
    * Pertener a una Especialización
    */
    public function especializacion(){
        return $this->belongsTo('App\Models\Especializacion', 'cod_esp');
    }

    public function addHorarios()
    {
        return $this->belongsToMany('App\Models\Horario', 'horario_grupo', 'cod_grupo', 'cod_horario')->withTimestamps();
    }

}
