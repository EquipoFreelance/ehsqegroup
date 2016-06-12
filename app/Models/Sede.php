<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{

    protected $table = 'sede';

    protected $fillable = [
        'nom_sede',
        'activo'
    ];

    protected $attributes = array(
       'deleted' => 0,
    );

    /**
     * Una sede tiene de uno a muchos Grupos
    */
    public function grupos()
    {
        return $this->hasMany('App\Models\Grupo', 'cod_sede', 'id');
    }

    /* Una Sede tiene de uno a muchos locales */
    public function locales(){
        return $this->hasMany('App\Models\SedeLocal', 'cod_sede', 'id');
    }

}
