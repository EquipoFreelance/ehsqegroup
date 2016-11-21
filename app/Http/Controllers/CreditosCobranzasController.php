<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Enrollment;

use App\Repositories\Eloquents\EnrollmentPaymentConceptRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class CreditosCobranzasController extends Controller
{
    public function index(){
        return view('creditos.index');
    }

    public function getVerifyPayment($id_enrollment){

        $data = compact('id_enrollment');
        return view('creditos.verify_payment', $data);

    }

}
