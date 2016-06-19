<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioAuxiliar extends Model
{
  // Nombre de la tabla asociada
  protected $table = 'horario_auxiliar';

  // Campos activos
  protected $fillable = [
      'cod_horario',
      'cod_auxiliar',
      'activo'
  ];

  // Atributos con valores por defecto
  protected $attributes = array(
     'deleted' => 0,
  );

  /*public function horario()
  {
    return $this->belongsTo('App\Models\Horario', 'cod_horario');
  }*/

}
