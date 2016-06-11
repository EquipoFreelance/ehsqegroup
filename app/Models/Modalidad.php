<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    // Nombre de la tabla asociada
    protected $table = 'modalidad';

    // Campos activos
    protected $fillable = [
        'nom_modalidad',
        'activo'
    ];

    // Atributos con valores por defecto
    protected $attributes = array(
       'deleted' => 0,
    );

    //Una Modalidad tiene de uno a muchas Especializaciones
    public function especializaciones()
    {
        return $this->hasMany('App\Especializacion', 'cod_mod', 'id');
    }

}
