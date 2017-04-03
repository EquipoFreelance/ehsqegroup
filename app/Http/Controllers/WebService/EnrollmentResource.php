<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\EspecializationRepository;
use Illuminate\Http\Request;
use App\Http\Requests;


class EnrollmentResource extends Controller
{
    private $re;
    private $esp_repo;

    public function __construct(
        EnrollmentRepository $re,
        EspecializationRepository $esp_repo
    )
    {
        $this->re = $re;
        $this->esp_repo = $esp_repo;
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

    public function getEspecializationByEnrollment(Request $request){

        if( $request->get("id_student") ){

            $id_student = $request->get("id_student");

            $response = "";

            $rs = $this->re->getEnrollmentByStudent($id_student);

            foreach ($rs as $r) {

                $especialization = $this->esp_repo->getById($r->cod_esp);

                $response[] = array(
                    "esp_name" =>  $especialization->nom_esp,
                    "esp_id"    =>  $especialization->id
                );
            }

            return response()->json(
                [
                    "data" => $response

                ], 200 );

        }

    }

}
