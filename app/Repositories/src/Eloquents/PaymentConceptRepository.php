<?php
namespace App\Repositories\Eloquents;

use App\Models\PaymentConcept;
use App\Repositories\Contracts\InterfaceRepository;

class PaymentConceptRepository implements InterfaceRepository
{

    private $model;

    public function __construct()
    {
        $this->model = new PaymentConcept();

    }

    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){
        return $this->model->find($id);
    }

    // Create Register
    public function create( array $attribute){

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

    }

    public function getByNameConcept($id){
        $concept = $this->model->find($id);
        return $concept->payment_concept_name;
    }
}