<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{

    protected $table = 'ub_provincias';

    public function departament()
    {
      return $this->belongsTo('App\Models\Departament', 'cod_dpto', 'id');
    }

    public function districts()
    {
      $this->hasMany('App\Models\District', 'cod_prov', 'id');
    }

}
