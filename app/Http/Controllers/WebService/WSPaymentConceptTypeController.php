<?php

namespace App\Http\Controllers\WebService;

use App\Repositories\Eloquents\PaymentConceptTypeRepository;
use App\Repositories\Eloquents\PaymentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class WSPaymentConceptTypeController extends Controller
{
    private $orm;
    private $orm_payment;
    
    public function __construct()
    {
        $this->orm = new PaymentConceptTypeRepository();
        $this->orm_payment = new PaymentRepository();

    }

    public function getConcepts($id_enrollment, $id_payment_method){

        // Pago
        $payment = $this->orm_payment->getPayments($id_enrollment, $id_payment_method);


        $response = $this->orm->getConceptsByParameters($id_payment_method);

        if($response){


            return response()->json(array("response" => $payment->toArray()), 200);
            
        } else {
            return response()->json(array("message" => "Sin conceptos disponibles"), 200);
        }


    }

}
