<?php

namespace App\Http\Controllers\WebService;

use App\Libraries\Payment\Payment;
use App\Models\EnrollmentPaymentCondicional;
use App\Models\EnrollmentPaymentFraccionado;
use App\Repositories\Eloquents\PaymentConceptTypeRepository;
use App\Repositories\Eloquents\PaymentDetailRepository;
use App\Repositories\Eloquents\PaymentRepository;
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
                
                $this->store_payment($request);
                
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

            // Pago Fraccionado
            if($data->id_payment_method == 2){

                // Existe algun registro con el id del medio de pago registrado
                $row = EnrollmentPaymentFraccionado::where("id_enrollment_payment", $data->id );

                $data->fraccionado = $row->first();

            // Condicional
            } else if($data->id_payment_method == 3) {

                $row = EnrollmentPaymentCondicional::where("id_enrollment_payment", $data->id );

                $data->condicional = $row->get();

            }

            return response()->json($data->toArray(), 200);
        }


    }

    /**
     * @param $id_enrollment_payment
     * @param Request $request
     */
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


            } else {

                // Registrar el número de cuotas
                $created_by = '1';
                EnrollmentPaymentFraccionado::create(compact('num_cuota', 'id_enrollment_payment', 'created_by'));

            }

            // Verificamo si existe registro en la tabla de medio de pago condicional
            $rs_condicional = EnrollmentPaymentCondicional::where("id_enrollment_payment", $id_enrollment_payment );
            if($rs_condicional->count() > 0){
                // Eliminamo
                $rs_condicional->delete();
            }


        // Condicional
        } else if($id_payment_method == 3){

            $arr_condicional_date   = $request->get("condicional_date");
            $arr_condicional_amount = $request->get("condicional_amount");
            $arr_num_cuota          = $request->get("num_cuotas");

            // Existe algun registro con el id del medio de pago registrado
            $exist = EnrollmentPaymentCondicional::where("id_enrollment_payment", $id_enrollment_payment );

            if($exist->count() > 0){

                // Actualizamos
                $rows       = $exist->get();
                $updated_by = '1';

                foreach ($rows as $key => $value) {

                    $key = array_search($value->num_cuota, $arr_num_cuota);

                    $update = EnrollmentPaymentCondicional::findOrFail($value->id);
                    $update->fill(
                        array(
                            "amount"     => $arr_condicional_amount[$key],
                            "date"       => $arr_condicional_date[$key],
                            "updated_by" => $updated_by
                        )
                    )->save();


                }


            } else {

                // Registrar el número de cuotas
                $created_by             = '1';
                foreach ($arr_num_cuota as $key => $num_cuota) {

                    $date       = ($arr_condicional_date[$key])? $arr_condicional_date[$key] : 0;
                    $amount     = ($arr_condicional_amount[$key])? $arr_condicional_amount[$key] : 0;
                    EnrollmentPaymentCondicional::create(compact('amount', 'date', 'id_enrollment_payment', 'num_cuota', 'created_by'));

                }
            }


            // Verificamo si existe registro en la tabla de medio de pago condicional
            $rs_fraccionado = EnrollmentPaymentFraccionado::where("id_enrollment_payment", $id_enrollment_payment );
            if($rs_fraccionado->count() > 0){
                // Eliminamo
                $rs_fraccionado->delete();
            }

        }

    }

    public function store_payment(Request $request){

        $concept_id    = $request->get('concept_id_concept');
        $concept_price = $request->get('concept_price');

        $amount = 0;
        foreach ($concept_price as $item) {
            $amount = $amount + $item;
        }

        $pay = new PaymentRepository();
        $create = $pay->create([
            'amount'            => $amount,
            'id_enrollment'     => $request->get('id_enrollment'),
            'id_payment_type'   => $request->get('id_payment_method'),
            'active'            => 1
        ]);

        $n = - 1;
        $detail = new PaymentDetailRepository();
        foreach ($concept_id as $item) {
            $n = $n + 1;
            $detail->create([
                'id_payment' => $create['id'],
                'price'      => $concept_price[$n],
                'id_concept' => $item,
                'quantity'   => 1,
                'active'     => 1
            ]);
        }



    }

    
}
