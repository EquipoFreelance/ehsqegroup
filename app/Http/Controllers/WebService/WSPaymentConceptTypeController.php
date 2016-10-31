<?php

namespace App\Http\Controllers\WebService;

use App\Repositories\Eloquents\PaymentConceptRepository;
use App\Repositories\Eloquents\EnrollmentPaymentConceptRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class WSPaymentConceptTypeController extends Controller
{
    private $orm_concept_type;
    private $orm_concept;

    public function __construct()
    {
        $this->orm_concept_type = new EnrollmentPaymentConceptRepository();
        $this->orm_concept      = new PaymentConceptRepository();
    }

    /**
     * Muestra los conceptos asociados a la forma de pago
     * @param $id_enrollment
     * @param $id_payment_method
     * @return $payment_detail
     */
    public function getEnrollmentConcepts($id_enrollment){

        // Verificando existencia del Pago
        $enrollment_concept = $this->orm_concept_type->getPaymentConcepts($id_enrollment);

        if($enrollment_concept){

            // Calculamos el monto
            $concept = $enrollment_concept->toArray();

            foreach ($concept as $item) {


                $payment_detail[] = array(
                    "id"                       => $item['id'],
                    "id_enrollment"            => $item['id_enrollment'],
                    "id_concept_payment_type"  => $item['id_concept_payment_type'],
                    "amount"                   => $item['amount'],
                    "active"                   => $item['active'],
                    "name_concept"             => $this->orm_concept->getByNameConcept($item['id_concept_payment_type'])
                );

            }

            return response()->json(array("response" => $payment_detail), 200);

        } else {
            return response()->json(array("response" => ""), 400);
        }


    }

}
