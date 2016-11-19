<?php
namespace App\Repositories\Eloquents;

use App\Models\PaymentDetail;
use App\Repositories\Contracts\InterfaceRepository;

use Auth;
use Carbon\Carbon;

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
        return $this->model->create($attribute);
    }

    // Update Register by Id
    public function update( $id, array $attribute){
        $update = $this->model->find($id);
        $update->verified_at = Carbon::now();
        $update->verified_by = \Auth::user()->id;
        $update->update($attribute);
        return $update;
    }

    // Delete Register by Id
    public function delete( $id ){
        $todo = $this->model->findOrFail($id);
        $todo->delete();
        return true;
    }

}