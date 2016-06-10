<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especializacion extends Model
{
    protected $table = 'especializacion';

    protected $attributes = array(
       'deleted' => 0,
    );

    protected $fillable = [
        'nom_esp', 'activo'
    ];

    // Una especializacion pertenece a un tipo de especializacion
    public function esptipo(){
      return $this->belongsTo('App\EspecializacionTipo', 'cod_esp_tipo');
    }

    // Una especializacion tiene muchos
    public function grupos(){
        return $this->hasMany('App\Models\Grupo', 'cod_esp', 'id');
    }

}
