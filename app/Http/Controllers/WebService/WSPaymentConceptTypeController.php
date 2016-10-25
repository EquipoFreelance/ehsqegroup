<?php

namespace App\Http\Controllers\WebService;

use App\Repositories\Eloquents\PaymentConceptTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class WSPaymentConceptTypeController extends Controller
{
    private $orm;
    
    public function __construct()
    {
        $this->orm = new PaymentConceptTypeRepository();
    }

    public function getConcepts($id_payment_method){

        $response = $this->orm->getConceptsByParameters($id_payment_method);
        if($response){
            return response()->json(array("response" => $response), 200);
        } else {
            return response()->json(array("message" => "Sin conceptos disponibles"), 200);
        }


    }

}
