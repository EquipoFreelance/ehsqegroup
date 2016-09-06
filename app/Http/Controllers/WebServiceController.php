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

use App\Models\Modulo;

use App\Models\Modalidad;

use App\Models\Enrollment;

use App\Models\Student;

use App\Models\AcademicPeriod;

use App\Models\Grupo;

use App\Models\Horario;

use App\Models\Docente;

use App\Models\Auxiliar;


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
     * Modalidades,
     * Servicio permite listar las modalidades
     * @return Response $response  -> Json
     */
    public function wsModalidades()
    {
        return Modalidad::select('nom_mod as name', 'id')->get()->toJson();
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
     * Modulos,
     * Servicio permite listar los modulos
     * @param string $cod_modalidad - Código de la modalidad
     * @param string $cod_esp_tipo  - Código del tipo de especialización
     * @param string $cod_esp       - Código de la especialización
     * @param string $q             - Nombres del Modulo
     * @return Response $response   - Json
     */
    public function wsModulos($cod_modalidad, $cod_esp_tipo, $cod_esp, $q){

        $response = '';

        $rs = Modulo::
        where('cod_modalidad', $cod_modalidad)->
        where('cod_esp_tipo', $cod_esp_tipo)->
        where('cod_esp', $cod_esp);

        if($q != '-'){
            $rs->where('nombre', 'LIKE', '%'. $q .'%');
        }

        $rs->select('nombre as name', 'id');

        if($rs->count() > 0){
            $rs = $rs->get();
            $response = response()->json(["items" => $rs], 200);
        } else {
            $response = response()->json(["message" => 'empty'], 400);
        }

        return $response;

    }

    /* Dependiendo el grupo seleccionado se listarán los módulos */
    public function GetHoraryModules($cod_grupo){

        $rs = Grupo::where("id", $cod_grupo)->where("activo", 1)->select("cod_modalidad", "cod_esp_tipo", "cod_esp");

        if ($rs->count() > 0){

            $group = $rs->first();

            $rs = Modulo::where("cod_modalidad", $group->cod_modalidad)->
            where("cod_esp_tipo", $group->cod_esp_tipo)->
            where("cod_esp", $group->cod_esp)->select("nombre as name", "id");

            ($rs->count() > 0)?
                $response = response()->json($rs->get(), 200) : $response = response()->json(["message" => 'empty'], 400);


        }else {
            $response = response()->json(["message" => 'empty'], 400);
        }

        return $response;

    }

    /**
    * Lista de Matriculados,
    * Servicio permite listar las matriculas realizadas filtradas por le fecha de inicio
    * @param string $fecha_inicio -> Fecha de Inicio
    * @return Response $response  -> Json
    */
    public function wsEnrollments($id_academic_period)
    {
      if($id_academic_period){

        // Solo cuando el usuario seleccione el signo "-"
        if($id_academic_period != '-')
        {
            // Verificando existencia de registros con los parametros recibidos
            if(Enrollment::where("id_academic_period", $id_academic_period)->with('student')->with('student.persona')->count() > 0)
            {
                $enrollment = Enrollment::where("id_academic_period", $id_academic_period)
                ->with('type_specialization')
                ->with('specialization')
                ->with('modality')
                ->with('student')
                ->with('student.persona')->orderBy('created_at', 'desc')->get();

                $response = response()->json(["response" => $enrollment->toArray()], 200);

            } else {

                $response = response()->json(["message" => "Empty"], 400);
            }

        } else {

            $enrollment = Enrollment::with('type_specialization')
            ->with('specialization')
            ->with('modality')
            ->with('student')
            ->with('student.persona')->orderBy('created_at', 'desc')->get();

            $response = response()->json(["response" => $enrollment->toArray()], 200);
        }


      } else {

        $response = response()->json(["message" => "Empty"], 400);

      }

      return $response;

    }

    /* WS - List of inscriptions */
    public function wsInscriptions($id_academic_period){

      if($id_academic_period){

        // Solo cuando el usuario seleccione el signo "-"
        if($id_academic_period != '-')
        {
            // Verificando existencia de registros con los parametros recibidos
            if(Enrollment::where("id_academic_period", $id_academic_period)->with('student')->with('student.persona')->count() > 0)
            {
                $enrollment = Enrollment::where("id_academic_period", $id_academic_period)
                ->with('type_specialization')
                ->with('specialization')
                ->with('modality')
                ->with('student')
                ->with('student.persona')->orderBy('created_at', 'desc')->get();

                $response = response()->json(["response" => $enrollment->toArray()], 200);

            } else {

                $response = response()->json(["message" => "Empty"], 400);
            }

        } else {

            $enrollment = Enrollment::with('type_specialization')
            ->with('specialization')
            ->with('modality')
            ->with('student')
            ->with('student.persona')->orderBy('created_at', 'desc')->get();

            $response = response()->json(["response" => $enrollment->toArray()], 200);
        }


      } else {

        $response = response()->json(["message" => "Empty"], 400);

      }

      return $response;

    }

    /* Lista de Estudiantes Activos */
    public function wsStudent()
    {
        $students = Student::with('persona')->orderBy('created_at', 'desc')->get();
        $response = response()->json(["response" => $students->toArray()], 200);
        return $response;
    }

    /* Lista de Estudiantes por nombres */
    public function wsStudentLike($q)
    {

        $students = Student::with('persona')->whereHas('persona', function ($query) use($q) {
            $query->where('nombre', 'LIKE', '%'. $q .'%');
        })->get();

        $response = response()->json(["items" => $students->toArray()], 200);

        return $response;
    }

    /**
     * List Periodo Academico
     * */
    public function getWsAcademicPeriod(){

        $schedules = AcademicPeriod::select('start_date as name', 'id')->where("active", 1)->orderBy('id', 'desc')->get()->toJson();
        return $schedules;

    }

    /**
     * Lista Grupos Activos
     **/
    public function getWsGroups(){

        $response = ''; $fills = array();

        $rs = Grupo::select('nom_grupo as name', 'id')->where("activo", 1)->orderBy('id', 'desc');

        if($rs->count() > 0){
            $fills = $rs->get();
        }

        $response = response()->json($fills, 200);

        return $response;

    }

    /**
    * Lista Horario Academico por Grupo
    * 
    **/
    public function getWsAcademicHorary($cod_grupo = '-'){

        $response = ''; $fills = array();

        $rs = Horario::with('docente.persona')
            ->with('sede')
            ->with('modulo')
            ->select('id', 'fec_inicio', 'fec_fin', 'fec_fin', 'h_inicio', 'h_fin', 'cod_docente', 'cod_sede', 'cod_mod', 'num_horas', 'activo');
        $rs->where("activo", 1);

        ($cod_grupo != '-')? $rs->where("cod_grupo", $cod_grupo)->orderBy('id', 'desc') : '';

        $rs->orderBy('id', 'desc');

        if( $count = $rs->count() > 0){
            $fills = $rs->get();

        }

        $response = response()->json(['response' => $fills], 200);

        return $response;

    }

    /* *
     * Busqueda de Grupo por nombres
     *  */
    public function getWsGroupsLike($q){
        $response = ''; $fills = array();

        $rs = Grupo::
        with('sede')->
        with('modalidad')->
        with('tipo_especializacion')->
        with('especializacion')->
        select('nom_grupo as name', 'id', 'cod_sede', 'cod_modalidad', 'cod_esp_tipo', 'cod_esp')->where('nom_grupo', 'LIKE', '%'. $q .'%')->orderBy('id', 'desc');

        if($rs->count() > 0){
            $fills = $rs->get();
        }

        $response = response()->json(["items" => $fills], 200);

        return $response;
    }

    /* *
     * Búsqueda de Docentes por nombres
     *  */
    public function getWsTeachersLike($q){

        $response = ''; $fills = array();

        $rs = Docente::
        with('persona')->
        whereHas('persona', function ($query) use($q) {
            if($q != '-'){
                $query->where('nombre', 'LIKE', '%'. $q .'%');
            }
        });

        if($rs->count() > 0){
            $fills = $rs->get();
        }

        $response = response()->json(["items" => $fills], 200);

        return $response;

    }

    /* *
     * Búsqueda de Todos los Docentes
     *  */
    public function getWsTeachers($cod_teacher){

        $response = ''; $fills = array();

        $rs = Docente::where('activo', 1)->select("id", "cod_persona");

        ( $cod_teacher != 'all')? $rs->where('id', $cod_teacher) : false;

        $rs->with('persona');

        if($rs->count() > 0){

            $fills = array();
            foreach ($rs->get() as $item) {
                $fills[] = array("name" => $item->persona->nombre, "id" => $item->id);
            }
        }

        $response = response()->json($fills, 200);

        return $response;

    }

    /* *
     * Búsqueda de Todos los Docentes
     *  */
    public function getWsAuxiliary($cod_teacher){

        $response = ''; $fills = array();

        $rs = Auxiliar::where('activo', 1)->select("id", "cod_persona");

        ( $cod_teacher != 'all')? $rs->where('id', $cod_teacher) : false;

        $rs->with('persona');

        if($rs->count() > 0){

            $fills = array();
            foreach ($rs->get() as $item) {
                $fills[] = array("name" => $item->persona->nombre, "id" => $item->id);
            }
        }

        $response = response()->json($fills, 200);

        return $response;

    }

    /* *
     * Búsqueda de Auxiliares por nombres
     *  */
    public function getWsAuxiliaryLike($q){

        $response = ''; $fills = array();

        $rs = Auxiliar::
        with('persona')->
        whereHas('persona', function ($query) use($q) {

            if($q != '-'){
                $query->where('nombre', 'LIKE', '%'. $q .'%');
            }

        });

        if($rs->count() > 0){
            $fills = $rs->get();
        }

        $response = response()->json(["items" => $fills], 200);

        return $response;

    }

}
