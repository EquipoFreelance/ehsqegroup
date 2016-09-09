<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
  // Nombre de la tabla asociada
  protected $table = 'horario';

  // Campos activos
  protected $fillable = [
      'cod_grupo',
      'cod_mod',
      'cod_docente',
      'cod_sede',
      'fec_inicio',
      'fec_fin',
      'h_inicio',
      'h_fin',
      'monday',
      'sunday',
      'tuesday',
      'wednesday',
      'thursday',
      'friday',
      'saturday',
      'num_horas',
      'num_taller',
      'activo',
      'updated_by',
      'created_by',
  ];

  // Atributos con valores por defecto
  protected $attributes = array(
      'monday'    => 0,
      'sunday'    => 0,
      'tuesday'   => 0,
      'wednesday' => 0,
      'thursday'  => 0,
      'friday'    => 0,
      'saturday'  => 0,
  );

  // Horario - Dias
  public function horariodias()
  {
      return $this->hasMany('App\Models\HorarioDia', 'cod_horario', 'id');
  }

  // Horarios - Auxiliares
  public function auxiliares()
  {
      return $this->belongsToMany('App\Models\Auxiliar', 'horario_auxiliar', 'cod_horario', 'cod_auxiliar')->withTimestamps();
  }

  // En un horario solo puede existir un docente
  public function docente(){
      return $this->belongsTo('App\Models\Docente', 'cod_docente', 'id');
  }

  // En un horario solo puede existir un modulo
  public function modulo()
  {
      return $this->belongsTo('App\Models\Modulo', 'cod_mod', 'id');
  }

  // En un horario solo puede existir una sede
  public function sede()
  {
      return $this->belongsTo('App\Models\SedeLocal', 'cod_sede', 'id');
  }

  // Un Horario - Grupos
  public function grupos()
  {
      return $this->belongsToMany('App\Models\Grupo', 'horario_grupo', 'cod_horario', 'cod_grupo')->withTimestamps();
  }


}
