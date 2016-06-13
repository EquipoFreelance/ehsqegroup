<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioGrupo extends Model
{
  // Nombre de la tabla asociada
  protected $table = 'horario_grupo';

  // Campos activos
  protected $fillable = [
      'cod_grupo',
      'cod_horario',
      'activo'
  ];

}
