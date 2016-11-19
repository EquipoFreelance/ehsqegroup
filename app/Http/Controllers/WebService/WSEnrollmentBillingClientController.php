<?php

namespace App\Http\Controllers\WebService;

use App\Repositories\Eloquents\EbcRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EnrollmentBillingClient;
use App\Http\Requests;

class WSEnrollmentBillingClientController extends Controller
{
    /*public function store(Request $request){

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

    }*/


    public function show($id_enrollment){

        $rs = EnrollmentBillingClient::where("id_enrollment", $id_enrollment);

        if($rs){

            $data = $rs->first();
            if($data){
                return response()->json($data->toArray(), 200);
            }


        }


    }

}
