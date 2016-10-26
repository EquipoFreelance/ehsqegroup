<?php

namespace App\Http\Controllers\WebService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EnrollmentBillingClient;
use App\Http\Requests;

class WSEnrollmentBillingClientController extends Controller
{
    public function store(Request $request){

        $exist = EnrollmentBillingClient::where("id_enrollment", $request->get("id_enrollment") );

        if($exist->count() > 0){

            $row = $exist->first();

            $billing_client = $this->update($request, $row->id);

            return $billing_client;

        } else {

            $billing_client = EnrollmentBillingClient::create(
                array(
                    "id_enrollment"     => $request->get("id_enrollment"),
                    "razon_social"      => $request->get("billing_razon_social"),
                    "ruc"               => $request->get("billing_ruc"),
                    "phone"             => $request->get("billing_phone"),
                    "address"           => $request->get("billing_address"),
                    "client_firstname"  => $request->get("billing_client_firstname"),
                    "client_lastname"   => $request->get("billing_client_lastname")
                )
            );

            return response()->json(array("data" => $billing_client->toArray(), "message" => "Los datos de la facturación fue registrada satisfactoriamente"), 200);

        }




    }

    public function update(Request $request, $id){

        $billing_client = EnrollmentBillingClient::findOrFail($id);
        $billing_client->fill(array(
            "id_enrollment"     => $request->get("id_enrollment"),
            "razon_social"      => $request->get("billing_razon_social"),
            "ruc"               => $request->get("billing_ruc"),
            "phone"             => $request->get("billing_phone"),
            "address"           => $request->get("billing_address"),
            "client_firstname"  => $request->get("billing_client_firstname"),
            "client_lastname"   => $request->get("billing_client_lastname")
        ))->save();
        return response()->json(array("data" => $billing_client->toArray(), "message" => "Los datos de la facturación fue actualizados satisfactoriamente"), 200);

    }

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
