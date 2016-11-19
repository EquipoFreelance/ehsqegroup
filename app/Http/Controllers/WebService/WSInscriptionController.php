<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\EbcRepository;
use App\Repositories\Eloquents\EnrollmentPMRepository;
use App\Repositories\Eloquents\EpmCondicionalRepository;
use App\Repositories\Eloquents\EpmFraccionadoRepository;
use App\Repositories\Eloquents\EpmTotalRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class WSInscriptionController extends Controller
{
    /**
     * Muestra el detalle de la matricula con la inscripción
     * @param $id_enrollment
     * @return \Illuminate\Http\JsonResponse
     */
    public function showInscription($id_enrollment){

        $epm_repo = new EnrollmentPMRepository();
        $ebc_repo = new EbcRepository();

        // Forma de Pago
        $epm = $epm_repo->getByIdEnrollment($id_enrollment);

        if($epm){

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

            $epm_merge = array('forma_pago' => $epm->toArray());



        }

        // Datos de la facturación
        $ebc = $ebc_repo->getByIdEnrollment($id_enrollment);
        if($ebc){

            $ebc_merge = array('billing_client' => $ebc_repo->getById($ebc->id));

        }

        $response = array_merge($epm_merge, $ebc_merge);

        return response()->json($response, 200);

    }

    /**
     * Registra o actualiza los datos de la forma de pago
     * storePaymentMethod
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePaymentMethod(Request $request){

        try {

            $epm_repo = new EnrollmentPMRepository();

            // Buscar forma de pago
            $epm = $epm_repo->getByIdEnrollment($request->get("id_enrollment"));

            // Si Existe el registro, actualizamos
            if($epm){

                $action = $epm_repo->update($epm->id, $request->toArray());

                // Registramos por primera vez
            } else {

                $action = $epm_repo->create($request->toArray());
            }

            return $action;


        } catch (Exception $e) {

            return response()->json(array("data" => $e->getMessage()), 400);
        }

    }

    /**
     * Registra y actualiza los datos de la facturación
     * storeBillingClient
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeBillingClient(Request $request){

        $ebc_repo = new EbcRepository();

        // Prepare request
        $p_request = array(
            "id_enrollment"     => $request->get("id_enrollment"),
            "razon_social"      => $request->get("billing_razon_social"),
            "ruc"               => $request->get("billing_ruc"),
            "phone"             => $request->get("billing_phone"),
            "address"           => $request->get("billing_address"),
            "client_firstname"  => $request->get("billing_client_firstname"),
            "client_lastname"   => $request->get("billing_client_lastname")
        );

        $ebc = $ebc_repo->getByIdEnrollment($request->get("id_enrollment"));

        if(!$ebc){

            $action = $ebc_repo->create($p_request);

        } else {

            $action = $ebc_repo->update($ebc->id, $p_request);
        }

        return $action;

    }


    public function showListInscription(){

    }
}
