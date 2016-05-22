<?php

namespace App;

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
      return $this->belongsTo('App\Especializacion', 'cod_esp');
    }

}
