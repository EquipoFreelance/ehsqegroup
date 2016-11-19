<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 14/11/2016
 * Time: 12:48 AM
 */

namespace App\Repositories\Eloquents;


use App\Models\EmpFraccionado;
use App\Repositories\Contracts\InterfaceRepository;

class EpmFraccionadoRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new EmpFraccionado();
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

        return $this->model->where("id_epm", $id_epm )->with('other_concepts')->first();

    }
    // Create Register
    public function create( array $attribute){

        $epm = $this->model->create($attribute);
        return $epm->toArray();

    }

    // Update Register by Id
    public function update( $id, array $attribute){

        $epm = $this->model->find($id);
        if($epm){
            $epm->update($attribute);
            return $epm->toArray();
        } else {
            return false;
        }

    }


    // Delete Register by Id
    public function delete( $id ){

        $epm = $this->model->findOrFail($id);
        $epm->delete();

    }

    public function deleteIdEpm($id_epm){
        $epm_repo_fra_otro =  new EpmFraccionadoOtrosRepository();
        $epm = $this->model->where("id_epm", $id_epm );
        if($epm){
            $first = $epm->first();
            if($first){
                $epm_repo_fra_otro->deleteIdEpm($first->id);
            }
            $epm->delete();
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

        $epm_fra = $this->getByIdEpm($epm_id);

        // Conceptos disponibles
        $concepts = $pct_repo->getConceptsByParameters($id_payment_method);

        // Lista de conceptos disponibles
        foreach ($concepts as $concept) {

            $concept_name =  $concept_repo->getById($concept->id_payment_concept);

            // Concepto: Cuota 1
            if($concept->id_payment_concept == 3){

                // Adjutnamos los conceptos
                $response_concepts[] = array(
                    'id'                => 'idx'+3,
                    'concept_id'        => 3,
                    'concept_name'      => $concept_name->payment_concept_name,
                    'concept_amount'    => $epm_fra->amount,
                    'concept_verifided' => 0
                );
                break;

            }


        }

        // Otros conceptos (Matricula o Certificado)
        $otros_conceptos = $epm_fra->other_concepts;

        // Concepto: Matricula
        // Concepto: Certificado
        foreach ($otros_conceptos as $otro_concepto) {

            $concept_name =  $concept_repo->getById($otro_concepto['id_concept']);

            // Adjutnamos los conceptos
            $response_concepts[] = array(
                'id'                => 'idx'.$otro_concepto['id_concept'],
                'concept_id'        => $otro_concepto['id_concept'],
                'concept_name'      => $concept_name->payment_concept_name,
                'concept_amount'    => $otro_concepto['amount'],
                'concept_verifided' => 0
            );

        }

        return $response_concepts;

    }
}