<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relación entre roles y usuarios
    public function role(){
      return $this->belongsTo('App\Models\Role', 'cod_role', 'id');
    }

    // Relacion entre usuario y perfil
    public function profile()
    {
      return $this->hasOne('App\Models\Profile', 'cod_user', 'id');
    }

    /**
     * Campo adicional.
     *
     * @param  string  $value
     * @return string
     */

    /*public function getIdAttribute($value)
    {
        return 'user/'.$value;
    }*/

    /* Scopes */
    public function scopeVerificarBloqueo($query){
      return $query->where('bloqueado', 1);
    }

    public function scopeVerificarActivo($query){
      return $query->where('activo', 1);
    }


}
