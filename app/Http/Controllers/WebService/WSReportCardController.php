<?php

namespace App\Http\Controllers\WebService;

use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Enrollment;
use App\Http\Controllers\Controller;
use App\Models\ReportCard;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
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
                        "report" => $this->ReportCardModules($item->id_enrollment, $id_module, $group, $header, $average),
                        "average" => $average,
                        "enrollment" => $item->id_enrollment
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

            $header[] = array("title" => "Examen");

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
    public function ReportCardModules($id_enrollment, $id_module, $group, &$header, &$average)
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

                        if(fmod($report_card->num_nota, 1) !== 0.00){

                            // your code if its decimals has a value
                            $nota = number_format($report_card->num_nota, 1, '.', '');
                        } else {
                            $nota = number_format($report_card->num_nota, 0, '.', '');
                        }

                        $rows[] = array(
                            "nota" =>
                                [
                                    'id'            => $report_card->id,
                                    'num_nota'      => $nota,
                                    'cod_matricula' => $report_card->cod_matricula,
                                    'cod_taller'    => $n
                                ]
                        );

                    // Caso contrario colocamos los valores en cero
                    }else{

                        $rows[] = array(
                            "nota" =>
                                [
                                    'id'            => 0,
                                    'num_nota'      => false,
                                    'cod_matricula' => $id_enrollment,
                                    'cod_taller'    => $n
                                ]
                        );

                    }


                }

                // Muestra la nota registrada anteriormente
                $report_card = ReportCard::where("cod_matricula", $id_enrollment)
                    ->where("cod_modulo", $id_module)
                    ->where("cod_taller", 11) // Identificador del examen
                    ->select('id', 'num_nota', 'cod_taller')->first();

                if($report_card) {

                    if(fmod($report_card->num_nota, 1) !== 0.00){
                        // your code if its decimals has a value
                        $nota = number_format($report_card->num_nota, 1, '.', '');
                    } else {
                        $nota = number_format($report_card->num_nota, 0, '.', '');
                    }

                    // Nota de Examen
                    $rows[] = array(
                        "nota" =>
                            [
                                'id'            => $report_card->id,
                                'num_nota'      => $nota,
                                'cod_matricula' => $report_card->cod_matricula,
                                'cod_taller'    => 11
                            ]
                    );



                } else {

                    // Nota de Examen
                    $rows[] = array(
                        "nota" =>
                            [
                                'id'            => 0,
                                'num_nota'      => false,
                                'cod_matricula' => $id_enrollment,
                                'cod_taller'    => 11
                            ]
                    );

                }

                break;
            }

        }

        // Nota final de talleres
        $sum_nota_talleres = 0;
        $n = 0;
        foreach ($rows as $row) {
            if($row["nota"]['cod_taller'] != 11){
                $n = $n + 1;
                $sum_nota_talleres = $sum_nota_talleres + $row["nota"]['num_nota'];
            }
        }

        $final_nota_taller = $this->getCalculateAverage($n, $sum_nota_talleres);


        // Nota examen del modulo
        $final_nota_examen = 0;
        foreach ($rows as $row) {
            if($row["nota"]['cod_taller'] == 11){
                $final_nota_examen = $row["nota"]['num_nota'];
                break;
            }
        }

        // Promedio modulo
        $average = ($final_nota_taller * 0.3) + ($final_nota_examen * 0.7);

        return $rows;

    }

    /**
     * Save Report Card
     * @param Request $request
     */
    public function ReportCardStore(Request $request){

        $ids            = $request->get("id_num_nota");
        $cod_grupo      = $request->get("group");
        $ids_matricula  = $request->get("id_matricula");
        $cod_modulo     = $request->get("cod_mod");
        $ids_taller     = $request->get("id_taller");

        $teacher        = Docente::where("cod_persona", Auth::user()->cod_persona )->first();

        foreach ($request->get("num_nota") as $key => $value)
        {
            if($value >= 0 && $value != ''){

                if($ids[$key] > 0){

                    $rc = ReportCard::findOrFail($ids[$key]);

                    if($rc){

                        if($rc->num_nota != $value)
                        {
                            $rc->fill(['num_nota' => $value])->save();

                        }

                    }

                } else {

                    $new_report_card = new ReportCard;
                    $new_report_card->fill(
                        [
                            'num_nota'      => $value,
                            'cod_matricula' => $ids_matricula[$key],
                            'cod_taller'    => $ids_taller[$key],
                            'cod_grupo'     => $cod_grupo,
                            'cod_modulo'    => $cod_modulo,
                            'cod_docente'   => $teacher->id,
                            'created_by'    => Auth::user()->id,
                            'created_at'    => Carbon::now(),
                        ]
                    )->save();

                }

            }

        }


    }

    public function getCalculateAverage($total_notas, $sum_notas){
        return ($sum_notas / $total_notas);
    }
}
