<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Repositories\Eloquents\EnrollmentPMRepository;
use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\EpmCondicionalRepository;
use App\Repositories\Eloquents\EpmFraccionadoRepository;
use App\Repositories\Eloquents\EpmTotalRepository;
use App\Repositories\Eloquents\PaymentConceptRepository;
use App\Repositories\Eloquents\PaymentConceptTypeRepository;
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

        $epm_repo      = new EnrollmentPMRepository();
        $pct           = new PaymentConceptTypeRepository();
        $concept_repo  = new PaymentConceptRepository();
        $enro_repo     = new EnrollmentRepository();

        $response_concepts = array();

        $epm = $epm_repo->getByIdEnrollment($id_enrollment);

        if($epm){

            // Id de la Forma de Pago
            $id_payment_method = $epm->id_payment_method;

            // Conceptos disponibles
            $concepts = $pct->getConceptsByParameters($id_payment_method);

            // Total
            if($id_payment_method == 1){

                $epm_repo_total = new EpmTotalRepository();

                $epm_total = $epm_repo_total->getByIdEpm($epm->id);

                // Lista de conceptos disponibles
                foreach ($concepts as $concept) {

                    $concept_name =  $concept_repo->getById($concept->id_payment_concept);

                    // Concepto Pago Total
                    if($concept->id_payment_concept == 9){

                        $response_concepts[] = array(
                            'concept_name'   => $concept_name->payment_concept_name,
                            'concept_amount' => $epm_total->amount
                        );
                        break;

                    }

                }

            // Fraccionado
            } else if($id_payment_method == 2){

                $epm_repo_fra = new EpmFraccionadoRepository();

                $epm_fra = $epm_repo_fra->getByIdEpm($epm->id);

                // Lista de conceptos disponibles
                foreach ($concepts as $concept) {

                    $concept_name =  $concept_repo->getById($concept->id_payment_concept);

                    // Cuota 1
                    if($concept->id_payment_concept == 3){

                        $response_concepts[] = array(
                            'concept_name'   => $concept_name->payment_concept_name,
                            'concept_amount' => $epm_fra->amount
                        );
                        break;

                    }


                }

                // Otros conceptos (Matricula o Certificado)
                $otros_conceptos = $epm_fra->other_concepts;

                foreach ($otros_conceptos as $otro_concepto) {

                    $concept_name =  $concept_repo->getById($otro_concepto['id_concept']);

                    $response_concepts[] = array(
                        'concept_name'   => $concept_name->payment_concept_name,
                        'concept_amount' => $otro_concepto['amount']
                    );

                }


            // Condicional
            } else if($id_payment_method == 3){

                $epm_repo_con = new EpmCondicionalRepository();

                $epm_con = $epm_repo_con->getByIdEpm($epm->id);

                foreach ($epm_con as $condicional) {

                    $concept_name =  $concept_repo->getById($condicional->id_concept);

                    $response_concepts[] = array(
                        'concept_name'   => $concept_name->payment_concept_name,
                        'concept_amount' => $condicional->amount
                    );

                }

            }

            // Información del inscripción
            $response_enrollment = $enro_repo->getInfoEnrollment($id_enrollment);

            return response()->json(array("inscription" => $response_enrollment, "concepts" => $response_concepts), 200);


        }

    }


    public function storeValidatePayment(Request $request){

    }
}
