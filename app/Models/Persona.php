<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';

    protected $fillable = [
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
      'activo',
      'created_at',
      'created_by',
      'updated_at',
      'updated_by'
    ];

    protected $visible = [
        'id',
        'nombre',
        'ape_pat',
        'ape_mat',
        'cod_doc_tip',
        'num_doc',
        'correo',
        'num_phone',
        'num_cellphone',
        'persona_document_type',
        'FullNameUpper'
    ];
    
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

    public function persona_document_type(){
        return $this->belongsTo('App\Models\DocumentType', 'cod_doc_tip', 'id');
    }


    public function getFullNameUpperAttribute()
    {
        return ucwords(mb_strtolower($this->nombre))." ".ucwords(mb_strtolower($this->ape_pat))." ".ucwords(mb_strtolower($this->ape_mat, 'UTF-8'));
    }

    // Una persona puede ser un auxiliar
    public function auxiliar()
    {
        return $this->hasOne('App\Models\Auxiliar', 'cod_persona', 'id');
    }

    // Una persona puede ser un docente
    public function docente()
    {
        return $this->hasOne('App\Models\Docente', 'cod_persona', 'id');
    }

}
