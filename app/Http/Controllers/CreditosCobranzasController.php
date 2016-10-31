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

    public function getValidaPagos($id){

        // Info of Student
        $student = Student::with('persona')->find($id);
        $data = compact('student');

        return view('creditos.edit_pagos', $data);
    }
    
    public function getUpdatePagos(Request $request){

        $repo_enrollment   = new EnrollmentPaymentConceptRepository();

        $n             = -1;
        $ids           = $request->get('enrollment_concept_id');      // Matricula id del concepto
        $actives       = $request->get('enrollment_concept_active');  // Matricula monto del concepto activo

        $check_active = 0;

        foreach ($ids as $item) {
            $n = $n + 1;
            
            if($actives[$n]){
                $check_active = 1;
            }

            $repo_enrollment->update($ids[$n], [
                'active'     => $check_active
            ]);
        }

        return response()->json(array("message" => "Los pagos fueron verificados satisfactoriamentexxx"), 200);

    }
}
