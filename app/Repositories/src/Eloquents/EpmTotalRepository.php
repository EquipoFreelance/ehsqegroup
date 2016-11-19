<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 14/11/2016
 * Time: 12:48 AM
 */

namespace App\Repositories\Eloquents;

use App\Models\EmpTotal;

use App\Repositories\Contracts\InterfaceRepository;

class EpmTotalRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new EmpTotal();
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

        return $this->model->where("id_epm", $id_epm )->first();

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


    // Delete Register by Id
    public function delete( $id ){

        $epm = $this->model->findOrFail($id);
        $epm->delete();

    }

    public function deleteIdEpm($id_epm){
        $epm = $this->model->where("id_epm", $id_epm );
        if($epm){
            return $epm->delete();
        }
    }

    /**
     * @param $epm_id
     * @param $id_payment_method
     * @return array
     */
    public function getConcepts($epm_id, $id_payment_method){

        $pct_repo     = new PaymentConceptTypeRepository();
        $concept_repo = new PaymentConceptRepository();

        $response_concepts = array();

        $epm_total = $this->getByIdEpm($epm_id);

        // Conceptos disponibles
        $concepts = $pct_repo->getConceptsByParameters($id_payment_method);

        // Lista de conceptos disponibles
        foreach ($concepts as $concept) {

            $concept_name =  $concept_repo->getById($concept->id_payment_concept);

            // Concepto: Pago Total
            if($concept->id_payment_concept == 9){

                // Adjutnamos los conceptos
                $response_concepts[] = array(
                    'concept_id'        => 0,
                    'concept_name'      => $concept_name->payment_concept_name,
                    'concept_amount'    => $epm_total->amount,
                    'concept_verifided' => false
                );
                break;

            }

        }

        return $response_concepts;

    }
}