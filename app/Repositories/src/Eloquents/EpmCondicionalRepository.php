<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 14/11/2016
 * Time: 12:48 AM
 */

namespace App\Repositories\Eloquents;

use App\Models\EmpCondicional;
use App\Repositories\Contracts\InterfaceRepository;

class EpmCondicionalRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new EmpCondicional();
    }

    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){

        //return $this->model->find("id", 25)->first();

    }

    // Find Register by Id
    public function getByIdEpm( $id_epm ){
        return $this->model->where("id_epm", $id_epm )->get();
    }

    // Find Register by Id
    public function getCountByIdEpm( $id_epm ){
        return $this->model->where("id_epm", $id_epm )->count();
    }



    // Create Register
    public function create( array $attribute){

        $epm = $this->model->create($attribute);
        return response()->json(array("data" => $epm->toArray(), "message" => "El detalle del medio de pago fue registrado satisfactoriamente"), 200);

    }

    // Update Register by Id
    public function update( $id, array $attribute){

        $epm = $this->model->findOrFail($id);
        $epm->update($attribute);
        return response()->json(array("data" => $epm->toArray(), "message" => "El detalle del medio de pago fue actualizado satisfactoriamente"), 200);

    }

    // Update Register by Id
    public function updateByIdCuotaAndIdEpm( $id_epm, $num_cuota, array $attribute){

        $epm = $this->model->where("id_epm", $id_epm )->where("num_cuota", $num_cuota)->first();
        $epm->update($attribute);
        return response()->json(array("data" => $epm->toArray(), "message" => "El detalle del medio de pago fue actualizado satisfactoriamente"), 200);

    }

    // Delete Register by Id
    public function delete( $id ){

        $epm = $this->model->findOrFail($id);
        $epm->delete();

    }

    public function deleteIdEpm($id_epm){
        $epm = $this->model->where("id_epm", $id_epm );
        if($epm){
            $epm->delete();
        }
    }

    /**
     * @param $epm_id
     * @param $id_payment_method
     * @return array
     */
    public function getConcepts($epm_id, $id_payment_method){

        $concept_repo = new PaymentConceptRepository();

        $response_concepts = array();

        $epm_con = $this->getByIdEpm($epm_id);

        foreach ($epm_con as $condicional) {

            $concept_name =  $concept_repo->getById($condicional->id_concept);

            // Adjutnamos los conceptos
            $response_concepts[] = array(
                'id'                => 'idx'.$condicional->id_concept,
                'concept_id'        => $condicional->id_concept,
                'concept_name'      => $concept_name->payment_concept_name,
                'concept_amount'    => $condicional->amount,
                'concept_verifided' => 0
            );

        }

        return $response_concepts;

    }
}