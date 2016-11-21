<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpBecado extends Model
{
    protected $table = 'epm_becado';

    protected $fillable = [
        'id_epm',
        'amount',
        'active'
    ];
}
