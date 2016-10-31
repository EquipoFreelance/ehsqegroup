<?php

namespace App\Repositories\Eloquents;

use App\Models\PaymentConceptType;
use App\Repositories\Contracts\InterfaceRepository;

class PaymentConceptTypeRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new PaymentConceptType();
    }


    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){

    }

    // Create Register
    public function create( array $attribute){

    }

    // Update Register by Id
    public function update( $id, array $attribute){

    }

    // Delete Register by Id
    public function delete( $id ){

    }

    // Obtiene los conceptos por parametros
    public function getConceptsByParameters($id_payment_type){
        
        $rs = $this->model->where("id_payment_type", $id_payment_type)->where("active", 1);//->with("attr_concept");

        if( $rs->count() ){

            return $rs->get();
            
        } else {

            return '';
        }

    }

}