<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'modulo';

    protected $attributes = array(
       'deleted' => 0,
    );

    protected $fillable = [
        'cod_modalidad',
        'cod_esp_tipo',
        'cod_esp',
        'nombre',
        'nom_corto',
        'descripcion',
        'activo'
    ];

    protected $visible = ['nombre', 'id', 'name'];

    // Relación de uno a muchos
    public function especializacion(){
      return $this->belongsTo('App\Models\Especializacion', 'cod_esp');
    }

    // Relación de uno a muchos
    public function tipo_especializacion(){
        return $this->belongsTo('App\Models\EspecializacionTipo', 'cod_esp_tipo');
    }

    // Relación de uno a muchos
    public function modalidad(){
        return $this->belongsTo('App\Models\Modalidad', 'cod_modalidad');
    }

    // Un Modulo puede estar en muchos horarios
    public function horario()
    {
        return $this->hasMany('App\Models\Horario', 'cod_mod');
    }

}
