<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $table = 'profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'avatar'
    ];

    // Relacion entre perfil y usuario
    public function user()
    {
      $this->belongsTo('App\User', 'cod_user', 'id');
    }

    


}
