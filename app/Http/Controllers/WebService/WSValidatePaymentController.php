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
use App\Repositories\Eloquents\PaymentDetailRepository;
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
                            'id'                => $concept->id,
                            'concept_id'        => $concept->id_concept,
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeValidatePayment(Request $request){

        $payment_repo         = new PaymentRepository();
        $payment_concept_repo = new PaymentDetailRepository();

        $arr_concept_ids       = $request->get("enrollment_concept_id");        // Identidicador de los conceptos
        $arr_concept_amounts   = $request->get("enrollment_concept_amount");    // Montos
        $arr_concept_verifieds = $request->get("enrollment_concept_verified_"); // Verificación de checks
        $arr_concept_idx       = $request->get("enrollment_concept_idx");       // Id de los conceptos

        $id_enrollment         = $request->get("id_enrollment");                // Id de la matricula

        $student_payment = StudentPayment::where('id_enrollment', $id_enrollment)->first();

        if( $student_payment ){

            // Id del pago realizado
            $id_payment   = $student_payment->id_payment;

            // Información del pago
            $payment      = $payment_repo->getById($id_payment);

            // Existe algun pago
            if($payment){

                foreach ($payment->payment_detail as $concept) {

                    $key = array_search($concept->id, $arr_concept_ids);

                    $payment_concept_repo->update($concept->id, array(
                        'amount'   => $arr_concept_amounts[$key],
                        'verified' => $arr_concept_verifieds[$key],
                    ));

                }

            }

            return response()->json(array("message" => 'Los pagos fueron verificados satisfactoriamente'), 200);

        } else {

            $epm_repo     = new EnrollmentPMRepository();
            $payment_repo = new PaymentRepository();

            $amount_total = 0;

            // Calculando monto total
            foreach ($arr_concept_amounts as  $amount) {
                $amount_total = $amount_total + $amount;
            }

            // Creando el Pago
            $create = $payment_repo->create(array(
                'amount_total' => $amount_total,
                'active'       => 1,
                'verified'     => 1,
            ));

            // Creando los conceptos
            foreach ($arr_concept_amounts as $key => $concept_id) {

                $payment_concept_repo->create(array(
                    'id_concept' => $arr_concept_idx[$key],
                    'id_payment' => $create->id,
                    'quantity'   => 1,
                    'amount'     => $arr_concept_amounts[$key],
                    'verified'   => $arr_concept_verifieds[$key],
                ));

            }

            if($create){

                // Verificando existencia de la forma de pago
                $epm = $epm_repo->getByIdEnrollment($id_enrollment);

                if($epm){

                    $enro_repo = new EnrollmentRepository();

                    $enrollment = $enro_repo->getById($epm->id_enrollment);

                    // Creando la relación entre la matricula y el pago
                    StudentPayment::create(array(
                        'id_enrollment'     => $epm->id_enrollment,         // Id de la matricula
                        'id_payment_method' => $epm->id_payment_method,     // Id de la forma de pago
                        'id_payment'        => $create->id,                 // Id del pago realizado
                        'id_student'        => $enrollment->student->id     // Id de estudiante
                    ));

                }

            }

            return response()->json(array("message" => 'Los pagos fueron verificados satisfactoriamente'), 200);

        }

    }


}
