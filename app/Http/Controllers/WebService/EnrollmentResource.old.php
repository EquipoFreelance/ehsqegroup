<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\EnrollmentRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use Psy\Exception\ErrorException;

class EspecializationResource extends Controller
{

    private $er;

    public function __construct(
        EnrollmentRepository $er
    )
    {

        $this->er = $er;

    }

    public function index(Request $request)
    {

    }

    public function getEspecializationByEnrollment(Request $request){
        if( $request->get("id_enrollment") ){

        }
    }

}
