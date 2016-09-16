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

use App\Models\GroupStudent;

use App\Models\Horario;

use App\Models\Docente;

use App\Models\Auxiliar;

use App\Models\Persona;

use Carbon\Carbon;

use Auth;


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

    /**
     * Muestra los Horarios por Grupo
     * @param string $cod_grupo, Id del Grupo
     * @return json $response
     * */
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
    * Lista de Matriculados
    * Servicio permite listar las matriculas realizadas filtradas por le fecha de inicio
    * @param string $id_academic_period, Id del periodo academico
    * @return json $response, Muestra el resultado en formaro JSON
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

    /**
     * Listado de Inscritos
     * @param $id_academic_period
     * @return \Illuminate\Http\JsonResponse
     */
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


    /**
     * Listado de Estudiantes
     * @return \Illuminate\Http\JsonResponse
     */
    public function wsStudent()
    {
        $students = Student::with('persona')->orderBy('created_at', 'desc')->get();
        $response = response()->json(["response" => $students->toArray()], 200);
        return $response;
    }

    /**
     * Búsqueda de Estudiantes por su nombres
     * @param $q
     * @return \Illuminate\Http\JsonResponse
     */
    public function wsStudentLike($q)
    {

        $students = Student::with('persona')->whereHas('persona', function ($query) use($q) {
            $query->where('nombre', 'LIKE', '%'. $q .'%');
        })->get();

        $response = response()->json(["items" => $students->toArray()], 200);

        return $response;
    }

    /**
     * Búsqueda de Alumnos por su nombre, dentro de un grupo determinado
     * @param $cod_grupo, Código del Grupo
     * @param $q, Palabra de búsqueda
     * @return json $response Resultado en Formato JSON
     * */
    public function wsStudentGroupLike($cod_grupo, $q)
    {

        // Para considerar coincidencias tomamos el periodo academico, la modalidad, tipo de especialización y la especialización

        $g = Grupo::find($cod_grupo);

        // Buscando alumnos que se hayan matriculado
        $rs = Enrollment::where('id_academic_period', $g->id_academic_period)
            ->where('cod_modalidad', $g->cod_modalidad)
            ->where('cod_esp_tipo', $g->cod_esp_tipo)
            ->where('cod_esp',  $g->cod_esp)
            ->where('activo', 1);

        $rs->with('student.persona');

        if($q != '-'){

            $rs->whereHas('student.persona', function ($query) use($q) {
                $query
                    ->orWhere('nombre', 'LIKE', '%'. $q .'%')
                    ->orWhere('ape_pat', 'LIKE', '%'. $q .'%')
                    ->orWhere('ape_mat', 'LIKE', '%'. $q .'%');
            });

        }

        $enrollments = $rs->get();

        // Realizando una busqueda de cada matriculado para saber si ya fue asignado al grupo correspondiente
        foreach ($enrollments as $item) {

            $item->is_asignemnt = 0;

            if( GroupStudent::where("cod_alumno", $item->cod_alumno)->count() > 0){
                $item->is_asignemnt = 1;
            }


        }

        $response = response()->json(["response" => $enrollments], 200);

        return $response;
    }

    /**
     * List Periodo Academico
     * @return json $schedules, Resultado en Formato JSON
     * */
    public function getWsAcademicPeriod(){

        $schedules = AcademicPeriod::select('start_date as name', 'id')->where("active", 1)->orderBy('id', 'desc')->get()->toJson();
        return $schedules;

    }

    /**
     * Lista Grupos Activos
     * @return json $response, Resultado en Formato JSON
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
     * Lista de Alumnos asignados a un determinado grupo
     * @param string $cod_grupo Id del grupo
     * @return string $response Resultado en Formato JSON
     **/
    public function getWsGroupsAssignedStudents($cod_grupo){

        $response = ''; $fills = array();

        $rs = Grupo::where('id', $cod_grupo)->with('students');

        if($rs->count() > 0){

            $g = $rs->first();

            foreach ($g->students as $item) {
                $student = Student::find($item->cod_alumno);
                $fills[] = array("name" => $student->persona->nombre.", ".$student->persona->ape_pat." ".$student->persona->ape_mat, "id" => $item->cod_alumno);
            }

        }

        $response = response()->json(["response" => $fills], 200);

        return $response;

    }

    /**
     * Asignar Estudiantes a Grupos
     * @param $request Request
     **/
    public function postWsStoreAssignGroup(Request $request){

        // Al quitar el check debería actualizar la lista

        $checkeds  = $request->get('student');
        $cod_grupo = $request->get('cod_grupo');
        $registers = [];

        // Existe elementos seleccionados?
        if( count($checkeds) > 0){

            // Caso 1: Aquellos que no se encuentren en la base de datos
            $rs = GroupStudent::select("cod_alumno", "id")->where("cod_grupo", $cod_grupo)->whereNotIn('cod_alumno', $checkeds);

            // Aquellos que estan en la lista y se les ha quitado el check....

            ($rs->count() > 0)? $rs->delete() : false;

            // Caso 2: Aquellos se encuentren en la base de datos, validamos
            $rs = GroupStudent::select("cod_alumno", "id")->where("cod_grupo", $cod_grupo);

            if( $rs->count() > 0 ){

                $old_register = $rs->lists('cod_alumno')->toArray();

                foreach ($request->get('student') as $cod_alumno) {

                    // Si los estudiantes seleccionados no existen en la tabla grupo_alumnos,
                    // los registramos
                    if( in_array($cod_alumno, $old_register) == false){
                        $registers[] = $cod_alumno;
                    }

                }

            } else {

                $registers = $request->get('student');

            }


            if( count($registers) > 0){

                foreach ($registers as $cod_alumno) {
                    $student = new GroupStudent();
                    $student->cod_grupo  = $cod_grupo;
                    $student->cod_alumno = $cod_alumno;
                    $student->created_by = Auth::user()->id;
                    $student->created_at = Carbon::now();
                    $student->save();
                }


            }




        } else {

            // Caso 4: Como el usuario deselecciono a los alumnos del grupo, eliminamos a todos
            $rs = GroupStudent::select("cod_alumno", "id")->where("cod_grupo", $cod_grupo);
            $rs->delete();

        }

    }

    /**
     * Lista de Horarios Academicos por el ID del grupo
     * @param string $cod_grupo Id del Grupo
     * @return string $response, retorna un resultado en formaro JSON
     * */
    public function getWsAcademicHorary($cod_grupo){

        $response = ''; $fills = array();

        $rs = Horario::with('docente.persona')
            ->with('sede')
            ->with('modulo')
            ->with('academic_period')
            ->select('id', 'id_academic_period', 'fec_inicio', 'fec_fin', 'fec_fin', 'h_inicio', 'h_fin', 'cod_docente', 'cod_sede', 'cod_mod', 'num_horas', 'activo');
        $rs->where("activo", 1);

        ($cod_grupo != '-')? $rs->where("cod_grupo", $cod_grupo)->orderBy('id', 'desc') : '';

        $rs->orderBy('id', 'desc');

        if( $count = $rs->count() > 0){
            $fills = $rs->get();
        }

        $response = response()->json(['response' => $fills], 200);

        return $response;

    }

    /**
     * Búsqueda de Grupos por su nombre
     * @param string $q Palabra
     * @return string $response, retorna un resultado en formaro JSON
     * */
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

    /**
     * Búsqueda de Docentes por su nombre
     * @param string $q Palabra
     * @return string $response, retorna un resultado en formaro JSON
     * */
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

    /**
     * Búsqueda de Docentes o Todos los Docentes
     * @param string $cod_teacher Id del auxiliar
     * @return string $response, retorna un resultado en formaro JSON
     **/
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

    /**
     * Búsqueda de Auxiliares o Todos los auxiliares
     * @param string $cod_auxiliar Id del auxiliar
     * @return string $response, retorna un resultado en formaro JSON
     * */
    public function getWsAuxiliary($cod_auxiliar){

        $response = ''; $fills = array();

        $rs = Auxiliar::where('activo', 1)->select("id", "cod_persona");

        ( $cod_auxiliar != 'all')? $rs->where('id', $cod_auxiliar) : false;

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

    /**
     * Búsqueda de Auxiliares por su nombre
     * @param string $q Palabra
     * @return string $response, retorna un resultado en formaro JSON
     * */
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

    /**
     * Listado de Horarios Disponibles
     * @param string $id_academic_period, Id del periodo academico
     * @param string $cod_persona, Id de la persona
     * @return json $response, retorna un resultado en formaro JSON
     * */
    public function getWsScheduleAvailable($id_academic_period, $cod_persona){

        $response = ''; $fills = array();

        $persona = Persona::where("id", $cod_persona)->with('docente')->first();

        $cod_docente = $persona->docente->id;

        $rs = Horario::
            with('sede')
            ->with('modulo')
            ->with('academic_period')
            ->select('id', 'id_academic_period', 'fec_inicio', 'fec_fin', 'fec_fin', 'h_inicio', 'h_fin', 'cod_docente', 'cod_sede', 'cod_mod', 'num_horas', 'num_taller', 'activo');
        $rs->where("activo", 1);

        // Si el periodo no ha sido seleccionado mostramos todos los horarios disponibles
        if($id_academic_period != 0){
            $rs->where('id_academic_period', $id_academic_period)->where('cod_docente', $cod_docente);    
        } else {
            $rs->where('cod_docente', $cod_docente);
        }
        

        $rs->orderBy('id', 'desc');

        if( $count = $rs->count() > 0){
            $fills = $rs->get();
        }

        $response = response()->json(['response' => $fills], 200);

        return $response;

    }

}
