<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\EnrollmentRepository;
use Illuminate\Http\Request;
use App\Http\Requests;


class EnrollmentResource extends Controller
{
    private $re;

    public function __construct(
        EnrollmentRepository $re
    )
    {
        $this->re = $re;
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

}
