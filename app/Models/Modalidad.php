<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    // Nombre de la tabla asociada
    protected $table = 'modalidad';

    // Campos activos
    protected $fillable = [
        'nom_mod',
        'activo'
    ];

    // Atributos con valores por defecto
    protected $attributes = array(
       'deleted' => 0,
    );

    protected $visible = ['nom_mod', 'id', 'name'];

    //Una Modalidad tiene de uno a muchas Especializaciones
    public function especializaciones()
    {
        return $this->hasMany('App\Models\Especializacion', 'cod_mod', 'id');
    }

}
