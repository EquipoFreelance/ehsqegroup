<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{

    protected $table = 'matricula';

    protected $fillable = [
        "id_academic_period",
        "cod_modalidad",
        "cod_esp_tipo",
        "cod_esp",
        "cod_alumno",
        "created_by",
        "creation_date",
        "activo"
    ];


    // Matricula - Estudiantes
    public function student()
    {
        return $this->belongsTo('App\Models\Student', "cod_alumno", "id");
    }

    // Matricula - Tipo de Expecialización
    public function type_specialization()
    {
        return $this->belongsTo("App\Models\EspecializacionTipo", "cod_esp_tipo", "id");
    }

    // Matricula - Expecialización
    public function specialization()
    {
        return $this->belongsTo("App\Models\Especializacion", "cod_esp", "id");
    }

    // Matricula - Modalidad
    public function modality()
    {
        return $this->belongsTo("App\Models\Modalidad", "cod_modalidad", "id");
    }

    // Matricula - Boleta de Notas
    public function report_card(){
        return $this->hasMany('App\Models\ReportCard', 'cod_matricula', 'id');
    }

    // Matricula - Cronograma academico
    public function academic_schedule(){
        return $this->hasMany("App\Models\ReportCard", "cod_matricula", "id");
    }

}
