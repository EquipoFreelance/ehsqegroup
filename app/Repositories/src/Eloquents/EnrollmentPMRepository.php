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

        return $this->model->find($id);

    }

    // Find Register by Id
    public function getByIdEnrollment( $id_enrollment ){

        return $this->model->where("id_enrollment", $id_enrollment )->first();

    }
    
    // Create Register
    public function create( array $attribute){

        $epm_create = $this->model->create($attribute);
        $this->doneEPMDetail($epm_create->id, $attribute);
        return response()->json(array("data" => $epm_create->toArray(), "message" => "El medio de pago fue registrado satisfactoriamente"), 200);

    }

    // Update Register by Id
    public function update( $id, array $attribute){

        $epm_update = $this->model->findOrFail($id);
        $epm_update->update($attribute);
        $this->doneEPMDetail($epm_update->id, $attribute);
        return response()->json(array("data" => $epm_update->toArray(), "message" => "El medio de pago fue actualizado satisfactoriamente"), 200);

    }

    public function doneEPMDetail($id_epm, $attribute){

        $epm_repo_total     = new EpmTotalRepository();
        $epm_repo_fra       = new EpmFraccionadoRepository();
        $epm_repo_fra_otros = new EpmFraccionadoOtrosRepository();
        $epm_repo_con       = new EpmCondicionalRepository();
        $epm_repo_becado    = new EpmBecadoRepository();
        $epm_repo_concept   = new EpmConceptRepository();

        $mp = $attribute['id_payment_method'];

        // Pago Total
        if($mp == 1){

            $epm_repo_concept->deleteByIdEpmByIdConcept($id_epm, [1,2,3]);

            $epm = $epm_repo_total->getByIdEpm($id_epm);

            $amount = $attribute['amount'];

            if(!$epm){

                // Registrando forma de pago
                $epm_repo_total->create(array(
                    'id_epm'     => $id_epm,
                    'id_concept' => 9,
                    'amount'     => $amount,
                    'active'     => '1',
                ));

                // Registrando concepto pago completo
                $epm_repo_concept->create(array(
                    'id_concept' => 9,
                    'id_epm'     => $id_epm,
                    'amount'     => $amount,
                    'active'     => 1
                ));

            } else {

                // Actualizando registro de forma de pago
                $epm_repo_total->update($epm->id, array(
                    'id_epm'     => $id_epm,
                    'id_concept' => 9,
                    'amount'     => $amount
                ));

                // Actualizando concepto pago completo
                $epm_concept = $epm_repo_concept->getByIdEpmByIdConcept($id_epm, 9);
                if($epm_concept){
                    $epm_repo_concept->update($epm_concept->id, array(
                        'amount'     => $amount
                    ));
                }

            }

            // Elimnando formas de pagos registrados anteriormente
            $epm_repo_fra->deleteIdEpm($id_epm);
            $epm_repo_con->deleteIdEpm($id_epm);
            $epm_repo_becado->deleteIdEpm($id_epm);

        // Pago Fraccionado
        }else if($mp == 2){

            $epm = $epm_repo_fra->getByIdEpm($id_epm);

            $epm_repo_concept->deleteByIdEpmByIdConcept($id_epm, [9]);

            if(!$epm){

                // Nuevo Registro freaccionado
                $create = $epm_repo_fra->create(array(
                    'id_epm'    => $id_epm,
                    'amount'    => $attribute['amount'],
                    'num_cuota' => $attribute['num_cuota'],
                    'active'    => '1',
                ));

                /* -- Agregando detalle a los forma de pago -- */

                // Matricula
                $epm_repo_fra_otros->create(
                    array(
                        'id_epm_fra' => $create['id'],
                        'id_concept' => 1,
                        'amount'     => $attribute['amount_enrollment'],
                    )
                );

                // Certificado
                $epm_repo_fra_otros->create(
                    array(
                        'id_epm_fra' => $create['id'],
                        'id_concept' => 2,
                        'amount'     => $attribute['amount_certificate'],
                    )
                );

                /* -- Agregando los conceptos -- */

                // Concepto Cuota 1
                $epm_repo_concept->create(array(
                    'id_concept' => 3,
                    'id_epm'     => $id_epm,
                    'amount'     => $attribute['amount'],
                    'active'     => 1
                ));

                // Concepto matricula
                $epm_repo_concept->create(array(
                    'id_concept' => 1,
                    'id_epm'     => $id_epm,
                    'amount'     => $attribute['amount_enrollment'],
                    'active'     => 1
                ));

                // Concepto certificado
                $epm_repo_concept->create(array(
                    'id_concept' => 2,
                    'id_epm'     => $id_epm,
                    'amount'     => $attribute['amount_certificate'],
                    'active'     => 1
                ));


            } else {

                /* -- Actualizando registro de la forma de pago -- */

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

                /* -- Actualizando los conceptos -- */

                // Actualizando concepto cuota 1
                $epm_concept = $epm_repo_concept->getByIdEpmByIdConcept($id_epm, 3);

                if($epm_concept){

                    $epm_repo_concept->update($epm_concept->id, array(
                        'amount'     => $attribute['amount']
                    ));

                }else{

                    $epm_repo_concept->create(array(
                        'id_concept' => 3,
                        'id_epm'     => $id_epm,
                        'amount'     => $attribute['amount'],
                        'active'     => 1
                    ));

                }

                // Actualizando concepto matricula
                $epm_concept = $epm_repo_concept->getByIdEpmByIdConcept($id_epm, 1);
                if($epm_concept){
                    $epm_repo_concept->update($epm_concept->id, array(
                        'amount'     => $attribute['amount_enrollment']
                    ));
                }

                // Actualizando concepto certificado
                $epm_concept = $epm_repo_concept->getByIdEpmByIdConcept($id_epm, 2);
                if($epm_concept){
                    $epm_repo_concept->update($epm_concept->id, array(
                        'amount'     => $attribute['amount_certificate']
                    ));
                }

            }

            // Elimnando formas de pagos registrados anteriormente
            $epm_repo_total->deleteIdEpm($id_epm);
            $epm_repo_con->deleteIdEpm($id_epm);
            $epm_repo_becado->deleteIdEpm($id_epm);

        // Pago Condicional
        } else if($mp == 3){

            $arr_condicional_date   = $attribute['condicional_date'];
            $arr_condicional_amount = $attribute['condicional_amount'];
            $arr_num_cuota          = $attribute['num_cuotas'];
            $arr_concepts           = $attribute['condicional_concept_id'];


            $epm_repo_concept->deleteByIdEpmByIdConcept($id_epm, [9,1,2,3]);

            // Existe registro de pago condicional
            $epm_count = $epm_repo_con->getCountByIdEpm($id_epm);
            
            if( $epm_count > 0 ){

                foreach ($arr_num_cuota as $key => $num_cuota) {

                    $date       = ($arr_condicional_date[$key])? $arr_condicional_date[$key] : 0;
                    $amount     = ($arr_condicional_amount[$key])? $arr_condicional_amount[$key] : 0;
                    $concept    = ($arr_concepts[$key])? $arr_concepts[$key] : 0;

                    $epm_repo_con->updateByIdCuotaAndIdEpm($id_epm, $num_cuota, array(
                        'amount'     => $amount,
                        'id_concept' => $concept,
                        'num_cuota'  => $num_cuota,
                        'date'       => $date
                    ));
                }


                // Actualizando concepto cuota 1
                $epm_concept = $epm_repo_concept->getByIdEpmByIdConcept($id_epm, 3);
                if($epm_concept){
                    $epm_repo_concept->update($epm_concept->id, array(
                        'amount'     => $arr_condicional_amount[0]
                    ));
                }


            } else {

                foreach ($arr_num_cuota as $key => $num_cuota) {

                    $date       = ($arr_condicional_date[$key])? $arr_condicional_date[$key] : 0;
                    $amount     = ($arr_condicional_amount[$key])? $arr_condicional_amount[$key] : 0;
                    $concept     = ($arr_concepts[$key])? $arr_concepts[$key] : 0;

                    $epm_repo_con->create(array(
                        'id_epm'     => $id_epm,
                        'id_concept' => $concept,
                        'amount'     => $amount,
                        'num_cuota'  => $num_cuota,
                        'date'       => $date,
                        'active'     => '1',
                    ));
                }

                // Registrando concepto cuota 1
                $epm_repo_concept->create(array(
                    'id_concept' => 3,
                    'id_epm'     => $id_epm,
                    'amount'     => $arr_condicional_amount[0],
                    'active'     => 1
                ));
            }

            // Elimnando formas de pagos registrados anteriormente
            $epm_repo_total->deleteIdEpm($id_epm);
            $epm_repo_fra->deleteIdEpm($id_epm);
            $epm_repo_becado->deleteIdEpm($id_epm);

        // Becado
        } else if( $mp == 4 ){

            $epm = $epm_repo_becado->getByIdEpm($id_epm);

            if(!$epm){

                // Nuevo Registro becado
                $epm_repo_becado->create(array(
                    'id_epm'    => $id_epm,
                    'amount'    => 0,
                    'active'    => '1',
                ));


            } else {

                // Actualizando registro de forma de pago
                $epm_repo_becado->update($epm->id, array(
                    'id_epm'     => $id_epm
                ));

            }

            // Elimnando formas de pagos registrados anteriormente
            $epm_repo_total->deleteIdEpm($id_epm);
            $epm_repo_fra->deleteIdEpm($id_epm);
            $epm_repo_con->deleteIdEpm($id_epm);
        }

    }

    // Delete Register by Id
    public function delete( $id ){

    }
}