<?php

namespace App\Http\Controllers\WebService;

use App\Libraries\Payment\Payment;
use App\Models\EnrollmentPaymentConcept;
use App\Models\EnrollmentPaymentCondicional;
use App\Models\EnrollmentPaymentFraccionado;
use App\Repositories\Eloquents\EnrollmentPaymentConceptRepository;
use App\Repositories\Eloquents\EnrollmentPMRepository;
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
            
            $epm_repo = new EnrollmentPMRepository();
            
            // Buscar forma de pago
            $epm = $epm_repo->getByIdEnrollment(25);

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
     * Actualización del medio de pagos
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    /*public function update(Request $request, $id){

        $student_payment = EnrollmentPaymentMethod::findOrFail($id);
        $student_payment->fill($request->all())->save();
        return response()->json(array("data" => $student_payment->toArray(), "message" => "EL medio de pago fue actualizado satisfactoriamente"), 200);

    }*/

    /**
     * @param $id_enrollment
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id_enrollment){

        $rs = EnrollmentPaymentMethod::where("id_enrollment", $id_enrollment);
        if($rs){

            $data = $rs->first();
            if($data){
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


    }

    /**
     * Actualización del detalle de la forma de pago
     * @param $id_enrollment_payment
     * @param Request $request
     */
    public function store_payment_method_detail($id_enrollment_payment, Request $request){
        
        $id_payment_method = $request->get("id_payment_method"); // Forma de Pago
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
    
    
    
    
    public function storeEnrollmentPayment(Request $request){

        // Consultar la tabla de formas de pago
        $repo_concept_type = new PaymentConceptTypeRepository();
        $repo_enrollment   = new EnrollmentPaymentConceptRepository();

        $id_enrollment     = $request->get('id_enrollment');
        $id_payment_method = $request->get('id_payment_method');

        if( $repo_enrollment->countByEnrollment($id_enrollment) > 0){
            $repo_enrollment->deleteAllByEnrollment($id_enrollment);
        }

        $rows = $repo_concept_type->getConceptsByParameters($id_payment_method);
        foreach ($rows as $item) {
            $repo_enrollment->create([
                'amount'                    => 0,
                'id_enrollment'             => $request->get('id_enrollment'),
                'id_concept_payment_type'   => $item->id_payment_concept,
                'active'                    => 0
            ]);
        }

        return response()->json(array("message" => "Los conceptos se registraron satisfactoriamente"), 200);

    }
    
    public function updateEnrollmentPayment($request){

        $repo_enrollment   = new EnrollmentPaymentConceptRepository();

        $n             = -1;
        $ids           = $request->get('enrollment_concept_id');      // Matricula id del concepto
        $amounts       = $request->get('enrollment_concept_amount');  // Matricula monto del concepto

        foreach ($ids as $item) {
            $n = $n + 1;
            $repo_enrollment->update($ids[$n], [
                'amount'     => $amounts[$n]
            ]);
        }
        
    }
}
