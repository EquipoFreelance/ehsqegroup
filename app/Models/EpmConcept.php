<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpmConcept extends Model
{
    protected $table = 'epm_concept';

    protected $fillable = [
        'id_concept',
        'id_epm',
        'amount',
        'active',
    ];

}
