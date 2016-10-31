<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 30/10/2016
 * Time: 10:12 PM
 */

namespace App\Repositories\Eloquents;

use App\Models\EnrollmentPaymentConcept;

use App\Repositories\Contracts\InterfaceRepository;

class EnrollmentPaymentConceptRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {

        $this->model =  new EnrollmentPaymentConcept();

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
        $todo = $this->model->findOrFail($id);
        $todo->update($attribute);
        return $todo;
    }

    // Delete Register by Id
    public function delete( $id ){

    }


    public function countByEnrollment($id_enrollment){
        return $this->model->where("id_enrollment", $id_enrollment)->count();
    }
    public function deleteAllByEnrollment($id_enrollment){
        $rs = $this->model->where("id_enrollment", $id_enrollment);
        return $rs->delete();
    }

    // Muestra los conceptos registrados por matricula
    public function getPaymentConcepts($id_enrollment){

        $rs = $this->model->where("id_enrollment", $id_enrollment);
        return $rs->get();

    }
}