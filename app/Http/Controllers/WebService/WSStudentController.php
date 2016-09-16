<?php

namespace App\Http\Controllers\WebService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Carbon\Carbon;
use Auth;
use App\Models\GroupStudent;

class WSStudentController extends Controller
{
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

            $rs = GroupStudent::select("cod_alumno", "id")->where("cod_grupo", $cod_grupo);

            foreach ($checkeds as $cod_alumno) {

                $ar_cod_alumno = explode("-", $cod_alumno); //Id-true o false

                if( $ar_cod_alumno[1] == 'true' ) {


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

            }

            if( count($remove_registers) > 0){

                $rs = GroupStudent::select("cod_alumno", "id")->where("cod_grupo", $cod_grupo);
                $rs->whereIn('cod_alumno', $remove_registers);
                ($rs->count() > 0)? $rs->delete() : false;

            }


        }

    }

}
