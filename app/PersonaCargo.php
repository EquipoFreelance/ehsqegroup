<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonaCargo extends Model
{
    protected $table = 'persona_cargo';

    protected $fillable = [
        'cod_persona',
        'cod_personal_cargo_tipo',
        'activo'
    ];


}
