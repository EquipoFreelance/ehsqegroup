<?php
namespace App\Repositories\Eloquents;

use App\Models\EnrollmentPaymentMethod;
use App\Repositories\Contracts\InterfaceRepository;

class EnrollmentPMRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new EnrollmentPaymentMethod();
    }

    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){

        //return $this->model->where("id", 25)->first();

    }

    // Find Register by Id
    public function getByIdEnrollment( $id_enrollment ){

        return $this->model->where("id_enrollment", $id_enrollment )->first();

    }
    
    // Create Register
    public function create( array $attribute){

        $epm_create = $this->model->create($attribute);
        $this->doneEPMDetail($epm_create->id, $attribute);
        return response()->json(array("data" => $epm_create->toArray(), "message" => "EL medio de pago fue registrado satisfactoriamente"), 200);

    }

    // Update Register by Id
    public function update( $id, array $attribute){

        $epm_update = $this->model->findOrFail($id);
        $epm_update->update($attribute);
        $this->doneEPMDetail($epm_update->id, $attribute);
        return response()->json(array("data" => $epm_update->toArray(), "message" => "EL medio de pago fue actualizado satisfactoriamente"), 200);

    }

    public function doneEPMDetail($id_epm, $attribute){

        $epm_repo_total     = new EpmTotalRepository();
        $epm_repo_fra       = new EpmFraccionadoRepository();
        $epm_repo_fra_otros = new EpmFraccionadoOtrosRepository();
        $epm_repo_con       = new EpmCondicionalRepository();

        $mp = $attribute['id_payment_method'];

        // Pago Total
        if($mp == 1){

            $epm = $epm_repo_total->getByIdEpm($id_epm);

            if(!$epm){

                // Nuevo registro de forma de pago
                $epm_repo_total->create(array(
                    'id_epm' => $id_epm,
                    'amount' => $attribute['amount'],
                    'active' => '1',
                ));


            } else {

                // Actualizando registro de forma de pago
                $epm_repo_total->update($epm->id, array(
                    'id_epm' => $id_epm,
                    'amount' => $attribute['amount']
                ));

            }

            // Elimnando formas de pagos registrados anteriormente
            $epm_repo_fra->deleteIdEpm($id_epm);
            $epm_repo_con->deleteIdEpm($id_epm);

        // Pago Fraccionado
        }else if($mp == 2){


            $epm = $epm_repo_fra->getByIdEpm($id_epm);

            if(!$epm){

                // Nuevo Registro freaccionado
                $create = $epm_repo_fra->create(array(
                    'id_epm'    => $id_epm,
                    'amount'    => $attribute['amount'],
                    'num_cuota' => $attribute['num_cuota'],
                    'active'    => '1',
                ));

                // Registrando Matricula
                $epm_repo_fra_otros->create(
                    array(
                        'id_epm_fra' => $create['id'],
                        'id_concept' => 1,
                        'amount'     => $attribute['amount_enrollment'],
                    )
                );

                // Registrando Certificado
                $epm_repo_fra_otros->create(
                    array(
                        'id_epm_fra' => $create['id'],
                        'id_concept' => 2,
                        'amount'     => $attribute['amount_certificate'],
                    )
                );

            } else {

                // Actualizando registro fraccionado
                $update = $epm_repo_fra->update($epm->id, array(
                    'amount'    => $attribute['amount'],
                    'num_cuota' => $attribute['num_cuota']
                ));

                // Actualizar el monto de la matricula
                if($attribute['amount_enrollment_id'] > 0){
                    $epm_repo_fra_otros->updateByIdEpmFra($update['id'], 1, array(
                        'amount' => $attribute['amount_enrollment']
                    ));
                }

                // Actualizar el monto del certificado
                if($attribute['amount_certificate_id'] > 0){
                    $epm_repo_fra_otros->updateByIdEpmFra($update['id'], 2, array(
                        'amount' => $attribute['amount_certificate']
                    ));
                }

            }

            // Elimnando formas de pagos registrados anteriormente
            $epm_repo_total->deleteIdEpm($id_epm);
            $epm_repo_con->deleteIdEpm($id_epm);

        // Pago Condicional
        } else if($mp == 3){


            $arr_condicional_date   = $attribute['condicional_date'];
            $arr_condicional_amount = $attribute['condicional_amount'];
            $arr_num_cuota          = $attribute['num_cuotas'];

            // Existe registro de pago condicional
            $epm_count = $epm_repo_con->getCountByIdEpm($id_epm);
            
            if( $epm_count > 0 ){

                foreach ($arr_num_cuota as $key => $num_cuota) {

                    $date       = ($arr_condicional_date[$key])? $arr_condicional_date[$key] : 0;
                    $amount     = ($arr_condicional_amount[$key])? $arr_condicional_amount[$key] : 0;

                    $epm_repo_con->updateByIdCuotaAndIdEpm($id_epm, $num_cuota, array(
                        'amount'    => $amount,
                        'num_cuota' => $num_cuota,
                        'date'      => $date
                    ));
                }


            } else {

                foreach ($arr_num_cuota as $key => $num_cuota) {

                    $date       = ($arr_condicional_date[$key])? $arr_condicional_date[$key] : 0;
                    $amount     = ($arr_condicional_amount[$key])? $arr_condicional_amount[$key] : 0;

                    $epm_repo_con->create(array(
                        'id_epm'    => $id_epm,
                        'amount'    => $amount,
                        'num_cuota' => $num_cuota,
                        'date'      => $date,
                        'active'    => '1',
                    ));
                }

            }

            // Elimnando formas de pagos registrados anteriormente
            $epm_repo_total->deleteIdEpm($id_epm);
            $epm_repo_fra->deleteIdEpm($id_epm);

        }

    }

    // Delete Register by Id
    public function delete( $id ){

    }
}