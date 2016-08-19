<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportCard extends Model
{
    protected $table = 'matricula_nota';

    protected $fillable = [
        'cod_matricula',
        'cod_modulo',
        'num_nota',
        'cod_docente'
    ];

}
