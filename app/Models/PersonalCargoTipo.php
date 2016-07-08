<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalCargoTipo extends Model
{
    protected $table = 'personal_cargo_tipo';

    // Una persona puede tener de uno a muchos cargos
    public function personacargo()
    {
        return $this->hasMany('App\Models\PersonaCargo', 'cod_personal_cargo_tipo', 'id');
    }

}
