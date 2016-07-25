<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Country;

use App\Models\Departament;

use App\Models\Province;

use App\Models\District;

use App\Models\EspecializacionTipo;

use App\Models\Especializacion;

use App\Models\Modalidad;

use App\Models\Enrollment;

use App\Models\Student;

class WebServiceController extends Controller
{
  /**
  * Países
  * Servicio permite listar los países
  * @param string $cod_pais -> Código del país
  * @return Response $response  -> Json
  */
    public function wsCountries()
    {
      return $departament = Country::select('nom_pais as name', 'id')->get()->toJson();
    }

    /**
    * Departamentos
    * Servicio permite listar las Provincias
    * @param string $cod_pais -> Código del país
    * @return Response $response  -> Json
    */
    public function wsDepartaments($cod_pais)
    {
      return Departament::where(compact('cod_pais'))->select('nom_dpto as name', 'id')->get()->toJson();
    }

    /**
    * Provincias
    * Servicio permite listar las Provincias
    * @param string $cod_dpto -> Código del departamento
    * @param string $cod_prov -> Código de la provincia
    * @return Response $response  -> Json
    */
    public function wsProvinces($cod_dpto)
    {
      return Province::where(compact('cod_dpto'))->select('nom_prov as name', 'id')->get()->toJson();
    }

    /**
    * Distritos
    * Servicio permite listar los Distritos
    * @param string $cod_dpto -> Código del departamento
    * @param string $cod_prov -> Código de la provincia
    * @return Response $response  -> Json
    */
    public function wsDistricts($cod_dpto, $cod_prov)
    {
      return District::where(compact('cod_dpto','cod_prov'))->select('nom_dist as name', 'id')->get()->toJson();
    }

    /**
    * Tipo de Especializaciones,
    * Servicio permite listar las Tipos de especializaciones
    * @return Response $response  -> Json
    */
    public function wsEspecializacionTipos()
    {
      return EspecializacionTipo::select('nom_esp_tipo as name', 'id')->get()->toJson();
    }

    /**
    * Especializaciones,
    * Servicio permite listar las Especializaciones
    * @param string $cod_esp_tipo -> Código del tipo de especialización
    * @return Response $response  -> Json
    */
    public function wsEspecializaciones($cod_esp_tipo)
    {
      return Especializacion::where(compact('cod_esp_tipo'))->select('nom_esp as name', 'id')->get()->toJson();
    }

    /**
    * Modalidades,
    * Servicio permite listar las modalidades
    * @return Response $response  -> Json
    */
    public function wsModalidades()
    {
      return Modalidad::select('nom_mod as name', 'id')->get()->toJson();
    }

    /**
    * Lista de Matriculados,
    * Servicio permite listar las matriculas realizadas filtradas por le fecha de inicio
    * @param string $fecha_inicio -> Fecha de Inicio
    * @return Response $response  -> Json
    */
    public function wsEnrollments($fecha_inicio)
    {
      if($fecha_inicio){

        // Solo cuando el usuario seleccione el signo "-"
        if($fecha_inicio != '-')
        {
            // Verificando existencia de registros con los parametros recibidos
            if(Enrollment::where("fecha_inicio", $fecha_inicio)->with('student')->with('student.persona')->count() > 0)
            {
                $enrollment = Enrollment::where("fecha_inicio", $fecha_inicio)
                ->with('type_specialization')
                ->with('specialization')
                ->with('modality')
                ->with('student')
                ->with('student.persona')
                ->with('student.persona.persona_correos')
                ->with('student.persona.persona_telefonos')->orderBy('created_at', 'desc')->get();

                $response = response()->json(["response" => $enrollment->toArray()], 200);

            } else {

                $response = response()->json(["message" => "Empty"], 400);
            }

        } else {

            $enrollment = Enrollment::with('type_specialization')
            ->with('specialization')
            ->with('modality')
            ->with('student')
            ->with('student.persona')
            ->with('student.persona.persona_correos')
            ->with('student.persona.persona_telefonos')->orderBy('created_at', 'desc')->get();

            $response = response()->json(["response" => $enrollment->toArray()], 200);
        }


      } else {

        $response = response()->json(["message" => "Empty"], 400);

      }

      return $response;

    }

    public function wsStudent()
    {
        $students = Student::with('persona')
        ->with('persona.persona_correos')
        ->with('persona.persona_telefonos')->orderBy('created_at', 'desc')->get();
        $response = response()->json(["response" => $students->toArray()], 200);
        return $response;
    }
}
