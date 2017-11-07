<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 05/06/2017
 * Time: 03:56 PM
 */

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\ActaRepository;

use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\EspecializationRepository;
use App\Repositories\Eloquents\GroupRepository;
use App\Repositories\Eloquents\HoraryRepository;
use App\Repositories\Eloquents\ModuleRepository;
use App\Repositories\Eloquents\PersonRepository;
use App\Repositories\Eloquents\ReportCardRepository;
use App\Repositories\Eloquents\TeacherRepository;
use App\Repositories\Eloquents\EImplementationNoteRepository;
use Illuminate\Http\Request;

class ActaResource extends Controller
{
    private $r_acta;
    private $r_esp;
    private $r_group;
    private $r_horary;
    private $r_module;
    private $r_teacher;
    private $r_person;
    private $r_enrollment;
    private $r_report;
    private $rein;

    public function __construct(
        ActaRepository $r_acta,
        EspecializationRepository $r_esp,
        GroupRepository $r_group,
        HoraryRepository $r_horary,
        ModuleRepository $r_module,
        TeacherRepository $r_teacher,
        PersonRepository $r_person,
        EnrollmentRepository $r_enrollment,
        ReportCardRepository $r_report,
        EImplementationNoteRepository $rein

    )
    {
            $this->r_acta       = $r_acta;
            $this->r_esp        = $r_esp;
            $this->r_group      = $r_group;
            $this->r_horary     = $r_horary;
            $this->r_module     = $r_module;
            $this->r_teacher    = $r_teacher;
            $this->r_person     = $r_person;
            $this->r_enrollment = $r_enrollment;
            $this->r_report     = $r_report;
            $this->rein = $rein;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){

        if( $request->get("id_group") ){

            $group = $this->r_group->getById($request->get("id_group"));

            $g_enrollments  = $group->group_enrollment;

            /* Horaries */
            $horary = $this->r_horary->getIdByGroup($request->get("id_group"));

            $ids_mod_horary = $this->r_horary->getIdByGroupIdModules($request->get("id_group"));
            
            $ids_modules = array();
            
            foreach ($ids_mod_horary as $id_mod_horary) {
                $ids_modules[] = $id_mod_horary->cod_mod;
            }
            //exit();
            /*print_r($ids_modules);
            exit();*/

            if($horary->monday){
                $day_week = $this->r_horary->getDayWeek(0);
            } else if($horary->sunday){
                $day_week = $this->r_horary->getDayWeek(1);
            } else if($horary->tuesday){
                $day_week = $this->r_horary->getDayWeek(2);
            } else if($horary->wednesday){
                $day_week = $this->r_horary->getDayWeek(3);
            } else if($horary->thursday){
                $day_week = $this->r_horary->getDayWeek(4);
            } else if($horary->friday){
                $day_week = $this->r_horary->getDayWeek(5);
            } else if($horary->saturday){
                $day_week = $this->r_horary->getDayWeek(6);
            }

            /* Modules */
            //$modules = $this->r_module->getModuleByIdEspecialization($group->especializacion->id);

            $modules = $this->r_module->getModuleByIdEspecializationWhereIn($ids_modules);
            $ar_modules = array();
            
            foreach ($modules as $module) {
                
                $id_teacher = $this->r_horary->getIdByGroupAndIdByModule($request->get("id_group"), $module->id)->cod_docente;

                $teacher = $this->r_teacher->getById($id_teacher);

                $person = $this->r_person->getById($teacher->cod_persona);

                $ar_modules[] = array(
                                        "id"         => $module->id,
                                        "name"       => $module->nom_corto,
                                        "name_corto" => $module->nom_corto,
                                        "teacher"    => $person->nombre." ".$person->ape_pat." ".$person->ape_mat,
                                        "date"       => "",
                                );


            }


            /* Alumnos matriculados asignados en el grupo */

            $g_enrollments  = $group->group_enrollment;
            $ar_enrollments = array();
            $proms = 0;
            $order = 0;
            foreach ($g_enrollments as $g_e) {

                $order += 1;
                $find_enrollment = $this->r_enrollment->getById($g_e->id_enrollment);

                $person = $this->r_person->getById($find_enrollment->student['cod_persona']);

                $ar_enrollments[] = array(
                    "order"     => $order,
                    "code"      => $g_e->id_enrollment,
                    "firstname" => trim($person->nombre),
                    "lastname"  => trim($person->ape_pat." ".$person->ape_mat),
                    "notes"     => $this->armandoModules($g_e->id_enrollment, $ar_modules, $proms),
                    "proms"     => $proms
                );

            }


            return response()->json(
                [
                    "response" => array(
                        "header" => array(
                            "especialization" => $group->nom_grupo." / ".$group->especializacion->nom_esp ,
                            "place"           => $group->sede->nom_local,
                            "schedule"        => $day_week." ".$horary->h_inicio." ".$horary->h_fin,
                            "duration"        => "Del ".$horary->fec_inicio." al ".$horary->fec_fin,
                            "observation"     => ""
                        ),
                        "body" => array(
                            "header" => array(
                                "group_count_esp" => array(
                                    "01",
                                    "02",
                                    "03",
                                    "04",
                                    "05",
                                    "06",
                                    "07",
                                    "08",
                                    "09",
                                    "10",
                                    "11",
                                    "12"
                                )
                            ),
                            "modules" => $ar_modules,
                            "data"    => $ar_enrollments
                        )
                    ),
                ], 200 );

        }

    }

    public function armandoModules($id_enrollment, $ar_modules, &$proms){

        $ar_notes = array();

        /* Ids de modulos */
        foreach ($ar_modules as $ar_module ) {

            // Obteniendo nota de los talleres por el id de la matricula y el id del modulo
            $report_card = $this->r_report->getByIdEnrollmentAndByIdModule($id_enrollment, $ar_module['id']);
            if($report_card){

                $count_talleres    = 0;
                $sum_nota_talleres = 0;
                $final_nota_examen = 0;

                foreach ($report_card as $r_c) {

                    // Validaci¨®n para solo talleres
                    if( $r_c->cod_taller != 11){

                        $count_talleres    = $count_talleres + 1;
                        $sum_nota_talleres = $sum_nota_talleres + $r_c->num_nota;   // Sumatoria de talleres

                    // Solo examenes
                    } else if($r_c->cod_taller == 11){

                        $final_nota_examen = $r_c->num_nota;

                        //break;

                    }

                }

                // Calculando promedio final de talleres
                $prom_talleres = 0;
                if($sum_nota_talleres > 0){
                    $prom_talleres = ($sum_nota_talleres / $count_talleres);
                }


            }


            // Calculando el promedio del modulo
            $prom_modulo = ($prom_talleres * 0.3) + ($final_nota_examen * 0.7);

            if($prom_modulo == 0){
                $prom_modulo = '';
            }

            $ar_notes[] = array(
                "id_module"     => $ar_module['id'],
                "prom_modulo"   => round($prom_modulo, 2)
            );

        }

        // Calculando el promedio final de los modulos
        $sum_prom_modulos = 0;
        $prom_modulos     = 0;
        $count_ok_prom_modulo = 0;
        foreach ($ar_notes as $ar_note) {

            if($ar_note['prom_modulo'] > 0){
                $count_ok_prom_modulo = $count_ok_prom_modulo + 1;
            }

            $sum_prom_modulos = $sum_prom_modulos + $ar_note['prom_modulo'];
        }

        if($sum_prom_modulos > 0){
            $prom_modulos = ( $sum_prom_modulos / $count_ok_prom_modulo );
        }



        // Calculando nota de proyecto y sustentaci¨®n
        $note_project = $this->rein->getByIdEnrollmentAndIdType($id_enrollment, 1);
        $note_sustent = $this->rein->getByIdEnrollmentAndIdType($id_enrollment, 2);

        $prom_susten_project = ($note_project['num_nota'] * 0.5) + ($note_sustent['num_nota'] * 0.5);



        $prom_final  = number_format(( (0.5 * $prom_modulos) + (0.5 * $prom_susten_project) ), 2, '.', '');

        if(count($ar_notes) < 12){
            $dscto = 12 - count($ar_notes);
            for($i = 1; $i <= ($dscto); $i++){

                $ar_notes[] = array(
                    "id_module"   => 0,
                    "prom_modulo" => ''
                );

            }
        }


        $proms = array("prom_modulos" => number_format($prom_modulos, 2, '.', '') , "prom_imple" => $prom_susten_project, 'prom_final' => $prom_final);

        return $ar_notes;
    }

}