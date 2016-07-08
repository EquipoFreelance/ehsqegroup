<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    // Relacion entre usuario y roles
    public function users(){
      return $this->hasMany('App\User', 'cod_role', 'id');
    }

}
