<?php

namespace App\Http\Controllers\WebService;

use App\Repositories\Eloquents\EnrollmentPMRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class WSEnrollmentPaymentMethodController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){

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


}
