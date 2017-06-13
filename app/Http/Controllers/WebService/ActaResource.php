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

use App\Repositories\Eloquents\EspecializationRepository;
use App\Repositories\Eloquents\GroupRepository;
use Illuminate\Http\Request;

class ActaResource extends Controller
{
    private $r_acta;
    private $r_esp;
    private $r_group;

    public function __construct(
        ActaRepository $r_acta,
        EspecializationRepository $r_esp,
        GroupRepository $r_group
    )
    {
            $this->r_acta = $r_acta;
            $this->r_esp  = $r_esp;
            $this->r_group = $r_group;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){

        if( $request->get("id_group") ){

            $group = $this->r_group->getById($request->get("id_group"));

            return response()->json(
                [
                    "response" => array(
                        "header" => array(
                            "especialization" => $group->especializacion->nom_esp,
                            "place"           => $group->sede->nom_local,
                            "schedule"        => "SABADOS 3 - 7 PM.",
                            "duration"        => "6 Meses",
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
                                    "08"
                                )
                            ),
                            "modules" => array(
                                array(
                                    "id"        => 001,
                                    "name"      => "Nombre de la especialización",
                                    "teacher"   => "Juan Rodas",
                                    "date"      => "01/06/2017"
                                ),
                                array(
                                    "id"        => 002,
                                    "name"      => "Nombre de la especialización",
                                    "teacher"   => "Juan Rodas",
                                    "date"      => "01/06/2017"
                                ),
                                array(
                                    "id"        => 003,
                                    "name"      => "Nombre de la especialización",
                                    "teacher"   => "Juan Rodas",
                                    "date"      => "01/06/2017"
                                ),
                                array(
                                    "id"        => 004,
                                    "name"      => "Nombre de la especialización",
                                    "teacher"   => "Juan Rodas",
                                    "date"      => "01/06/2017"
                                ),
                                array(
                                    "id"        => 005,
                                    "name"      => "Nombre de la especialización",
                                    "teacher"   => "Juan Rodas",
                                    "date"      => "01/06/2017"
                                ),
                                array(
                                    "id"        => 006,
                                    "name"      => "Nombre de la especialización",
                                    "teacher"   => "Juan Rodas",
                                    "date"      => "01/06/2017"
                                )
                            ),
                            "data" => array(
                                array(
                                    "order"     => "1",
                                    "code"      => "001",
                                    "firstname" => "Juan",
                                    "lastname"  => "Rodas",
                                    "notes"     => array(
                                        "id"   => "001",
                                        "note" => array("01","02", "03", "04", "05"),
                                        "prom_mod"       => "12",
                                        "prom_pro_imp"   => "12",
                                        "prom_pro_final" => "12.5"
                                    )
                                ),
                                array(
                                    "order"     => "2",
                                    "code"      => "002",
                                    "firstname" => "Juan",
                                    "lastname"  => "Rodas",
                                    "notes"     => array(
                                        "id"   => "001",
                                        "note" => array("01","02", "03", "04", "05"),
                                        "prom_mod"       => "12",
                                        "prom_pro_imp"   => "12",
                                        "prom_pro_final" => "12.5"
                                    )
                                ),
                                array(
                                    "order"     => "3",
                                    "code"      => "003",
                                    "firstname" => "Juan",
                                    "lastname"  => "Rodas",
                                    "notes"     => array(
                                        "id"   => "001",
                                        "note" => array("01","02", "03", "04", "05"),
                                        "prom_mod"       => "12",
                                        "prom_pro_imp"   => "12",
                                        "prom_pro_final" => "12.5"
                                    )
                                ),
                                array(
                                    "order"     => "4",
                                    "code"      => "004",
                                    "firstname" => "Juan",
                                    "lastname"  => "Rodas",
                                    "notes"     => array(
                                        "id"   => "001",
                                        "note" => array("01","02", "03", "04", "05"),
                                        "prom_mod"       => "12",
                                        "prom_pro_imp"   => "12",
                                        "prom_pro_final" => "12.5"
                                    )
                                ),
                                array(
                                    "order"     => "5",
                                    "code"      => "005",
                                    "firstname" => "Juan",
                                    "lastname"  => "Rodas",
                                    "notes"     => array(
                                        "id"   => "001",
                                        "note" => array("01","02", "03", "04", "05"),
                                        "prom_mod"       => "12",
                                        "prom_pro_imp"   => "12",
                                        "prom_pro_final" => "12.5"
                                    )
                                ),
                                array(
                                    "order"     => "6",
                                    "code"      => "006",
                                    "firstname" => "Juan",
                                    "lastname"  => "Rodas",
                                    "notes"     => array(
                                        "id"   => "001",
                                        "note" => array("01","02", "03", "04", "05"),
                                        "prom_mod"       => "12",
                                        "prom_pro_imp"   => "12",
                                        "prom_pro_final" => "12.5"
                                    )
                                )
                            )
                        )
                    ),
                ], 200 );

        }

    }

}