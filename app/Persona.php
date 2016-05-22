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

}
