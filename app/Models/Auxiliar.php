<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{

    protected $table = 'auxiliar';

    protected $fillable = [
        'cod_persona',
        'activo'
    ];

    // Un auxiliar pertence a un persona
    public function persona()
    {
      return $this->belongsTo('App\Persona', 'cod_persona');
    }
}
