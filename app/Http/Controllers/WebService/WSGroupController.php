<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Models\Docente;
use App\Models\GroupTeacher;
use App\Models\GroupStudent;
use App\Models\Enrollment;
use App\Models\Grupo;
use App\Models\Student;
use App\Models\Horario;
use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Carbon\Carbon;

class WSGroupController extends Controller
{

    /**
     * Lista de Grupos por el:
     * @param $id_person                       Id de la persona(docente)
     * @return \Illuminate\Http\JsonResponse
     */
    public function GrouTeacher($id_person)
    {
        $find_teacher = Docente::where("cod_persona", $id_person)->first();

        $find = GroupTeacher::where("id_teacher", $find_teacher->id)->with('group');
        if($find->count() > 0){
            return response()->json($find->get(), 200);
        } else {
            return response()->json(false, 400);
        }

    }

    /**
     * Busqueda de Horario disponibles por el:
     * @param $id_group     Id del grupo
     * @param $id_person    Id de la persona(docente)
     * @return \Illuminate\Http\JsonResponse
     */
    public function GroupHoraryModulo($id_group, $id_person)
    {
        $find_teacher = Docente::where("cod_persona", $id_person)->first();
        
        $rs = Horario::where("cod_grupo", $id_group)->where("cod_docente", $find_teacher->id)->with('modulo');

        if($rs->count() > 0){
            return response()->json($rs->get(), 200);
        } else {
            return response()->json(false, 400);
        }

    }


    // Listado de Alumnos vs la matricula y sus notas

    // La incognita es si en vez de cod de alumno va el cod de la matricula
    public function GroupStudent(){
        
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
     * Asignar Estudiantes a Grupos
     * @param $request Request
     **/
    public function postWsStoreAssignGroup(Request $request){

        // Al quitar el check debería actualizar la lista

        $checkeds         = explode(",", $request->get('set_students'));
        $cod_grupo        = $request->get('cod_grupo');
        $add_registers    = [];
        $remove_registers = [];

        // Existe elementos seleccionados?
        if( count($checkeds) > 0){

            foreach ($checkeds as $cod_alumno) {

                $ar_cod_alumno = explode("-", $cod_alumno); //Id-true o false

                if( $ar_cod_alumno[1] == 'true' ) {

                    $rs = GroupStudent::select("cod_alumno", "id")->where("cod_grupo", $cod_grupo);
                    $rs->where('cod_alumno', $ar_cod_alumno[0]);

                    if( $rs->count() == 0){
                        $add_registers[] = $ar_cod_alumno[0];
                    }

                } else if( $ar_cod_alumno[1] == 'false') { // Estado del Check (true o false)

                    $remove_registers[] = $ar_cod_alumno[0];
                }

            }

            if( count($add_registers) > 0){

                foreach ($add_registers as $cod_alumno) {
                    $student = new GroupStudent();
                    $student->cod_grupo  = $cod_grupo;
                    $student->cod_alumno = $cod_alumno;
                    $student->created_by = Auth::user()->id;
                    $student->created_at = Carbon::now();
                    $student->save();
                }
                $add_registers = [];
            }

            if( count($remove_registers) > 0){

                $rs = GroupStudent::select("cod_alumno", "id")->where("cod_grupo", $cod_grupo);
                $rs->whereIn('cod_alumno', $remove_registers);
                ($rs->count() > 0)? $rs->delete() : false;

            }


        }

    }
}
