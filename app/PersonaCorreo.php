<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonaCorreo extends Model
{
  protected $table = 'persona_correo';

  protected $fillable = [
    'cod_persona',
    'correo',
    'deleted',
    'activo'
  ];

  protected $attributes = array(
    'deleted' => 0,
  );

  // Un correo pertenece a una persona
  public function persona()
  {
    return $this->hasMany('App\Persona', 'cod_persona', 'id');
  }

}
