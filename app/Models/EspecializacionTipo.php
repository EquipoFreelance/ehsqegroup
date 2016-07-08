<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspecializacionTipo extends Model
{
    protected $table = 'especializacion_tipo';

    protected $attributes = array(
       'deleted' => 0,
    );

    protected $fillable = [
        'nom_esp_type', 'activo'
    ];

    // Un telefono pertenece a una persona
    public function especializacion()
    {
      return $this->hasMany('App\Models\Especializacion', 'cod_esp_tipo', 'id');
    }

}
