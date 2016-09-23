<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupEnrollment extends Model
{
    protected $table = 'grupo_enrollment';

    protected $fillable = [
        'cod_grupo',
        'id_enrollment',
        'created_by',
        'created_at'
    ];

    public function grupo()
    {
        return $this->belongsTo('App\Models\Grupo', 'cod_grupo', 'id');
    }
}
