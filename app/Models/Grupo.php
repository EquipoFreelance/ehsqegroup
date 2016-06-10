<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupo';

    protected $fillable = [
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
        return $this->belongsTo('App\Especializacion', 'cod_esp');
    }

}
