<?php
namespace App\Repositories\Eloquents;

use App\Models\PaymentDetail;
use App\Repositories\Contracts\InterfaceRepository;

class PaymentDetailRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new PaymentDetail();
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

}