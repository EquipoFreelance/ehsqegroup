<?php
/**
 * Created by PhpStorm.
 * User: JUAN
 * Date: 14/11/2016
 * Time: 12:43 AM
 */

namespace App\Repositories\Eloquents;


use App\Models\Enrollment;
use App\Repositories\Contracts\InterfaceRepository;

class EnrollmentRepository implements InterfaceRepository
{
    private $model;

    public function __construct()
    {
        $this->model =  new Enrollment();
    }

    // Get All Register
    public function getAll(){

    }

    // Find Register by Id
    public function getById( $id ){
        //$this->model->
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