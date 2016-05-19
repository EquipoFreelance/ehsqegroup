<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'users_type';

    // Relación de uno a muchos
    public function users(){
      return $this->hasMany('App\User', 'id_user_type', 'id');
    }


}
