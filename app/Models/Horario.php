<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
  // Nombre de la tabla asociada
  protected $table = 'horario';

  // Campos activos
  protected $fillable = [
      'fec_inicio',
      'fe_fin',
      'h_inicio',
      'h_fin',
      'num_horas',
      'cod_sede',
      'cod_local',
      'activo'
  ];

  // Atributos con valores por defecto
  protected $attributes = array(
     'deleted' => 0,
  );

}
