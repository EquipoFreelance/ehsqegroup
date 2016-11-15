<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpFraccionadoOtros extends Model
{
    protected $table = 'epm_fraccionado_otros';

    protected $fillable = [
        'id_epm_fra',
        'id_concept',
        'amount',
        'active'
    ];

}
