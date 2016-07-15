<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'ub_paises';

    public function departaments()
    {
      $this->hasMany('App\Models\Departament', 'cod_dpto', 'id');
    }

}
