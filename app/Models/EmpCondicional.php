<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpCondicional extends Model
{
    protected $table = 'epm_condicional';

    protected $fillable = [
        'id_epm',
        'id_concept',
        'amount',
        'num_cuota',
        'date',
        'active'
    ];
}
