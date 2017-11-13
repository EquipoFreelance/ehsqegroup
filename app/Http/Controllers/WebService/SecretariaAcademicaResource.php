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
use App\Repositories\Eloquents\HoraryRepository;
use App\Repositories\Eloquents\ModuleRepository;
use App\Repositories\Eloquents\ReportCardRepository;
use App\Repositories\Eloquents\StudentRepository;
use Illuminate\Http\Request;
use App\Repositories\Eloquents\EnrollmentRepository;
use League\Flysystem\Exception;

class SecretariaAcademicaResource extends controller
{

    private $enrollment;
    private $group;
    private $student;
    private $horary;
    private $reportCard;
    private $module;

    public function __construct(
        EnrollmentRepository $enrollment,
        GroupRepository $group,
        StudentRepository $student,
        HoraryRepository $horary,
        ReportCardRepository $reportCard,
        ModuleRepository $module
    ){

        $this->enrollment = $enrollment;
        $this->group      = $group;
        $this->student    = $student;
        $this->horary     = $horary;
        $this->reportCard = $reportCard;
        $this->module = $module;

    }

    public function index(Request $request){

        try {



        $ar_mat = array();

        // Obteniendo la lista de grupos
        $group = $this->group->getById($request->get('id_group')); //, $request->get('id_academic_period')

        $talleres = $this->horary->getIdByModuleAndByCodMod($request->get('id_group'), $request->get('cod_modulo'));

        if($talleres){


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

                    $ar_cal = [];

                    if(count($califications) > 0){

                        foreach ($califications as $c) {

                            $ar_cal[] = array(
                                'value'  => round($c->num_nota, 2),
                                'id'     => $c->id,
                                'taller' => $c->cod_taller,
                                'edit'   => false
                            );

                        }

                        for ($i = 0; $i <= ( $talleres->num_taller - count($califications) ); $i++){

                            $ar_cal[] = array(
                                'value'  => 0,
                                'id'     => 0,
                                'taller' => $i,
                                'edit'   => false
                            );

                        }

                    } else {

                        for ($i = 1; $i <= $talleres->num_taller; $i++){

                            $ar_cal[] = array(
                                'value'  => 0,
                                'id'     => 0,
                                'taller' => $i,
                                'edit'   => false
                            );
                        }

                        $ar_cal[] = array(
                            'value'  => 0,
                            'id'     => 0,
                            'taller' => 11,
                            'edit'   => false
                        );

                    }

                    $ar_mat[] = array(
                        'enrollment'    => $g_e->id_enrollment,
                        'fullname'      => trim(ucwords(strtolower(strtoupper($student->persona->ape_pat))))." ".trim(ucwords(strtolower(strtoupper($student->persona->ape_mat)))).", ".trim(ucwords(strtolower(strtoupper($student->persona->nombre)))),
                        'dni'           => $student->persona->num_doc,
                        'califications' => $ar_cal,
                        'prom'          => 0,
                        'edit'          => false
                    );

                }

            }

            return response()->json(array("data" => $ar_mat, "talleres" => $talleres));

        }



        }catch (Exception $exception){
            return '';
        }


    }

    public function getModules(Request $request){

        $group = $this->group->getById($request->get('id_group'));


        return response()->json(array("data" => $this->module->getModulesByModalidadByEspTipoByCodEsp($group->cod_modalidad, $group->cod_esp_tipo, $group->cod_esp), "group" => $group));


    }

    public function store(Request $request){

        $califications = $request->get('data');

        foreach ($califications as $c) {

            $this->reportCard->update($c['id'], array('num_nota' => $c['value']) );

        }

        return response()->json($califications);

    }


}