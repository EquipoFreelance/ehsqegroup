<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Models\StudentPayment;
use App\Repositories\Eloquents\EnrollmentPMRepository;
use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\EpmCondicionalRepository;
use App\Repositories\Eloquents\EpmFraccionadoRepository;
use App\Repositories\Eloquents\EpmTotalRepository;
use App\Repositories\Eloquents\PaymentConceptRepository;
use App\Repositories\Eloquents\PaymentRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class WSValidatePaymentController extends Controller
{
    /**
     * Muestra los conceptos disponibles
     * @param $id_enrollment
     * @return \Illuminate\Http\JsonResponse
     */
    public function showPaymentOfInscription($id_enrollment){

        $payment_repo  = new PaymentRepository();
        $enro_repo     = new EnrollmentRepository();
        $epm_repo      = new EnrollmentPMRepository();
        $concept_repo  = new PaymentConceptRepository();

        $response_concepts = array();

        // Información de la inscripción
        $response_enrollment = $enro_repo->getInfoEnrollment($id_enrollment);

        // Validación de pago realizados

            // Buscamos la relación
            $student_payment = StudentPayment::where('id_enrollment', $id_enrollment)->first();

            if($student_payment){

                // Id del pago realizado
                $id_payment   = $student_payment->id_payment;

                // Información del pago
                $payment      = $payment_repo->getById($id_payment);

                // Existe algun pago
                if($payment){

                    foreach ($payment->payment_detail as $concept) {

                        $concept_name =  $concept_repo->getById($concept->id_concept);

                        $response_concepts[] = array(
                            'concept_id'        => $concept->id,
                            'concept_name'      => $concept_name->payment_concept_name,
                            'concept_amount'    => $concept->amount,
                            'concept_verifided' => $concept->verified
                        );

                    }

                }


            } else {

                // Ubicando los conceptos registrados en la inscripción
                $epm = $epm_repo->getByIdEnrollment($id_enrollment);

                if($epm){

                    // Id de la Forma de Pago
                    $id_payment_method = $epm->id_payment_method;

                    $epm_repo_pm = '';

                    // Total
                    if($id_payment_method == 1){

                        $epm_repo_pm = new EpmTotalRepository();

                    // Fraccionado
                    } else if($id_payment_method == 2){

                        $epm_repo_pm = new EpmFraccionadoRepository();

                    // Condicional
                    } else if($id_payment_method == 3){

                        $epm_repo_pm = new EpmCondicionalRepository();

                    }

                    $response_concepts =  $epm_repo_pm->getConcepts($epm->id, $id_payment_method);

                }

            }

            return response()->json(array("inscription" => $response_enrollment, "concepts" => $response_concepts), 200);

    }


    public function storeValidatePayment(Request $request){

    }
}