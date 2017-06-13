<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\CalificationRepository;
use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\EspecializationRepository;
use App\Repositories\Eloquents\ModuleRepository;
use App\Repositories\Eloquents\EImplementationNoteRepository;
use Illuminate\Http\Request;
use App\Http\Requests;


class EnrollmentResource extends Controller
{
    private $re;
    private $esp_repo;
    private $cal_repo;
    private $mod_repo;
    private $rein;


    public function __construct(
        EnrollmentRepository $re,
        EspecializationRepository $esp_repo,
        CalificationRepository $cal_repo,
        ModuleRepository $mod_repo,
        EImplementationNoteRepository $rein
    )
    {
        $this->re = $re;
        $this->esp_repo = $esp_repo;
        $this->cal_repo = $cal_repo;
        $this->mod_repo = $mod_repo;
        $this->rein = $rein;
    }

    public function index(Request $request){

        $type = $request->get("type");

        $response = "";

        $id_enrollment = $request->get("id_student");

        if($type == "list"){

            $response =  $this->re->getEnrollmentByIdStudent($id_enrollment);

        } else {

        }

        return response()->json(
            [
                "data" => $response

            ], 200 );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEspecializationByEnrollment(Request $request){

        if( $request->get("id_student") ){

            $id_student = $request->get("id_student");

            $response = "";

            $rs = $this->re->getEnrollmentByStudent($id_student);

            foreach ($rs as $r) {

                $especialization = $this->esp_repo->getById($r->cod_esp);

                $response[] = array(
                    "esp_name" =>  $especialization->nom_esp,
                    "esp_id"   =>  $especialization->id,
                    "id_enrollment" => $r->id
                );
            }

            return response()->json(
                [
                    "data" => $response

                ], 200 );

        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getModuleByIdEspecialization(Request $request){



        // Get Info Module
        //$rs = $this->re->getEnrollmentByStudent($id_student);
        $response = [];

        $rs_en = $this->mod_repo->getModuleByIdEspecialization( $request->get("id_esp") );

        $x = 0;
        $prom_total_module = 0;

        foreach ($rs_en as $r) {

            $rs_exam         = $this->cal_repo->getExamByIdModule(11, $r->id, $request->get("id_enrollment"));
            $rs_calification = $this->cal_repo->getCalificationByIdModule($r->id, $request->get("id_enrollment"));

            $num_nota_taller = 0;
            $workshops = [];


            foreach ($rs_calification as $r_c) {
                $num_nota_taller = $num_nota_taller + $r_c['num_nota'];
                $workshops[] = array(
                        "num_nota"   => $r_c['num_nota'],
                        "cod_taller" => $r_c['cod_taller']
                );


            }
            $header =  5 - count($rs_calification);
            for ($i = 1; $i <= $header; $i++) {
                $workshops[] = array(
                    "num_nota"   => "",
                    "cod_taller" => ""
                );
            }


            $note_project = $this->rein->getByIdEnrollmentAndIdType($request->get("id_enrollment"), 1);
            $note_sustent = $this->rein->getByIdEnrollmentAndIdType($request->get("id_enrollment"), 2);

            $prom_susten_project = ($note_project['num_nota'] * 0.5) + ($note_sustent['num_nota'] * 0.5);

            if($num_nota_taller != 0){

                $prom_taller = number_format(($num_nota_taller / count($rs_calification)), 2, '.', '');


                $prom_module = number_format(( (0.3 * $prom_taller) + (0.7 * $rs_exam['num_nota']) ), 2, '.', '');


                $prom_final  = number_format(( (0.5 * $prom_module) + (0.5 * $prom_susten_project) ), 2, '.', '');

                $x = $x + 1;
                $response[] = array(
                    "idx"           => $x,
                    "module_id"     => $r->id,
                    "module_name"   => $r->nombre,
                    "exam"          => $rs_exam['num_nota'],
                    "workshops"     => $workshops,
                    "prom_taller"   => $prom_taller,
                    "prom_module"   => $prom_module,
                    "prom_final"    => $prom_final
                );

                $prom_total_module = $prom_total_module + $prom_module;

            }


        }

        return response()->json(
            [
                "data"      => $response,
                "data_2"    => array(
                                    "prom_module_final"     => number_format(($prom_total_module / $x), 2, '.', ''),
                                    "prom_project"          => $note_project,
                                    "prom_sustent_project"   => $prom_susten_project
                )

            ], 200 );

    }
}
