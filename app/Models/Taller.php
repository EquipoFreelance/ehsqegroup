<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taller extends Model
{

    use SoftDeletes;

    protected $table = 'taller';

    protected $fillable = [
        'nom_taller',
        'activo'
    ];

    protected $attributes = array(
       'deleted' => 0,
    );
    
    protected $dates = ['deleted_at'];

    public function modulos(){
        return $this->belongsToMany('App\Models\Modulo', 'modulo_taller', 'cod_taller', 'cod_modulo');
    }
    
}
