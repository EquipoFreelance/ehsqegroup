<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{

    protected $table = 'administrativo';

    protected $fillable = [
        'cod_persona',
        'activo'
    ];

    // Un Administrativo pertenece a una persona
    public function persona()
    {
      return $this->belongsTo('App\Models\Persona', 'cod_persona');
    }

}
