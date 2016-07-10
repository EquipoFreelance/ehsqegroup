<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaTelefono extends Model
{
    protected $table = 'persona_telefono';

    public $timestamps = true;

    protected $fillable = [
      'cod_persona',
      'num_telefono'
    ];

    // Un telefono pertenece a una persona
    public function persona()
    {
      return $this->hasMany('App\Models\Persona', 'cod_persona', 'id');
    }

}
