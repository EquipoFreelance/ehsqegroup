<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';

    protected $fillable = [
        'cod_doc_tip',
        'num_doc',
        'nombre',
        'ape_pat',
        'ape_mat',
        'direccion',
        'fe_nacimiento',
        'cod_sexo',
        'activo'
    ];

    protected $attributes = array(
       'deleted' => 0,
    );

    // Una persona puede tener de uno a muchos cargos
    public function cargos()
    {
        return $this->hasMany('App\PersonaCargo', 'cod_persona', 'id');
    }

    // Una persona puede tener de uno a muchos correos
    public function correos()
    {
        return $this->hasMany('App\PersonaCorreo', 'cod_persona', 'id');
    }

    // Una persona puede tener de uno a muchos teléfonos
    public function telefonos()
    {
        return $this->hasMany('App\PersonaTelefono', 'cod_persona', 'id');
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

    // Una persona puede ser un administrativo
    public function administrativo()
    {
        return $this->hasOne('App\Models\Administrativo', 'cod_persona', 'id');
    }

}
