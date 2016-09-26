<?php

namespace App\Http\Controllers\WebService;

use App\Models\Grupo;
use App\Models\Enrollment;
use App\Http\Controllers\Controller;
use App\Models\Horario;
use App\Models\ReportCard;
use Illuminate\Http\Request;

use App\Http\Requests;

class WSReportCardController extends Controller
{
    /**
     * Lista de reporte de notas
     * @param $id_group
     * @param $id_module
     * @return \Illuminate\Http\JsonResponse
     */
    public function ReportCardEnrollment($id_group, $id_module)
    {

        $group = Grupo::find($id_group);
        $header  = '';
        $body    = '';
        $builder = [];

        if($group){
            
            if($group->group_enrollment){

                foreach ($group->group_enrollment as $item) {

                    $enrollment = Enrollment::find($item->id_enrollment);

                    $body[] = array(
                        "id"     => $item->id_enrollment,
                        "name"   => $enrollment->student->persona->nombre.", ".$enrollment->student->persona->ape_pat." ".$enrollment->student->persona->ape_mat,
                        "report" => $this->ReportCardModules($item->id_enrollment, $id_module, $group, $header)
                    );

                }

            }

            // Generando la cabecera del listado
            foreach ($group->group_horary as $horary) {
                if($horary->cod_mod == $id_module) {
                    for ($n = 1; $n <= $horary->num_taller; $n++)
                    $header[] = array("title" => "Taller " . $n);
                    break;
                }
            }

        }


        $builder = array("body" => $body, "header" => $header);

        return response()->json(array("response" => $builder), 200);

    }

    /**
     * Lista las notas dependiendo el modulo seleccionado
     * @param $id_enrollment
     * @param $id_module
     * @param $group
     * @param $header
     * @return array
     */
    public function ReportCardModules($id_enrollment, $id_module, $group, &$header)
    {
        $rows = [];

        foreach ($group->group_horary as $horary) {

            if($horary->cod_mod == $id_module)
            {

                for ($n = 1; $n <= $horary->num_taller; $n++)
                {

                    // Muestra la nota registrada anteriormente
                    $report_card = ReportCard::where("cod_matricula", $id_enrollment)
                        ->where("cod_modulo", $id_module)
                        ->where("cod_taller", $n)
                        ->select('id', 'num_nota', 'cod_taller')->first();

                    // Si existe lo mostramos
                    if($report_card){

                        $rows[] = array(
                            "nota" =>
                                [
                                    'id'       => $report_card->id,
                                    'num_nota' => $report_card->num_nota
                                ]
                        );

                    // Caso contrario colocamos los valores en cero
                    }else{

                        $rows[] = array(
                            "nota" =>
                                [
                                    'id'       => 0,
                                    'num_nota' => 0
                                ]
                        );

                    }


                }

                break;
            }

        }

        return $rows;

    }

}
