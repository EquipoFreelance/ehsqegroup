<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpFraccionado extends Model
{
    protected $table = 'epm_fraccionado';

    protected $fillable = [
        'id_epm',
        'amount',
        'num_cuota',
        'active'
    ];

}
