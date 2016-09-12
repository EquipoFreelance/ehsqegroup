<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'alumno';

    protected $fillable = [
        'cod_persona',
        'cod_sede',
        'activo'
    ];

    // Relacion entre usuario y perfil
    public function persona()
    {
      return $this->belongsTo('App\Models\Persona', 'cod_persona', 'id');
    }

    // Estudiante - Matriculas
    public function enrollments()
    {
      return $this->hasMany('App\Models\Enrollment', 'cod_alumno', 'id');
    }
    

}
