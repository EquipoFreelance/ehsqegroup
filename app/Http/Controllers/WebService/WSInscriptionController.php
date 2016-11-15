<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\EnrollmentPMRepository;
use App\Repositories\Eloquents\EpmCondicionalRepository;
use App\Repositories\Eloquents\EpmFraccionadoRepository;
use App\Repositories\Eloquents\EpmTotalRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class WSInscriptionController extends Controller
{
    // Muestra el detalle de la matricula con la inscripción
    public function showInscription($id_enrollment){

        // Forma de Pago
        $epm_repo = new EnrollmentPMRepository();

        $epm = $epm_repo->getByIdEnrollment($id_enrollment);

        // Pago Total
        if($epm->id_payment_method == 1){
            $epm_type = new EpmTotalRepository();
        // Pago Fraccionado
        } else if ($epm->id_payment_method == 2){
            $epm_type = new EpmFraccionadoRepository();
        // Pago Condicional
        } else if ($epm->id_payment_method == 3){
            $epm_type = new EpmCondicionalRepository();
        }

        $epm->form_pago_detalle = $epm_type->getByIdEpm($epm->id);

        $response = array('forma_pago' => $epm->toArray());

        return response()->json($response, 200);

    }

}
