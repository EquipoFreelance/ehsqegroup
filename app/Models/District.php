<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    protected $table = 'ub_distritos';

    public function province(){
      return $this->belongsTo('App\Models\Province', 'cod_prov', 'id');
    }

    public function pepartament(){
      return $this->belongsTo('App\Models\Departament', 'cod_prov', 'id');
    }

}
