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
        'nombre', 'nom_corto', 'descripcion', 'cod_esp'
    ];

    // Relación de uno a muchos
    public function especializacion(){
      return $this->belongsTo('App\Models\Especializacion', 'cod_esp');
    }

    // Un Modulo puede estar en muchos horarios
    public function horario()
    {
      return $this->hasMany('App\Models\Horario', 'cod_mod');
    }

}
