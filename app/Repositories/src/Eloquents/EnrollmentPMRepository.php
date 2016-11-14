<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 14/11/2016
 * Time: 12:48 AM
 */

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
    public function getByIdEnrollment( $id ){

        return $this->model->where("id_enrollment", $id )->first();

    }
    // Create Register
    public function create( array $attribute){

        $epm_create = $this->model->create($attribute);
        return response()->json(array("data" => $epm_create->toArray(), "message" => "EL medio de pago fue registrado satisfactoriamente"), 200);

    }

    // Update Register by Id
    public function update( $id, array $attribute){

        $epm_update = $this->model->findOrFail($id);
        $epm_update->update($attribute);
        $this->createEPMDetail($epm_update->id, $attribute);
        return response()->json(array("data" => $epm_update->toArray(), "message" => "EL medio de pago fue actualizado satisfactoriamente"), 200);

    }

    public function createEPMDetail($id_epm, $attribute){

        $epm_repo_total = new EpmTotalRepository();
        $epm_repo_fra   = new EpmFraccionadoRepository();
        $epm_repo_con   = new EpmCondicionalRepository();

        $mp = $attribute['id_payment_method'];

        // Pago Total
        if($mp == 1){

            
            $epm = $epm_repo_total->getByIdEpm($mp);

            if($epm){

                $epm_repo_total->update($epm->id, array(
                    'id_epm' => $id_epm,
                    'amount' => $attribute['amount']
                ));

            } else {

                $epm_repo_total->create(array(
                    'id_epm' => $id_epm,
                    'amount' => $attribute['amount'],
                    'active' => '1',
                ));

            }

            $epm_repo_fra->deleteIdEpm($id_epm);
            $epm_repo_con->deleteIdEpm($id_epm);

        // Pago Fraccionado
        }else if($mp == 2){


            $epm = $epm_repo_fra->getByIdEpm($mp);

            if($epm){

                $epm_repo_fra->update($epm->id, array(
                    'amount'    => $attribute['amount'],
                    'num_cuota' => $attribute['num_cuota']
                ));

            } else {

                $epm_repo_fra->create(array(
                    'id_epm'    => $id_epm,
                    'amount'    => $attribute['amount'],
                    'num_cuota' => $attribute['num_cuota'],
                    'active'    => '1',
                ));

            }

            $epm_repo_total->deleteIdEpm($id_epm);
            $epm_repo_con->deleteIdEpm($id_epm);

        // Pago Condicional
        } else if($mp == 3){

            $arr_condicional_date   = $attribute['condicional_date'];
            $arr_condicional_amount = $attribute['condicional_amount'];
            $arr_num_cuota          = $attribute['num_cuotas'];

            $epm = $epm_repo_con->getByIdEpm($id_epm);
            
            if($epm > 0){

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

            $epm_repo_total->deleteIdEpm($id_epm);
            $epm_repo_fra->deleteIdEpm($id_epm);

        }

    }

    // Delete Register by Id
    public function delete( $id ){

    }
}