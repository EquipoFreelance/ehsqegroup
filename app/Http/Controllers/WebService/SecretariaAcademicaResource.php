<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 05/06/2017
 * Time: 03:56 PM
 */

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\GroupRepository;
use App\Repositories\Eloquents\StudentRepository;
use Illuminate\Http\Request;
use App\Repositories\Eloquents\EnrollmentRepository;

class SecretariaAcademicaResource extends controller
{

    private $enrollment;
    private $group;
    private $student;

    public function __construct(  EnrollmentRepository $enrollment, GroupRepository $group, StudentRepository $student ){

        $this->enrollment = $enrollment;
        $this->group      = $group;
        $this->student    = $student;

    }

    public function index(Request $request){

        $ar_mat = array();

        // Obteniendo la lista de grupos
        $group = $this->group->getByIdAndIdPeriod($request->get('id_group'), $request->get('id_academic_period'));

        // Obteniendo la lista de matriculados
        $group_enrollment = $group->group_enrollment;

        foreach ($group_enrollment as $g_e) {

            // Obteniendo el detalle de la matricula
            $enrollments = $this->enrollment->getById($g_e->id_enrollment);

            $student = $this->student->getById($enrollments->cod_alumno);

            // Filtrando por tipo de especialidad y especialización
            if($enrollments->cod_esp_tipo == $request->get('cod_esp_tipo') && $enrollments->cod_esp == $request->get('cod_esp')){

                // Obteniendo la lista de notas asociados a la matricula;

                $califications = $enrollments->report_card()->where('cod_modulo', $request->get('cod_modulo'))->get();

                $ar_cal = array();

                foreach ($califications as $c) {

                    $ar_cal[] = array(
                        'value' => $c->num_nota,
                        'id'    => $c->id
                    );

                }

                $ar_mat[] = array(
                    'enrollment'   => $g_e->id_enrollment,
                    'fullname'     => trim($student->persona->ape_pat)." ".trim($student->persona->ape_mat)." ".trim($student->persona->nombre),
                    'calification' => $ar_cal
                );

            }

        }

        return response()->json($ar_mat);

    }



}