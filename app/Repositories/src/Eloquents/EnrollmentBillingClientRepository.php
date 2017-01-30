<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 18/11/2016
 * Time: 03:49 PM
 */

namespace App\Repositories\Eloquents;

use App\Models\EnrollmentBillingClient;
use App\Repositories\Contracts\InterfaceRepository;

class EnrollmentBillingClientRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new EnrollmentBillingClient();
    }


    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){
        $find = $this->model->find($id);
        return $find->toArray();
    }

    // Find Register by Id
    public function getByIdEnrollment($id_enrollment){
        return $this->model->where("id_enrollment", $id_enrollment )->first();
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

    public function getValidateTypeDoc($ruc){

        $type_doc = "";

        if($ruc){

            $type_doc = "Factura";

        } else {

            $type_doc = "Boleta";

        }

        return $type_doc;

    }

}