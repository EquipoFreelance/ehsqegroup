<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{

    protected $table = 'ub_departamentos';

    public function provinces()
    {
      $this->hasMany('App\Models\Province', 'cod_dpto', 'id');
    }

}
