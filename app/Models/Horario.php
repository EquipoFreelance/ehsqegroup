<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
  // Nombre de la tabla asociada
  protected $table = 'horario';

  // Campos activos
  protected $fillable = [
      'fec_inicio',
      'fec_fin',
      'h_inicio',
      'h_fin',
      'num_horas',
      'cod_sede',
      'cod_local',
      'cod_mod',
      'activo'
  ];

  // Atributos con valores por defecto
  protected $attributes = array(
     'deleted' => 0,
  );

  public function horariodias(){
      return $this->hasMany('App\Models\HorarioDia', 'cod_horario', 'id');
  }

  public function auxiliares()
  {
      return $this->belongsToMany('App\Models\Auxiliar', 'horario_auxiliar', 'cod_horario', 'cod_horario');
  }

  /*public function auxiliar(){
      return $this->hasMany('App\Models\HorarioAuxiliar', 'cod_horario', 'id');
  }*/

}
