<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpTotal extends Model
{

    protected $table = 'epm_total';

    protected $fillable = [
        'id_epm',
        'amount',
        'active'
    ];

}
