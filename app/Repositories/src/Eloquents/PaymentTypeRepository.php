<?php
namespace App\Repositories\Eloquents;

use App\Models\Payment;
use App\PaymentType;
use App\Repositories\Contracts\InterfaceRepository;

class PaymentTypeRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new PaymentType();
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

    public function getNameById($id){

        $pmt = $this->model->find($id);
        return $pmt->payment_type_name;

    }

    public function getCount($id){
        return $this->model->find($id)->count();
    }

}