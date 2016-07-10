<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{

    protected $table = 'matricula';

    // Matricula - Estudiantes
    public function student()
    {
      $this->belongsTo("App\Models\Student", "cod_alumno", "id");
    }

}
