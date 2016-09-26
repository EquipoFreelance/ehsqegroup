<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportCard extends Model
{
    protected $table = 'matricula_nota';

    protected $fillable = [
        'id',
        'cod_matricula',
        'cod_modulo',
        'cod_taller',
        'num_nota',
        'cod_docente'
    ];

}
