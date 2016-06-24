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

    // Relación de uno a muchos
    public function usertype(){
      return $this->belongsTo('App\UserType', 'id_user_type');
    }

    // Una usuario puede ser un administrativo
    public function administrativo()
    {
        return $this->hasOne('App\Models\Administrativo', 'cod_persona', 'id');
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
