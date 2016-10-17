<?php

namespace App\Http\Controllers\WebService;

use App\Models\EnrollmentPaymentFraccionado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EnrollmentPaymentMethod;
use App\Http\Requests;

class WSEnrollmentPaymentMethodController extends Controller
{

    public function store(Request $request){

        try {

            $exist = EnrollmentPaymentMethod::where("id_enrollment", $request->get("id_enrollment") );

            if($exist->count() > 0){

                $row = $exist->first();

                $student_payment = $this->update($request, $row->id);

                $this->store_payment_method_detail($row->id, $request);

                return $student_payment;

            } else {

                $student_payment = EnrollmentPaymentMethod::create($request->all());

                return response()->json(array("data" => $student_payment->toArray(), "message" => "El medio de pago fue registrado satisfactoriamente"), 200);
            }

        } catch (Exception $e) {

            return response()->json(array("data" => $e->getMessage()), 400);
        }

    }

    public function update(Request $request, $id){

        $student_payment = EnrollmentPaymentMethod::findOrFail($id);
        $student_payment->fill($request->all())->save();
        return response()->json(array("data" => $student_payment->toArray(), "message" => "El medio de pago fue actualizado satisfactoriamente"), 200);

    }

    public function show($id_enrollment){

        $rs = EnrollmentPaymentMethod::where("id_enrollment", $id_enrollment);
        if($rs){
            $data = $rs->first();
            return response()->json($data->toArray(), 200);
        }


    }

    public function store_payment_method_detail($id_enrollment_payment, Request $request){
        
        $id_payment_method = $request->get("id_payment_method");
        $num_cuota         = $request->get("num_cuota");

        // Fraccionado
        if($id_payment_method == 2){

            // Existe algun registro con el id del medio de pago registrado
            $exist = EnrollmentPaymentFraccionado::where("id_enrollment_payment", $id_enrollment_payment );

            if($exist->count() > 0){

                // Actualizamos
                $row = $exist->first();
                $updated_by = '1';
                $update = EnrollmentPaymentFraccionado::findOrFail($row->id);
                $update->fill(compact('num_cuota', 'id_enrollment_payment', 'updated_by'))->save();
                $update->save();

            } else {

                // Registrar el número de cuotas
                $created_by = '1';
                EnrollmentPaymentFraccionado::create(compact('num_cuota', 'id_enrollment_payment', 'created_by'));

            }

            // los otros medios de pagos en la tabla
            // Condicional
            //


            // Condicional
        } else if($id_payment_method == 3){

            // Registramos el número de cuotas
            // los otros medios de pagos en la tabla
            // Fraccionado
            //

        }

    }

}
