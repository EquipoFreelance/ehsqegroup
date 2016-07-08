<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaTelefono extends Model
{
    protected $table = 'persona_telefono';

    public $timestamps = false;

    protected $fillable = [
      'cod_persona',
      'telefono'
    ];

    // Un telefono pertenece a una persona
    public function persona()
    {
      return $this->hasMany('App\Models\Persona', 'cod_persona', 'id');
    }

}
