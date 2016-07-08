<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especializacion extends Model
{
    // Nombre de la tabla asociada
    protected $table = 'especializacion';

    // Campos activos
    protected $attributes = array(
       'deleted' => 0,
    );

    // Atributos con valores por defecto
    protected $fillable = [
        'nom_esp', 'activo'
    ];

    // Una especializacion pertenece a un tipo de especializacion
    public function esptipo(){
      return $this->belongsTo('App\Models\EspecializacionTipo', 'cod_esp_tipo');
    }

    // Una especializacion tiene muchos
    public function grupos(){
        return $this->hasMany('App\Models\Grupo', 'cod_esp', 'id');
    }

    // Una especialicion pertenece a un tipo de modalidad
    public function modalidad(){
        return $this->belongsTo('App\Models\Modalidad', 'cod_mod');
    }

}
