<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    /**
     * Una sede tiene de uno a muchos Grupos
    */
    public function grupos()
    {
        return $this->hasMany('App\Models\Grupo', 'cod_sede', 'id');
    }

}
