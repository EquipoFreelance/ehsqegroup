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
        $todo = $this->model->findOrFail($id);
        $todo->update($attribute);
        return $todo->toArray();
    }

    // Delete Register by Id
    public function delete( $id ){

    }

    public function getPayments($id_enrollment){

        //, $id_payment_type
        // ->where("id_payment_type", $id_payment_type)
        $rs = Payment::where("id_enrollment", $id_enrollment)->with("payment_detail");//->with("payment_detail.attr_concept"); //->where("active", 0)
        return $rs;

    }

    public function getCount($id){
        return $this->model->find($id)->count();
    }

}