<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioDia extends Model
{
  // Nombre de la tabla asociada
  protected $table = 'horario_dia';

  // Campos activos
  protected $fillable = [
      'cod_horario',
      'cod_dia',
      'fecha',
      'activo'
  ];

  // Atributos con valores por defecto
  protected $attributes = array(
     'deleted' => 0,
  );

  public function horario()
  {
      return $this->belongsTo('App\Models\Horario', 'cod_horario');
  }

}
