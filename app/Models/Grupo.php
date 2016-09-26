<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupo';

    protected $fillable = [
        'cod_sede',
        'cod_modalidad',
        'cod_esp_tipo',
        'cod_esp',
        'nom_grupo',
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

    protected $visible = ['nom_grupo', 'id', 'name', 'cod_sede', 'cod_modalidad', 'cod_esp_tipo', 'cod_esp', 'students'];

    /**
     * Pertenece a una Sede
     */
    public function sede()
    {
        return $this->belongsTo('App\Models\SedeLocal', 'cod_sede', 'id');
    }

    /**
     * Pertenece a una modalidad
     */
    public function modalidad()
    {
        return $this->belongsTo('App\Models\Modalidad', 'cod_modalidad', 'id');
    }

    /**
    * Pertenece a una tipo de Especialización
    */
    public function tipo_especializacion()
    {
        return $this->belongsTo('App\Models\EspecializacionTipo', 'cod_esp_tipo', 'id');
    }

    /*
    * Pertener a una Especialización
    */
    public function especializacion(){
        return $this->belongsTo('App\Models\Especializacion', 'cod_esp');
    }

    /* Grupo - Matriculas */
    public function group_enrollment(){

        return $this->hasMany('App\Models\GroupEnrollment', 'cod_grupo', 'id');

    }

    /* Grupo - Horario */
    public function group_horary(){

        return $this->hasMany('App\Models\Horario', 'cod_grupo', 'id');

    }
}
