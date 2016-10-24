<?php
namespace App\Repositories\Eloquents;

use App\Models\Payment;
use App\Repositories\Contracts\InterfaceRepository;

class PaymentRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Payment();
    }


    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){

    }

    // Create Register
    public function create( array $attribute){
        return Payment::create($attribute);
    }

    // Update Register by Id
    public function update( $id, array $attribute){

    }

    // Delete Register by Id
    public function delete( $id ){

    }

}