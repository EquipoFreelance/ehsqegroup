<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';

    protected $fillable = [
      'id',
      'nombre',
      'ape_pat',
      'ape_mat' ,
      'cod_doc_tip',
      'num_doc',
      'correo',
      'cod_pais',
      'cod_dpto',
      'cod_prov',
      'cod_dist',
      'direccion',
      'fe_nacimiento',
      'cod_sexo',
      'num_cellphone',
      'num_phone',
      'proteccion_datos',
      'activo'
    ];

    protected $visible = ['nombre', 'ape_pat', 'ape_mat', 'num_doc', 'correo', 'num_phone', 'num_cellphone', 'id'];

    // Una persona puede tener de uno a muchos cargos
    /*public function cargos()
    {
        return $this->hasMany('App\Models\PersonaCargo', 'cod_persona', 'id');
    }*/

    // Relacion entre usuario y perfil
    public function users()
    {
      return $this->hasMany('App\User', 'cod_persona', 'id');
    }

    // Una persona puede tener de uno a muchos correos
    public function persona_correos()
    {
      return $this->hasMany('App\Models\PersonaCorreo', 'cod_persona', 'id');
    }

    // Una persona puede tener de uno a muchos teléfonos
    public function persona_telefonos()
    {
        return $this->hasMany('App\Models\PersonaTelefono', 'cod_persona', 'id');
    }

    // Atributos extras de la persona
    public function persona_student()
    {
        return $this->hasOne('App\Models\Student', 'cod_persona', 'id');
    }


    // Una persona puede ser un auxiliar
  /*  public function auxiliar()
    {
        return $this->hasOne('App\Models\Auxiliar', 'cod_persona', 'id');
    }*/

    // Una persona puede ser un docente
    public function docente()
    {
        return $this->hasOne('App\Models\Docente', 'cod_persona', 'id');
    }

}
