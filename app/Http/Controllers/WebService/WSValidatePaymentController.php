<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;

use App\Models\StudentPayment;
use App\Repositories\Eloquents\EnrollmentPMRepository;
use App\Repositories\Eloquents\EnrollmentRepository;
use App\Repositories\Eloquents\EpmConceptRepository;
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

        $epm_repo         = new EnrollmentPMRepository();
        $enro_repo        = new EnrollmentRepository();
        $concept_repo     = new PaymentConceptRepository();
        $epm_repo_concept = new EpmConceptRepository();

        $response_concepts = array();

        // Información de la inscripción
        $response_enrollment = $enro_repo->getInfoEnrollment($id_enrollment);

        // Información de la forma de pago
        $epm = $epm_repo->getByIdEnrollment($id_enrollment);

        if($epm){

            $concepts = $epm_repo_concept->getByIdEpm($epm->id);

            if($concepts){

                foreach ($concepts as $concept) {

                    $concept_name =  $concept_repo->getById($concept->id_concept);

                    $response_concepts[] = array(
                        'id'                => $concept->id,
                        'concept_id'        => $concept->id_concept,
                        'concept_name'      => $concept_name->payment_concept_name,
                        'concept_amount'    => $concept->amount,
                        'concept_verifided' => ($concept->verified == 1)? true : false
                    );

                }

                return response()->json(array("inscription" => $response_enrollment, "concepts" => $response_concepts), 200);

            }else{

                return response()->json(array("inscription" => $response_enrollment, "message" => "No hay conceptos disponibles"), 200);

            }

        } else {

            return response()->json(array("inscription" => $response_enrollment, "message" => "Aun no hay forma de pago disponible para esta inscripción"), 200);

        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeValidatePayment(Request $request){

        $epm_repo_concept = new EpmConceptRepository();

        $arr_concept_ids       = $request->get("enrollment_concept_id");        // Identidicador de los conceptos
        $arr_concept_verifieds = $request->get("enrollment_concept_verified_"); // Verificación de checks


        if($arr_concept_ids){

            foreach ($arr_concept_ids as $key => $concept_id) {

                $epm_repo_concept->update($concept_id, array(
                    'verified' => $arr_concept_verifieds[$key],
                ));

            }

        }

        return response()->json(array("message" => "Los conceptos fueron verificados satisfactoriamente"), 200);

    }


}
