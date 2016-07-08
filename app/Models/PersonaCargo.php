<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaCargo extends Model
{
  protected $table = 'persona_cargo';

  protected $fillable = [
    'cod_persona',
    'cod_personal_cargo_tipo',
    'deleted',
    'activo'
  ];

  protected $attributes = array(
    'deleted' => 0,
  );

  // Un cargo pertenece a muchas personas
  public function persona()
  {
    return $this->hasMany('App\Models\Persona', 'cod_persona', 'id');
  }

}
